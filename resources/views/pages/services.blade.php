@extends('layouts.app')

@section('title', 'الخدمات - قطاف القصيم')

@section('styles')
<style>
    .services-hero {
        position: relative;
        background: url('/images/hero_palm_farm.jpg') center/cover no-repeat;
        color: white;
        padding: 20px 20px;
        text-align: right;
        overflow: hidden;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(-20deg, rgba(254, 252, 240, 0.9) 0%, rgba(254, 253, 245, 0.7) 45%, rgba(247, 239, 239, 0.2) 50%);
        z-index: 0;
    }

    .services-hero > * {
        position: relative;
        z-index: 1;
    }

    .services-hero h1 {
        font-size: 42px;
        margin-bottom: 15px;
        font-weight: 800;
        color: #036403;
    }

    .services-hero p {
        font-size: 18px;
        color: #d89f02;
        font-weight: 600;
    }

    .services-section {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .section-title {
        font-size: 32px;
        color: #b38d06;
        margin-bottom: 40px;
        text-align: center;
        font-weight: 700;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .service-card {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .service-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .service-content {
        padding: 25px;
    }

    .service-content h3 {
        color: var(--primary-green);
        margin-bottom: 15px;
        font-size: 18px;
    }

    .service-content p {
        color: var(--light-text);
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .service-features {
        list-style: none;
        margin-bottom: 15px;
    }

    .service-features li {
        padding: 8px 0;
        color: var(--light-text);
        font-size: 14px;
        padding-right: 20px;
        position: relative;
    }

    .service-features li:before {
        content: "✓";
        position: absolute;
        right: 0;
        color: var(--primary-green);
        font-weight: 700;
    }

    .service-btn {
        display: inline-block;
        background-color:goldenrod;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
        font-weight: 600;
    }

    .service-btn:hover {
        background-color:green;
    }

    .process-section {
        background-color: #f9f7f4;
        padding: 40px;
        border-radius: 10px;
        margin: 60px 0;
    }

    .process-section .section-title {
        color: #000000;
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin-top: 40px;
        
    }

    .process-step {
        text-align: center;
        packground-color: goldenrod;
    }

    .step-number {
        width: 50px;
        height: 50px;
        background-color: var(--primary-green);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        margin: 0 auto 15px;
    }

    .process-step h4 {
        color: var(--primary-green);
        margin-bottom: 10px;
    }

    .process-step p {
        color: var(--light-text);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .services-hero h1 {
            font-size: 28px;
        }

        .section-title {
            font-size: 24px;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<section class="services-hero">
    <h1>خدماتنا</h1>
    <p>مجموعة شاملة من الخدمات الزراعية المتخصصة</p>
</section>

<section class="services-section">
    <h2 class="section-title">الخدمات الرئيسية</h2>
    <div class="services-grid">
        <div class="service-card">
            <img src="{{ asset('images/date_harvesting.jpg') }}" alt="جني التمور" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>جني التمور</h3>
                <p>خدمة متخصصة في جني التمور بكفاءة واحترافية عالية</p>
                <ul class="service-features">
                    <li>عمال مدربون ومعتمدون</li>
                    <li>معدات حديثة وآمنة</li>
                    <li>سرعة وكفاءة عالية</li>
                    <li>ضمان جودة العمل</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>

        <div class="service-card">
            <img src="{{ asset('images/palm_pollination.jpg') }}" alt="تلقيح النخيل" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>تلقيح النخيل</h3>
                <p>خدمات تلقيح النخيل بأحدث الطرق والتقنيات</p>
                <ul class="service-features">
                    <li>متخصصون في التلقيح</li>
                    <li>أوقات محددة بدقة</li>
                    <li>معدات متطورة</li>
                    <li>نتائج مضمونة</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>

        <div class="service-card">
            <img src="{{ asset('images/palm_pruning.jpg') }}" alt="تقليم النخيل" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>تقليم النخيل</h3>
                <p>تقليم احترافي لضمان صحة وإنتاجية النخيل</p>
                <ul class="service-features">
                    <li>خبرة طويلة في التقليم</li>
                    <li>تقليم صحي وآمن</li>
                    <li>تحسين الإنتاجية</li>
                    <li>الحفاظ على صحة النخيل</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>

        <div class="service-card">
            <img src="{{ asset('images/palm_irrigation.jpg') }}" alt="الري والعناية" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>الري والعناية</h3>
                <p>خدمات الري والعناية الدورية للنخيل</p>
                <ul class="service-features">
                    <li>جدول ري منتظم</li>
                    <li>عناية شاملة</li>
                    <li>مكافحة الآفات</li>
                    <li>تسميد متوازن</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>

        <div class="service-card">
            <img src="{{ asset('images/date_sorting.jpg') }}" alt="الفرز والتعبئة" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>الفرز والتعبئة</h3>
                <p>فرز وتعبئة التمور بمعايير جودة عالية</p>
                <ul class="service-features">
                    <li>فرز دقيق حسب الجودة</li>
                    <li>تعبئة احترافية</li>
                    <li>معايير صحية</li>
                    <li>عبوات متنوعة</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>

        <div class="service-card">
            <img src="{{ asset('images/date_transport.jpg') }}" alt="تحميل ونقل" class="service-image" loading="lazy">
            <div class="service-content">
                <h3>تحميل ونقل</h3>
                <p>خدمات تحميل ونقل المحصول بأمان</p>
                <ul class="service-features">
                    <li>تحميل احترافي</li>
                    <li>نقل آمن</li>
                    <li>مركبات مجهزة</li>
                    <li>توصيل سريع</li>
                </ul>
                <a href="/request-labor" class="service-btn">طلب الخدمة</a>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="process-section">
        <h2 class="section-title">كيفية الحصول على الخدمة</h2>
        <div class="process-grid">
            <div class="process-step">
                <div class="step-number">1</div>
                <h4>تسجيل الطلب</h4>
                <p>قم بتسجيل طلب الخدمة من خلال المنصة</p>
            </div>
            <div class="process-step">
                <div class="step-number">2</div>
                <h4>المراجعة</h4>
                <p>سيتم مراجعة طلبك من قبل فريقنا</p>
            </div>
            <div class="process-step">
                <div class="step-number">3</div>
                <h4>الموافقة</h4>
                <p>تلقي الموافقة على طلبك</p>
            </div>
            <div class="process-step">
                <div class="step-number">4</div>
                <h4>التنفيذ</h4>
                <p>تنفيذ الخدمة بكفاءة واحترافية</p>
            </div>
        </div>
    </div>
</section>
@endsection
