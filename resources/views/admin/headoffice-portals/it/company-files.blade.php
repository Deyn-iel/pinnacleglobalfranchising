<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Files</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@vite(['resources/css/admin/shadcn-tables.css'])

<style>
:root {
  --sidebar-w: 260px;

  --bg: #f4f6f9;
  --card: #ffffff;
  --card-soft: #f8fafc;

  --text: #111827;
  --muted: #6b7280;
  --border: #e5e7eb;

  --primary: #2563eb;
  --primary-dark: #1d4ed8;
  --primary-soft: #eff6ff;

  --success: #16a34a;
  --success-soft: #ecfdf5;

  --danger: #dc2626;
  --warning: #f59e0b;

  --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.08);
  --shadow-md: 0 10px 24px rgba(15, 23, 42, 0.08);

  --radius: 14px;
  --radius-lg: 18px;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  width: 100%;
  scroll-behavior: smooth;
}

body {
  margin: 0;
  width: 100%;
  min-height: 100vh;
  background: var(--bg);
  color: var(--text);
  font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  overflow-x: hidden;
}

a {
  text-decoration: none;
}

img,
svg,
video {
  max-width: 100%;
  height: auto;
}

/* ================= MAIN LAYOUT ================= */
.main {
  width: calc(100% - var(--sidebar-w));
  min-height: 100vh;
  margin-left: var(--sidebar-w);
  padding: clamp(20px, 2.2vw, 34px);
}

.page-shell {
  width: 100%;
  max-width: 1500px;
  margin: 0 auto;
}

/* ================= PAGE HEADER ================= */
.page-header {
  width: 100%;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: clamp(18px, 1.6vw, 24px);
  box-shadow: var(--shadow-sm);
  margin-bottom: 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}

.page-title-wrap {
  min-width: 0;
  flex: 1 1 320px;
  display: flex;
  align-items: center;
  gap: 14px;
}

.page-icon {
  width: clamp(42px, 3.5vw, 52px);
  height: clamp(42px, 3.5vw, 52px);
  border-radius: var(--radius);
  background: var(--primary-soft);
  color: var(--primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: clamp(19px, 1.5vw, 23px);
  flex: 0 0 auto;
}

.page-title {
  margin: 0;
  font-size: clamp(22px, 2vw, 30px);
  font-weight: 900;
  line-height: 1.2;
  color: var(--text);
  word-break: break-word;
}

.page-subtitle {
  margin-top: 4px;
  color: var(--muted);
  font-size: clamp(13px, 1vw, 14px);
  font-weight: 500;
}

.header-badge {
  background: var(--card-soft);
  border: 1px solid var(--border);
  color: var(--muted);
  border-radius: 999px;
  padding: 9px 14px;
  font-size: 13px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  white-space: nowrap;
}

/* ================= BACK BUTTON ================= */
.back-btn {
  min-height: 42px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--card);
  color: var(--primary);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 10px 15px;
  font-size: 14px;
  font-weight: 800;
  box-shadow: var(--shadow-sm);
  transition: 0.2s ease;
  white-space: nowrap;
}

.back-btn:hover {
  background: var(--primary);
  border-color: var(--primary);
  color: #ffffff;
}

/* ================= FOLDER GRID ================= */
.folder-grid {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 230px), 1fr));
  gap: clamp(14px, 1.3vw, 20px);
  margin-bottom: 22px;
}

.folder-card {
  min-height: 145px;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: clamp(17px, 1.5vw, 22px);
  color: var(--text);
  box-shadow: var(--shadow-sm);
  transition: 0.2s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}

.folder-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  border-color: #bfdbfe;
  color: var(--text);
}

.folder-top {
  display: flex;
  align-items: flex-start;
  gap: 13px;
  min-width: 0;
}

.folder-icon {
  width: clamp(42px, 3.2vw, 48px);
  height: clamp(42px, 3.2vw, 48px);
  border-radius: var(--radius);
  background: #fffbeb;
  color: var(--warning);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: clamp(20px, 1.5vw, 24px);
  flex: 0 0 auto;
}

.folder-name {
  min-width: 0;
  font-size: clamp(15px, 1.1vw, 17px);
  font-weight: 900;
  line-height: 1.35;
  word-break: break-word;
  overflow-wrap: anywhere;
}

.folder-desc {
  color: var(--muted);
  font-size: 13px;
  margin-top: 5px;
}

.folder-footer {
  margin-top: 18px;
  color: var(--primary);
  font-size: 13px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  gap: 7px;
}

/* ================= TABLE CARD ================= */
.table-card {
  width: 100%;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}

