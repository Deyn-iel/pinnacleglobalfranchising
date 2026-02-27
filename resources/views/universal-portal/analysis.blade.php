<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pinnacle Claims Portal</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Premium font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
          boxShadow: {
            soft: "0 10px 30px rgba(2,6,23,.08)",
            lift: "0 18px 50px rgba(2,6,23,.14)",
          },
          keyframes: {
            fadeIn: { '0%': {opacity: 0}, '100%': {opacity: 1} },
            popIn: { '0%': {opacity: 0, transform:'scale(.98)'}, '100%': {opacity: 1, transform:'scale(1)'} },
          },
          animation: {
            fadeIn: 'fadeIn .18s ease-out',
            popIn: 'popIn .18s ease-out',
          }
        }
      }
    }
  </script>

  <style>
    html, body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }

    .no-select { user-select: none; -webkit-user-select: none; }

    /* Premium "app" background (light/dark) */
    .app-bg {
      background:
        linear-gradient(#f8fafc, #f8fafc);
    }
    .dark .app-bg{
      background:
        radial-gradient(1200px 600px at 20% -10%, rgba(99,102,241,.18), transparent 55%),
        radial-gradient(900px 500px at 100% 0%, rgba(16,185,129,.14), transparent 55%),
        radial-gradient(900px 500px at 80% 120%, rgba(14,165,233,.12), transparent 55%),
        linear-gradient(#020617, #020617);
    }

    /* Watermark adjusted for dark */
    .watermark {
      position: absolute; inset: 0; pointer-events: none;
      background-image: repeating-linear-gradient(-30deg, rgba(0,0,0,0.07) 0px, rgba(0,0,0,0.07) 1px, transparent 1px, transparent 36px);
      mix-blend-mode: multiply;
    }
    .dark .watermark{
      background-image: repeating-linear-gradient(-30deg, rgba(255,255,255,0.06) 0px, rgba(255,255,255,0.06) 1px, transparent 1px, transparent 36px);
      mix-blend-mode: screen;
    }

    .wm-text {
      position: absolute; inset: 0; pointer-events: none;
      display: grid; place-items: center;
      transform: rotate(-20deg);
      opacity: .16;
      font-weight: 800;
      letter-spacing: .22em;
      text-transform: uppercase;
      font-size: clamp(18px, 3vw, 44px);
      text-align: center;
      white-space: pre-line;
    }
    .dark .wm-text{ opacity: .12; }

    :focus-visible { outline: 2px solid rgba(99,102,241,.55); outline-offset: 3px; }

    /* Reusable "system" inputs (less repetitive classes) */
    .ui-input, .ui-select, .ui-textarea{
      width: 100%;
      border-radius: 14px;
      border: 1px solid rgb(226 232 240);
      background: white;
      padding: .65rem .85rem;
      font-size: .875rem;
      line-height: 1.25rem;
      box-shadow: 0 1px 0 rgba(2,6,23,.04);
      transition: box-shadow .15s ease, border-color .15s ease, background .15s ease;
    }
    .ui-input:focus, .ui-select:focus, .ui-textarea:focus{
      outline: none;
      border-color: rgb(148 163 184);
      box-shadow: 0 0 0 4px rgba(148,163,184,.22);
    }
    .dark .ui-input, .dark .ui-select, .dark .ui-textarea{
      background: rgb(15 23 42);
      border-color: rgb(30 41 59);
      color: rgb(248 250 252);
      box-shadow: 0 1px 0 rgba(0,0,0,.25);
    }
    .dark .ui-input:focus, .dark .ui-select:focus, .dark .ui-textarea:focus{
      border-color: rgb(148 163 184);
      box-shadow: 0 0 0 4px rgba(30,41,59,.65);
    }

    /* Nicer scrollbars (optional) */
    .scrollbar-premium::-webkit-scrollbar{ height: 10px; width: 10px; }
    .scrollbar-premium::-webkit-scrollbar-thumb{ background: rgba(100,116,139,.35); border-radius: 999px; }
    .dark .scrollbar-premium::-webkit-scrollbar-thumb{ background: rgba(148,163,184,.28); }
    .scrollbar-premium::-webkit-scrollbar-track{ background: transparent; }
  </style>
</head>

<body class="min-h-full app-bg text-slate-900 antialiased dark:text-slate-50">
  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[60] focus:bg-white focus:dark:bg-slate-900 focus:border focus:rounded-xl focus:px-3 focus:py-2">
    Skip to content
  </a>

  <!-- Flash -->
  @if(session('success'))
    <div class="mx-auto max-w-7xl px-4 pt-4">
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-100 shadow-soft">
        <div class="font-semibold"><i class="fa-solid fa-circle-check mr-2"></i> Success</div>
        <div class="text-sm mt-1">{{ session('success') }}</div>
      </div>
    </div>
  @endif

  @if($errors->any())
    <div class="mx-auto max-w-7xl px-4 pt-4">
      <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-900 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-100 shadow-soft">
        <div class="font-semibold"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Please fix the errors</div>
        <ul class="text-sm mt-2 list-disc pl-5 space-y-1">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <!-- Mobile Nav Drawer (premium animated) -->
  <div id="mobileOverlay" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-200">
    <div class="absolute inset-0 bg-black/50" onclick="toggleMobile(false)"></div>

    <aside id="mobilePanel"
           class="absolute left-0 top-0 h-full w-[88%] max-w-sm
                  bg-white dark:bg-slate-950 border-r border-slate-200 dark:border-slate-800
                  shadow-lift transform -translate-x-full transition-transform duration-200">
      <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-2xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 grid place-items-center font-extrabold">PG</div>
          <div class="min-w-0">
            <div class="font-semibold leading-tight truncate">Pinnacle Portal</div>
            <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight truncate">HR Dashboard</div>
          </div>
        </div>

        <button class="h-10 w-10 rounded-xl border border-slate-200 dark:border-slate-800 grid place-items-center bg-white dark:bg-slate-900"
                onclick="toggleMobile(false)" aria-label="Close menu">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="p-4 space-y-2">
        <button data-nav="home" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-slate-900 text-white dark:bg-white dark:text-slate-900 dark:border-white">
          <i class="fa-solid fa-house mr-2"></i> Home
        </button>
        <button data-nav="lodge" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-900/60">
          <i class="fa-solid fa-file-circle-plus mr-2"></i> Lodge Claim
        </button>
        <button data-nav="analysis" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-900/60">
          <i class="fa-solid fa-chart-column mr-2"></i> Analysis Sheet
        </button> 
        <button data-nav="soa" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-900/60">
          <i class="fa-solid fa-receipt mr-2"></i> Statement of Account
        </button>
        <button data-nav="company" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-900/60">
          <i class="fa-solid fa-building mr-2"></i> Company Registration
        </button>

        <div class="mt-4 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
          <div class="flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="text-xs text-slate-500 dark:text-slate-400">Signed in as</div>
              <div class="mt-1 font-semibold text-sm truncate" id="mockUserMobile">{{ auth()->user()->name ?? 'HR User' }}</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 truncate" id="mockEmailMobile">{{ auth()->user()->email ?? '' }}</div>
            </div>

            <!-- Premium theme toggle -->
            <button id="themeToggleMobile" type="button"
                    class="relative inline-flex h-10 w-16 items-center rounded-full border border-slate-200 dark:border-slate-700 bg-white/80 dark:bg-slate-900 shadow-soft"
                    aria-label="Toggle theme">
              <span class="absolute left-1 h-8 w-8 rounded-full bg-white dark:bg-slate-950 shadow transition-transform duration-200 translate-x-0 dark:translate-x-6"></span>
              <span class="absolute left-2 text-slate-600 dark:opacity-0 text-xs"><i class="fa-solid fa-sun"></i></span>
              <span class="absolute right-2 text-slate-300 opacity-0 dark:opacity-100 text-xs"><i class="fa-solid fa-moon"></i></span>
            </button>
          </div>

          <div class="mt-3">
            <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
              @csrf
              <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-900/60">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </aside>
  </div>

  <!-- Top Bar -->
  <header class="sticky top-0 z-40 border-b border-slate-200/70 dark:border-slate-800/70 bg-white/75 dark:bg-slate-950/55 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between gap-3">
      <div class="flex items-center gap-3 min-w-0">
        <button class="md:hidden h-10 w-10 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/60 grid place-items-center"
                onclick="toggleMobile(true)" aria-label="Open menu">
          <i class="fa-solid fa-bars"></i>
        </button>

        <div class="h-10 w-10 rounded-2xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 grid place-items-center font-extrabold shrink-0">
          PG
        </div>

        <div class="min-w-0">
          <div class="font-semibold leading-tight truncate">Pinnacle Claims Portal</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight truncate">HR Dashboard</div>
        </div>
      </div>

      <nav class="hidden md:flex items-center gap-2">
        <button data-nav="home" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-slate-900 text-white dark:bg-white dark:text-slate-900">Home</button>
        <button data-nav="lodge" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white/70 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 hover:bg-white dark:hover:bg-slate-900">Lodge</button>
        <button data-nav="analysis" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white/70 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 hover:bg-white dark:hover:bg-slate-900">Analysis</button>
        {{-- <button data-nav="soa" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white/70 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 hover:bg-white dark:hover:bg-slate-900">SOA</button>
        <button data-nav="company" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white/70 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 hover:bg-white dark:hover:bg-slate-900">Company Reg</button> --}}
      </nav>

      <div class="hidden md:flex items-center gap-3">

        <div class="text-right">
          <div class="font-semibold text-sm leading-tight" id="mockUser">{{ auth()->user()->name ?? 'HR User' }}</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight" id="mockEmail">{{ auth()->user()->email ?? '' }}</div>
        </div>

        <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-800 grid place-items-center font-semibold">
          {{ strtoupper(substr(auth()->user()->name ?? 'HR', 0, 2)) }}
        </div>

        <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
          @csrf
          <button type="submit" class="h-10 px-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                  title="Logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </button>
        </form>
      </div>
    </div>
  </header>

  <main id="main" class="mx-auto max-w-7xl px-4 py-6 space-y-6">

    <!-- ========================= HOME ========================= -->
    <section id="page-home" class="space-y-6">
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          <div class="min-w-0">
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">Home Portal</h1>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              View submitted requests list, transaction status, history, assessment, totals, recomputation details, and aging.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95"
                    onclick="go('lodge')">
              <i class="fa-solid fa-plus mr-2"></i> Lodge New Claim
            </button>
            <button class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                    onclick="toast('Export: implement backend CSV/PDF export.')">
              <i class="fa-solid fa-file-export mr-2"></i> Export
            </button>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500 dark:text-slate-400">Total Claims</div>
            <div class="h-10 w-10 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 grid place-items-center">
              <i class="fa-solid fa-list-check text-slate-700 dark:text-slate-200"></i>
            </div>
          </div>
          <div class="text-2xl font-extrabold mt-2" id="sumTotal">{{ $summary['total'] ?? 0 }}</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">All time</div>
        </div>

        <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500 dark:text-slate-400">Overdue</div>
            <div class="h-10 w-10 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/40 grid place-items-center">
              <i class="fa-solid fa-triangle-exclamation text-rose-600 dark:text-rose-300"></i>
            </div>
          </div>
          <div class="text-2xl font-extrabold mt-2 text-rose-600 dark:text-rose-300" id="sumOverdue">{{ $summary['overdue'] ?? 0 }}</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Beyond 14 days</div>
        </div>

        <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500 dark:text-slate-400">For Checking</div>
            <div class="h-10 w-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-100 dark:border-indigo-900/40 grid place-items-center">
              <i class="fa-solid fa-user-check text-indigo-700 dark:text-indigo-300"></i>
            </div>
          </div>
          <div class="text-2xl font-extrabold mt-2" id="sumChecking">{{ $summary['checking'] ?? 0 }}</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">With checker</div>
        </div>

        <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500 dark:text-slate-400">Ready for HR Review</div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-100 dark:border-emerald-900/40 grid place-items-center">
              <i class="fa-solid fa-circle-check text-emerald-700 dark:text-emerald-300"></i>
            </div>
          </div>
          <div class="text-2xl font-extrabold mt-2" id="sumReady">{{ $summary['ready'] ?? 0 }}</div>
          <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Approved / ready</div>
        </div>
      </div>

      <!-- Filters -->
      <form class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-4 shadow-soft"
            method="GET" action="{{ route('portal.dashboard') }}">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
          <div class="md:col-span-5">
            <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Search</label>
            <div class="mt-1 relative">
              <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
              <input name="q" value="{{ request('q') }}" class="ui-input pl-9 pr-3" placeholder="Employee name, claim type, benefit, ID..." />
            </div>
          </div>

          <div class="md:col-span-3">
            <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Transaction Status</label>
            <select name="status" class="ui-select mt-1">
              <option value="">All</option>
              @foreach(['Submitted','Accepted','Reviewing','For Checking','Approved','HR Review','Recomputation Requested','Ready to Download'] as $st)
                <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
              @endforeach
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Benefit</label>
            <select name="benefit" class="ui-select mt-1">
              <option value="">All</option>
              @foreach(['Basic Medical','Major Medical','Dread Disease','Accident Benefit'] as $bf)
                <option value="{{ $bf }}" @selected(request('benefit')===$bf)>{{ $bf }}</option>
              @endforeach
            </select>
          </div>

          <div class="md:col-span-2 flex items-end gap-2">
            <button class="w-full px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95"
                    type="submit">Apply</button>
            <a class="w-full text-center px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
               href="{{ route('portal.dashboard') }}">Clear</a>
          </div>
        </div>
      </form>

      <!-- Claims: MOBILE cards + DESKTOP table -->
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 overflow-hidden shadow-soft">
        <div class="p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200/70 dark:border-slate-800">
          <div class="font-semibold">Submitted Requests</div>
          <div class="text-xs text-slate-500 dark:text-slate-400">Aging &gt; 14 days = overdue</div>
        </div>

        <!-- MOBILE -->
        <div class="block lg:hidden divide-y divide-slate-200/70 dark:divide-slate-800">
          @forelse($claims as $c)
            @php
              $overdue = (int)$c->aging_days > 14;
              $canEdit = optional($c->created_at)->diffInHours(now()) <= 24;

              $statusMap = [
                'Submitted' => 'bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-800',
                'For Checking' => 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-800 dark:text-indigo-200 border-indigo-100 dark:border-indigo-900/40',
                'Approved' => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-200 border-emerald-100 dark:border-emerald-900/40',
                'HR Review' => 'bg-amber-50 dark:bg-amber-950/40 text-amber-900 dark:text-amber-200 border-amber-200 dark:border-amber-900/40',
                'Recomputation Requested' => 'bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-200 border-rose-200 dark:border-rose-900/40',
                'Ready to Download' => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-200 border-emerald-100 dark:border-emerald-900/40',
              ];
              $badgeClass = $statusMap[$c->status] ?? $statusMap['Submitted'];
            @endphp

            <div class="p-4">
              <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                  <div class="font-semibold truncate">{{ $c->employee_name }}</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                    {{ $c->claim_id }} • {{ $c->benefit }} • {{ $c->claim_type }}
                  </div>
                </div>
                <span class="shrink-0 inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $badgeClass }}">
                  {{ $c->status }}
                </span>
              </div>

              <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/30 p-3">
                  <div class="text-xs text-slate-500 dark:text-slate-400">Submitted</div>
                  <div class="font-semibold mt-1">{{ $c->date_submitted }}</div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/30 p-3">
                  <div class="text-xs text-slate-500 dark:text-slate-400">Aging</div>
                  <div class="font-semibold mt-1 {{ $overdue ? 'text-rose-600 dark:text-rose-300' : '' }}">
                    {{ $c->aging_days }} days
                    @if($overdue) <span class="ml-1 text-xs font-bold">OVERDUE</span> @endif
                  </div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/30 p-3">
                  <div class="text-xs text-slate-500 dark:text-slate-400">Total</div>
                  <div class="font-semibold mt-1">₱ {{ number_format((float)($c->total_amount ?? 0), 2) }}</div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/30 p-3">
                  <div class="text-xs text-slate-500 dark:text-slate-400">Recomputed</div>
                  <div class="font-semibold mt-1">
                    {{ $c->recomputed_total !== null ? '₱ '.number_format((float)$c->recomputed_total, 2) : '—' }}
                  </div>
                </div>
              </div>

              <div class="mt-3 flex flex-col sm:flex-row gap-2">
                <button class="px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                        onclick="openModal('{{ $c->id }}')">
                  Details
                </button>

                {{-- <a class="px-3 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95 text-center"
                   href="{{ route('hr.claims.analysis', $c->id) }}">
                  View Analysis
                </a> --}}

                <button
  class="px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold
         {{ $canEdit ? 'hover:bg-white dark:hover:bg-slate-900' : 'opacity-50 cursor-not-allowed' }}"
  {{ $canEdit ? '' : 'disabled' }}
  onclick="deleteClaim('{{ $c->id }}')">
  Delete
</button>

                <button class="px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold
                               {{ $canEdit ? 'hover:bg-white dark:hover:bg-slate-900' : 'opacity-50 cursor-not-allowed' }}"
                        {{ $canEdit ? '' : 'disabled' }}
                        onclick="toast('Hook this to backend reupload endpoint.')">
                  Reupload
                </button>
              </div>
            </div>
          @empty
            <div class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No results found.</div>
          @endforelse
        </div>

        <!-- DESKTOP TABLE -->
        <div class="hidden lg:block overflow-auto scrollbar-premium">
          <table class="min-w-[1400px] w-full text-sm">
            <thead class="bg-slate-50/80 dark:bg-slate-900/50 text-slate-600 dark:text-slate-300 sticky top-0 z-10 backdrop-blur border-b border-slate-200/70 dark:border-slate-800">
              <tr>
                <th class="text-left px-4 py-3 font-semibold">Date Submitted</th>
                <th class="text-left px-4 py-3 font-semibold">Aging</th>
                <th class="text-left px-4 py-3 font-semibold">Name</th>
                <th class="text-left px-4 py-3 font-semibold">Employment</th>
                <th class="text-left px-4 py-3 font-semibold">Claim Type</th>
                <th class="text-left px-4 py-3 font-semibold">Benefit</th>
                <th class="text-left px-4 py-3 font-semibold">Transaction Status</th>
                <th class="text-right px-4 py-3 font-semibold">Total Amount</th>
                <th class="text-right px-4 py-3 font-semibold">Recomputed Total</th>
                <th class="text-left px-4 py-3 font-semibold">Recomp Reason</th>
                <th class="text-left px-4 py-3 font-semibold">Remarks</th>
                <th class="text-left px-4 py-3 font-semibold">Actions</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800">
              @forelse($claims as $c)
                @php
                  $overdue = (int)$c->aging_days > 14;
                  $canEdit = optional($c->created_at)->diffInHours(now()) <= 24;

                  $statusMap = [
                    'Submitted' => 'bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-800',
                    'For Checking' => 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-800 dark:text-indigo-200 border-indigo-100 dark:border-indigo-900/40',
                    'Approved' => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-200 border-emerald-100 dark:border-emerald-900/40',
                    'HR Review' => 'bg-amber-50 dark:bg-amber-950/40 text-amber-900 dark:text-amber-200 border-amber-200 dark:border-amber-900/40',
                    'Recomputation Requested' => 'bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-200 border-rose-200 dark:border-rose-900/40',
                    'Ready to Download' => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-200 border-emerald-100 dark:border-emerald-900/40',
                  ];
                  $badgeClass = $statusMap[$c->status] ?? $statusMap['Submitted'];
                @endphp

                <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                  <td class="px-4 py-3">
                    <div class="font-medium">{{ $c->date_submitted }}</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">
                      {{ $c->claim_id }}
                      @if(($c->occurrence ?? 1) > 1)
                        • <span class="text-rose-600 dark:text-rose-300 font-semibold">{{ $c->occurrence }}nd+</span>
                      @endif
                    </div>
                  </td>

                  <td class="px-4 py-3">
                    <span class="font-semibold {{ $overdue ? 'text-rose-600 dark:text-rose-300' : '' }}">{{ $c->aging_days }} days</span>
                    @if($overdue)
                      <div class="text-xs text-rose-600 dark:text-rose-300 font-semibold">OVERDUE</div>
                    @endif
                  </td>

                  <td class="px-4 py-3 font-semibold">{{ $c->employee_name }}</td>
                  <td class="px-4 py-3">{{ $c->employment }}</td>
                  <td class="px-4 py-3">{{ $c->claim_type }}</td>
                  <td class="px-4 py-3">{{ $c->benefit }}</td>

                  <td class="px-4 py-3">
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $badgeClass }}">
                      {{ $c->status }}
                    </span>
                  </td>

                  <td class="px-4 py-3 text-right font-medium">₱ {{ number_format((float)($c->total_amount ?? 0), 2) }}</td>
                  <td class="px-4 py-3 text-right font-medium">
                    {{ $c->recomputed_total !== null ? '₱ '.number_format((float)$c->recomputed_total, 2) : '—' }}
                  </td>
                  <td class="px-4 py-3">{{ $c->recomputation_reason ?? '—' }}</td>
                  <td class="px-4 py-3 max-w-[240px]">
                    <div class="truncate" title="{{ $c->recomputation_remarks ?? $c->remarks ?? '—' }}">
                      {{ $c->recomputation_remarks ?? $c->remarks ?? '—' }}
                    </div>
                  </td>

                  <td class="px-4 py-3">
                    <div class="flex flex-wrap gap-2">
                      <button
  class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold
         border border-blue-200 dark:border-blue-800
         bg-blue-50 dark:bg-blue-900/40
         text-blue-700 dark:text-blue-300
         hover:bg-blue-100 dark:hover:bg-blue-900/60"
  onclick="openModal('{{ $c->id }}')">

  <!-- Info Icon -->
  <svg xmlns="http://www.w3.org/2000/svg"
       class="w-4 h-4"
       fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor"
       stroke-width="2">
    <circle cx="12" cy="12" r="10" />
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 16v-4m0-4h.01"/>
  </svg>

  Details
</button>

                      {{-- <a class="px-3 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-semibold hover:opacity-95"
                         href="{{ route('hr.claims.analysis', $c->id) }}">
                        View Analysis
                      </a> --}}

                      <button
  class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold
         border border-red-200 dark:border-red-800
         bg-red-50 dark:bg-red-900/40
         text-red-700 dark:text-red-300
         {{ $canEdit ? 'hover:bg-red-100 dark:hover:bg-red-900/60' : 'opacity-50 cursor-not-allowed' }}"
  {{ $canEdit ? '' : 'disabled' }}
  onclick="deleteClaim('{{ $c->id }}')">

  <!-- Trash Icon -->
  <svg xmlns="http://www.w3.org/2000/svg"
       class="w-4 h-4"
       fill="none"
       viewBox="0 0 24 24"
       stroke="currentColor"
       stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13"/>
  </svg>

  Delete
</button>

                      {{-- <button class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-xs font-semibold
                                     {{ $canEdit ? 'hover:bg-white dark:hover:bg-slate-900' : 'opacity-50 cursor-not-allowed' }}"
                              {{ $canEdit ? '' : 'disabled' }}
                              onclick="toast('Hook this to backend reupload endpoint.')">
                        Reupload
                      </button> --}}
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="12" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No results found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="p-4 border-t border-slate-200/70 dark:border-slate-800 bg-white/60 dark:bg-slate-950/20">
          {{ $claims->links() }}
        </div>
      </div>

      <!-- Claim Details Modal -->
      <div id="claimModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 p-4 z-50">
        <div class="w-full max-w-4xl rounded-2xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-lift overflow-hidden animate-popIn">
          <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="font-extrabold truncate" id="modalTitle">Claim Details</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 truncate" id="modalSubtitle">History, assessment, remarks</div>
            </div>
            <button class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                    onclick="closeModal()">Close</button>
          </div>

          <div class="p-5 grid grid-cols-1 lg:grid-cols-3 gap-4 max-h-[78vh] overflow-auto scrollbar-premium">
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 lg:col-span-2 bg-white/60 dark:bg-slate-950/30">
              <div class="text-xs font-semibold text-slate-600 dark:text-slate-300 flex items-center justify-between">
                <span>History Details</span>
                <span class="text-xs px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800" id="modalAging"></span>
              </div>
              <ul class="mt-3 text-sm text-slate-700 dark:text-slate-200 space-y-2" id="modalHistory"></ul>

              <div class="mt-4 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
                <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Assessment</div>
                <div class="mt-2 text-sm text-slate-700 dark:text-slate-200" id="modalAssessment"></div>
              </div>
            </div>

            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 space-y-3 bg-white/60 dark:bg-slate-950/30">
              <div>
                <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Remarks</div>
                <div class="mt-2 text-sm text-slate-700 dark:text-slate-200" id="modalRemarks"></div>
              </div>

              <div class="grid grid-cols-1 gap-2">
                <button class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                        onclick="openAnalysisFromModal()">
                  View Analysis Sheet
                </button>

                <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95"
                        onclick="openRecomputeModal()">
                  Request Re-computation
                </button>
              </div>

              <div class="text-xs text-slate-500 dark:text-slate-400">
                Note: Recomputation will update status in backend.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recomputation Modal -->
      <div id="recomputeModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 p-4 z-50">
        <div class="w-full max-w-2xl rounded-2xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-lift overflow-hidden animate-popIn">
          <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="font-extrabold truncate">Request Re-computation</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 truncate">Tagging + remarks/justification</div>
            </div>
            <button class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                    onclick="closeRecomputeModal()">Close</button>
          </div>

          <div class="p-5 space-y-4">
            <div class="rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
              <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Reason for Tagging</div>
              <select id="recomputeReason" class="ui-select mt-2">
                <option value="">Select…</option>
                <option>Error in computation</option>
                <option>Change in Company Policy</option>
                <option>Others</option>
              </select>

              <div class="mt-3">
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Remarks / Justification</label>
                <textarea id="recomputeRemarks" class="ui-textarea mt-2" rows="4"
                          placeholder="Enter specific justification. Required if 'Others'."></textarea>
                <div class="mt-2 text-xs text-slate-500 dark:text-slate-400" id="recomputeFeeNote">2% applies if reason is not “Error in computation”.</div>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
              <button class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                      onclick="closeRecomputeModal()">
                Cancel
              </button>
              <button class="w-full px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95"
                      onclick="submitRecompute()">
                Submit Request
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================= LODGE CLAIM ========================= -->
    <section id="page-lodge" class="space-y-6 hidden">
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div>
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">Lodge Claim Request</h1>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">
              HR lodge claim request and upload documents to Service Provider (backend + UI validations).
            </p>
          </div>
          <button class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                  onclick="go('home')">
            Back to Home
          </button>
        </div>
      </div>

      <form id="claimForm"
            method="POST"
            action="{{ route('hr.claims.store') }}"
            enctype="multipart/form-data"
            class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        @csrf

        <!-- Left -->
        <div class="xl:col-span-2 space-y-4">

          <!-- Employee Details -->
          <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
            <div class="flex items-center justify-between gap-3">
              <div class="font-semibold">Employee Details</div>

              <info-tooltip
                pos="right"
                wide="w-[360px]"
                text="Employee DOB accepted: <b>18–65</b> only.<br>Dependent rules vary by relationship."
              ></info-tooltip>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Surname</label>
                <input required class="ui-input mt-1" name="surname" value="{{ old('surname') }}" placeholder="Dela Cruz" />
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Given Name</label>
                <input required class="ui-input mt-1" name="given" value="{{ old('given') }}" placeholder="Juan" />
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Middle Name</label>
                <input class="ui-input mt-1" name="middle" value="{{ old('middle') }}" placeholder="Santos" />
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Date of Birth</label>
                <input required type="date" class="ui-input mt-1" name="dob" value="{{ old('dob') }}" />
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Accepted: 18–65 years old</div>
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Civil Status</label>
                <select required class="ui-select mt-1" name="civil">
                  <option value="">Select…</option>
                  <option value="Single" @selected(old('civil')==='Single')>Single</option>
                  <option value="Married" @selected(old('civil')==='Married')>Married</option>
                </select>
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Employment Status</label>
                <select required class="ui-select mt-1" name="empType" id="empType">
                  <option value="">Select…</option>
                  <option value="Regular / Probational Employee" @selected(old('empType')==='Regular / Probational Employee')>
                    Regular / Probational Employee
                  </option>
                  <option value="Seasonal Employee" @selected(old('empType')==='Seasonal Employee')>
                    Seasonal Employee
                  </option>
                </select>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Limits benefit entitlement & thresholds (backend).</div>
              </div>
            </div>
          </div>

          <!-- Type of Claim -->
          <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
            <div class="font-semibold flex items-center justify-between gap-3">
              <span>Type of Claim</span>
              <info-tooltip
                pos="right"
                wide="w-[420px]"
                text="• Accident Benefit may have <b>90-day rule</b> (backend).<br>
                      • Major Medical requires <b>minimum 6 hours</b> admission duration.<br>
                      • Duplicate claim name + benefit is blocked unless you select <b>2nd/3rd/4th claim</b>."
              ></info-tooltip>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
              <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <label class="flex items-center gap-2 text-sm font-semibold">
                  <input type="radio" name="claimType" value="Personal Claim" required @checked(old('claimType')==='Personal Claim') />
                  Personal Claim
                </label>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Employee is the claimant.</p>
              </div>

              <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <label class="flex items-center gap-2 text-sm font-semibold">
                  <input type="radio" name="claimType" value="Dependent's Claim" required @checked(old('claimType')==="Dependent's Claim") />
                  Dependent’s Claim
                </label>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Parent / Spouse / Child.</p>
              </div>
            </div>

            <!-- Dependent Box -->
            <div id="dependentBox" class="mt-4 hidden">
              <div class="rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
                <div class="text-sm font-semibold">Dependent Details</div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Dependent Full Name</label>
                    <input class="ui-input mt-1" name="depName" value="{{ old('depName') }}" placeholder="Surname_Given_Middle" />
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Relationship</label>
                    <select class="ui-select mt-1" name="depRel" id="depRel">
                      <option value="">Select…</option>
                      <option value="Parent" @selected(old('depRel')==='Parent')>Parent</option>
                      <option value="Spouse" @selected(old('depRel')==='Spouse')>Spouse</option>
                      <option value="Children" @selected(old('depRel')==='Children')>Children</option>
                    </select>
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Dependent DOB</label>
                    <input type="date" class="ui-input mt-1" name="depDob" id="depDob" value="{{ old('depDob') }}" />
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1" id="depRule">
                      Rules: children 14–21; spouse/parent 18–65
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Duplicate claim number selection -->
            <div class="mt-4 rounded-2xl border border-slate-200 dark:border-slate-800 p-4 bg-white/60 dark:bg-slate-950/20">
              <div class="flex items-center justify-between gap-3">
                <div>
                  <div class="text-sm font-semibold">Duplicate Claim Handling</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">
                    If same name + benefit exists, you must select claim occurrence (2nd/3rd/4th...).
                  </div>
                </div>

                <span id="dupWarnBadge" class="hidden text-xs px-2 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-200 border border-rose-200 dark:border-rose-900/40 font-semibold">
                  DUPLICATE DETECTED
                </span>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                <div class="md:col-span-1">
                  <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Claim Occurrence</label>

                

                <select id="claimOccurrence" class="ui-select mt-1" disabled>
                  <option value="1" @selected(old('claimOccurrence')=='1')>1st time</option>
                  <option value="2" @selected(old('claimOccurrence')=='2')>2nd time</option>
                  <option value="3" @selected(old('claimOccurrence')=='3')>3rd time</option>
                  <option value="4" @selected(old('claimOccurrence')=='4')>4th time</option>
                  <option value="5" @selected(old('claimOccurrence')=='5')>5th time</option>
                </select>

                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                  Auto-set by system (occurrence is computed from last claim + 90-day rule).
                </div>
                </div>

                <div class="md:col-span-2 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/40 p-4 text-sm text-amber-900 dark:text-amber-200">
                  <div class="font-semibold">
                    <i class="fa-solid fa-circle-info mr-1"></i> Checker Notice
                  </div>
                  <div class="mt-1">
                    For 2nd+ claims, checker screen will show RED blocking notice (backend).
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Benefit to Claim -->
          <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
            <div class="flex items-center justify-between gap-3">
              <div class="font-semibold">Benefit to Claim</div>
              <info-tooltip pos="right" wide="w-[360px]" text="Some benefits may have time rules (e.g., 90 days) and thresholds (backend)."></info-tooltip>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3 mt-4">
              <label class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 flex gap-2 items-start hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <input type="radio" name="benefit" value="Basic Medical" required class="mt-1" @checked(old('benefit')==='Basic Medical') />
                <div>
                  <div class="font-semibold text-sm">Basic Medical</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">Standard threshold (backend)</div>
                </div>
              </label>

              <label class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 flex gap-2 items-start hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <input type="radio" name="benefit" value="Major Medical" required class="mt-1" @checked(old('benefit')==='Major Medical') />
                <div>
                  <div class="font-semibold text-sm">Major Medical</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">May require admit details</div>
                </div>
              </label>

              <label class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 flex gap-2 items-start hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <input type="radio" name="benefit" value="Dread Disease" required class="mt-1" @checked(old('benefit')==='Dread Disease') />
                <div>
                  <div class="font-semibold text-sm">Dread Disease</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">Critical illness category</div>
                </div>
              </label>

              <label class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 flex gap-2 items-start hover:bg-slate-50/70 dark:hover:bg-slate-900/30">
                <input type="radio" name="benefit" value="Accident Benefit" required class="mt-1" @checked(old('benefit')==='Accident Benefit') />
                <div>
                  <div class="font-semibold text-sm">Accident Benefit</div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">May have 90-day rule (backend)</div>
                </div>
              </label>
            </div>

            <!-- Major Medical Admit Details -->
            <div id="majorMedicalBox" class="mt-4 hidden">
              <div class="rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
                <div class="flex items-center justify-between gap-3">
                  <div>
                    <div class="text-sm font-semibold">Major Medical • Admit Details</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">Minimum 6 hours duration rule (client-side validation).</div>
                  </div>
                  <info-tooltip pos="right" wide="w-[360px]" text="Admit rule: In-Out duration must be at least <b>6 hours</b>."></info-tooltip>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Room & Board Date</label>
                    <input type="date" id="roomDate" name="roomDate" value="{{ old('roomDate') }}" class="ui-input mt-1" />
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Time In</label>
                    <input type="time" id="timeIn" name="timeIn" value="{{ old('timeIn') }}" class="ui-input mt-1" />
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Time Out</label>
                    <input type="time" id="timeOut" name="timeOut" value="{{ old('timeOut') }}" class="ui-input mt-1" />
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Amount per Receipt (example)</label>
                    <input type="number" min="0" step="0.01" id="amtPerReceipt" name="amtPerReceipt" value="{{ old('amtPerReceipt') }}"
                           class="ui-input mt-1" placeholder="e.g. 32500.00" />
                  </div>

                  <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-950/20 p-4">
                    <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Computed Duration</div>
                    <div class="mt-1 text-sm font-semibold" id="durationText">—</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Must be ≥ 6 hours</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Upload Forms + Receipts -->
          <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
            <div class="font-semibold">Upload Forms</div>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">Backend upload inputs.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
              <!-- required -->
              <upload-field label="Policy Data Page" required name="attachments[policy_data_page]"></upload-field>
              <upload-field label="Duly accomplished Claim Form" required name="attachments[claim_form]"></upload-field>
              <upload-field label="PhilHealth Benefit Deduction Statement" required name="attachments[philhealth_deduction]"></upload-field>
              <upload-field label="Attending Physician Statement" required name="attachments[physician_statement]"></upload-field>

              <!-- optional -->
              <upload-field label="HR Endorsement" name="attachments[hr_endorsement]"></upload-field>
              <upload-field label="Hospital Statement of Account (itemized)" name="attachments[soa_itemized]"></upload-field>
              <upload-field label="Medical Abstract / Clinical Summary" name="attachments[medical_abstract]"></upload-field>
              <upload-field label="Surgical Report (if applicable)" name="attachments[surgical_report]"></upload-field>
              <upload-field label="Doctor’s Prescription" name="attachments[doctors_prescription]"></upload-field>
              <upload-field label="Police/Barangay/Employee Report" name="attachments[incident_report]"></upload-field>
              <upload-field label="Others" name="attachments[others_file]"></upload-field>

              <!-- Official Receipts -->
              <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 md:col-span-2 bg-white/60 dark:bg-slate-950/20">
                <div class="flex items-start justify-between gap-3">
                  <div>
                    <div class="text-sm font-semibold">Official Receipts</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">
                      Categorize receipts: Medicine / Professional Fees / Hospital Billing / Surgical Fees / Others
                    </div>
                  </div>
                  <info-tooltip pos="right" wide="w-[360px]" text="Tip: In real system, receipts are itemized then computed by analysis sheet format."></info-tooltip>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Category</label>
                    <select class="ui-select mt-1" id="receiptCategory">
                      <option>Medicine</option>
                      <option>Professional Fees</option>
                      <option>Hospital Billing</option>
                      <option>Surgical Fees</option>
                      <option>Others</option>
                    </select>
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Receipt Description</label>
                    <input class="ui-input mt-1" id="receiptDesc" placeholder="e.g., OR #123 / Room & board" />
                  </div>

                  <div>
                    <label class="text-xs font-semibold text-slate-600 dark:text-slate-300">Amount</label>
                    <input type="number" step="0.01" min="0" class="ui-input mt-1" id="receiptAmount" placeholder="e.g. 1200.00" />
                  </div>
                </div>

                <div class="mt-3 flex flex-col sm:flex-row gap-2">
                  <button type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                          onclick="addReceiptLine()">
                    Add Receipt Line
                  </button>

                  <div class="text-sm text-slate-700 dark:text-slate-200 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-3 flex-1">
                    <div class="text-xs text-slate-500 dark:text-slate-400">Receipt Lines</div>
                    <div class="font-semibold mt-1" id="receiptCount">0 item(s)</div>
                  </div>
                </div>

                <input type="hidden" name="receipt_lines_json" id="receiptLinesJson" value="{{ old('receipt_lines_json','[]') }}">
              </div>
            </div>

            <div class="mt-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/40 p-4 text-sm text-amber-900 dark:text-amber-200">
              <div class="font-semibold">Note</div>
              <div class="mt-1">In the real system: HR can delete/reupload within <b>24 hours</b> after submission.</div>
            </div>
          </div>
        </div>

        <!-- Right -->
        <aside class="space-y-4">
          <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft xl:sticky xl:top-20">
            <div class="font-semibold">Submit Notice</div>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
              I hereby solemnly declare and certify, under penalty of perjury, that all information provided herein is true, complete, and accurate...
            </p>

            <label class="mt-4 flex items-start gap-2 text-sm">
              <input type="checkbox" required class="mt-1"/>
              <span>I agree and understand the consequences of misrepresentation.</span>
            </label>

            <div class="mt-4 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
              <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Email Notification Recipients (display only)</div>
              <ul class="mt-2 text-xs text-slate-600 dark:text-slate-300 space-y-1">
                <li>johncedricktan@pinnacleglobalfranchising.com</li>
                <li>Admin@pinnacleglobalfranchising.com</li>
                <li>alenmarkfernandez@pinnacleglobalfranchising.com</li>
                <li>HR of Universal Leaf (TBD)</li>
              </ul>
            </div>

            <button type="submit" class="mt-4 w-full px-4 py-3 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95">
              Submit Claim
            </button>

            <button type="button" class="mt-2 w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                    onclick="toast('Draft saved (UI only).')">
              Save Draft
            </button>

            <div class="mt-4 text-xs text-slate-500 dark:text-slate-400">
              After submit: system sends email + locks delete/reupload after 24h (backend).
            </div>
          </div>
        </aside>
      </form>
    </section>

    <!-- ========================= ANALYSIS SHEET ========================= -->
    <section id="page-analysis" class="space-y-6 hidden">
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
          <div>
            <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">Analysis Sheet Viewer</h1>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">View-only UI deterrent + watermark.</p>
          </div>
          <div class="flex flex-col sm:flex-row gap-2">
            <button class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold hover:bg-white dark:hover:bg-slate-900"
                    onclick="openRecomputeModal()">
              Request Recomputation
            </button>
            <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold hover:opacity-95"
                    onclick="unlockDownload()">
              Confirm Computation Correct
            </button>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 overflow-hidden relative shadow-soft">
          <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="font-semibold truncate" id="analysisTitle">Analysis Sheet</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 truncate" id="analysisSub">Claim: —</div>
            </div>
            <div class="text-xs px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800" id="viewMode">VIEW ONLY</div>
          </div>

          <div class="relative p-6 no-select" id="analysisCanvas">
            <div class="watermark"></div>
            <div class="wm-text" id="wmText"></div>

            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white/70 dark:bg-slate-950/20">
              <table class="w-full text-sm">
                <thead class="bg-slate-50/80 dark:bg-slate-900/50 text-slate-600 dark:text-slate-300">
                  <tr>
                    <th class="text-left px-4 py-3 font-semibold">Item</th>
                    <th class="text-left px-4 py-3 font-semibold">Category</th>
                    <th class="text-right px-4 py-3 font-semibold">Amount</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800" id="analysisRows"></tbody>
                <tfoot class="bg-slate-50/80 dark:bg-slate-900/50">
                  <tr>
                    <td class="px-4 py-3 font-semibold" colspan="2">Total Amount of Claim</td>
                    <td class="px-4 py-3 text-right font-extrabold" id="analysisTotal">₱ 0.00</td>
                  </tr>
                  <tr>
                    <td class="px-4 py-3 font-semibold" colspan="2">Recomputed Total Amount</td>
                    <td class="px-4 py-3 text-right font-extrabold" id="analysisRecomputed">₱ 0.00</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="mt-4 rounded-2xl border border-slate-200 dark:border-slate-800 p-4 bg-white/60 dark:bg-slate-950/20">
              <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Assessment Notes</div>
              <p class="mt-2 text-sm text-slate-700 dark:text-slate-200" id="analysisAssessment">—</p>
            </div>
          </div>
        </div>

        <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 space-y-4 shadow-soft xl:sticky xl:top-24 self-start">
          <div>
            <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Claim Info</div>
            <div class="mt-2 space-y-2 text-sm" id="analysisInfo"></div>
          </div>

          <div class="rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 p-4">
            <div class="text-xs font-semibold text-slate-600 dark:text-slate-300">Download/Print</div>
            <p class="mt-2 text-sm text-slate-700 dark:text-slate-200" id="dlNote">Locked until HR confirms computation is correct.</p>
            <div class="mt-3 grid grid-cols-2 gap-2">
              <button id="btnPrint" disabled class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 text-sm font-semibold opacity-50">Print</button>
              <button id="btnDownload" disabled class="px-4 py-2.5 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold opacity-50">Download</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="page-soa" class="space-y-6 hidden">
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
        <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">Statement of Account</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">Hook to backend SOA endpoint when ready.</p>
      </div>
    </section>

    <section id="page-company" class="space-y-6 hidden">
      <div class="rounded-2xl border border-slate-200/70 dark:border-slate-800 bg-white/80 dark:bg-slate-950/40 p-5 shadow-soft">
        <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">Company Registration</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">Hook to backend when ready.</p>
      </div>
    </section>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-5 left-1/2 -translate-x-1/2 hidden z-50">
      <div class="rounded-2xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 px-4 py-3 text-sm shadow-lift animate-fadeIn"
           id="toastMsg"></div>
    </div>
  </main>

  <script>
/* =========================================================
   HELPERS
========================================================= */
function peso(n){
  return "₱ " + (Number(n||0)).toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});
}

