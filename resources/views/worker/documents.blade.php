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
        background-color: goldenrod;
    }

    .documents-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .document-card {
        background: linear-gradient(135deg, #ffffff 0%, #fdfcf8 100%);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0ebe2;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .document-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
    }

    .document-icon {
        font-size: 42px;
        margin-bottom: 12px;
        text-align: center;
    }

    .document-name {
        color: var(--dark-text);
        font-weight: 700;
        margin-bottom: 10px;
        word-break: break-word;
    }

    .document-info {
        color: var(--light-text);
        font-size: 13px;
        margin-bottom: 12px;
        line-height: 1.7;
    }

    .document-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .status-verified {
        background-color: #eaf8ee;
        color: #198754;
    }

    .status-pending {
        background-color: #fff8e1;
        color: #b8860b;
    }

    .status-rejected {
        background-color: #fdecec;
        color: #dc3545;
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
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
    }

    .action-btn:hover {
        border-color: var(--primary-green);
        background-color: var(--primary-green);
        color: white;
    }

    .action-btn-delete {
        color: #dc3545;
        border-color: #dc3545;
    }

    .action-btn-delete:hover {
        background-color: #fdecec;
        color: #dc3545;
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
        border-radius: 14px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fcfbf7;
    }

    .upload-area:hover,
    .upload-area.active {
        border-color: var(--primary-green);
        background-color: #f6efe4;
        transform: translateY(-2px);
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

    .upload-preview {
        margin-top: 18px;
        padding: 14px;
        border-radius: 12px;
        background: #f8f5ed;
        border: 1px solid #e9e0cf;
        display: none;
    }

    .upload-preview.active {
        display: block;
    }

    .upload-preview .preview-name {
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 6px;
        word-break: break-word;
    }

    .upload-preview .preview-size {
        color: var(--light-text);
        font-size: 13px;
    }

    .upload-preview .preview-state {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
        font-size: 13px;
        font-weight: 700;
    }

    .upload-preview .preview-state.ready {
        color: #198754;
    }

    .upload-preview .preview-state.error {
        color: #dc3545;
    }

    .upload-preview-image {
        margin-top: 12px;
        display: none;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e7dfcf;
        max-height: 220px;
    }

    .upload-preview-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
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
        background-color:goldenrod;
    }

    .upload-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: #9aa08d;
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
        <a href="#uploadSection">+ رفع وثيقة</a>
    </div>

    <!-- Upload Section -->
    <div class="upload-section" id="uploadSection">
        <h2>رفع وثيقة جديدة</h2>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="margin-bottom: 20px;">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('worker.documents.upload') }}" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>اسحب الملفات هنا أو انقر للاختيار</p>
                <small style="color: var(--light-text);">الملفات المدعومة: PDF, JPG, PNG (الحد الأقصى 5MB)</small>
                <input type="file" id="fileInput" name="document" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <div class="upload-preview" id="uploadPreview">
                <div class="preview-name" id="previewName">لا توجد ملفات بعد</div>
                <div class="preview-size" id="previewSize"></div>
                <div class="preview-state" id="previewState">بانتظار اختيار الملف</div>
                <div class="upload-preview-image" id="uploadPreviewImage"></div>
            </div>
            <div style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 10px; color: var(--dark-text); font-weight: 600;">نوع الوثيقة</label>
                <select name="document_type" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 5px; font-family: 'Tajawal', sans-serif;">
                    <option value="">اختر نوع الوثيقة</option>
                    <option value="id">بطاقة هوية</option>
                    <option value="license">رخصة عمل</option>
                    <option value="certificate">شهادة تدريب</option>
                    <option value="medical">فحص طبي</option>
                    <option value="other">أخرى</option>
                </select>
            </div>
            <button type="submit" class="upload-btn" id="submitUploadBtn" style="margin-top: 20px;" disabled>رفع الوثيقة</button>
        </form>
    </div>

    <!-- Documents List -->
    <h2 style="color: var(--primary-green); margin-bottom: 20px; font-size: 20px;">وثائقي</h2>

    <div class="documents-grid">
        @forelse($documents as $document)
            <div class="document-card">
                <div class="document-icon">{{ $document['icon'] }}</div>
                <div class="document-name">{{ $document['name'] }}</div>
                <div class="document-info">
                    <p>تم الرفع: {{ $document['uploaded_at'] }}</p>
                    <p>الحجم: {{ number_format($document['size_mb'], 1) }} MB</p>
                </div>
                <span class="document-status status-{{ $document['status'] }}">
                    <i class="fas {{ $document['status'] === 'verified' ? 'fa-check-circle' : ($document['status'] === 'pending' ? 'fa-hourglass-half' : 'fa-times-circle') }}"></i>
                    {{ $document['status_label'] }}
                </span>
                <div class="document-actions">
                    @if(!empty($document['path']))
                        <a href="{{ route('worker.documents.download') }}" class="action-btn">تحميل</a>
                    @endif
                    <form method="POST" action="{{ route('worker.documents.delete') }}" style="margin:0;">
                        @csrf
                        <input type="hidden" name="delete_document" value="1">
                        <button type="submit" class="action-btn action-btn-delete">حذف</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-file-upload"></i>
                    <h3>لا توجد مستندات مرفوعة بعد</h3>
                    <p>ابدأ برفع أول وثيقة من القسم أعلاه.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewName = document.getElementById('previewName');
    const previewSize = document.getElementById('previewSize');
    const previewState = document.getElementById('previewState');
    const uploadPreviewImage = document.getElementById('uploadPreviewImage');
    const submitUploadBtn = document.getElementById('submitUploadBtn');

    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function setPreview(file) {
        if (!file) {
            uploadPreview.classList.remove('active');
            uploadPreviewImage.innerHTML = '';
            uploadPreviewImage.style.display = 'none';
            submitUploadBtn.disabled = true;
            return;
        }

        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        const isAllowed = allowedTypes.includes(file.type) || /\.pdf$/i.test(file.name) || /\.jpg$/i.test(file.name) || /\.jpeg$/i.test(file.name) || /\.png$/i.test(file.name);
        const isTooLarge = file.size > 5 * 1024 * 1024;

        previewName.textContent = file.name;
        previewSize.textContent = formatBytes(file.size);
        uploadPreview.classList.add('active');

        if (!isAllowed) {
            previewState.className = 'preview-state error';
            previewState.innerHTML = '<i class="fas fa-times-circle"></i> نوع الملف غير مدعوم';
            uploadPreviewImage.innerHTML = '';
            uploadPreviewImage.style.display = 'none';
            submitUploadBtn.disabled = true;
            return;
        }

        if (isTooLarge) {
            previewState.className = 'preview-state error';
            previewState.innerHTML = '<i class="fas fa-times-circle"></i> الملف كبير جداً (الحد الأقصى 5MB)';
            uploadPreviewImage.innerHTML = '';
            uploadPreviewImage.style.display = 'none';
            submitUploadBtn.disabled = true;
            return;
        }

        previewState.className = 'preview-state ready';
        previewState.innerHTML = '<i class="fas fa-check-circle"></i> الملف جاهز للرفع';
        submitUploadBtn.disabled = false;

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                uploadPreviewImage.innerHTML = '<img src="' + e.target.result + '" alt="معاينة الملف">';
                uploadPreviewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            uploadPreviewImage.innerHTML = '<div style="padding: 16px; text-align: center; color: #2d5a27; font-weight: 700;"><i class="fas fa-file-pdf"></i> مستند PDF</div>';
            uploadPreviewImage.style.display = 'block';
        }
    }

    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('active');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('active');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('active');
        const droppedFile = e.dataTransfer.files[0];
        if (droppedFile) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(droppedFile);
            fileInput.files = dataTransfer.files;
            setPreview(droppedFile);
        }
    });

    fileInput.addEventListener('change', (e) => {
        const selectedFile = e.target.files[0];
        setPreview(selectedFile);
    });
</script>
@endsection
