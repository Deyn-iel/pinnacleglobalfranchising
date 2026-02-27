<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Service Provider Admin • Inbox</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- keep your Tailwind build -->
  @vite(['resources/css/admin/app.css'])

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    /* light premium background */
    .app-bg{
      background:
        radial-gradient(1200px 600px at 20% -10%, rgba(99,102,241,.10), transparent 55%),
        radial-gradient(900px 500px at 100% 0%, rgba(16,185,129,.08), transparent 55%),
        radial-gradient(900px 500px at 80% 120%, rgba(14,165,233,.06), transparent 55%),
        linear-gradient(#f8fafc, #f8fafc);
    }
    .scrollbar-premium::-webkit-scrollbar{ height: 10px; width: 10px; }
    .scrollbar-premium::-webkit-scrollbar-thumb{ background: rgba(100,116,139,.35); border-radius: 999px; }
    .scrollbar-premium::-webkit-scrollbar-track{ background: transparent; }

    @keyframes fadeIn{ from{opacity:0; transform: translateY(6px);} to{opacity:1; transform: translateY(0);} }
    .animate-toast{ animation: fadeIn .18s ease-out; }
  </style>
</head>

<body class="min-h-full app-bg text-slate-900 antialiased">
  <!-- keep includes; header removed as requested -->
  @include('admin-sidebar.navbar')
  @include('admin-sidebar.sidebar')

  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[60] focus:bg-white focus:border focus:rounded-xl focus:px-3 focus:py-2">
    Skip to content
  </a>

  <main id="main" class="mx-auto max-w-7xl px-4 py-6 space-y-6">

    {{-- flash --}}
    @if(session('success'))
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900 shadow">
        <div class="font-semibold"><i class="fa-solid fa-circle-check mr-2"></i> Success</div>
        <div class="text-sm mt-1">{{ session('success') }}</div>
      </div>
    @endif

    @php
      $badgeMap = [
        'Submitted' => 'bg-slate-50 text-slate-700 border-slate-200',
        'Accepted' => 'bg-blue-50 text-blue-700 border-blue-200',
        'Reviewing' => 'bg-amber-50 text-amber-900 border-amber-200',
        'For Checking' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
        'Approved' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'Ready to Download' => 'bg-slate-900 text-white border-slate-900',
        'Recomputation Requested' => 'bg-rose-50 text-rose-700 border-rose-200',
      ];
    @endphp

    {{-- KPIs --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
      <div class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
        <div class="text-sm text-slate-500">Total (Filtered)</div>
        <div class="text-2xl font-extrabold mt-2" id="kpiOpen">{{ $kpi['open'] ?? 0 }}</div>
        <div class="text-xs text-slate-500 mt-1">All results in view</div>
      </div>

      <div class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
        <div class="text-sm text-slate-500">Submitted</div>
        <div class="text-2xl font-extrabold mt-2" id="kpiSubmitted">{{ $kpi['submitted'] ?? 0 }}</div>
        <div class="text-xs text-slate-500 mt-1">Needs acceptance</div>
      </div>

      <div class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
        <div class="text-sm text-slate-500">Reviewing</div>
        <div class="text-2xl font-extrabold mt-2" id="kpiReviewing">{{ $kpi['reviewing'] ?? 0 }}</div>
        <div class="text-xs text-slate-500 mt-1">Assessment in progress</div>
      </div>

      <div class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
        <div class="text-sm text-slate-500">For Checking</div>
        <div class="text-2xl font-extrabold mt-2" id="kpiChecking">{{ $kpi['checking'] ?? 0 }}</div>
        <div class="text-xs text-slate-500 mt-1">Sent to checker</div>
      </div>

      <div class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
        <div class="text-sm text-slate-500">Overdue</div>
        <div class="text-2xl font-extrabold mt-2 text-rose-600" id="kpiOverdue">{{ $kpi['overdue'] ?? 0 }}</div>
        <div class="text-xs text-slate-500 mt-1">Aging &gt; 14 days</div>
      </div>
    </section>

    {{-- Filters --}}
    <section class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-4 shadow">
      <form method="GET" action="{{ route('admin.inbox') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
        <div class="md:col-span-6">
          <label class="text-xs font-semibold text-slate-600">Search</label>
          <div class="mt-1 relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
              name="q"
              value="{{ request('q') }}"
              class="w-full rounded-xl border border-slate-200 bg-white px-9 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-200"
              placeholder="Claim code, employee, benefit..."
            />
          </div>
        </div>

        <div class="md:col-span-2">
          <label class="text-xs font-semibold text-slate-600">Status</label>
          <select name="status" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-200">
            <option value="">All</option>
            @foreach(['Submitted','Accepted','Reviewing','For Checking','Approved','Ready to Download','Recomputation Requested'] as $st)
              <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
            @endforeach
          </select>
        </div>

        <div class="md:col-span-2">
          <label class="text-xs font-semibold text-slate-600">Benefit</label>
          <select name="benefit" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-200">
            <option value="">All</option>
            @foreach(['Basic Medical','Major Medical','Dread Disease','Accident Benefit'] as $bf)
              <option value="{{ $bf }}" @selected(request('benefit')===$bf)>{{ $bf }}</option>
            @endforeach
          </select>
        </div>

        <div class="md:col-span-2 flex gap-2">
          <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:opacity-95">
            <i class="fa-solid fa-filter"></i> Apply
          </button>
          <a href="{{ route('admin.inbox') }}" class="w-full text-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">
            Clear
          </a>
        </div>
      </form>
    </section>

    {{-- Main grid --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      {{-- Queue --}}
      <div class="lg:col-span-2 rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur shadow overflow-hidden">
        <div class="p-4 border-b border-slate-200/70 flex items-start justify-between gap-3">
          <div>
            <div class="font-semibold">Claims Queue</div>
            <div class="text-xs text-slate-500 mt-0.5">Open a claim to see documents checklist + receipts.</div>
          </div>
        </div>

        {{-- MOBILE cards --}}
        <div class="block lg:hidden divide-y divide-slate-200/70">
          @forelse($claims as $c)
            @php
              $employee = trim($c->employee_given.' '.$c->employee_middle.' '.$c->employee_surname);
              $aging = $c->created_at ? $c->created_at->diffInDays(now()) : 0;
              $overdue = $aging > 14;
              $submittedBy = optional($c->hrUser)->name ?? '—';
              $email = optional($c->hrUser)->email ?? '';
              $badge = $badgeMap[$c->status] ?? $badgeMap['Submitted'];
            @endphp

            <div class="p-4">
              <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                  <div class="font-semibold truncate">{{ $c->claim_code }}</div>
                  <div class="text-xs text-slate-500 mt-0.5 truncate">{{ $employee }} • {{ $c->benefit }}</div>
                </div>
                <span class="shrink-0 inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $badge }}">
                  {{ $c->status }}
                </span>
              </div>

              <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                <div class="rounded-2xl border border-slate-200/70 bg-slate-50/70 p-3">
                  <div class="text-xs text-slate-500">Submitted</div>
                  <div class="font-semibold mt-1">{{ optional($c->created_at)->format('Y-m-d') ?? '—' }}</div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 bg-slate-50/70 p-3">
                  <div class="text-xs text-slate-500">Aging</div>
                  <div class="font-semibold mt-1 {{ $overdue ? 'text-rose-600' : '' }}">
                    {{ $aging }} days
                    @if($overdue) <span class="ml-1 text-xs font-bold">OVERDUE</span> @endif
                  </div>
                </div>
              </div>

              <div class="mt-3 rounded-2xl border border-slate-200/70 bg-white/70 p-3">
                <div class="text-xs text-slate-500">Submitted By</div>
                <div class="font-semibold mt-1">{{ $submittedBy }}</div>
                <div class="text-xs text-slate-500 truncate">{{ $email }}</div>
              </div>

              <button
                type="button"
                class="mt-3 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:opacity-95"
                onclick="openDrawer({{ $c->id }})"
              >
                <i class="fa-solid fa-folder-open"></i> Open Claim
              </button>
            </div>
          @empty
            <div class="px-4 py-10 text-center text-slate-500">No claims found.</div>
          @endforelse
        </div>

        {{-- DESKTOP table --}}
        <div class="hidden lg:block overflow-auto scrollbar-premium">
          <table class="min-w-[1100px] w-full text-sm">
            <thead class="bg-slate-50/80 text-slate-600 sticky top-0 z-10 backdrop-blur border-b border-slate-200/70">
              <tr>
                <th class="text-left px-4 py-3 font-semibold">Claim</th>
                <th class="text-left px-4 py-3 font-semibold">Submitted By</th>
                <th class="text-left px-4 py-3 font-semibold">Employee</th>
                <th class="text-left px-4 py-3 font-semibold">Benefit</th>
                <th class="text-left px-4 py-3 font-semibold">Status</th>
                <th class="text-left px-4 py-3 font-semibold">Aging</th>
                <th class="text-left px-4 py-3 font-semibold">Actions</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-slate-200/70">
              @forelse($claims as $c)
                @php
                  $employee = trim($c->employee_given.' '.$c->employee_middle.' '.$c->employee_surname);
                  $aging = $c->created_at ? $c->created_at->diffInDays(now()) : 0;
                  $overdue = $aging > 14;
                  $submittedBy = optional($c->hrUser)->name ?? '—';
                  $email = optional($c->hrUser)->email ?? '';
                  $badge = $badgeMap[$c->status] ?? $badgeMap['Submitted'];
                @endphp

                <tr class="hover:bg-slate-50/70">
                  <td class="px-4 py-3">
                    <div class="font-semibold">{{ $c->claim_code }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Submitted: {{ optional($c->created_at)->format('Y-m-d') ?? '—' }}</div>
                  </td>

                  <td class="px-4 py-3">
                    <div class="font-semibold">{{ $submittedBy }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">{{ $email }}</div>
                  </td>

                  <td class="px-4 py-3 font-semibold">{{ $employee }}</td>
                  <td class="px-4 py-3">{{ $c->benefit }}</td>

                  <td class="px-4 py-3">
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $badge }}">
                      {{ $c->status }}
                    </span>
                  </td>

                  <td class="px-4 py-3">
                    <div class="font-semibold {{ $overdue ? 'text-rose-600' : '' }}">{{ $aging }} days</div>
                    @if($overdue)
                      <div class="text-xs font-semibold text-rose-600">OVERDUE</div>
                    @endif
                  </td>

                  <td class="px-4 py-3">
                    <button
                      type="button"
                      class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold hover:bg-slate-50"
                      onclick="openDrawer({{ $c->id }})"
                    >
                      Open
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-4 py-10 text-center text-slate-500">No claims found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="p-4 border-t border-slate-200/70 bg-white/60">
          {{ $claims->links() }}
        </div>
      </div>

      {{-- Right guide --}}
      <aside class="rounded-2xl border border-slate-200/70 bg-white/80 backdrop-blur p-5 shadow self-start">
        <div class="font-semibold">Processing Guide</div>

        <div class="mt-3 space-y-2 text-sm text-slate-700">
          <p><span class="font-semibold">Submitted → Accepted</span> once docs are complete.</p>
          <p><span class="font-semibold">Accepted → Reviewing</span> start assessment.</p>
          <p><span class="font-semibold">Reviewing → For Checking</span> upload analysis then send to checker.</p>
        </div>

        <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <div class="text-xs font-semibold text-slate-600">Aging Rule</div>
          <div class="mt-2 text-sm text-slate-700">Beyond <b>14 days</b> = overdue.</div>
        </div>

        <div class="mt-4 text-xs text-slate-500">
          Tip: Use filters for faster triage, then open drawer to validate document completeness.
        </div>
      </aside>
    </section>

  </main>

  {{-- Drawer --}}
  <div id="drawerWrap" class="fixed inset-0 z-50 hidden" aria-hidden="true">
    <div id="drawerBackdrop" class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-200"></div>

    <aside
      id="drawerPanel"
      class="absolute right-0 top-0 h-full w-full max-w-3xl bg-white border-l border-slate-200 shadow-2xl
             translate-x-full transition-transform duration-200 overflow-auto"
      role="dialog"
      aria-modal="true"
      aria-label="Claim drawer"
    >
      <div class="sticky top-0 z-10 bg-white/90 backdrop-blur border-b border-slate-200 px-5 py-4 flex items-start justify-between gap-3">
        <div class="min-w-0">
          <div class="text-xs text-slate-500">Claim Detail</div>
          <div class="mt-1 font-extrabold text-lg truncate" id="dTitle">—</div>
          <div class="mt-1 text-sm text-slate-600 truncate" id="dSub">—</div>
        </div>
        <button class="h-10 px-4 rounded-xl border border-slate-200 bg-white text-sm font-semibold hover:bg-slate-50" type="button" onclick="closeDrawer()">
          Close
        </button>
      </div>

      <div class="p-5 space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <div class="flex items-center justify-between gap-3">
            <div>
              <div class="text-xs font-semibold text-slate-500">Current Status</div>
              <div class="mt-2" id="dStatusChip">—</div>
            </div>
            <div class="text-right">
              <div class="text-xs font-semibold text-slate-500">Aging</div>
              <div class="mt-2 font-extrabold" id="dAging">—</div>
            </div>
          </div>

          <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div class="text-xs font-semibold text-slate-600">Submitted By</div>
            <div class="mt-2 text-sm font-semibold text-slate-800" id="dSubmittedBy">—</div>
          </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <div class="font-semibold">Documents Checklist</div>
          <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3" id="docList"></div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <div class="font-semibold">History Timeline</div>
          <ul class="mt-3 space-y-2 text-sm text-slate-700" id="history"></ul>
        </div>
      </div>
    </aside>
  </div>

  {{-- Toast --}}
  <div id="toast" class="fixed left-1/2 bottom-5 -translate-x-1/2 z-[60] hidden" aria-live="polite" aria-atomic="true">
    <div class="rounded-2xl bg-slate-900 text-white px-4 py-3 text-sm font-semibold shadow-2xl animate-toast" id="toastMsg"></div>
  </div>

  <script>
    /* =========================================================
       Toast
    ========================================================= */
    function toast(msg){
      const t = document.getElementById("toast");
      const m = document.getElementById("toastMsg");
      if(!t || !m) return;
      m.textContent = msg;
      t.classList.remove("hidden");
      clearTimeout(window.__toastTimer);
      window.__toastTimer = setTimeout(()=>t.classList.add("hidden"), 2200);
    }

    /* =========================================================
       Badge mapping (JS side for drawer)
    ========================================================= */
    function badgeClass(status){
      const map = {
        "Submitted": "bg-slate-50 text-slate-700 border-slate-200",
        "Accepted": "bg-blue-50 text-blue-700 border-blue-200",
        "Reviewing": "bg-amber-50 text-amber-900 border-amber-200",
        "For Checking": "bg-indigo-50 text-indigo-700 border-indigo-200",
        "Approved": "bg-emerald-50 text-emerald-800 border-emerald-200",
        "Ready to Download": "bg-slate-900 text-white border-slate-900",
        "Recomputation Requested": "bg-rose-50 text-rose-700 border-rose-200",
      };
      return map[status] || map["Submitted"];
    }

    function badgeHTML(status){
      const cls = badgeClass(status);
      return `<span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border ${cls}">${status}</span>`;
    }

    /* =========================================================
       Drawer open/close (Tailwind transitions)
    ========================================================= */
    function openDrawerShell(){
      const wrap = document.getElementById("drawerWrap");
      const backdrop = document.getElementById("drawerBackdrop");
      const panel = document.getElementById("drawerPanel");

      wrap.classList.remove("hidden");
      wrap.setAttribute("aria-hidden","false");

      requestAnimationFrame(()=>{
        backdrop.classList.add("opacity-100");
        panel.classList.remove("translate-x-full");
        document.body.style.overflow = "hidden";
      });
    }

    function closeDrawer(){
      const wrap = document.getElementById("drawerWrap");
      const backdrop = document.getElementById("drawerBackdrop");
      const panel = document.getElementById("drawerPanel");

      backdrop.classList.remove("opacity-100");
      panel.classList.add("translate-x-full");
      document.body.style.overflow = "";

      setTimeout(()=>{
        wrap.classList.add("hidden");
        wrap.setAttribute("aria-hidden","true");
      }, 200);
    }
    window.closeDrawer = closeDrawer;

    // click backdrop to close
    document.getElementById("drawerBackdrop")?.addEventListener("click", closeDrawer);

    /* =========================================================
       Open drawer + fetch
    ========================================================= */
    async function openDrawer(dbId){
      try{
        const res = await fetch(`{{ url('/admin/claims') }}/${dbId}`, {
          headers: { "Accept": "application/json" }
        });
        if(!res.ok){ toast("Failed to load claim details."); return; }

        const c = await res.json();

        document.getElementById("dTitle").textContent = `${c.id} • ${c.employee}`;
        document.getElementById("dSub").textContent = `${c.benefit} • Submitted: ${c.dateSubmitted}`;
        document.getElementById("dStatusChip").innerHTML = badgeHTML(c.status);
        document.getElementById("dAging").textContent = `${c.agingDays} days${(c.agingDays||0)>14 ? " • OVERDUE" : ""}`;
        document.getElementById("dSubmittedBy").textContent = `${c.submittedBy} (${c.submittedEmail})`;

        // docs
        const docList = document.getElementById("docList");
        docList.innerHTML = "";
        Object.entries(c.docs || {}).forEach(([k,v])=>{
          docList.insertAdjacentHTML("beforeend", `
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 flex items-start justify-between gap-3">
              <div class="min-w-0">
                <div class="text-sm font-semibold text-slate-800">${k}</div>
                <div class="text-xs text-slate-500 mt-1">${v ? "Provided" : "Missing"}</div>
              </div>
              <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-extrabold border
                           ${v ? "bg-emerald-50 text-emerald-800 border-emerald-200" : "bg-rose-50 text-rose-700 border-rose-200"}">
                ${v ? "OK" : "REQ"}
              </span>
            </div>
          `);
        });

        // history
        const hist = Array.isArray(c.history) ? c.history : [];
        document.getElementById("history").innerHTML = hist.length
          ? hist.map(h=>`
              <li class="flex gap-2">
                <span class="mt-2 h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                <span>${h}</span>
              </li>
            `).join("")
          : `<li class="text-slate-500">No history yet.</li>`;

        openDrawerShell();
      }catch(e){
        toast("Error loading drawer.");
      }
    }
    window.openDrawer = openDrawer;

    // ESC close
    document.addEventListener("keydown", (e)=>{
      if(e.key === "Escape"){
        const wrap = document.getElementById("drawerWrap");
        if(wrap && !wrap.classList.contains("hidden")) closeDrawer();
      }
    });
  </script>
</body>
</html>