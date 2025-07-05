#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
تطبيق Flask الرئيسي
Main Flask Application
"""

from flask import Flask, render_template, request, jsonify, session, redirect, url_for
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager, UserMixin, login_user, logout_user, login_required, current_user
from werkzeug.security import generate_password_hash, check_password_hash
import os
from datetime import datetime
import json

# إنشاء تطبيق Flask
app = Flask(__name__)
app.config['SECRET_KEY'] = 'your-secret-key-here'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///dev_workspace.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

# إنشاء قاعدة البيانات
db = SQLAlchemy(app)

# إعداد نظام تسجيل الدخول
login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'

# نموذج المستخدم
class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password_hash = db.Column(db.String(120), nullable=False)
    full_name = db.Column(db.String(100))
    role = db.Column(db.String(20), default='user')
    created_at = db.Column(db.DateTime, default=datetime.utcnow)
    
    def set_password(self, password):
        self.password_hash = generate_password_hash(password)
    
    def check_password(self, password):
        return check_password_hash(self.password_hash, password)

# نموذج المنشور
class Post(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(200), nullable=False)
    content = db.Column(db.Text)
    author_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    status = db.Column(db.String(20), default='draft')
    created_at = db.Column(db.DateTime, default=datetime.utcnow)
    updated_at = db.Column(db.DateTime, default=datetime.utcnow, onupdate=datetime.utcnow)

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

# الصفحة الرئيسية
@app.route('/')
def home():
    return render_template('home.html', title='الرئيسية')

# صفحة تسجيل الدخول
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        
        user = User.query.filter_by(username=username).first()
        if user and user.check_password(password):
            login_user(user)
            return redirect(url_for('dashboard'))
        else:
            return render_template('login.html', error='بيانات غير صحيحة')
    
    return render_template('login.html')

# صفحة التسجيل
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form.get('username')
        email = request.form.get('email')
        password = request.form.get('password')
        
        if User.query.filter_by(username=username).first():
            return render_template('register.html', error='اسم المستخدم موجود مسبقاً')
        
        if User.query.filter_by(email=email).first():
            return render_template('register.html', error='البريد الإلكتروني موجود مسبقاً')
        
        user = User(username=username, email=email)
        user.set_password(password)
        db.session.add(user)
        db.session.commit()
        
        return redirect(url_for('login'))
    
    return render_template('register.html')

# لوحة التحكم
@app.route('/dashboard')
@login_required
def dashboard():
    posts = Post.query.filter_by(author_id=current_user.id).all()
    return render_template('dashboard.html', posts=posts)

# تسجيل الخروج
@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('home'))

# API للمستخدمين
@app.route('/api/users', methods=['GET'])
def get_users():
    users = User.query.all()
    return jsonify([{
        'id': user.id,
        'username': user.username,
        'email': user.email,
        'role': user.role
    } for user in users])

# API للمنشورات
@app.route('/api/posts', methods=['GET', 'POST'])
def api_posts():
    if request.method == 'GET':
        posts = Post.query.all()
        return jsonify([{
            'id': post.id,
            'title': post.title,
            'content': post.content,
            'status': post.status,
            'created_at': post.created_at.isoformat()
        } for post in posts])
    
    elif request.method == 'POST':
        data = request.get_json()
        post = Post(
            title=data['title'],
            content=data['content'],
            author_id=current_user.id if current_user.is_authenticated else 1
        )
        db.session.add(post)
        db.session.commit()
        return jsonify({'success': True, 'id': post.id})

# صفحة حول التطبيق
@app.route('/about')
def about():
    return render_template('about.html', title='حول التطبيق')

# صفحة الاتصال
@app.route('/contact', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        name = request.form.get('name')
        email = request.form.get('email')
        message = request.form.get('message')
        
        # هنا يمكن إرسال البريد الإلكتروني
        return render_template('contact.html', success=True)
    
    return render_template('contact.html', title='اتصل بنا')

# معالج الأخطاء 404
@app.errorhandler(404)
def not_found_error(error):
    return render_template('404.html'), 404

# معالج الأخطاء 500
@app.errorhandler(500)
def internal_error(error):
    db.session.rollback()
    return render_template('500.html'), 500

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True, host='0.0.0.0', port=5000) 