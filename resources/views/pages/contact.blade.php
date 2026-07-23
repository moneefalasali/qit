@extends('layouts.app')

@section('title', 'تواصل معنا - قطاف القصيم')

@section('styles')
<style>
    .contact-container {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .contact-header h1 {
        font-size: 36px;
        color: var(--primary-green);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .contact-header p {
        font-size: 16px;
        color: var(--light-text);
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-form {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
        background-color: #f9ebd6;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: greenyellow;
        box-shadow: 0 0 5px rgba(45, 80, 22, 0.2);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: goldenrod;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .info-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .info-card h3 {
        color: var(--primary-green);
        margin-bottom: 15px;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-card p {
        color: var(--light-text);
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .info-card a {
        color: var(--primary-green);
        text-decoration: none;
    }

    .info-card a:hover {
        text-decoration: underline;
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        background-color: whitesmoke;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .social-link:hover {
        background-color: black;
    }

    .map-container {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .map {
        width: 100%;
        height: 300px;
        background-color: #e8dcc8;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    @media (max-width: 768px) {
        .contact-content {
            grid-template-columns: 1fr;
        }

        .contact-header h1 {
            font-size: 28px;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h1>تواصل معنا</h1>
        <p>نحن هنا للإجابة على جميع استفساراتك</p>
    </div>

    <div class="contact-content">
        <div class="contact-form">
            <h2 style="color: var(--primary-green); margin-bottom: 20px;">أرسل لنا رسالة</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf

                <div class="form-group">
                    <label for="name">الاسم الكامل</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>

                <div class="form-group">
                    <label for="subject">الموضوع</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                </div>

                <div class="form-group">
                    <label for="message">الرسالة</label>
                    <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="submit-btn">إرسال الرسالة</button>
            </form>
        </div>

        <div class="contact-info">
            <div class="info-card">
                <h3>
                    <i class="fas fa-map-marker-alt"></i>
                    عنواننا
                </h3>
                <p>منطقة القصيم</p>
                <p>المملكة العربية السعودية</p>
            </div>

            <div class="info-card">
                <h3>
                    <i class="fas fa-phone"></i>
                    رقم الهاتف
                </h3>
                <p><a href="tel:+966501234567">+966 50 123 4567</a></p>
                <p><a href="tel:+966163334444">+966 16 333 4444</a></p>
            </div>

            <div class="info-card">
                <h3>
                    <i class="fas fa-envelope"></i>
                    البريد الإلكتروني
                </h3>
                <p><a href="mailto:info@qitafalqassim.sa">info@qitafalqassim.sa</a></p>
                <p><a href="mailto:support@qitafalqassim.sa">support@qitafalqassim.sa</a></p>
            </div>

            <div class="info-card">
                <h3>
                    <i class="fas fa-clock"></i>
                    ساعات العمل
                </h3>
                <p>السبت - الخميس: 08:00 صباحاً - 08:00 مساءً</p>
                <p>الجمعة: 04:00 مساءً - 08:00 مساءً</p>
            </div>

            <div class="info-card">
                <h3>
                    <i class="fas fa-share-alt"></i>
                    تابعنا
                </h3>
                <div class="social-links">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" rel="noopener" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/966501234567" target="_blank" rel="noopener" class="social-link" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="map-container" style="margin-top: 40px;">
        <h2 style="color: var(--primary-green); margin-bottom: 15px;">موقعنا</h2>
        <div class="map">
            <i class="fas fa-map"></i>
        </div>
    </div>
</div>
@endsection
