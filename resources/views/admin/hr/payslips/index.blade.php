<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR • Payslips</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --bg:#f3f4f6;
      --card:#ffffff;
      --border:#e5e7eb;
      --text:#111827;
      --muted:#6b7280;
      --black:#111827;
      --chip:#f8fafc;
      --shadow: 0 12px 35px rgba(0,0,0,.08);
      --radius: 18px;
    }

    body{
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background: radial-gradient(1200px 600px at 10% 0%, #ffffff 0%, var(--bg) 55%, var(--bg) 100%);
      color: var(--text);
    }

    .wrap{ max-width: 1150px; }

    .app-head{
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
      gap: 12px;
      flex-wrap: wrap;
      margin: 18px 0 12px;
    }
    .app-head h1{
      margin:0;
      font-size: 20px;
      font-weight: 950;
      letter-spacing:.2px;
    }
    .app-head p{
      margin: 6px 0 0;
      color: var(--muted);
      font-weight: 650;
      font-size: 13px;
    }

    .btn-black{
      background: var(--black);
      color:#fff;
      border:none;
      border-radius: 999px;
      font-weight: 900;
      padding: 10px 14px;
      box-shadow: 0 10px 24px rgba(17,24,39,.16);
      white-space: nowrap;
    }
    .btn-black:hover{ background:#000; color:#fff; }

    .btn-ghost{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 999px;
      font-weight: 900;
      padding: 10px 14px;
      color: var(--text);
      white-space: nowrap;
    }
    .btn-ghost:hover{ background:#f9fafb; }

    .panel{
      background: var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }

    .panel-h{
      padding: 12px 14px;
      border-bottom:1px solid var(--border);
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:10px;
      flex-wrap: wrap;
      background: linear-gradient(180deg, #ffffff 0%, #fbfbfb 100%);
    }
    .hint{
      color: var(--muted);
      font-weight: 650;
      font-size: 12px;
    }

    .grid{
      display:grid;
      grid-template-columns: 340px 1fr;
      gap: 12px;
      align-items: start;
    }

    .filters{
      padding: 12px 14px;
      border-bottom:1px solid var(--border);
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
    }
    .search{
      width: 100%;
      padding: 11px 12px;
      border-radius: 999px;
      border:1px solid var(--border);
      font-weight: 650;
      font-size: 13px;
      outline:none;
      background:#fff;
    }
    .search:focus{
      box-shadow: 0 0 0 .2rem rgba(17,24,39,.08);
      border-color: rgba(17,24,39,.18);
    }

    .folder-list{
      max-height: 520px;
      overflow:auto;
      padding: 8px;
    }
    .folder-item{
      display:flex;
      justify-content:space-between;
      gap: 12px;
      padding: 12px;
      border-radius: 14px;
      border:1px solid var(--border);
      background:#fff;
      text-decoration:none;
      color: var(--text);
      margin-bottom: 8px;
      transition: transform .12s ease, background .12s ease;
    }
    .folder-item:hover{ background:#fafafa; transform: translateY(-1px); }
    .folder-item.active{
      border-color: rgba(17,24,39,.35);
      box-shadow: 0 10px 22px rgba(0,0,0,.06);
    }
    .folder-item .k{
      font-weight: 950;
      font-size: 13px;
      margin: 0;
    }
    .folder-item .m{
      color: var(--muted);
      font-weight: 700;
      font-size: 12px;
      margin-top: 4px;
    }
    .pill{
      height: fit-content;
      padding: 6px 10px;
      border-radius: 999px;
      border:1px solid var(--border);
      background: var(--chip);
      font-weight: 900;
      font-size: 12px;
      white-space: nowrap;
    }

    table{ margin:0; }
    thead th{
      font-size: 12px;
      color: var(--muted);
      font-weight: 900;
      text-transform: uppercase;
      letter-spacing: .35px;
      padding: 12px 14px !important;
      border-bottom:1px solid var(--border) !important;
    }
    tbody td{
      padding: 14px !important;
      border-top:1px solid var(--border) !important;
      vertical-align: middle;
      font-weight: 650;
      font-size: 13px;
    }
    .file-name{
      font-weight: 950;
      font-size: 13px;
      margin:0;
      word-break: break-word;
    }
    .sub{
      color: var(--muted);
      font-weight: 700;
      font-size: 12px;
      margin-top: 4px;
    }

    @media (max-width: 992px){
      .grid{ grid-template-columns: 1fr; }
      .folder-list{ max-height: 320px; }
    }
  </style>
</head>

<body>
<main class="container wrap py-4">

  <div class="app-head">
    <div>
      <h1>Payslips</h1>
      <p>Browse folders and search uploaded payslip files.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
      <a href="{{ url('/hr/dashboard') }}" class="btn btn-ghost">Back</a>
      {{-- optional: add upload button if you have route --}}
      {{-- <a href="{{ route('hr.payslips.create') }}" class="btn btn-black">Upload Payslip</a> --}}
    </div>
  </div>

  <div class="grid">

    {{-- LEFT: FOLDERS --}}
    <section class="panel">
      <div class="panel-h">
        <div class="fw-bold">Folders</div>
        <div class="hint">Filter by month</div>
      </div>

      <div class="filters">
        <a href="{{ route('hr.payslips.index') }}" class="btn btn-ghost w-100">
          All Payslips
        </a>
      </div>

      <div class="folder-list">
        @forelse($folders as $f)
          <a
            class="folder-item {{ ($folder === $f['key']) ? 'active' : '' }}"
            href="{{ route('hr.payslips.index', ['folder' => $f['key'], 'q' => $q]) }}"
          >
            <div>
              <p class="k">{{ $f['label'] }}</p>
              <div class="m">
                Key: {{ $f['key'] }} • Latest: {{ $f['latest'] ?? '—' }}
              </div>
            </div>
            <span class="pill">{{ $f['count'] }}</span>
          </a>
        @empty
          <div class="p-3 text-muted fw-semibold">No folders yet.</div>
        @endforelse
      </div>
    </section>

    {{-- RIGHT: PAYSLIPS --}}
    <section class="panel">
      <div class="panel-h">
        <div>
          <div class="fw-bold">
            Files {{ $folder ? '• '.$folder : '' }}
          </div>
          <div class="hint">
            Showing {{ $payslips->total() }} result(s)
          </div>
        </div>
      </div>

      <div class="filters">
        <form class="d-flex gap-2 flex-wrap w-100" method="GET" action="{{ route('hr.payslips.index') }}">
          <input type="hidden" name="folder" value="{{ $folder }}">
          <input
            class="search"
            type="text"
            name="q"
            value="{{ $q }}"
            placeholder="Search file name, batch name, folder key..."
          >
          <button class="btn btn-black" type="submit">Search</button>
        </form>
      </div>

      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>File</th>
              <th>Folder</th>
              <th>Uploader</th>
              <th>Date</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($payslips as $p)
              <tr>
                <td>
                  <p class="file-name">{{ $p->original_name ?? '—' }}</p>
                  <div class="sub">Batch: {{ $p->batch_name ?? '—' }}</div>
                </td>

                <td>
                  <span class="pill">{{ $p->folder_key }}</span>
                </td>

                <td>
                  {{ $p->uploader->name ?? '—' }}
                </td>

                <td>
                  {{ optional($p->created_at)->format('M d, Y • h:i A') }}
                </td>

                <td class="text-end d-flex justify-content-end gap-2">
                  {{-- Palitan mo ito base sa routes mo --}}
                  {{-- Example: download/view --}}
                  <a href="{{ url('/hr/payslips/'.$p->id.'/download') }}" class="btn btn-ghost">Download</a>

                  {{-- Optional delete --}}
                  {{-- <form method="POST" action="{{ url('/hr/payslips/'.$p->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-ghost" type="submit">Delete</button>
                  </form> --}}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted fw-semibold py-5">
                  No payslips found.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="p-3 border-top" style="border-color: var(--border) !important;">
        {{ $payslips->links() }}
      </div>
    </section>

  </div>
</main>
</body>
</html>
