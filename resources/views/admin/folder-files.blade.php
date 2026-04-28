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
        :root {
            --sidebar-w: 260px;
            --topbar-h: 70px;

            --bg: #f4f6f9;
            --surface: #ffffff;
            --surface-soft: #f8fafc;

            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;

            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #eff6ff;

            --success: #16a34a;
            --success-dark: #15803d;

            --danger: #dc2626;
            --danger-dark: #b91c1c;

            --warning: #f59e0b;

            --shadow-sm: 0 1px 3px rgba(15, 23, 42, .08);
            --shadow-md: 0 10px 24px rgba(15, 23, 42, .08);

            --radius: 14px;
            --radius-lg: 18px;
        }

        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* MAIN PAGE */
        .file-manager-page {
            width: calc(100% - var(--sidebar-w));
            min-height: 100vh;
            margin-left: var(--sidebar-w);
            padding: 24px clamp(18px, 2.4vw, 40px) 36px;
        }

        @media (max-width: 1366px) {
            :root {
                --sidebar-w: 240px;
            }

            .file-manager-page {
                padding: 20px 24px 30px;
            }
        }

        /* SMALL LAPTOP */
        @media (max-width: 1199px) {
            :root {
                --sidebar-w: 220px;
            }

            .file-manager-page {
                padding: 18px 20px 28px;
            }
        }

        /* TABLET / COLLAPSED SIDEBAR */
        @media (max-width: 991px) {
            .file-manager-page {
                width: 100%;
                margin-left: 0;
                padding: 16px 16px 24px;
            }
        }

        /* MOBILE */
        @media (max-width: 575px) {
            .file-manager-page {
                padding: 12px 12px 20px;
            }
        }

        /* HEADER */
        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .folder-title {
            min-width: 0;
            max-width: 100%;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 14px 18px;
            box-shadow: var(--shadow-sm);
            font-size: clamp(18px, 1.8vw, 26px);
            font-weight: 800;
            line-height: 1.2;
        }

        .folder-title i {
            flex: 0 0 auto;
            font-size: clamp(22px, 2vw, 28px);
            color: var(--warning);
        }

        .folder-title span {
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .folder-title .badge {
            flex: 0 0 auto;
            background: var(--surface-soft) !important;
            color: var(--text) !important;
            border: 1px solid var(--border);
            font-size: 12px !important;
            font-weight: 700;
            padding: 7px 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--surface);
            color: var(--primary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: var(--shadow-sm);
            transition: .2s ease;
        }

        .back-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* UPLOAD CARD */
        .upload-card {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px;
            margin-bottom: 26px;
            box-shadow: var(--shadow-sm);
        }

        .upload-box {
            width: 100%;
            border: 2px dashed #cbd5e1;
            border-radius: var(--radius);
            background: var(--surface-soft);
            padding: clamp(34px, 4vw, 54px) clamp(18px, 3vw, 34px);
            text-align: center;
            transition: .2s ease;
        }

        .upload-box.drag-over {
            background: var(--primary-soft);
            border-color: var(--primary);
        }

        .upload-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            pointer-events: none;
        }

        .upload-text {
            font-size: clamp(14px, 1.1vw, 16px);
            font-weight: 700;
            color: #334155;
            margin-bottom: 18px;
            pointer-events: none;
        }

        .upload-text strong {
            color: var(--text);
        }

        .file-upload-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-upload-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: var(--surface);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .custom-upload-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }

        #selectedFileName {
            min-height: 20px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .selected-file-info {
            max-width: min(90%, 560px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 12px auto;
            background: #eef2ff;
            color: #1e293b;
            border: 1px solid #dbeafe;
            border-radius: var(--radius);
            padding: 9px 14px;
            font-size: 13px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        #uploadBtn {
            min-height: 44px;
            background: var(--success);
            border: 1px solid var(--success);
            border-radius: var(--radius);
            padding: 10px 28px;
            font-size: 14px;
            font-weight: 800;
            box-shadow: none;
            transition: .2s ease;
        }

        #uploadBtn:hover {
            background: var(--success-dark);
            border-color: var(--success-dark);
        }

        #uploadBtn:disabled {
            opacity: .75;
            cursor: not-allowed;
        }

        /* FILE GRID */
        .file-grid {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 18px;
            align-items: stretch;
        }

        @media (min-width: 1600px) {
            .file-grid {
                grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            }
        }

        @media (max-width: 1199px) {
            .file-grid {
                grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            }
        }

        @media (max-width: 575px) {
            .file-grid {
                grid-template-columns: 1fr;
            }
        }

        /* FILE CARD */
        .file-card {
            min-width: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px;
            box-shadow: var(--shadow-sm);
            transition: .2s ease;
            position: relative;
            overflow: hidden;
        }

        .file-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .file-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius);
            background: var(--surface-soft);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 14px;
        }

        .file-name {
            min-width: 0;
            display: flex;
            align-items: flex-start;
            gap: 7px;
            flex-wrap: wrap;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
            line-height: 1.35;
            margin-bottom: 14px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .file-badge {
            flex: 0 0 auto;
            background: var(--primary-soft);
            color: var(--primary);
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        /* ACTION BUTTONS */
        .file-actions {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 5;
        }

        .file-actions-toggle {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            transition: .2s ease;
        }

        .file-actions-toggle:hover,
        .file-actions-toggle.show {
            background: var(--text);
            border-color: var(--text);
            color: #fff;
        }

        .file-actions-menu {
            min-width: 170px;
            padding: 8px;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-md);
        }

        .file-actions-menu.show {
            margin-top: 8px !important;
        }

        .file-actions-menu .btn,
        .file-actions-menu button {
            width: 100%;
            min-height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
            transition: .2s ease;
        }

        .file-actions-menu form:last-child button,
        .file-actions-menu .btn:last-child {
            margin-bottom: 0;
        }

        .btn-outline-primary {
            background: #fff;
            border: 1px solid #bfdbfe;
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-outline-secondary {
            background: #fff;
            border: 1px solid var(--border);
            color: #475569;
        }

        .btn-outline-secondary:hover {
            background: #111827;
            border-color: #111827;
            color: #fff;
        }

        .btn-outline-danger {
            background: #fff;
            border: 1px solid #fecaca;
            color: var(--danger);
        }

        .btn-outline-danger:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
        }

        /* FOLDER CARD */
        .folder-card-inner .file-icon {
            background: #fffbeb;
            border-color: #fde68a;
        }

        .folder-card-inner:hover {
            border-color: #fde68a;
            background: #fffbeb;
        }

        /* EMPTY STATE */
        .empty {
            grid-column: 1 / -1;
            background: var(--surface);
            border: 1px dashed #cbd5e1;
            border-radius: var(--radius-lg);
            padding: clamp(44px, 6vw, 76px) 20px;
            text-align: center;
            color: var(--muted);
            box-shadow: var(--shadow-sm);
        }

        .empty i {
            width: 62px;
            height: 62px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: var(--surface-soft);
            color: #94a3b8;
            display: flex !important;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .empty p {
            color: var(--text);
            font-size: clamp(15px, 1.2vw, 17px);
            font-weight: 800;
            margin-bottom: 4px;
        }

        .empty small {
            color: var(--muted);
        }

        /* TOAST */
        .toast-notify {
            position: fixed;
            right: 26px;
            bottom: 26px;
            max-width: calc(100vw - 40px);
            display: flex;
            align-items: center;
            gap: 10px;
            background: #111827;
            color: #fff;
            border-radius: var(--radius);
            padding: 13px 18px;
            font-size: 14px;
            font-weight: 700;
            box-shadow: var(--shadow-md);
            z-index: 9999;
            transform: translateX(420px);
            transition: transform .25s ease;
        }

        .toast-notify.show {
            transform: translateX(0);
        }

        /* LOADING */
        .loading-spinner {
            display: inline-block;
            width: 17px;
            height: 17px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .65s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .header {
                align-items: stretch;
            }

            .folder-title,
            .back-btn {
                width: 100%;
            }

            .folder-title {
                justify-content: center;
                text-align: center;
                border-radius: var(--radius-lg);
            }

            .back-btn {
                justify-content: center;
            }

            .upload-card {
                padding: 14px;
            }

            .upload-box {
                padding: 30px 16px;
            }

            #uploadBtn,
            .custom-upload-btn {
                width: 100%;
                max-width: 320px;
            }

            .file-actions {
                align-items: stretch;
            }

            .file-actions .btn,
            .delete-file-form,
            .delete-folder-form {
                flex: 1 1 auto;
            }

            .delete-file-form .btn,
            .delete-folder-form .btn {
                width: 100%;
            }

            .toast-notify {
                left: 12px;
                right: 12px;
                bottom: 16px;
                justify-content: center;
                border-radius: var(--radius);
                transform: translateY(120px);
            }

            .toast-notify.show {
                transform: translateY(0);
            }
        }

        @media (max-width: 420px) {
            .folder-title {
                padding: 12px 14px;
                font-size: 18px;
            }

            .folder-title .badge {
                margin-left: 0 !important;
            }

            .file-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    @include('admin-sidebar.navbar')
    @include('admin-sidebar.sidebar')

    <main class="file-manager-page">

        <div class="header">
            <div class="folder-title">
                <i class="fas fa-folder-open"></i>
                <span id="folderNameDisplay">{{ $folderName ?? basename($folder) }}</span>
                <span class="badge bg-light text-dark rounded-pill ms-2">
                    <i class="fas fa-layer-group"></i>
                    <span id="fileCountBadge">0</span>
                </span>
            </div>

            @if (!empty($parentFolder))
                <a href="{{ route('admin.folder.view', $parentFolder) }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            @else
                <a href="{{ route('admin.requirements') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Requirements
                </a>
            @endif
        </div>

        @if (session('success'))
            <div id="successMsg" class="alert alert-success fw-bold">
                <i class="fa-solid fa-circle-check me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="upload-card">
            <form action="{{ route('admin.folder.create.inside', $folder) }}" method="POST">
                @csrf

                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-8 col-lg-6">
                        <label class="form-label fw-bold">Create Subfolder</label>
                        <input type="text" name="folder" class="form-control" placeholder="Enter subfolder name"
                            required>
                    </div>

                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-folder-plus"></i>
                            Create Folder
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="upload-card">
            <form id="uploadForm" action="{{ route('admin.folder.upload', $folder) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="upload-box" id="dropZone">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>

                    <div class="upload-text">
                        <strong>Drag & drop</strong> your file here
                    </div>

                    <div style="margin: 8px 0 12px 0;">
                        <div class="file-upload-wrapper">
                            <label for="fileInput" class="custom-upload-btn">
                                <i class="fas fa-folder-open"></i> Choose File
                            </label>
                            <input type="file" name="file" id="fileInput" hidden required>
                        </div>
                    </div>

                    <div id="selectedFileName"></div>

                    <button type="submit" id="uploadBtn" class="btn btn-success px-5">
                        <i class="fas fa-upload me-2"></i> Upload File
                    </button>

                    <p style="font-size: 11px; color: #94a3b8; margin-top: 16px; margin-bottom: 0;">
                        <i class="fas fa-shield-alt"></i> Max file size: 50MB
                    </p>
                </div>
            </form>
        </div>

        <div class="file-grid" id="fileGrid">

            @if (isset($subfolders) && count($subfolders) > 0)
                @foreach ($subfolders as $subfolder)
                    <div class="file-card folder-card-inner">
                        <div class="file-icon">
                            <i class="fas fa-folder text-warning"></i>
                        </div>

                        <div class="file-name">
                            {{ $subfolder['name'] }}
                            <span class="file-badge">FOLDER</span>
                        </div>

                        <div class="file-actions">
                            <a href="{{ route('admin.folder.view', $subfolder['path']) }}"
                                class="btn btn-outline-primary btn-sm">
                                Open
                            </a>

                            <form class="delete-folder-form"
                                action="{{ route('admin.folder.delete', $subfolder['path']) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

            @forelse($files as $file)
                @php
                    $ext = strtolower(pathinfo($file->file_original_name ?? '', PATHINFO_EXTENSION));
                    $icon = 'fa-file text-secondary';

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $icon = 'fa-file-image text-success';
                    } elseif ($ext == 'pdf') {
                        $icon = 'fa-file-pdf text-danger';
                    } elseif (in_array($ext, ['doc', 'docx'])) {
                        $icon = 'fa-file-word text-primary';
                    } elseif (in_array($ext, ['xls', 'xlsx'])) {
                        $icon = 'fa-file-excel text-success';
                    } elseif (in_array($ext, ['ppt', 'pptx'])) {
                        $icon = 'fa-file-powerpoint text-warning';
                    }
                @endphp

                <div class="file-card actual-file-card" data-file-id="{{ $file->id }}">
                    <div class="file-icon">
                        <i class="fas {{ $icon }}"></i>
                    </div>

                    <div class="file-name">
                        {{ $file->file_original_name }}
                        <span class="file-badge">{{ $ext ? strtoupper($ext) : 'FILE' }}</span>
                    </div>

                    <div class="file-actions dropdown">
                        <button class="file-actions-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Open actions">
                            <i class="fas fa-ellipsis"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end file-actions-menu">
                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i>
                                View
                            </a>

                            <a href="{{ route('admin.requirements.download', $file) }}"
                                class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-download"></i>
                                Download
                            </a>

                            <form class="delete-file-form" action="{{ route('admin.requirements.delete', $file->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                @if (!isset($subfolders) || count($subfolders) === 0)
                    <div class="empty" id="emptyStatePlaceholder">
                        <i class="fas fa-folder-open d-block"></i>
                        <p>This folder is empty</p>
                        <small>Create a subfolder or upload a file above.</small>
                    </div>
                @endif
            @endforelse

        </div>

    </main>

    <div id="toastMsg" class="toast-notify">
        <i class="fas fa-check-circle"></i>
        <span id="toastText">Action completed</span>
    </div>

    <script>
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
            const csrfToken = document.querySelector('input[name="_token"]')?.value || '';
            const deleteFileBaseUrl = "{{ url('/admin/requirements') }}";
            const downloadFileBaseUrl = "{{ url('/admin/requirements') }}";
            const storageBaseUrl = "{{ asset('storage') }}";

            let toastTimeout;

            function escapeHtml(str) {
                if (!str) return '';

                return String(str).replace(/[&<>"']/g, function(m) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    } [m];
                });
            }

            function showToast(message, isError = false) {
                if (!toastEl || !toastTextSpan) return;

                clearTimeout(toastTimeout);

                toastTextSpan.innerHTML = message;

                if (isError) {
                    toastEl.style.background = 'rgba(220,38,38,0.92)';
                    toastEl.querySelector('i').className = 'fas fa-exclamation-triangle';
                } else {
                    toastEl.style.background = 'rgba(15,23,42,0.92)';
                    toastEl.querySelector('i').className = 'fas fa-check-circle';
                }

                toastEl.classList.add('show');

                toastTimeout = setTimeout(() => {
                    toastEl.classList.remove('show');
                }, 2500);
            }

            function updateFileCount() {
                const itemCards = document.querySelectorAll('.file-card');
                const emptyStates = document.querySelectorAll('.empty');

                if (fileCountBadge) {
                    fileCountBadge.innerText = itemCards.length;
                }

                if (itemCards.length > 0) {
                    emptyStates.forEach(empty => empty.remove());
                    return;
                }

                if (fileGrid && emptyStates.length === 0) {
                    const emptyDiv = document.createElement('div');
                    emptyDiv.className = 'empty';
                    emptyDiv.id = 'emptyStatePlaceholder';
                    emptyDiv.innerHTML = `
        <i class="fas fa-folder-open d-block"></i>
        <p>This folder is empty</p>
        <small>Create a subfolder or upload a file above.</small>
      `;
                    fileGrid.appendChild(emptyDiv);
                }
            }

            function updateSelectedFileName(name) {
                if (!selectedFileNameSpan) return;

                const safeName = escapeHtml(name);
                const shortName = safeName.length > 45 ? safeName.substring(0, 45) + '...' : safeName;

                selectedFileNameSpan.innerHTML = `
      <div class="selected-file-info">
        <i class="fas fa-paperclip text-primary"></i>
        <strong>Selected:</strong> ${shortName}
      </div>
    `;
            }

            function getIconClass(ext) {
                ext = String(ext || '').toLowerCase();

                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) return 'fa-file-image text-success';
                if (ext === 'pdf') return 'fa-file-pdf text-danger';
                if (['doc', 'docx'].includes(ext)) return 'fa-file-word text-primary';
                if (['xls', 'xlsx'].includes(ext)) return 'fa-file-excel text-success';
                if (['ppt', 'pptx'].includes(ext)) return 'fa-file-powerpoint text-warning';

                return 'fa-file text-secondary';
            }

            function addFileCardToGrid(fileData) {
                if (!fileGrid || !fileData) return;

                const fileName = fileData.original_name || fileData.file_original_name || 'Uploaded file';
                const safeFileName = escapeHtml(fileName);
                const ext = fileName.includes('.') ? fileName.split('.').pop().toLowerCase() : 'file';
                const iconClass = getIconClass(ext);
                const fileUrl = storageBaseUrl + '/' + fileData.file_path;
                const downloadUrl = `${downloadFileBaseUrl}/${fileData.id}/download`;

                document.querySelectorAll('.empty').forEach(empty => empty.remove());

                const fileCard = document.createElement('div');
                fileCard.className = 'file-card actual-file-card';
                fileCard.setAttribute('data-file-id', fileData.id);

                fileCard.innerHTML = `
      <div class="file-icon">
        <i class="fas ${iconClass}"></i>
      </div>

      <div class="file-name">
        ${safeFileName}
        <span class="file-badge">${escapeHtml(ext.toUpperCase())}</span>
      </div>

      <div class="file-actions dropdown">
        <button class="file-actions-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open actions">
          <i class="fas fa-ellipsis"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-end file-actions-menu">
          <a href="${fileUrl}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i> View</a>
          <a href="${downloadUrl}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-download"></i> Download</a>

          <form class="delete-file-form" action="${deleteFileBaseUrl}/${fileData.id}" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
          </form>
        </div>
      </div>
    `;

                fileGrid.prepend(fileCard);
                attachDeleteEvent(fileCard.querySelector('.delete-file-form'));
                updateFileCount();
            }

            function attachDeleteEvent(formElement) {
                if (!formElement) return;

                formElement.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!confirm('⚠️ Permanently delete this file? This action cannot be undone.')) {
                        return;
                    }

                    const deleteBtn = formElement.querySelector('button');
                    const originalText = deleteBtn ? deleteBtn.innerHTML : '';

                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<span class="loading-spinner"></span>';
                        deleteBtn.disabled = true;
                    }

                    try {
                        const response = await fetch(formElement.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': formElement.querySelector(
                                    'input[name="_token"]')?.value || csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new URLSearchParams({
                                '_method': 'DELETE'
                            })
                        });

                        let data = {};

                        try {
                            data = await response.json();
                        } catch (err) {
                            data = {};
                        }

                        if (response.ok && (data.success === true || Object.keys(data).length === 0)) {
                            showToast(data.message || '🗑️ File deleted');

                            const card = formElement.closest('.file-card');
                            if (card) card.remove();

                            updateFileCount();
                        } else {
                            showToast(data.message || 'Delete failed', true);
                        }

                    } catch (err) {
                        console.error(err);
                        showToast('Error deleting file', true);
                    } finally {
                        if (deleteBtn) {
                            deleteBtn.disabled = false;
                            deleteBtn.innerHTML = originalText;
                        }
                    }
                });
            }

            function attachDeleteFolderEvents() {
                document.querySelectorAll('.delete-folder-form').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        const confirmed = confirm(
                            'Delete this folder and all files/subfolders inside it?');

                        if (!confirmed) {
                            e.preventDefault();
                        }
                    });
                });
            }

            if (dropZone && fileInput) {
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

                    if (files.length > 0) {
                        fileInput.files = files;
                        updateSelectedFileName(files[0].name);
                        showToast(`File "${escapeHtml(files[0].name)}" selected`);
                    }
                });

                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        updateSelectedFileName(this.files[0].name);
                    } else if (selectedFileNameSpan) {
                        selectedFileNameSpan.innerHTML = '';
                    }
                });
            }

            if (uploadForm && uploadBtn && fileInput) {
                uploadForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const file = fileInput.files[0];

                    if (!file) {
                        showToast('❌ Please select a file first', true);
                        return;
                    }

                    if (file.size > 50 * 1024 * 1024) {
                        showToast('File size exceeds 50MB limit', true);
                        return;
                    }

                    const formData = new FormData(uploadForm);
                    const originalBtnHtml = uploadBtn.innerHTML;

                    uploadBtn.disabled = true;
                    uploadBtn.innerHTML = '<span class="loading-spinner"></span> Uploading...';

                    try {
                        const response = await fetch(uploadForm.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData
                        });

                        let result;

                        try {
                            result = await response.json();
                        } catch (err) {
                            if (response.ok) {
                                showToast('Upload successful! Refreshing...');
                                setTimeout(() => location.reload(), 800);
                            } else {
                                showToast('Upload failed. Server error.', true);
                            }

                            return;
                        }

                        if (response.ok && result.success) {
                            showToast(result.message || '✅ File uploaded successfully!');

                            if (result.file) {
                                addFileCardToGrid(result.file);
                                fileInput.value = '';

                                if (selectedFileNameSpan) {
                                    selectedFileNameSpan.innerHTML = '';
                                }
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
            }

            document.querySelectorAll('.delete-file-form').forEach(form => attachDeleteEvent(form));
            attachDeleteFolderEvents();
            updateFileCount();

            const successMsg = document.getElementById('successMsg');

            if (successMsg) {
                setTimeout(() => {
                    successMsg.style.opacity = '0';
                    successMsg.style.transform = 'translateY(-6px)';
                    successMsg.style.transition = 'opacity .35s ease, transform .35s ease';

                    setTimeout(() => {
                        successMsg.remove();
                    }, 400);
                }, 3000);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

