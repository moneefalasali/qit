<?php $__env->startSection('title', 'من نحن - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .about-hero {
        background: #243f13;
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    .about-hero h1 {
        font-size: 42px;
        margin-bottom: 15px;
        font-weight: 800;
    }

    .about-hero p {
        font-size: 18px;
        color: #e8dcc8;
    }

    .about-section {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .section-title {
        font-size: 32px;
        color: var(--primary-green);
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
        margin-bottom: 60px;
    }

    .about-text p {
        margin-bottom: 15px;
        color: var(--light-text);
        line-height: 1.8;
        font-size: 16px;
    }

    .about-image {
        background-color: #e8dcc8;
        height: 400px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 100px;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .value-card {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .value-icon {
        font-size: 48px;
        color: var(--primary-green);
        margin-bottom: 15px;
    }

    .value-card h3 {
        color: var(--primary-green);
        margin-bottom: 10px;
        font-size: 18px;
    }

    .value-card p {
        color: var(--light-text);
        font-size: 14px;
        line-height: 1.6;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .team-member {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .member-image {
        background-color: #e8dcc8;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
    }

    .member-info {
        padding: 20px;
    }

    .member-info h4 {
        color: var(--primary-green);
        margin-bottom: 5px;
    }

    .member-info p {
        font-size: 13px;
        color: var(--light-text);
    }

    @media (max-width: 768px) {
        .about-content {
            grid-template-columns: 1fr;
        }

        .about-hero h1 {
            font-size: 28px;
        }

        .section-title {
            font-size: 24px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="about-hero">
    <h1>من نحن</h1>
    <p>منصة قطاف القصيم - شريكك الموثوق في موسم الحصاد</p>
</section>

<section class="about-section">
    <h2 class="section-title">رؤيتنا ورسالتنا</h2>
    <div class="about-content">
        <div class="about-text">
            <h3 style="color: var(--primary-green); margin-bottom: 15px;">رؤيتنا</h3>
            <p>أن نكون المنصة الرقمية الموثوقة والرائدة في تنظيم وتيسير الوصول الى الخدمات الزراعية لقطاع النخيل والتمور في منطقة القصيم.</p>
            
            <h3 style="color: var(--primary-green); margin-bottom: 15px; margin-top: 30px;">رسالتنا</h3>
            <p>توفير منصة رقمية تربط مزارعي ومستثمري التمور في منطقة القصيم بمقدمي الخدمات الزراعية المؤهلين عبر مطابقة الطلبات وفق طبيعة الخدمة ومتطلبات التنفيذ، وتنظيم اجراءات الطلب ومتابعتها حتى اكتمالها، للمساهمة في رفع كفاءة تقديم الخدمات الزراعية وتحقيق قيمة مضافة للمزارعين ومقدمي الخدمات.</p>
        </div>
        <div class="about-image">
            🌾
        </div>
    </div>
</section>

<section class="about-section">
    <h2 class="section-title">قيمنا الأساسية</h2>
    <div class="values-grid">
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <h3>الثقة والموثوقية</h3>
            <p>نبني علاقاتنا على أساس الثقة والشفافية الكاملة مع جميع المستخدمين</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-star"></i>
            </div>
            <h3>الجودة والاحترافية</h3>
            <p>نلتزم بتقديم أعلى مستويات الجودة والاحترافية في جميع خدماتنا</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>العدالة والمساواة</h3>
            <p>نؤمن بالعدالة والمساواة في التعاملات بين جميع أطراف المنصة</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h3>الاستدامة</h3>
            <p>نسعى لدعم الزراعة المستدامة والحفاظ على البيئة</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h3>الابتكار</h3>
            <p>نستمر في تطوير حلول مبتكرة لتحسين تجربة المستخدم</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h3>خدمة العملاء</h3>
            <p>نقدم دعماً متميزاً ومستمراً لجميع عملائنا</p>
        </div>
    </div>
</section>

<section class="about-section">
    <h2 class="section-title">فريقنا</h2>
    <div class="team-grid">
        <div class="team-member">
            <div class="member-image">👨‍💼</div>
            <div class="member-info">
                <h4>أحمد السويلم</h4>
                <p>المدير التنفيذي</p>
            </div>
        </div>
        <div class="team-member">
            <div class="member-image">👩‍💼</div>
            <div class="member-info">
                <h4>فاطمة الدوسري</h4>
                <p>مدير العمليات</p>
            </div>
        </div>
        <div class="team-member">
            <div class="member-image">👨‍💻</div>
            <div class="member-info">
                <h4>محمد القحطاني</h4>
                <p>مدير التطوير</p>
            </div>
        </div>
        <div class="team-member">
            <div class="member-image">👩‍💼</div>
            <div class="member-info">
                <h4>سارة العتيبي</h4>
                <p>مدير خدمة العملاء</p>
            </div>
        </div>
    </div>
</section>

<section class="about-section" style="background-color: #f9f7f4; padding: 40px; border-radius: 10px; margin-bottom: 60px;">
    <h2 class="section-title">إحصائياتنا</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center;">
        <div>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-green); margin-bottom: 10px;">5000+</div>
            <p style="color: var(--light-text);">عامل معتمد</p>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-green); margin-bottom: 10px;">1000+</div>
            <p style="color: var(--light-text);">مزرعة مسجلة</p>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-green); margin-bottom: 10px;">10000+</div>
            <p style="color: var(--light-text);">طلب منجز</p>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-green); margin-bottom: 10px;">98%</div>
            <p style="color: var(--light-text);">رضا العملاء</p>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/pages/about.blade.php ENDPATH**/ ?>