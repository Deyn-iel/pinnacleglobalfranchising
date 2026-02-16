<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Desktop/Laptop only: responsive pa rin sa iba't ibang screen widths -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration (Admin)</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/admin/app.css'])

    <style>
        :root{
            --sidebar-w: 260px;
            --bg: #f5f6fa;
            --card: rgba(255,255,255,.88);
            --text:#0f172a;
            --muted:#64748b;
            --border: rgba(15,23,42,.10);
            --shadow: 0 18px 45px rgba(15,23,42,.08);
            --shadow-hover: 0 30px 80px rgba(15,23,42,.18);
            --radius: 18px;
            --primary: #0d3553;
            --primary-soft: rgba(13,53,83,.12);
            --stroke-strong:#d1d5db;
        }

        html,body{ height:100%; }
        body{
            margin:0;
            background:
                radial-gradient(1200px 600px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
                radial-gradient(900px 500px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
                var(--bg);
            color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
            overflow-x:hidden;
        }

        /* ✅ IMPORTANT FIX:
           Sidebar include usually renders a top-level <aside>.
           We target ONLY the top-level aside, NOT the Review Panel aside inside <main>. */
        body > aside{
            width: var(--sidebar-w);
            z-index: 999;
        }

        /* Main content offset from sidebar */
        main{
            margin-left: var(--sidebar-w);
            padding: clamp(16px, 2vw, 34px);
            max-width: calc(100vw - var(--sidebar-w));
            min-width: 0;
        }

        /* ===== Header card ===== */
        .dashboard-header{
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: clamp(16px, 2vw, 26px);
            box-shadow: var(--shadow);
            margin-bottom: 18px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }
        .dashboard-header::after{
            content:"";
            position:absolute;
            right:-90px; top:-90px;
            width: 260px; height: 260px;
            pointer-events:none;
        }
        .dashboard-header h2{
            font-weight: 900;
            margin-bottom: 6px;
            letter-spacing: -.02em;
            font-size: clamp(18px, 2vw, 26px);
        }
        .dashboard-header p{
            color: var(--muted);
            margin: 0;
        }

        /* Buttons */
        .page-actions{
            display:flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .adm-btn{
            border-radius: 999px;
            border: 1px solid rgba(13,53,83,.22);
            padding: 10px 14px;
            font-size: 13px;
            cursor:pointer;
            background: var(--primary);
            color:#fff;
            box-shadow: 0 8px 18px rgba(13,53,83,.15);
            transition: transform .12s ease, filter .12s ease;
            white-space: nowrap;
        }
        .adm-btn:hover{ transform: translateY(-1px); filter: brightness(1.05); }
        .adm-btn:active{ transform: translateY(0); }
        .adm-btn-ghost{
            background:#fff;
            color: var(--primary);
            border: 1px solid rgba(13,53,83,.25);
            box-shadow:none;
        }
        .adm-btn-ghost:hover{ background: rgba(13,53,83,.04); }

        /* Cards */
        .glass-card{
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }
        .glass-card:hover{
            box-shadow: var(--shadow-hover);
            border-color: rgba(13,110,253,.22);
        }

        .card-head{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
            padding: 18px 18px 0 18px;
        }
        .card-title{
            display:flex;
            align-items:center;
            gap: 10px;
            margin:0;
            font-weight: 900;
            font-size: 15px;
            letter-spacing: -.01em;
        }
        .title-icon{
            width: 44px;
            height: 44px;
            border-radius: 16px;
            display:grid;
            place-items:center;
            background: var(--primary-soft);
            color: var(--primary);
            box-shadow: 0 14px 28px rgba(13,53,83,.10);
            flex: 0 0 auto;
        }
        .badge-live{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(15,23,42,.04);
            border: 1px solid rgba(15,23,42,.06);
            font-size: 12px;
            color: #0f172a;
            white-space: nowrap;
        }
        .badge-live .dot{
            width:8px;height:8px;border-radius:999px;
            background:#22c55e;
            box-shadow: 0 0 0 6px rgba(34,197,94,.14);
        }

        .card-body-pad{
            padding: 14px 18px 18px 18px;
        }

        /* Table */
        .table-wrap{
            border: 1px solid rgba(15,23,42,.08);
            border-radius: 16px;
            overflow: hidden;
            background: rgba(255,255,255,.85);
        }
        /* ✅ allow horizontal scroll on small laptops */
        .table-scroll{
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table{
            margin:0;
            min-width: 1120px; /* more columns now */
        }
        .table thead th{
            background: rgba(248,250,252,.95);
            color:#334155;
            font-weight: 800;
            font-size: 12.5px;
            border-bottom: 1px solid rgba(15,23,42,.08) !important;
            white-space: nowrap;
        }
        .table td{
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .pill-mini{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 6px 10px;
            border-radius:999px;
            border: 1px solid rgba(15,23,42,.10);
            background: rgba(255,255,255,.9);
            font-size: 12px;
            color: #0f172a;
            white-space: nowrap;
        }

        .pill-status{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 6px 10px;
            border-radius:999px;
            border: 1px solid rgba(15,23,42,.10);
            background: rgba(255,255,255,.9);
            font-size: 12px;
            color: #0f172a;
            white-space: nowrap;
        }
        .pill-status.pending{ border-color: rgba(234,179,8,.35); background: rgba(234,179,8,.10); }
        .pill-status.approved{ border-color: rgba(34,197,94,.35); background: rgba(34,197,94,.10); }
        .pill-status.rejected{ border-color: rgba(239,68,68,.35); background: rgba(239,68,68,.10); }
        .pill-status.draft{ border-color: rgba(100,116,139,.35); background: rgba(100,116,139,.10); }

        /* Form */
        .form-label{ color: var(--muted); font-size: 12.5px; }
        .form-control, .form-select{
            border-radius: 14px !important;
            border-color: var(--stroke-strong) !important;
            padding: 10px 12px !important;
            background: rgba(255,255,255,.92);
        }
        .form-control:focus, .form-select:focus{
            border-color: rgba(13,53,83,.45) !important;
            box-shadow: 0 0 0 4px rgba(13,53,83,.10) !important;
        }

        .note{
            border: 1px solid rgba(15,23,42,.08);
            background: rgba(255,255,255,.70);
            border-radius: 16px;
            padding: 12px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        /* ✅ DESKTOP/LAPTOP RESPONSIVE GRID */
        .adm-grid{
            display:grid;
            grid-template-columns: minmax(620px, 1fr) 460px;
            gap: 16px;
            align-items: start;
        }

        /* ====== Laptop 1366px and below ====== */
        @media (max-width: 1366px){
            :root{ --sidebar-w: 250px; }
            main{
                margin-left: var(--sidebar-w);
                max-width: calc(100vw - var(--sidebar-w));
                padding: 22px;
            }
            .adm-grid{
                grid-template-columns: minmax(600px, 1fr) 420px;
            }
        }

        /* ====== Laptop 1280px and below ====== */
        @media (max-width: 1280px){
            .adm-grid{
                grid-template-columns: minmax(560px, 1fr) 390px;
            }
            .card-head{ padding: 16px 16px 0 16px; }
            .card-body-pad{ padding: 12px 16px 16px 16px; }
        }

        /* ====== Small laptop 1024px and below ====== */
        @media (max-width: 1024px){
            :root{ --sidebar-w: 240px; }
            main{
                margin-left: var(--sidebar-w);
                max-width: calc(100vw - var(--sidebar-w));
                padding: 18px;
            }
            .adm-grid{
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 1600px){
            main{ padding: 34px; }
            .adm-grid{
                grid-template-columns: minmax(820px, 1fr) 520px;
            }
        }

        /* small helpers */
        .text-truncate-1{
            max-width: 280px;
            overflow:hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display:inline-block;
            vertical-align: bottom;
        }
        /* ✅ smoother transitions (Alpine classes) */
.adm-fade-enter,
.adm-fade-leave{
  transition-property: opacity, transform, filter;
  transition-timing-function: cubic-bezier(.22,1,.36,1);
  will-change: opacity, transform;
}

.adm-fade-enter{ transition-duration: 320ms; }
.adm-fade-leave{ transition-duration: 900ms; } /* smoother fade-out */

.adm-fade-enter-start{
  opacity: 0;
  transform: translateY(-8px);
  filter: blur(2px);
}
.adm-fade-enter-end{
  opacity: 1;
  transform: translateY(0);
  filter: blur(0);
}

.adm-fade-leave-start{
  opacity: 1;
  transform: translateY(0);
  filter: blur(0);
}
.adm-fade-leave-end{
  opacity: 0;
  transform: translateY(-8px);
  filter: blur(2px);
}

/* ✅ Alert Design */
.adm-alert{
  display:flex;
  align-items:center;
  gap: 10px;
  border-radius: 14px;
  padding: 12px 14px;
  border: 1px solid rgba(15,23,42,.10);
  background: rgba(255,255,255,.92);
  box-shadow: 0 14px 35px rgba(15,23,42,.08);
  backdrop-filter: blur(10px);
  position: relative;
}

.adm-alert-success{
  border-color: rgba(34,197,94,.30);
  background: rgba(34,197,94,.10);
  color: #166534;
}

.adm-alert-close{
  margin-left: auto;
  border: 0;
  background: transparent;
  color: rgba(15,23,42,.45);
  padding: 6px 8px;
  border-radius: 10px;
  cursor: pointer;
  transition: background .15s ease, color .15s ease, transform .15s ease;
}
.adm-alert-close:hover{
  background: rgba(15,23,42,.06);
  color: rgba(15,23,42,.75);
  transform: translateY(-1px);
}

    </style>
</head>

<body>

    @include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>
  @if(session('success'))
  <div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition:enter="adm-fade-enter"
    x-transition:enter-start="adm-fade-enter-start"
    x-transition:enter-end="adm-fade-enter-end"
    x-transition:leave="adm-fade-leave"
    x-transition:leave-start="adm-fade-leave-start"
    x-transition:leave-end="adm-fade-leave-end"
    class="adm-alert adm-alert-success mb-3"
    role="alert"
  >
    <i class="fa-solid fa-circle-check me-2"></i>
    <span>{{ session('success') }}</span>

  </div>
@endif


  <div class="dashboard-header d-flex justify-content-between align-items-center gap-3">
    <div>
      <h2 class="mb-1">Coffee Track Registrations</h2>
      <p class="mb-0">Incoming submissions from users</p>
    </div>

    <form class="d-flex gap-2" method="GET" action="{{ route('admin.coffee-registrations.index') }}">
      <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search name/email/session">
      <select class="form-select" name="status">
        <option value="">All</option>
        @foreach(['Pending','Approved','Rejected'] as $st)
          <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
        @endforeach
      </select>
      <button class="btn btn-primary">Filter</button>
    </form>
  </div>

  <div class="adm-grid">

    <section class="glass-card">
      <div class="card-head">
        <h3 class="card-title">
          <span class="title-icon"><i class="fa-solid fa-list-check"></i></span>
          Submissions
        </h3>
        <span class="badge-live"><span class="dot"></span> Live</span>
      </div>

      <div class="card-body-pad">
        <div class="table-wrap table-scroll">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>Applicant</th>
                <th>Email</th>
                <th>Session</th>
                <th>Package</th>
                <th>Status</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($regs as $r)
                <tr>
                  <td><span class="pill-mini">{{ $r->full_name }}</span></td>
                  <td class="text-muted">{{ $r->email }}</td>
                  <td class="text-muted">{{ $r->session_datetime }}</td>
                  <td class="text-muted">{{ $r->rate_type }} (₱{{ number_format($r->rate_amount,2) }})</td>
                  <td><span class="pill-mini">{{ $r->status }}</span></td>
                  <td class="text-end">
  <div class="d-inline-flex gap-2">
    <a class="btn btn-sm btn-outline-secondary rounded-pill"
       href="{{ route('admin.coffee-registrations.index', array_merge(request()->query(), ['selected'=>$r->id])) }}">
      View
    </a>

    <form
      method="POST"
      action="{{ route('admin.coffee-registrations.destroy', $r->id) }}"
      onsubmit="return confirm('Delete this registration? This cannot be undone.')"
      class="d-inline"
    >
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
        <i class="fa-solid fa-trash me-1"></i> Delete
      </button>
    </form>
  </div>
</td>

                </tr>
              @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No registrations found.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $regs->links() }}
        </div>
      </div>
    </section>

    <aside class="glass-card">
  <div class="card-head">
    <h3 class="card-title">
      <span class="title-icon"><i class="fa-solid fa-file-lines"></i></span>
      Review Panel
    </h3>
    <span class="pill-mini">Admin / HR</span>
  </div>

  <div class="card-body-pad">
    @if($selected)

      {{-- EVENT INFO --}}
      <div class="note mb-3">
        <strong>Event:</strong> {{ $selected->event_name }} <br>
        <strong>Venue:</strong> {{ $selected->event_venue }} <br>
        <strong>Date:</strong> {{ $selected->event_date_range }}
      </div>

      {{-- APPLICANT DETAILS --}}
      <div class="mb-3">
        <div><strong>Applicant:</strong> {{ $selected->full_name }}</div>
        <div><strong>Email:</strong> {{ $selected->email }}</div>
        <div><strong>Phone:</strong> {{ $selected->phone ?? '—' }}</div>
        <hr>
        <div><strong>Session:</strong> {{ $selected->session_title }}</div>
        <div><strong>Speaker:</strong> {{ $selected->session_speaker }}</div>
        <div><strong>Schedule:</strong> {{ $selected->session_datetime }}</div>
        <hr>
        <div><strong>Package:</strong> {{ $selected->rate_type }} (₱{{ number_format($selected->rate_amount,2) }})</div>
        <div><strong>Payment:</strong> {{ $selected->payment_method ?? '—' }}</div>
        <div><strong>Ref #:</strong> {{ $selected->reference_no ?? '—' }}</div>
      </div>

      {{-- STATUS UPDATE --}}
      <form method="POST" action="{{ route('admin.coffee-registrations.update', $selected) }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status" required>
            @foreach(['Pending','Approved','Rejected','Confirmed'] as $st)
              <option value="{{ $st }}" @selected($selected->status===$st)>
                {{ $st }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Admin notes</label>
          <textarea class="form-control" name="admin_notes" rows="4">
            {{ old('admin_notes', $selected->admin_notes) }}
          </textarea>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-3">
          <button class="adm-btn" type="submit">
            <i class="fa-solid fa-check me-1"></i> Update
          </button>
        </div>
      </form>

      {{-- DELETE BUTTON --}}
      <form
        method="POST"
        action="{{ route('admin.coffee-registrations.destroy', $selected) }}"
        onsubmit="return confirm('Delete this registration? This cannot be undone.')"
        class="mb-4"
      >
        @csrf
        @method('DELETE')
        <button class="adm-btn adm-btn-ghost w-100"
                style="border-color: rgba(239,68,68,.35); color:#b91c1c;">
          <i class="fa-solid fa-trash me-1"></i> Delete Registration
        </button>
      </form>

      {{-- ================= HR SECTION ================= --}}
      @php $hrAccess = auth()->user()->hr_access ?? false; @endphp

      @if($hrAccess)

        <hr>

        <h6 class="fw-bold mb-2">HR Requirements (3 documents)</h6>

        @php
          $count = 0;
          if($selected->request_approval_path) $count++;
          if($selected->travel_order_path) $count++;
          if($selected->registration_ticket_path) $count++;
        @endphp

        <div class="note mb-3">
          <strong>Progress:</strong> {{ $count }}/3 <br>

          @if($selected->completed_at)
            <span class="text-success fw-bold">
              ✅ Completed ({{ \Carbon\Carbon::parse($selected->completed_at)->format('M d, Y h:i A') }})
            </span>
          @endif
        </div>

        <form method="POST"
              action="{{ route('admin.coffee-registrations.documents', $selected) }}"
              enctype="multipart/form-data">
          @csrf

          <div class="mb-2">
            <label class="form-label">1) Request for Approval</label>
            <input type="file" name="request_approval" class="form-control">
            @if($selected->request_approval_path)
              <small class="text-success">Uploaded ✓</small>
            @endif
          </div>

          <div class="mb-2">
            <label class="form-label">2) Travel Order</label>
            <input type="file" name="travel_order" class="form-control">
            @if($selected->travel_order_path)
              <small class="text-success">Uploaded ✓</small>
            @endif
          </div>

          <div class="mb-2">
            <label class="form-label">3) Registration Ticket</label>
            <input type="file" name="registration_ticket" class="form-control">
            @if($selected->registration_ticket_path)
              <small class="text-success">Uploaded ✓</small>
            @endif
          </div>

          <button class="adm-btn mt-2 w-100" type="submit">
            Upload / Update Documents
          </button>
        </form>

      @endif
      {{-- ================= END HR SECTION ================= --}}

    @else
      <div class="note">Select a submission to review.</div>
    @endif
  </div>
</aside>


  </div>
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