function toast(msg){
  const t = document.getElementById("toast");
  const m = document.getElementById("toastMsg");
  if(!t || !m) return;
  m.textContent = msg;
  t.classList.remove("hidden");
  clearTimeout(window.__toastTimer);
  window.__toastTimer = setTimeout(()=>t.classList.add("hidden"), 2200);
}

function yearsBetween(dateStr){
  const d = new Date(dateStr);
  const now = new Date();
  let age = now.getFullYear() - d.getFullYear();
  const m = now.getMonth() - d.getMonth();
  if (m < 0 || (m===0 && now.getDate() < d.getDate())) age--;
  return age;
}

function escapeHtml(str){
  return String(str || "")
    .replaceAll("&","&amp;")
    .replaceAll("<","&lt;")
    .replaceAll(">","&gt;")
    .replaceAll('"',"&quot;")
    .replaceAll("'","&#039;");
}

/* =========================================================
   PREMIUM THEME TOGGLE
========================================================= */
function setTheme(isDark){
  document.documentElement.classList.toggle("dark", !!isDark);
  localStorage.setItem("pg_theme", isDark ? "dark" : "light");
  updateWatermark();
}
function toggleTheme(){
  setTheme(!document.documentElement.classList.contains("dark"));
}
function initThemeToggles(){
  const a = document.getElementById("themeToggle");
  const b = document.getElementById("themeToggleMobile");
  if(a) a.addEventListener("click", toggleTheme);
  if(b) b.addEventListener("click", toggleTheme);
}
window.toggleTheme = toggleTheme;

