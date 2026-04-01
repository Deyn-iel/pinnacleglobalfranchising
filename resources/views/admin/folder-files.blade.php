<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $folder ?? 'Files' }} · File Manager</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@vite(['resources/css/admin/app.css'])

<style>
/* ===== RESET & GLOBAL ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%);
  font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
  color: #0f172a;
  min-height: 100vh;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* ===== HEADER SECTION ===== */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  flex-wrap: wrap;
  gap: 16px;
  padding: 0 4px;
}

.folder-title {
  font-size: 28px;
  font-weight: 800;
  display: flex;
  align-items: center;
  gap: 12px;
  background: rgba(255,255,255,0.6);
  backdrop-filter: blur(4px);
  padding: 8px 20px;
  border-radius: 60px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.folder-title i {
  font-size: 28px;
  color: #f59e0b;
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.back-btn {
  font-size: 14px;
  text-decoration: none;
  color: #4f46e5;
  font-weight: 600;
  background: white;
  padding: 8px 20px;
  border-radius: 40px;
  transition: all 0.25s ease;
  box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.back-btn:hover {
  background: #4f46e5;
  color: white;
  transform: translateX(-3px);
  box-shadow: 0 8px 20px rgba(79,70,229,0.2);
}

/* ===== UPLOAD CARD ===== */
.upload-card {
  background: rgba(255,255,255,0.9);
  backdrop-filter: blur(8px);
  border-radius: 28px;
  padding: 8px;
  box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
  margin-bottom: 32px;
  border: 1px solid rgba(255,255,255,0.5);
  transition: all 0.2s;
}

.upload-box {
  border: 2px dashed #cbd5e1;
  border-radius: 24px;
  padding: 40px 30px;
  text-align: center;
  transition: all 0.25s ease;
  background: #ffffffcc;
  /* REMOVED cursor: pointer from here - only file input should trigger file dialog */
}

.upload-box.drag-over {
  background: #e0e7ff;
  border-color: #6366f1;
  transform: scale(0.98);
  border-style: solid;
}

.upload-icon {
  font-size: 44px;
  color: #6366f1;
  margin-bottom: 12px;
  transition: transform 0.2s;
  pointer-events: none; /* Prevents icon from capturing clicks */
}

.upload-text {
  font-size: 15px;
  font-weight: 500;
  color: #334155;
  margin-bottom: 18px;
  pointer-events: none; /* Prevents text from capturing clicks */
}

/* Custom file input styling - THIS IS THE ONLY WAY TO SELECT FILES */
.custom-upload-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #16a34a; /* same sa btn-success */
  color: white;
  padding: 10px 22px;
  border-radius: 40px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.2s;
}

.custom-upload-btn:hover {
  background: #22c55e;
  box-shadow: 0 6px 16px rgba(34,197,94,0.3);
}

.btn-upload-primary {
  background: linear-gradient(105deg, #4f46e5 0%, #6366f1 100%);
  border: none;
  padding: 10px 28px;
  border-radius: 40px;
  font-weight: 600;
  letter-spacing: 0.3px;
  transition: all 0.25s;
  box-shadow: 0 4px 12px rgba(79,70,229,0.3);
}

.btn-upload-primary:hover {
  box-shadow: 0 12px 22px rgba(79,70,229,0.4);
  background: linear-gradient(105deg, #4338ca 0%, #4f46e5 100%);
}

/* ===== FILE GRID ===== */
.file-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 24px;
  margin-top: 8px;
}

/* ===== FILE CARD (GLASS MORPH) ===== */
.file-card {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(12px);
  border-radius: 28px;
  padding: 20px 18px 20px 18px;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  border: 1px solid rgba(255,255,255,0.6);
  position: relative;
  overflow: hidden;
}

.file-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #818cf8, #c084fc, #facc15);
  opacity: 0;
  transition: opacity 0.3s;
}

.file-card:hover::before {
  opacity: 1;
}

.file-card:hover {
  box-shadow: 0 24px 42px rgba(0, 0, 0, 0.12);
  background: rgba(255, 255, 255, 0.96);
  border-color: #cbd5e1;
}

.file-icon {
  font-size: 46px;
  margin-bottom: 14px;
  transition: transform 0.2s;
}

.file-card:hover .file-icon {
  transform: scale(1.02);
}

.file-name {
  font-weight: 700;
  font-size: 15px;
  margin-bottom: 6px;
  word-break: break-word;
  color: #0f172a;
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.file-badge {
  font-size: 9px;
  background: #eef2ff;
  padding: 2px 8px;
  border-radius: 50px;
  font-weight: 500;
  color: #4f46e5;
  text-transform: uppercase;
}

.file-date {
  font-size: 11px;
  color: #64748b;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.file-date i {
  font-size: 10px;
}

/* ===== ACTION BUTTONS ===== */
.file-actions {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-top: 4px;
}

.file-actions .btn {
  font-size: 12px;
  border-radius: 40px;
  padding: 6px 14px;
  font-weight: 500;
  transition: all 0.2s;
  backdrop-filter: blur(2px);
}

.btn-outline-primary {
  border: 1px solid #c7d2fe;
  color: #4f46e5;
  background: white;
}

.btn-outline-primary:hover {
  background: #4f46e5;
  border-color: #4f46e5;
  color: white;
}

.btn-outline-secondary {
  border: 1px solid #e2e8f0;
  color: #475569;
}

.btn-outline-secondary:hover {
  background: #000000;
}

.btn-outline-danger {
  border: 1px solid #fee2e2;
  color: #e11d48;
}

.btn-outline-danger:hover {
  background: #e11d48;
  border-color: #e11d48;
  color: white;
}

/* ===== EMPTY STATE ===== */
.empty {
  text-align: center;
  padding: 70px 20px;
  color: #475569;
  background: rgba(255,255,255,0.6);
  backdrop-filter: blur(4px);
  border-radius: 48px;
  margin-top: 20px;
  grid-column: 1 / -1;
}

.empty i {
  font-size: 56px;
  margin-bottom: 18px;
  opacity: 0.7;
  color: #94a3b8;
}

.empty p {
  font-size: 16px;
  font-weight: 500;
}

/* ===== TOAST NOTIFICATION ===== */
.toast-notify {
  position: fixed;
  bottom: 30px;
  right: 30px;
  background: #1e293b;
  color: white;
  padding: 12px 24px;
  border-radius: 60px;
  font-size: 14px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 10px;
  z-index: 9999;
  box-shadow: 0 12px 28px rgba(0,0,0,0.2);
  backdrop-filter: blur(8px);
  background: rgba(15,23,42,0.9);
  transform: translateX(400px);
  transition: transform 0.3s ease;
  font-family: monospace;
}

.toast-notify.show {
  transform: translateX(0);
}

/* loading spinner */
.loading-spinner {
  display: inline-block;
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 50%;
  border-top-color: white;
  animation: spin 0.6s linear infinite;
  margin-right: 8px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
  .container {
    padding-left: 16px;
    padding-right: 16px;
  }
  .folder-title {
    font-size: 22px;
    padding: 5px 14px;
  }
  .file-grid {
    grid-template-columns: 1fr;
  }
  .upload-box {
    padding: 28px 18px;
  }
  .custom-file-input {
    width: 90%;
    min-width: auto;
  }
}

/* file size hint */
.file-size-badge {
  font-size: 10px;
  background: #f1f5f9;
  border-radius: 20px;
  padding: 2px 10px;
  display: inline-block;
  margin-top: 6px;
  color: #334155;
}

/* Selected file name styling */
.selected-file-info {
  background: #f1f5f9;
  border-radius: 40px;
  padding: 8px 16px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 12px auto;
  font-size: 13px;
  color: #0f172a;
  max-width: 90%;
}
.form-control {
    width: 50%;
    margin: 0 auto 12px auto;
    display: block;
}
</style>
</head>

<body>
@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')
<div class="container py-4">

  <!-- HEADER with animated breadcrumb -->
  <div class="header">
    <div class="folder-title">
      <i class="fas fa-folder-open"></i>
      <span id="folderNameDisplay">{{ $folder ?? 'Documents' }}</span>
      <span class="badge bg-light text-dark rounded-pill ms-2" style="font-size:12px">
        <i class="fas fa-file-alt"></i> <span id="fileCountBadge">0</span>
      </span>
    </div>

    <a href="{{ route('admin.requirements') }}" class="back-btn">
      <i class="fas fa-arrow-left"></i> Back to Requirements
    </a>
  </div>

  <!-- UPLOAD CARD - FIXED: Only file input opens file dialog -->
  <div class="upload-card">
    <form id="uploadForm" action="{{ route('admin.folder.upload', $folder) }}" method="POST" enctype="multipart/form-data">
    @csrf

      <div class="upload-box" id="dropZone">
        <div class="upload-icon">
          <i class="fas fa-cloud-upload-alt"></i>
        </div>

        <div class="upload-text">
          <strong>Drag & drop</strong> your file here
        </div>

        <!-- ONLY THIS INPUT TRIGGERS FILE SELECTION - No other click handlers open file dialog -->
        <div style="margin: 8px 0 12px 0;">

  <div class="file-upload-wrapper">
  <label for="fileInput" class="custom-upload-btn">
    <i class="fas fa-folder-open"></i> Choose File
  </label>
  <input type="file" name="file" id="fileInput" hidden required>
</div>
</div>
        
        <div id="selectedFileName" style="font-size:13px; margin-bottom:16px;"></div>
        
        <button type="submit" id="uploadBtn" class="btn btn-success px-5">
          <i class="fas fa-upload me-2"></i> Upload File
        </button>
        
        <p style="font-size: 11px; color: #94a3b8; margin-top: 16px; margin-bottom: 0;">
          <i class="fas fa-shield-alt"></i> Max file size: 50MB
        </p>
      </div>

    </form>
  </div>

  <!-- FILES GRID -->
<div class="file-grid" id="fileGrid">

@forelse($files as $file)
  @php
    $ext = strtolower(pathinfo($file->file_original_name ?? '', PATHINFO_EXTENSION));
    $icon = 'fa-file text-secondary';
    if(in_array($ext, ['jpg','jpeg','png'])) $icon = 'fa-file-image text-success';
    elseif($ext == 'pdf') $icon = 'fa-file-pdf text-danger';
    elseif(in_array($ext, ['doc','docx'])) $icon = 'fa-file-word text-primary';
  @endphp

  <div class="file-card" data-file-id="{{ $file->id }}">
    <div class="file-icon">
      <i class="fas {{ $icon }}"></i>
    </div>

    <div class="file-name">
      {{ $file->file_original_name }}
      <span class="file-badge">{{ strtoupper($ext) }}</span>
    </div>

    <div class="file-actions">
      <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
      <a href="{{ asset('storage/'.$file->file_path) }}" download class="btn btn-outline-secondary btn-sm">Download</a>

      <form class="delete-file-form" action="{{ route('admin.requirements.delete', $file->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
      </form>
    </div>
  </div>

@empty
  <div class="empty">
    <p>No files uploaded yet</p>
  </div>
@endforelse

</div>

</div>

<!-- Toast message container -->
<div id="toastMsg" class="toast-notify">
  <i class="fas fa-check-circle"></i> <span id="toastText">Action completed</span>
</div>

<script>
// ========== FIXED: NO UNWANTED FILE DIALOG TRIGGERS ==========
document.addEventListener('DOMContentLoaded', () => {
  const dropZone = document.getElementById('dropZone');
  const fileInput = document.getElementById('fileInput');
  const uploadForm = document.getElementById('uploadForm');
  const uploadBtn = document.getElementById('uploadBtn');
  const selectedFileNameSpan = document.getElementById('selectedFileName');
  const toastEl = document.getElementById('toastMsg');
  const toastTextSpan = document.getElementById('toastText');
  const fileGrid = document.getElementById('fileGrid');
  const fileCountBadge = document.getElementById('fileCountBadge');

  // IMPORTANT: Remove any click handler from dropZone that might trigger file dialog
  // The ONLY way to open file dialog is clicking the file input itself
  
  // update file count badge dynamically
  function updateFileCount() {
    const fileCards = document.querySelectorAll('.file-card');
    if(fileCountBadge) {
      fileCountBadge.innerText = fileCards.length;
    }
    if(fileCards.length === 0 && !document.querySelector('.empty')) {
      if(fileGrid && !document.getElementById('emptyStatePlaceholder')) {
        const emptyDiv = document.createElement('div');
        emptyDiv.className = 'empty';
        emptyDiv.id = 'emptyStatePlaceholder';
        emptyDiv.innerHTML = `<i class="fas fa-folder-open"></i><p>✨ No files uploaded yet</p><small>Click "Choose File" above to select a file, then click Upload</small>`;
        fileGrid.appendChild(emptyDiv);
      }
    } else if(fileCards.length > 0) {
      const existingEmpty = document.getElementById('emptyStatePlaceholder');
      if(existingEmpty) existingEmpty.remove();
    }
  }

let toastTimeout;

function showToast(message, isError = false) {
  clearTimeout(toastTimeout);

  toastTextSpan.innerHTML = message;

  if (isError) {
    toastEl.style.background = "rgba(220,38,38,0.9)";
    toastEl.querySelector('i').className = "fas fa-exclamation-triangle";
  } else {
    toastEl.style.background = "rgba(15,23,42,0.9)";
    toastEl.querySelector('i').className = "fas fa-check-circle";
  }

  toastEl.classList.add('show');

  toastTimeout = setTimeout(() => {
    toastEl.classList.remove('show');
  }, 2500);
}

  // Drag & drop visual ONLY - does NOT open file dialog
  dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('drag-over');
  });
  dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('drag-over');
  });
  dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('drag-over');
    const files = e.dataTransfer.files;
    if(files.length > 0) {
      // Set files to the file input
      fileInput.files = files;
      updateSelectedFileName(files[0].name);
      showToast(`File "${files[0].name}" selected`, false);
    }
  });

  function updateSelectedFileName(name) {
    if(selectedFileNameSpan) {
      selectedFileNameSpan.innerHTML = `<div class="selected-file-info"><i class="fas fa-paperclip text-primary"></i> <strong>Selected:</strong> ${name.length > 40 ? name.substring(0, 40) + '...' : name}</div>`;
    }
  }

  // When file input changes (user clicked it directly)
  fileInput.addEventListener('change', function(e) {
    if(this.files.length > 0) {
      updateSelectedFileName(this.files[0].name);
    } else {
      if(selectedFileNameSpan) selectedFileNameSpan.innerHTML = '';
    }
  });

  // Upload with AJAX (prevents page reload)
  uploadForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const file = fileInput.files[0];
    if(!file) {
      showToast('❌ Please select a file first', true);
      return;
    }
    
    // Validate file size (max 50MB)
    if(file.size > 50 * 1024 * 1024) {
      showToast('File size exceeds 50MB limit', true);
      return;
    }
    
    const formData = new FormData(uploadForm);
    uploadBtn.disabled = true;
    const originalBtnHtml = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<span class="loading-spinner"></span> Uploading...';
    
    try {
      const response = await fetch(uploadForm.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
      });
      
      let result;
      try {
        result = await response.json();
      } catch (e) {
        // If response is not JSON, fallback to page reload
        if(response.ok) {
          showToast('Upload successful! Refreshing...', false);
          setTimeout(() => location.reload(), 1000);
        } else {
          showToast('Upload failed. Server error.', true);
        }
        uploadBtn.disabled = false;
        uploadBtn.innerHTML = originalBtnHtml;
        return;
      }
      
      if(response.ok && result.success) {
        showToast(result.message || '✅ File uploaded successfully!');
        if(result.file) {
          addFileCardToGrid(result.file);
          fileInput.value = '';
          if(selectedFileNameSpan) selectedFileNameSpan.innerHTML = '';
          updateFileCount();
        } else {
          setTimeout(() => location.reload(), 800);
        }
      } else {
        showToast(result.message || 'Upload failed. Please try again.', true);
      }
    } catch (error) {
      console.error('Upload error:', error);
      showToast('Network error. Please check your connection.', true);
    } finally {
      uploadBtn.disabled = false;
      uploadBtn.innerHTML = originalBtnHtml;
    }
  });
  
  // Helper to add card dynamically
