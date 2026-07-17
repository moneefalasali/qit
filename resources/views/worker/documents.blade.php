@extends('layouts.app')

@section('title', 'إدارة الوثائق - قطاف القصيم')

@section('styles')
<style>
    .documents-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--primary-green);
        font-size: 28px;
    }

    .page-header a {
        background-color: var(--primary-green);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .page-header a:hover {
        background-color: var(--light-green);
    }

    .documents-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .document-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .document-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .document-icon {
        font-size: 48px;
        margin-bottom: 15px;
        text-align: center;
    }

    .document-name {
        color: var(--dark-text);
        font-weight: 600;
        margin-bottom: 10px;
        word-break: break-word;
    }

    .document-info {
        color: var(--light-text);
        font-size: 13px;
        margin-bottom: 15px;
    }

    .document-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .status-verified {
        background-color: #d4edda;
        color: #155724;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .document-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        flex: 1;
        padding: 8px;
        border: 1px solid var(--border-color);
        background-color: white;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
    }

    .action-btn:hover {
        border-color: var(--primary-green);
        color: var(--primary-green);
    }

    .action-btn-delete {
        color: #dc3545;
        border-color: #dc3545;
    }

    .action-btn-delete:hover {
        background-color: #f8d7da;
    }

    .upload-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .upload-section h2 {
        color: var(--primary-green);
        margin-bottom: 20px;
        font-size: 20px;
    }

    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .upload-area:hover {
        border-color: var(--primary-green);
        background-color: #f9f7f4;
    }

    .upload-area i {
        font-size: 48px;
        color: var(--primary-green);
        margin-bottom: 15px;
        display: block;
    }

    .upload-area p {
        color: var(--light-text);
        margin-bottom: 10px;
    }

    .upload-area input[type="file"] {
        display: none;
    }

    .upload-btn {
        background-color: var(--primary-green);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .upload-btn:hover {
        background-color: var(--light-green);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background-color: white;
        border-radius: 10px;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--beige);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--light-text);
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .documents-grid {
            grid-template-columns: 1fr;
        }

        .upload-area {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="documents-container">
    <div class="page-header">
        <h1>إدارة الوثائق</h1>
        <a href="#">+ رفع وثيقة</a>
    </div>

    <!-- Upload Section -->
    <div class="upload-section">
        <h2>رفع وثيقة جديدة</h2>
        <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>اسحب الملفات هنا أو انقر للاختيار</p>
                <small style="color: var(--light-text);">الملفات المدعومة: PDF, JPG, PNG (الحد الأقصى 5MB)</small>
                <input type="file" id="fileInput" name="document" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 10px; color: var(--dark-text); font-weight: 600;">نوع الوثيقة</label>
                <select name="document_type" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 5px; font-family: 'Tajawal', sans-serif;">
                    <option value="">اختر نوع الوثيقة</option>
                    <option value="id">بطاقة هوية</option>
                    <option value="license">رخصة عمل</option>
                    <option value="certificate">شهادة تدريب</option>
                    <option value="medical">فحص طبي</option>
                    <option value="other">أخرى</option>
                </select>
            </div>
            <button type="submit" class="upload-btn" style="margin-top: 20px;">رفع الوثيقة</button>
        </form>
    </div>

    <!-- Documents List -->
    <h2 style="color: var(--primary-green); margin-bottom: 20px; font-size: 20px;">وثائقي</h2>
    
    <div class="documents-grid">
        @foreach($documents as $document)
            <div class="document-card">
                <div class="document-icon">{{ $document['icon'] }}</div>
                <div class="document-name">{{ $document['name'] }}</div>
                <div class="document-info">
                    <p>تم الرفع: {{ $document['uploaded_at'] }}</p>
                    <p>الحجم: {{ number_format($document['size_mb'], 1) }} MB</p>
                </div>
                <span class="document-status status-{{ $document['status'] }}">
                    {{ $document['status_icon'] }} {{ $document['status_label'] }}
                </span>
                <div class="document-actions">
                    <a href="#" class="action-btn">عرض</a>
                    <a href="#" class="action-btn">تحميل</a>
                    <button class="action-btn action-btn-delete">حذف</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Drag and drop functionality
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');

    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--primary-green)';
        uploadArea.style.backgroundColor = '#f9f7f4';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = 'var(--border-color)';
        uploadArea.style.backgroundColor = 'transparent';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--border-color)';
        uploadArea.style.backgroundColor = 'transparent';
        fileInput.files = e.dataTransfer.files;
    });
</script>
@endsection