/* =========================================================
   NAV + PREMIUM MOBILE DRAWER ANIMATION
========================================================= */
function toggleMobile(open){
  const overlay = document.getElementById("mobileOverlay");
  const panel = document.getElementById("mobilePanel");
  if(!overlay || !panel) return;

  if(open){
    overlay.classList.remove("hidden");
    requestAnimationFrame(()=>{
      overlay.classList.add("opacity-100");
      panel.classList.remove("-translate-x-full");
      document.body.style.overflow = "hidden";
    });
  } else {
    overlay.classList.remove("opacity-100");
    panel.classList.add("-translate-x-full");
    document.body.style.overflow = "";
    setTimeout(()=> overlay.classList.add("hidden"), 200);
  }
}
window.toggleMobile = toggleMobile;

function go(page){
  ["home","lodge","analysis","soa","company"].forEach(p=>{
    const el = document.getElementById(`page-${p}`);
    if(el) el.classList.toggle("hidden", p!==page);
  });

  document.querySelectorAll(".navBtn").forEach(btn=>{
    const active = btn.dataset.nav === page;
    btn.className =
      "navBtn px-3 py-2 rounded-xl text-sm font-semibold transition " +
      (active
        ? "bg-slate-900 text-white dark:bg-white dark:text-slate-900"
        : "bg-white/70 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 hover:bg-white dark:hover:bg-slate-900");
  });

  document.querySelectorAll(".navBtnMobile").forEach(btn=>{
    const active = btn.dataset.nav === page;
    btn.className =
      "navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border transition " +
      (active
        ? "bg-slate-900 text-white dark:bg-white dark:text-slate-900 dark:border-white"
        : "bg-white hover:bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-900/60");
  });

  toggleMobile(false);
  window.scrollTo({top:0, behavior:"smooth"});
}
window.go = go;