function addFileCardToGrid(fileData) {
  const fileGrid = document.getElementById('fileGrid');

  const fileName = fileData.original_name;
  const ext = fileName.split('.').pop().toLowerCase();

  let iconClass = 'fa-file text-secondary';
  if(['jpg','jpeg','png','gif','webp'].includes(ext)) iconClass = 'fa-file-image text-success';
  else if(ext === 'pdf') iconClass = 'fa-file-pdf text-danger';
  else if(['doc','docx'].includes(ext)) iconClass = 'fa-file-word text-primary';

  const fileUrl = '/storage/' + fileData.file_path;

  const fileCard = document.createElement('div');
  fileCard.className = 'file-card';
  fileCard.setAttribute('data-file-id', fileData.id);

  fileCard.innerHTML = `
    <div class="file-icon"><i class="fas ${iconClass}"></i></div>
    <div class="file-name">${fileName}<span class="file-badge">${ext.toUpperCase()}</span></div>
    <div class="file-actions">
      <a href="${fileUrl}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
      <a href="${fileUrl}" download class="btn btn-outline-secondary btn-sm">Download</a>
      <form class="delete-file-form" action="/admin/requirements/${fileData.id}" method="POST">
        <input type="hidden" name="_token" value="${document.querySelector('input[name="_token"]').value}">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
      </form>
    </div>
  `;

  fileGrid.prepend(fileCard);

  attachDeleteEvent(fileCard.querySelector('.delete-file-form'));
}
  
  function escapeHtml(str) {
    if(!str) return '';
    return str.replace(/[&<>]/g, function(m) {
      if(m === '&') return '&amp;';
      if(m === '<') return '&lt;';
      if(m === '>') return '&gt;';
      return m;
    });
  }
  
  // attach delete with confirmation & AJAX