.table-toolbar {
  padding: clamp(15px, 1.3vw, 18px);
  border-bottom: 1px solid var(--border);
  background: var(--card);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}

.table-title {
  margin: 0;
  font-size: 16px;
  font-weight: 900;
}

.table-subtitle {
  color: var(--muted);
  font-size: 13px;
  margin-top: 2px;
}

.table-responsive {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.files-table {
  width: 100%;
  min-width: 620px;
  margin: 0;
  border-collapse: collapse;
  table-layout: fixed;
}

.files-table thead th {
  background: var(--card-soft);
  color: #374151;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  font-weight: 900;
  padding: 14px 18px;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
}

.files-table tbody td {
  padding: 16px 18px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}

.files-table tbody tr:last-child td {
  border-bottom: none;
}

.files-table tbody tr:hover {
  background: #f9fafb;
}

/* ================= FILE CELL ================= */
.file-info {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
}

.file-icon {
  width: 42px;
  height: 42px;
  border-radius: var(--radius);
  background: var(--primary-soft);
  color: var(--primary);
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 0 0 auto;
  font-size: 18px;
}

.file-name {
  min-width: 0;
  color: var(--text);
  font-size: 14px;
  font-weight: 800;
  line-height: 1.35;
  word-break: break-word;
  overflow-wrap: anywhere;
}

.file-type {
  display: inline-flex;
  align-items: center;
  margin-top: 5px;
  background: var(--card-soft);
  border: 1px solid var(--border);
  border-radius: 999px;
  padding: 3px 8px;
  color: var(--muted);
  font-size: 10px;
  font-weight: 900;
  text-transform: uppercase;
}

/* ================= ACTION BUTTONS ================= */
.actions {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.actions-toggle {
  width: 36px;
  height: 36px;
  border: 1px solid var(--border);
  border-radius: 12px;
  background: #fff;
  color: var(--text);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  box-shadow: var(--shadow-sm);
  transition: 0.2s ease;
}

.actions-toggle:hover,
.actions-toggle.show {
  background: var(--text);
  border-color: var(--text);
  color: #fff;
}

.actions-menu {
  min-width: 170px;
  padding: 8px;
  border: 1px solid var(--border);
  border-radius: 14px;
  box-shadow: var(--shadow-md);
}

.actions-menu.show {
  margin-top: 8px !important;
}

.action-btn {
  width: 100%;
  min-height: 38px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 7px;
  border-radius: 10px;
  padding: 8px 12px;
  font-size: 12px;
  font-weight: 900;
  transition: 0.2s ease;
  border: 1px solid transparent;
  white-space: nowrap;
  margin-bottom: 6px;
}

.actions-menu .action-btn:last-child {
  margin-bottom: 0;
}

.view {
  background: var(--primary-soft);
  color: var(--primary);
  border-color: #bfdbfe;
}

.view:hover {
  background: var(--primary);
  border-color: var(--primary);
  color: #ffffff;
}

.download {
  background: var(--success-soft);
  color: var(--success);
  border-color: #bbf7d0;
}

.download:hover {
  background: var(--success);
  border-color: var(--success);
  color: #ffffff;
}

/* ================= EMPTY STATE ================= */
.empty-state {
  width: 100%;
  background: var(--card);
  border: 1px dashed #cbd5e1;
  border-radius: var(--radius-lg);
  padding: clamp(40px, 5vw, 60px) 20px;
  text-align: center;
  color: var(--muted);
  box-shadow: var(--shadow-sm);
}

.empty-icon {
  width: 64px;
  height: 64px;
  margin: 0 auto 16px;
  border-radius: 50%;
  background: var(--card-soft);
  color: #94a3b8;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
}

.empty-state h5 {
  color: var(--text);
  font-size: 17px;
  font-weight: 900;
  margin-bottom: 6px;
}

.empty-state p {
  margin: 0;
  font-size: 14px;
}

/* ================= RESPONSIVE ================= */
@media (min-width: 1600px) {
  :root {
    --sidebar-w: 280px;
  }

  .page-shell {
    max-width: 1680px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  }

  .folder-card {
    min-height: 160px;
  }
}

@media (max-width: 1440px) {
  :root {
    --sidebar-w: 250px;
  }

  .page-shell {
    max-width: 1280px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  }
}

@media (max-width: 1366px) {
  :root {
    --sidebar-w: 240px;
  }

  .main {
    padding: 24px;
  }

  .page-shell {
    max-width: 1180px;
  }
}

@media (max-width: 1280px) {
  :root {
    --sidebar-w: 230px;
  }

  .main {
    padding: 22px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  }

  .files-table thead th,
  .files-table tbody td {
    padding-left: 15px;
    padding-right: 15px;
  }
}

@media (max-width: 1199px) {
  :root {
    --sidebar-w: 220px;
  }

  .main {
    width: calc(100% - var(--sidebar-w));
    margin-left: var(--sidebar-w);
    padding: 20px;
  }

  .page-shell {
    max-width: 100%;
  }

  .page-header {
    gap: 14px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  }

  .action-btn {
    padding: 8px 10px;
  }
}

@media (max-width: 1024px) {
  :root {
    --sidebar-w: 210px;
  }

  .main {
    padding: 18px;
  }

  .page-header {
    padding: 18px;
    align-items: stretch;
  }

  .page-title-wrap {
    flex: 1 1 100%;
  }

  .header-badge,
  .back-btn {
    width: 100%;
    justify-content: center;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  }
}

@media (max-width: 900px) {
  :root {
    --sidebar-w: 190px;
  }

  .main {
    padding: 16px;
  }

  .page-title {
    font-size: 22px;
  }

  .page-subtitle {
    font-size: 13px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  }

  .folder-card {
    min-height: 135px;
  }

  .files-table {
    min-width: 560px;
  }
}

@media (max-width: 768px) {
  :root {
    --sidebar-w: 0px;
  }

  .sidebar {
    display: none !important;
  }

  .main {
    width: 100%;
    margin-left: 0;
    padding: 14px;
  }

  .page-header {
    padding: 18px;
  }

  .folder-grid {
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 14px;
  }

  .folder-card {
    min-height: 135px;
    padding: 17px;
  }

  .table-toolbar {
    align-items: flex-start;
  }

  .table-responsive {
    overflow-x: visible;
  }

  .files-table {
    min-width: 0;
  }

  .files-table thead {
    display: none;
  }

  .files-table,
  .files-table tbody,
  .files-table tr,
  .files-table td {
    display: block;
    width: 100%;
  }

  .files-table tbody tr {
    padding: 14px;
    border-bottom: 1px solid var(--border);
  }

  .files-table tbody tr:last-child {
    border-bottom: none;
  }

  .files-table tbody td {
    padding: 8px 0;
    border-bottom: none;
  }

  .files-table tbody td::before {
    content: attr(data-label);
    display: block;
    color: var(--muted);
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 6px;
  }

  .actions {
    align-items: stretch;
  }

  .action-btn {
    flex: 1 1 120px;
  }
}

@media (max-width: 575px) {
  .main {
    padding: 14px;
  }

  .page-header {
    border-radius: 16px;
  }

  .page-title-wrap {
    align-items: flex-start;
  }

  .page-icon {
    width: 42px;
    height: 42px;
    font-size: 19px;
  }

  .page-title {
    font-size: 21px;
  }

  .folder-grid {
    grid-template-columns: 1fr;
  }

  .folder-card {
    min-height: auto;
  }

  .file-info {
    align-items: flex-start;
  }

  .actions {
    flex-direction: column;
  }

  .action-btn {
    width: 100%;
  }
}

@media (max-width: 380px) {
  .main {
    padding: 12px;
  }

  .page-header,
  .folder-card,
  .table-toolbar {
    padding: 14px;
  }

  .file-icon,
  .folder-icon {
    width: 38px;
    height: 38px;
    font-size: 17px;
  }
}

@media print {
  .sidebar,
  .back-btn,
  .actions {
    display: none !important;
  }

  .main {
    width: 100%;
    margin-left: 0;
    padding: 0;
  }

  .page-header,
  .table-card,
  .folder-card,
  .empty-state {
    box-shadow: none;
  }
}
</style>
</head>

<body>

@include('admin.headoffice-portals.it.partials.sidebar')

<main class="main">
  <div class="page-shell">

    {{-- ================= ROOT FOLDER VIEW ================= --}}
    @if(!isset($files))

      <div class="page-header">
        <div class="page-title-wrap">
          <div class="page-icon">
            <i class="fa-solid fa-folder-open"></i>
          </div>

          <div>
            <h2 class="page-title">Company Files</h2>
            <div class="page-subtitle">Browse folders and access company documents.</div>
          </div>
        </div>

        <div class="header-badge">
          <i class="fa-solid fa-folder"></i>
          {{ count($folders) }} Folder{{ count($folders) == 1 ? '' : 's' }}
        </div>
      </div>

      @if(count($folders) > 0)
        <div class="folder-grid">
          @foreach($folders as $rootFolder)
            <a href="{{ route('portal.company-files.folder', [$department, $rootFolder]) }}" class="folder-card">
              <div class="folder-top">
                <div class="folder-icon">
                  <i class="fa-solid fa-folder"></i>
                </div>

                <div>
                  <div class="folder-name">{{ $rootFolder }}</div>
                  <div class="folder-desc">Click to view files</div>
                </div>
              </div>

              <div class="folder-footer">
                Open folder
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </a>
          @endforeach
        </div>
      @else
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fa-solid fa-folder-open"></i>
          </div>
          <h5>No folders found</h5>
          <p>There are no company file folders available yet.</p>
        </div>
      @endif

    @endif

    {{-- ================= FOLDER / FILE VIEW ================= --}}
    @if(isset($files))

      @php
        $subfolderCount = isset($subfolders) ? count($subfolders) : 0;
        $fileCount = count($files);
        $itemCount = $subfolderCount + $fileCount;
      @endphp

      <div class="page-header">
        <div class="page-title-wrap">
          <div class="page-icon">
            <i class="fa-solid fa-folder"></i>
          </div>

          <div>
            <h2 class="page-title">{{ $folderName ?? basename($folder) }}</h2>
            <div class="page-subtitle">
              {{ $itemCount }} item{{ $itemCount == 1 ? '' : 's' }} available
            </div>
          </div>
        </div>

        @if(!empty($parentFolder))
          <a href="{{ route('portal.company-files.folder', [$department, $parentFolder]) }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back
          </a>
        @else
          <a href="{{ route('portal.company-files', $department) }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to folders
          </a>
        @endif
      </div>

      @if(isset($subfolders) && count($subfolders) > 0)
        <div class="folder-grid">
          @foreach($subfolders as $subfolder)
            <a href="{{ route('portal.company-files.folder', [$department, $subfolder['path']]) }}" class="folder-card">
              <div class="folder-top">
                <div class="folder-icon">
                  <i class="fa-solid fa-folder"></i>
                </div>

                <div>
                  <div class="folder-name">{{ $subfolder['name'] }}</div>
                  <div class="folder-desc">Subfolder</div>
                </div>
              </div>

              <div class="folder-footer">
                Open folder
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </a>
          @endforeach
        </div>
      @endif

      @if(count($files) > 0)
        <div class="table-card">
          <div class="table-toolbar">
            <div>
              <h5 class="table-title">Files</h5>
              <div class="table-subtitle">
                {{ count($files) }} File{{ count($files) == 1 ? '' : 's' }} available
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="files-table">
              <thead>
                <tr>
                  <th>File Name</th>
                  <th style="width: 240px;">Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($files as $file)
                  @php
                    $ext = strtolower(pathinfo($file->file_original_name ?? '', PATHINFO_EXTENSION));
                    $icon = 'fa-file';

                    if(in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                      $icon = 'fa-file-image';
                    } elseif($ext === 'pdf') {
                      $icon = 'fa-file-pdf';
                    } elseif(in_array($ext, ['doc','docx'])) {
                      $icon = 'fa-file-word';
                    } elseif(in_array($ext, ['xls','xlsx'])) {
                      $icon = 'fa-file-excel';
                    } elseif(in_array($ext, ['ppt','pptx'])) {
                      $icon = 'fa-file-powerpoint';
                    }
                  @endphp

                  <tr>
                    <td data-label="File Name">
                      <div class="file-info">
                        <div class="file-icon">
                          <i class="fa-solid {{ $icon }}"></i>
                        </div>

                        <div>
                          <div class="file-name">
                            {{ $file->file_original_name }}
                          </div>

                          <span class="file-type">{{ $ext ? $ext : 'file' }}</span>
                        </div>
                      </div>
                    </td>

                    <td data-label="Action">
                      <div class="actions dropdown">
                        <button class="actions-toggle" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false" aria-label="Open actions">
                          <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end actions-menu">
                          <a
                            href="{{ asset('storage/'.$file->file_path) }}"
                            target="_blank"
                            class="action-btn view">
                            <i class="fa-solid fa-eye"></i>
                            View
                          </a>

                          <a
                            href="{{ route('portal.company-files.download', [$department, $file]) }}"
                            class="action-btn download">
                            <i class="fa-solid fa-download"></i>
                            Download
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif

      @if($itemCount === 0)
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fa-solid fa-folder-open"></i>
          </div>
          <h5>This folder is empty</h5>
          <p>This folder does not contain files or subfolders yet.</p>
        </div>
      @endif

    @endif

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