/* =========================================================
   WEB COMPONENT: upload-field
========================================================= */
class UploadField extends HTMLElement {
  connectedCallback(){
    const label = this.getAttribute("label") || "Upload";
    const req = this.hasAttribute("required");
    const name = this.getAttribute("name") || "";
    const multiple = this.hasAttribute("multiple");

    this.innerHTML = `
      <div class="rounded-2xl border border-slate-200 dark:border-slate-800 p-4 bg-white/60 dark:bg-slate-950/20 hover:bg-slate-50/70 dark:hover:bg-slate-900/30 transition">
        <div class="flex items-start justify-between gap-3">
          <div class="min-w-0">
            <div class="text-sm font-semibold">
              ${escapeHtml(label)} ${req?'<span class="text-rose-600 dark:text-rose-300">*</span>':''}
            </div>
            <div class="text-xs text-slate-500 dark:text-slate-400">${req?'Mandatory':'Optional'}</div>
          </div>
          <div class="h-10 w-10 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 grid place-items-center shrink-0">
            <i class="fa-solid fa-paperclip text-slate-700 dark:text-slate-200"></i>
          </div>
        </div>

        <input ${req?'required':''}
               type="file"
               ${multiple?'multiple':''}
               name="${escapeHtml(name)}${multiple ? '[]' : ''}"
               class="mt-3 w-full rounded-xl border border-slate-200 dark:border-slate-800 px-3 py-2.5 text-sm bg-white dark:bg-slate-900/60" />
      </div>
    `;
  }
}
if(!customElements.get("upload-field")){
  customElements.define("upload-field", UploadField);
}