function attachDeleteEvent(formElement) {
  if(!formElement) return;

  formElement.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.stopPropagation();

    if(!confirm('⚠️ Permanently delete this file? This action cannot be undone.')) return;

    const deleteBtn = formElement.querySelector('button');
    const originalText = deleteBtn.innerHTML;
    deleteBtn.innerHTML = '<span class="loading-spinner"></span>';
    deleteBtn.disabled = true;

    try {
      const response = await fetch(formElement.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': formElement.querySelector('input[name="_token"]').value,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({ '_method': 'DELETE' })
      });

      const data = await response.json();

      if (response.ok && data.success) {
        showToast(data.message || '🗑️ File deleted');
        const card = formElement.closest('.file-card');
if (card) {
  const categoryWrapper = card.closest('[data-category]');
  const categoryFiles = categoryWrapper.querySelector('.category-files');

  card.remove();

  if (categoryFiles.children.length === 0) {
    categoryWrapper.remove();
  }
}

updateFileCount();
      } else {
        showToast(data.message || 'Delete failed', true);
      }

    } catch (err) {
      console.error(err);
      showToast('Error deleting file', true);
    } finally {
      deleteBtn.disabled = false;
      deleteBtn.innerHTML = originalText;
    }
  });
}
  
  // Attach to all existing delete forms
  document.querySelectorAll('.delete-file-form').forEach(form => attachDeleteEvent(form));
  updateFileCount();
  
  // IMPORTANT: NO click handler on dropZone that opens file dialog
  // The file input handles file selection exclusively
});
</script>

</body>
</html>