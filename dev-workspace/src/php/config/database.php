<?php
/**
 * ملف اتصال قاعدة البيانات
 * Database Connection File
 */

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset;
    private $conn;
    
    public function __construct() {
        $this->host = DB_HOST;
        $this->db_name = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->charset = DB_CHARSET;
    }
    
    /**
     * إنشاء اتصال بقاعدة البيانات
     */
    public function getConnection() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $exception) {
            if (DEBUG_MODE) {
                echo "خطأ في الاتصال: " . $exception->getMessage();
            } else {
                error_log("Database connection error: " . $exception->getMessage());
            }
        }
        
        return $this->conn;
    }
    
    /**
     * إغلاق الاتصال
     */
    public function closeConnection() {
        $this->conn = null;
    }
    
    /**
     * تنفيذ استعلام
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            if (DEBUG_MODE) {
                throw $e;
            } else {
                error_log("Query error: " . $e->getMessage());
                return false;
            }
        }
    }
    
    /**
     * جلب صف واحد
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->fetch() : false;
    }
    
    /**
     * جلب جميع الصفوف
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->fetchAll() : false;
    }
    
    /**
     * إدراج بيانات
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this->query($sql, $data);
        return $stmt ? $this->conn->lastInsertId() : false;
    }
    
    /**
     * تحديث بيانات
     */
    public function update($table, $data, $where, $whereParams = []) {
        $setParts = [];
        foreach (array_keys($data) as $column) {
            $setParts[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";
        $params = array_merge($data, $whereParams);
        
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : false;
    }
    
    /**
     * حذف بيانات
     */
    public function delete($table, $where, $params = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : false;
    }
    
    /**
     * التحقق من وجود جدول
     */
    public function tableExists($table) {
        $sql = "SHOW TABLES LIKE :table";
        $result = $this->fetchOne($sql, ['table' => $table]);
        return $result !== false;
    }
    
    /**
     * إنشاء الجداول الأساسية
     */
    public function createTables() {
        // جدول المستخدمين
        $usersTable = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                full_name VARCHAR(100),
                role ENUM('admin', 'user') DEFAULT 'user',
                status ENUM('active', 'inactive') DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        // جدول المنشورات
        $postsTable = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(200) NOT NULL,
                content TEXT,
                author_id INT,
                status ENUM('published', 'draft') DEFAULT 'draft',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        // جدول الجلسات
        $sessionsTable = "
            CREATE TABLE IF NOT EXISTS sessions (
                id VARCHAR(128) PRIMARY KEY,
                user_id INT,
                data TEXT,
                expires_at TIMESTAMP,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        try {
            $this->query($usersTable);
            $this->query($postsTable);
            $this->query($sessionsTable);
            return true;
        } catch(Exception $e) {
            if (DEBUG_MODE) {
                echo "خطأ في إنشاء الجداول: " . $e->getMessage();
            }
            return false;
        }
    }
}

// إنشاء مثيل قاعدة البيانات
$database = new Database();
$db = $database->getConnection();

// إنشاء الجداول إذا لم تكن موجودة
if ($db) {
    $database->createTables();
}
?> 