/* =========================================================
   WEB COMPONENT: info-tooltip (hover + tap-friendly)
========================================================= */
class InfoTooltip extends HTMLElement {
  connectedCallback() {
    const text = this.getAttribute("text") || "Reminder details here.";
    const wide = this.getAttribute("wide") || "w-72";
    const pos = (this.getAttribute("pos") || "right").toLowerCase();
    const isRight = pos === "right";

    const bubbleRight = `absolute left-full ml-2 top-1/2 -translate-y-1/2 ${wide}`;
    const arrowRight  = `absolute left-[-6px] top-1/2 -translate-y-1/2 h-3 w-3 rotate-45 bg-slate-900 dark:bg-white`;

    const bubbleBottom = `absolute left-1/2 -translate-x-1/2 top-full mt-2 ${wide}`;
    const arrowBottom  = `absolute -top-1 left-1/2 -translate-x-1/2 h-2 w-2 rotate-45 bg-slate-900 dark:bg-white`;

    this.innerHTML = `
      <div class="relative inline-flex align-middle">
        <button type="button"
          class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-extrabold text-slate-700 dark:text-slate-200
                 hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition"
          aria-label="Info tooltip">
          ?
        </button>

        <div class="tip ${isRight ? bubbleRight : bubbleBottom}
                    p-3 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs leading-relaxed
                    opacity-0 translate-y-1 pointer-events-none transition duration-200 z-50 shadow-xl">
          <div class="${isRight ? arrowRight : arrowBottom}"></div>
          ${text}
        </div>
      </div>
    `;

    const btn = this.querySelector("button");
    const tip = this.querySelector(".tip");

    const show = ()=>{ tip.classList.remove("opacity-0","translate-y-1","pointer-events-none"); tip.classList.add("opacity-100","translate-y-0","pointer-events-auto"); };
    const hide = ()=>{ tip.classList.add("opacity-0","translate-y-1","pointer-events-none"); tip.classList.remove("opacity-100","translate-y-0","pointer-events-auto"); };

    // hover for desktop
    this.addEventListener("mouseenter", show);
    this.addEventListener("mouseleave", hide);

    // tap/click for mobile
    btn.addEventListener("click", (e)=>{
      e.stopPropagation();
      const opened = tip.classList.contains("opacity-100");
      opened ? hide() : show();
    });
    document.addEventListener("click", hide);
  }
}
if(!customElements.get("info-tooltip")){
  customElements.define("info-tooltip", InfoTooltip);
}

/* =========================================================
   LODGE: Dependent toggle + rules text
========================================================= */
function initDependentBox(){
  const depBox = document.getElementById("dependentBox");
  if(!depBox) return;

  function sync(){
    const checked = document.querySelector("input[name='claimType']:checked");
    const show = checked && checked.value === "Dependent's Claim";
    depBox.classList.toggle("hidden", !show);
  }

  document.querySelectorAll("input[name='claimType']").forEach(r=>{
    r.addEventListener("change", sync);
  });

  const depRel = document.getElementById("depRel");
  const depRule = document.getElementById("depRule");
  if(depRel && depRule){
    depRel.addEventListener("change", ()=>{
      depRule.textContent =
        depRel.value==="Children"
          ? "Accepted If children: 14–21 years old only"
          : "Accepted If spouse/parent: 18–65 years old only";
    });
  }

  sync();
}

/* =========================================================
   LODGE: Major Medical box + duration compute
========================================================= */
function computeDuration(){
  const tin = document.getElementById("timeIn")?.value;
  const tout = document.getElementById("timeOut")?.value;

  const dt = document.getElementById("durationText");
  if(!tin || !tout){
    if(dt) dt.textContent = "—";
    return null;
  }

  const [h1,m1] = tin.split(":").map(Number);
  const [h2,m2] = tout.split(":").map(Number);

  const mins1 = h1*60 + m1;
  let mins2 = h2*60 + m2;

  // ✅ support overnight (same as backend addDay)
  if(mins2 <= mins1){
    mins2 += 24*60;
  }

  const diff = mins2 - mins1;
  const hrs = Math.floor(diff/60);
  const mins = diff%60;

  if(dt) dt.textContent = `${hrs}h ${mins}m` + (mins2 >= 24*60 ? " (overnight)" : "");
  return diff/60;
}

function initMajorMedicalUI(){
  const majorBox = document.getElementById("majorMedicalBox");
  if(!majorBox) return;

  function sync(){
    const selected = document.querySelector("input[name='benefit']:checked")?.value || "";
    majorBox.classList.toggle("hidden", selected !== "Major Medical");
    if(selected !== "Major Medical"){
      const dt = document.getElementById("durationText");
      if(dt) dt.textContent = "—";
    } else {
      computeDuration();
    }
  }

  document.querySelectorAll("input[name='benefit']").forEach(r=>{
    r.addEventListener("change", sync);
  });

  ["timeIn","timeOut"].forEach(id=>{
    const el = document.getElementById(id);
    if(el) el.addEventListener("change", computeDuration);
  });

  sync();
}

/* =========================================================
   LODGE: Receipt Lines + hidden JSON
========================================================= */
const receiptLines = [];

function hydrateReceiptLinesFromHidden(){
  const jsonEl = document.getElementById("receiptLinesJson");
  if(!jsonEl) return;
  try{
    const arr = JSON.parse(jsonEl.value || "[]");
    if(Array.isArray(arr)){
      receiptLines.length = 0;
      arr.forEach(x=>receiptLines.push(x));
      const cnt = document.getElementById("receiptCount");
      if(cnt) cnt.textContent = `${receiptLines.length} item(s)`;
    }
  }catch(e){}
}

function addReceiptLine(){
  const cat = document.getElementById("receiptCategory")?.value || "";
  const desc = (document.getElementById("receiptDesc")?.value || "").trim();
  const amt = Number(document.getElementById("receiptAmount")?.value || 0);

  if(!desc || amt <= 0){
    toast("Enter receipt description and amount.");
    return;
  }

  receiptLines.push({cat, desc, amt});
  document.getElementById("receiptDesc").value = "";
  document.getElementById("receiptAmount").value = "";
  const cnt = document.getElementById("receiptCount");
  if(cnt) cnt.textContent = `${receiptLines.length} item(s)`;

  const jsonEl = document.getElementById("receiptLinesJson");
  if(jsonEl) jsonEl.value = JSON.stringify(receiptLines);

  toast("Receipt line added.");
}
window.addReceiptLine = addReceiptLine;


//SCHEDULE INIT
let __dupState = { duplicate:false, eligible:true, suggested_occurrence:1, next_eligible_at:null };
let __dupTimer = null;

function scheduleDupCheck(){
  clearTimeout(__dupTimer);
  __dupTimer = setTimeout(checkDuplicateLive, 350);
}

async function checkDuplicateLive(){
  const form = document.getElementById("claimForm");
  const badge = document.getElementById("dupWarnBadge");
  const occEl = document.getElementById("claimOccurrence");
  if(!form || !badge || !occEl) return;

  const given  = (form.querySelector("[name='given']")?.value || "").trim();
  const middle = (form.querySelector("[name='middle']")?.value || "").trim();
  const surname= (form.querySelector("[name='surname']")?.value || "").trim();
  const dob    = form.querySelector("[name='dob']")?.value || "";

  const benefit  = document.querySelector("input[name='benefit']:checked")?.value || "";
  const claimType= document.querySelector("input[name='claimType']:checked")?.value || "";

  // require muna bago mag check
  if(!given || !surname || !dob || !benefit || !claimType){
    badge.classList.add("hidden");
    __dupState = { duplicate:false, eligible:true, suggested_occurrence:1, next_eligible_at:null };
    return;
  }

  const params = new URLSearchParams({ given, middle, surname, dob, benefit, claimType });

  try{
    const res = await fetch(`{{ url('/hr/claims/check-duplicate') }}?` + params.toString(), {
      headers: { "Accept":"application/json" }
    });
    if(!res.ok) return;

    const data = await res.json();

// compare first
const prev = __dupState || { duplicate:false, eligible:true, suggested_occurrence:1, next_eligible_at:null };
const changed =
  prev.duplicate !== data.duplicate ||
  prev.eligible !== data.eligible ||
  prev.next_eligible_at !== data.next_eligible_at ||
  prev.suggested_occurrence !== data.suggested_occurrence;

// update state ONCE
__dupState = data;

if (data.duplicate) {
  badge.classList.remove("hidden");

  if (data.eligible) {
    occEl.disabled = true; // display-only
    occEl.value = String(data.suggested_occurrence || 2);
    if (hidden) hidden.value = occEl.value;

    if (changed) toast(`Duplicate detected. Eligible now. Auto-set to ${occEl.options[occEl.selectedIndex].text}.`);
  } else {
    occEl.disabled = true;
    occEl.value = "1";
    if (hidden) hidden.value = "1";

    if (changed) toast(`Duplicate detected. Next eligible on ${data.next_eligible_at} (90-day rule).`);
  }

} else {
  badge.classList.add("hidden");

  occEl.disabled = true;
  occEl.value = "1";
  if (hidden) hidden.value = "1";

  // optional toast on change only
  // if (changed) toast("No duplicate detected.");
}
  }catch(e){}
}

/* =========================================================
   LODGE: Client-side validation before submit
========================================================= */
function initClaimFormValidation(){
  const form = document.getElementById("claimForm");
  if(!form) return;

  form.addEventListener("submit", (e)=>{

    // ✅ receipts required: at least 1 line (match backend)
if (!Array.isArray(receiptLines) || receiptLines.length === 0) {
  e.preventDefault();
  toast("Please add at least 1 receipt line.");
  return;
}

    const dob = form.querySelector("[name='dob']")?.value;
    if(dob){
      const age = yearsBetween(dob);
      if(age < 18 || age > 65){
        e.preventDefault();
        toast("Employee DOB invalid: accepted 18–65 only.");
        return;
      }
    }

    const claimType = document.querySelector("input[name='claimType']:checked")?.value || "";
    if(claimType === "Dependent's Claim"){
      const rel = form.querySelector("[name='depRel']")?.value || "";
      const depDob = form.querySelector("[name='depDob']")?.value || "";
      if(!rel || !depDob){
        e.preventDefault();
        toast("Dependent details required.");
        return;
      }
      const a = yearsBetween(depDob);
      if(rel === "Children"){
        if(a < 14 || a > 21){
          e.preventDefault();
          toast("Dependent child DOB invalid: 14–21 only.");
          return;
        }
      } else {
        if(a < 18 || a > 65){
          e.preventDefault();
          toast("Dependent spouse/parent DOB invalid: 18–65 only.");
          return;
        }
      }
    }

    const benefit = document.querySelector("input[name='benefit']:checked")?.value || "";
    if(benefit === "Major Medical"){
      const hrs = computeDuration();
      if(hrs === null){
        e.preventDefault();
        toast("Major Medical: please set Time In and Time Out.");
        return;
      }
      if(hrs < 6){
        e.preventDefault();
        toast("Major Medical: Duration must be at least 6 hours.");
        return;
      }
    }
  });
}

/* =========================================================
   MODALS + AJAX
========================================================= */
let selectedClaimDbId = null;

async function openModal(dbId){
  selectedClaimDbId = dbId;

  try{
    const res = await fetch(`{{ url('/hr/claims') }}/${dbId}`, {
      headers: { "Accept": "application/json" }
    });

    if(!res.ok){
      toast("Failed to load claim details.");
      return;
    }

    const c = await res.json();

    document.getElementById("modalTitle").textContent = `${c.id} • ${c.name}`;
    document.getElementById("modalSubtitle").textContent = `${c.benefit} • ${c.claimType} • Status: ${c.status}`;
    document.getElementById("modalAging").textContent = `Aging: ${c.agingDays} day(s)${(c.agingDays||0)>14 ? " • OVERDUE" : ""}`;

    const hist = Array.isArray(c.history) ? c.history : [];
    document.getElementById("modalHistory").innerHTML = hist.length
      ? hist.map(h=>`<li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-slate-400"></span><span>${escapeHtml(h)}</span></li>`).join("")
      : `<li class="text-slate-500 dark:text-slate-400">No history available.</li>`;

    document.getElementById("modalAssessment").textContent = c.assessment || "—";
    document.getElementById("modalRemarks").textContent = c.recomputationRemarks || c.remarks || "—";

    loadAnalysis(c);

    const modal = document.getElementById("claimModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    document.body.style.overflow = "hidden";
  }catch(err){
    toast("Error loading claim.");
  }
}
window.openModal = openModal;

function closeModal(){
  const m = document.getElementById("claimModal");
  if(!m) return;
  m.classList.add("hidden");
  m.classList.remove("flex");
  document.body.style.overflow = "";
  selectedClaimDbId = null;
}
window.closeModal = closeModal;

function openAnalysisFromModal(){
  if(!selectedClaimDbId){
    toast("No claim selected.");
    return;
  }
  go("analysis");
  closeModal();
}
window.openAnalysisFromModal = openAnalysisFromModal;

/* =========================================================
   RECOMPUTE MODAL + SUBMIT (AJAX)
========================================================= */
function openRecomputeModal(){
  if(!selectedClaimDbId){
    toast("Open a claim first (Details).");
    return;
  }

  document.getElementById("recomputeReason").value = "";
  document.getElementById("recomputeRemarks").value = "";
  document.getElementById("recomputeFeeNote").textContent = "2% applies if reason is not “Error in computation”.";

  const m = document.getElementById("recomputeModal");
  m.classList.remove("hidden");
  m.classList.add("flex");
}
window.openRecomputeModal = openRecomputeModal;

function closeRecomputeModal(){
  const m = document.getElementById("recomputeModal");
  if(!m) return;
  m.classList.add("hidden");
  m.classList.remove("flex");
}
window.closeRecomputeModal = closeRecomputeModal;

async function submitRecompute(){
  if(!selectedClaimDbId) return;

  const reason = document.getElementById("recomputeReason")?.value || "";
  const remarks = (document.getElementById("recomputeRemarks")?.value || "").trim();

  if(!reason){ toast("Select a recomputation reason."); return; }
  if(reason === "Others" && !remarks){ toast("Remarks required when reason is Others."); return; }

  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";

  try{
    const res = await fetch(`{{ url('/hr/claims') }}/${selectedClaimDbId}/recompute`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token,
        "Accept": "application/json"
      },
      body: JSON.stringify({ reason, remarks })
    });

    if(!res.ok){
      toast("Failed to submit recomputation.");
      return;
    }

    toast("Recomputation requested.");
    closeRecomputeModal();
    closeModal();
    window.location.reload();
  }catch(err){
    toast("Network error submitting recomputation.");
  }
}
window.submitRecompute = submitRecompute;

/* =========================================================
   ANALYSIS VIEW
========================================================= */
function loadAnalysis(c){
  const t = document.getElementById("analysisTitle");
  const sub = document.getElementById("analysisSub");
  const assess = document.getElementById("analysisAssessment");

  if(t) t.textContent = `Analysis Sheet #${Math.max(1, c.occurrence || 1)}`;
  if(sub) sub.textContent = `Claim: ${c.id} • ${c.benefit} • Employee: ${c.name}`;
  if(assess) assess.textContent = c.assessment || "—";

  const rows = document.getElementById("analysisRows");
  if(rows){
    rows.innerHTML = "";
    const arr = Array.isArray(c.analysisRows) ? c.analysisRows : [];
    arr.forEach(r=>{
      rows.insertAdjacentHTML("beforeend", `
        <tr>
          <td class="px-4 py-3">${escapeHtml(r.item ?? "")}</td>
          <td class="px-4 py-3">${escapeHtml(r.cat ?? "")}</td>
          <td class="px-4 py-3 text-right">${peso(r.amt ?? 0)}</td>
        </tr>
      `);
    });
  }

  const total = document.getElementById("analysisTotal");
  const recomputed = document.getElementById("analysisRecomputed");
  if(total) total.textContent = peso(c.total || 0);
  if(recomputed) recomputed.textContent = (c.recomputed !== null && c.recomputed !== undefined) ? peso(c.recomputed) : "₱ 0.00";

  const info = document.getElementById("analysisInfo");
  if(info){
    info.innerHTML = `
      <div class="flex justify-between"><span class="text-slate-500 dark:text-slate-400">Date Submitted</span><span>${escapeHtml(c.dateSubmitted || "—")}</span></div>
      <div class="flex justify-between"><span class="text-slate-500 dark:text-slate-400">Aging</span><span class="${(c.agingDays||0)>14?'text-rose-600 dark:text-rose-300 font-semibold':''}">${escapeHtml(String(c.agingDays||0))} day(s)</span></div>
      <div class="flex justify-between"><span class="text-slate-500 dark:text-slate-400">Status</span><span class="font-semibold">${escapeHtml(c.status || "—")}</span></div>
      <div class="flex justify-between"><span class="text-slate-500 dark:text-slate-400">Occurrence</span><span>${escapeHtml(String(c.occurrence || 1))}</span></div>
      <div class="flex justify-between"><span class="text-slate-500 dark:text-slate-400">Recomp Reason</span><span>${escapeHtml(c.recomputationReason || "—")}</span></div>
    `;
  }

  lockDownload();
}

function updateWatermark(){
  const email = document.getElementById("mockEmail")?.textContent || document.getElementById("mockEmailMobile")?.textContent || "user@example.com";
  const ts = new Date().toLocaleString();
  const wm = document.getElementById("wmText");
  if(wm) wm.textContent = `CONFIDENTIAL\n${email}\n${ts}`;
}

function lockDownload(){
  const btnPrint = document.getElementById("btnPrint");
  const btnDownload = document.getElementById("btnDownload");
  if(btnPrint){ btnPrint.disabled = true; btnPrint.classList.add("opacity-50"); }
  if(btnDownload){ btnDownload.disabled = true; btnDownload.classList.add("opacity-50"); }

  const dlNote = document.getElementById("dlNote");
  const viewMode = document.getElementById("viewMode");
  if(dlNote) dlNote.textContent = "Locked until HR confirms computation is correct.";
  if(viewMode) viewMode.textContent = "VIEW ONLY";
}

function unlockDownload(){
  const btnPrint = document.getElementById("btnPrint");
  const btnDownload = document.getElementById("btnDownload");
  if(btnPrint){ btnPrint.disabled = false; btnPrint.classList.remove("opacity-50"); }
  if(btnDownload){ btnDownload.disabled = false; btnDownload.classList.remove("opacity-50"); }

  const dlNote = document.getElementById("dlNote");
  const viewMode = document.getElementById("viewMode");
  if(dlNote) dlNote.textContent = "Unlocked: You may now print/download.";
  if(viewMode) viewMode.textContent = "UNLOCKED";
  toast("Unlocked.");
}
window.unlockDownload = unlockDownload;

/* =========================================================
   GLOBAL INIT
========================================================= */
document.addEventListener("DOMContentLoaded", () => {
  initThemeToggles();

  document.querySelectorAll(".navBtn").forEach(btn=>{
    btn.addEventListener("click", ()=>go(btn.dataset.nav));
  });
  document.querySelectorAll(".navBtnMobile").forEach(btn=>{
    btn.addEventListener("click", ()=>go(btn.dataset.nav));
  });

  const claimModal = document.getElementById("claimModal");
  if(claimModal){
    claimModal.addEventListener("click", (e)=>{
      if(e.target.id==="claimModal") closeModal();
    });
  }

  const recomputeModal = document.getElementById("recomputeModal");
  if(recomputeModal){
    recomputeModal.addEventListener("click", (e)=>{
      if(e.target.id==="recomputeModal") closeRecomputeModal();
    });
  }

  const recomputeReason = document.getElementById("recomputeReason");
  if(recomputeReason){
    recomputeReason.addEventListener("change", ()=>{
      const note = document.getElementById("recomputeFeeNote");
      if(!note) return;
      const r = recomputeReason.value;
      if(r === "Error in computation") note.textContent = "Fee: 0% (Error in computation).";
      else if(r) note.textContent = "Fee: 2% applies (backend) for Change in Policy / Others.";
      else note.textContent = "2% applies if reason is not “Error in computation”.";
    });
  }

  initDependentBox();
  initMajorMedicalUI();
  hydrateReceiptLinesFromHidden();
  
  // live duplicate check hooks
["surname","given","middle","dob"].forEach(n=>{
  const el = document.querySelector(`[name='${n}']`);
  if(el) el.addEventListener("input", scheduleDupCheck);
});
document.querySelectorAll("input[name='benefit']").forEach(r=> r.addEventListener("change", scheduleDupCheck));
document.querySelectorAll("input[name='claimType']").forEach(r=> r.addEventListener("change", scheduleDupCheck));

// run once
scheduleDupCheck();

  initClaimFormValidation();

  updateWatermark();
  setInterval(updateWatermark, 5000);

  document.addEventListener("contextmenu", (e)=>{
    const canvas = document.getElementById("analysisCanvas");
    if(canvas && canvas.contains(e.target)){
      e.preventDefault();
      toast("Right-click disabled.");
    }
  });

  @if($errors->any())
    go('lodge');
  @else
    @if(session('success'))
      go('home');
    @endif
  @endif
});

// ESC close
// ESC close lang dito
document.addEventListener("keydown", (e)=>{
  if(e.key === "Escape"){
    const m1 = document.getElementById("claimModal");
    if(m1 && !m1.classList.contains("hidden")) closeModal();

    const m2 = document.getElementById("recomputeModal");
    if(m2 && !m2.classList.contains("hidden")) closeRecomputeModal();

    const mo = document.getElementById("mobileOverlay");
    if(mo && !mo.classList.contains("hidden")) toggleMobile(false);
  }
});

// ✅ DELETE (global scope)
async function deleteClaim(dbId){
  if(!dbId) return;

  const ok = confirm("Delete this claim? This cannot be undone.");
  if(!ok) return;

  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";

  const res = await fetch(`{{ url('/hr/claims') }}/${dbId}`, {
    method: "DELETE",
    credentials: "same-origin",
    headers: {
      "X-CSRF-TOKEN": token,
      "X-Requested-With": "XMLHttpRequest",
      "Accept": "application/json"
    }
  });

  // if HTML ang balik, ito yung dahilan bakit nagfa-fail yung res.json()
  const ct = res.headers.get("content-type") || "";
  if(!ct.includes("application/json")){
    const text = await res.text();
    console.error("DELETE returned non-JSON:", res.status, text.slice(0, 300));
    toast(`Delete failed (${res.status}). Check console.`);
    return;
  }

  const data = await res.json();

  if(!res.ok){
    toast(data.message || "Failed to delete claim.");
    return;
  }

  toast(data.message || "Deleted.");
  window.location.reload();
}
window.deleteClaim = deleteClaim;
  </script>
</body>
</html>