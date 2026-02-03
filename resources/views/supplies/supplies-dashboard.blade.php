<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Supplies Dashboard · Analytics</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  /* softer, cleaner palette */
  --primary:#111827;
  --accent:#2563eb;
  --bg:#f6f7fb;
  --panel:#ffffff;
  --border:#e5e7eb;
  --muted:#6b7280;

  --success:#16a34a;
  --warning:#f59e0b;
  --danger:#ef4444;

  --radius:16px;
  --shadow: 0 10px 24px rgba(17,24,39,.08);

  --pad: clamp(14px, 2.2vw, 22px);
  --gap: clamp(10px, 2vw, 18px);
  --topbarH: 68px;
  --sidebarW: 270px;
}

*{ box-sizing:border-box; }
html,body{ overflow-x:hidden; }
body{
  margin:0;
  font-family: Inter, system-ui, Segoe UI, sans-serif;
  background: var(--bg);
  color: var(--primary);
}

/* ================= TOPBAR ================= */
.topbar{
  position:fixed;
  top:0;left:0;right:0;
  height: var(--topbarH);
  background: #ffffff;
  border-bottom:1px solid var(--border);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding: 0 var(--pad);
  z-index: 1000;
}
.topbar-left{
  display:flex;
  align-items:center;
  gap: 12px;
  min-width: 180px;
}
.topbar h1{
  font-size: 15px;
  margin:0;
  font-weight: 800;
  letter-spacing: .2px;
}
.toggle-btn{
  font-size:20px;
  cursor:pointer;
  display:none;
  width:42px;height:42px;
  border-radius:12px;
  border:1px solid var(--border);
  display:grid;
  place-items:center;
  background:#fff;
}
.toggle-btn:hover{ box-shadow: var(--shadow); }

.logout{
  background: #111827;
  border:none;
  color:#fff;
  padding:10px 16px;
  border-radius:999px;
  font-weight:700;
  cursor:pointer;
  min-height: 44px;
}
.logout:hover{ opacity:.92; }

/* ================= SIDEBAR ================= */
.sidebar{
  position:fixed;
  top: var(--topbarH);
  left:0;
  width: var(--sidebarW);
  height: calc(100vh - var(--topbarH));
  background: #ffffff;
  border-right:1px solid var(--border);
  padding: 14px;
  z-index: 999;
  transition: transform .25s ease;
}
.sidebar .side-title{
  font-size: 12px;
  color: var(--muted);
  margin: 10px 10px 6px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
}
.sidebar a{
  display:flex;
  align-items:center;
  gap:12px;
  padding: 12px 12px;
  border-radius: 12px;
  text-decoration:none;
  color: #111827;
  font-weight: 700;
}
.sidebar a.active,
.sidebar a:hover{
  background: #f3f4f6;
}
.sidebar .closeRow{
  display:none;
  justify-content:space-between;
  align-items:center;
  padding: 6px 8px 12px;
}
.sidebar .closeBtn{
  width:40px;height:40px;
  border-radius:12px;
  border:1px solid var(--border);
  background:#fff;
}

/* ================= OVERLAY ================= */
.overlay{
  position:fixed;
  inset:0;
  background: rgba(17,24,39,.45);
  z-index: 998;
  display:none;
}
.overlay.show{ display:block; }

/* ================= MAIN ================= */
.main{
  margin-left: var(--sidebarW);
  padding: calc(var(--topbarH) + var(--pad)) var(--pad) 40px;
  max-width: 1400px;
  margin-right:auto;
}

/* ================= SEARCH ================= */
.search{
  margin-bottom: 18px;
  position:relative;
}
.search input{
  border-radius: 999px;
  padding: 12px 18px 12px 44px;
  border: 1px solid var(--border);
  background:#fff;
  font-size: 14px;
  min-height: 46px;
}
.search i{
  position:absolute;
  top:50%;
  left: 16px;
  transform: translateY(-50%);
  color: #9ca3af;
}

/* ================= KPI ================= */
.kpis{
  display:grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: var(--gap);
  margin-bottom: 18px;
}
.kpi{
  background: var(--panel);
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding: clamp(14px, 1.5vw, 20px);
  box-shadow: var(--shadow);
}
.kpi span{
  font-size:12px;
  color: var(--muted);
  font-weight: 700;
}
.kpi strong{
  display:block;
  margin-top: 6px;
  font-size: clamp(20px, 2vw, 28px);
  font-weight: 900;
}

/* ================= ANALYTICS ================= */
.analytics{
  display:grid;
  grid-template-columns: 1.6fr 1fr;
  gap: var(--gap);
  margin-top: 18px;
  margin-bottom: 18px;
}
.chart-card{
  background: var(--panel);
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding: clamp(14px, 2vw, 20px);
  box-shadow: var(--shadow);
  min-width: 0;
}
.chart-title{
  font-weight: 900;
  font-size: 14px;
  margin-bottom: 12px;
  display:flex;
  align-items:center;
  gap:10px;
}
.chart-card canvas{
  width:100% !important;
  height:auto !important;
  max-height: 340px;
}

/* ================= GRID ================= */
.grid{
  display:grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: var(--gap);
}
.card-item{
  background: var(--panel);
  border: 1px solid var(--border);
  border-radius: 18px;
  overflow:hidden;
  box-shadow: var(--shadow);
  transition: transform .18s ease, box-shadow .18s ease;
}
.card-item:hover{
  transform: translateY(-2px);
  box-shadow: 0 14px 28px rgba(17,24,39,.10);
}
.card-item img{
  width:100%;
  height: 170px;
  object-fit: cover;
  background:#f3f4f6;
}
.card-body{
  padding: 14px;
}
.card-body h3{
  margin:0 0 4px;
  font-size: 15px;
  font-weight: 900;
}
.meta{
  font-size:12px;
  color: var(--muted);
}
.price{
  margin-top: 8px;
  font-weight: 900;
  color: #111827;
}
.badge-stock{
  margin-top: 10px;
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding: 6px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 800;
  border:1px solid var(--border);
  background:#fff;
}
.badge-stock::before{
  content:"";
  width:8px;height:8px;
  border-radius:50%;
  background:#9ca3af;
}
.ok{ }
.ok::before{ background: var(--success); }
.low{ }
.low::before{ background: var(--warning); }
.out{ }
.out::before{ background: var(--danger); }

/* EMPTY STATES */
.grid-full{ grid-column: 1 / -1; }
.empty-state{
  background: var(--panel);
  border:1px dashed #cbd5e1;
  border-radius: 18px;
  padding: 52px 18px;
  text-align:center;
  color: var(--muted);
}

/* ================= ORDER (Search -> KPI -> Grid -> Analytics) ================= */
.main{ display:flex; flex-direction:column; }
.search{ order:1; }
.kpis{ order:2; }
.grid{ order:3; margin-top: 6px; }
.analytics{ order:4; }

/* ================= RESPONSIVE ================= */
@media (max-width: 1024px){
  .toggle-btn{ display:grid; }
  .sidebar{
    transform: translateX(-110%);
    width: min(320px, 86vw);
    box-shadow: 0 18px 40px rgba(17,24,39,.18);
  }
  .sidebar.open{ transform: translateX(0); }
  .sidebar .closeRow{ display:flex; }
  .main{ margin-left:0; }
  .analytics{ grid-template-columns: 1fr; }
  .kpis{ grid-template-columns: repeat(2, minmax(0,1fr)); }
}

@media (max-width: 520px){
  .kpis{ grid-template-columns: 1fr; }
  .card-item img{ height: 150px; }
  .chart-card canvas{ max-height: 280px; }
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-left">
    <div class="toggle-btn" id="toggleBtn" aria-label="Open sidebar">
      <i class="fas fa-bars"></i>
    </div>
    <h1><i class="fas fa-boxes-stacked me-2"></i>Supplies</h1>
  </div>

  <form method="POST" action="{{ route('custom.logout') }}">
    @csrf
    <button class="logout">Logout</button>
  </form>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <div class="closeRow">
    <div style="font-weight:900;">Menu</div>
    <button class="closeBtn" id="closeBtn" aria-label="Close sidebar">✕</button>
  </div>

  <div class="side-title">Dashboard</div>
  <a class="active"><i class="fas fa-boxes-stacked"></i> Supplies</a>
</div>

<div class="overlay" id="overlay"></div>

<!-- MAIN -->
<div class="main">

  <!-- SEARCH -->
  <div class="search">
    <i class="fas fa-magnifying-glass"></i>
    <input type="text" id="search" class="form-control" placeholder="Search supplies...">
  </div>

  @php
  $totalStock = $supplies->sum('stock');
  $lowStock = $supplies->where('stock','<=',10)->count();
  $outStock = $supplies->where('stock',0)->count();
  @endphp

  <!-- KPI -->
  <div class="kpis">
    <div class="kpi"><span>Total Supplies</span><strong>{{ $supplies->count() }}</strong></div>
    <div class="kpi"><span>Total Stock</span><strong>{{ $totalStock }}</strong></div>
    <div class="kpi"><span>Low Stock Items</span><strong>{{ $lowStock }}</strong></div>
    <div class="kpi"><span>Out of Stock</span><strong>{{ $outStock }}</strong></div>
  </div>

  <!-- GRID -->
  <div class="grid">
    @forelse($supplies as $s)
      @php $state = $s->stock == 0 ? 'out' : ($s->stock <= 10 ? 'low' : 'ok'); @endphp

      <div class="card-item" data-name="{{ strtolower($s->name) }}">
        <img src="{{ $s->image ? Storage::url($s->image) : 'https://via.placeholder.com/400x250' }}">
        <div class="card-body">
          <h3>{{ $s->name }}</h3>
          <div class="meta">{{ $s->unit }}</div>
          <div class="price">₱{{ number_format($s->selling_price,2) }}</div>
          <span class="badge-stock {{ $state }}">Stock: {{ $s->stock }}</span>
        </div>
      </div>

    @empty
      <div class="grid-full empty-state">
        <i class="fas fa-box-open fa-3x mb-3"></i>
        <h4 class="fw-bold mb-1">No supplies available</h4>
        <p class="mb-0">Stocks will appear here once added.</p>
      </div>
    @endforelse
  </div>

  <!-- FULL WIDTH NO SEARCH RESULTS -->
  <div id="noResults" class="grid" style="display:none;">
    <div class="grid-full empty-state">
      <i class="fas fa-magnifying-glass fa-2x mb-2"></i>
      <h5 class="fw-bold mb-0">No matching supplies</h5>
    </div>
  </div>

  <!-- ANALYTICS -->
  <div class="analytics">
    <div class="chart-card">
      <div class="chart-title"><i class="fas fa-chart-line"></i> Stock per Supply</div>
      <canvas id="stockBarChart"></canvas>
    </div>

    <div class="chart-card">
      <div class="chart-title"><i class="fas fa-chart-simple"></i> Stock Status</div>
      <canvas id="stockStatusChart"></canvas>
    </div>
  </div>

</div>

<script>
  // Sidebar elements
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const toggleBtn = document.getElementById('toggleBtn');
  const closeBtn = document.getElementById('closeBtn');

  function openSidebar(){
    sidebar.classList.add('open');
    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }
  function closeSidebar(){
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
  }

  toggleBtn?.addEventListener('click', openSidebar);
  closeBtn?.addEventListener('click', closeSidebar);
  overlay?.addEventListener('click', closeSidebar);
  document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') closeSidebar(); });

  /* SEARCH */
  document.getElementById('search').addEventListener('keyup', function(){
    const q = this.value.toLowerCase();
    let visible = 0;

    document.querySelectorAll('.card-item[data-name]').forEach(card=>{
      const show = card.dataset.name.includes(q);
      card.style.display = show ? 'block' : 'none';
      if(show) visible++;
    });

    document.getElementById('noResults').style.display =
      visible === 0 && q.length ? 'grid' : 'none';
  });

  /* CHARTS (more responsive) */
  const barCtx = document.getElementById('stockBarChart');
  const doughCtx = document.getElementById('stockStatusChart');

  new Chart(barCtx,{
    type:'bar',
    data:{
      labels:[{!! $supplies->pluck('name')->map(fn($n)=>"'$n'")->join(',') !!}],
      datasets:[{
        data:[{!! $supplies->pluck('stock')->join(',') !!}],
        backgroundColor:'#2563eb',
        borderRadius: 10,
        maxBarThickness: 38
      }]
    },
    options:{
      responsive:true,
      maintainAspectRatio:false,
      plugins:{ legend:{display:false} },
      scales:{
        x:{ ticks:{ color:'#6b7280' }, grid:{ display:false } },
        y:{ ticks:{ color:'#6b7280' }, grid:{ color:'rgba(107,114,128,.18)' } }
      }
    }
  });

  new Chart(doughCtx,{
    type:'doughnut',
    data:{
      labels:['OK','Low','Out'],
      datasets:[{
        data:[
          {{ $supplies->where('stock','>',10)->count() }},
          {{ $lowStock }},
          {{ $outStock }}
        ],
        backgroundColor:['#16a34a','#f59e0b','#ef4444'],
        borderWidth: 0
      }]
    },
    options:{
      responsive:true,
      maintainAspectRatio:false,
      cutout:'68%',
      plugins:{
        legend:{ position:'bottom', labels:{ color:'#374151', boxWidth:12 } }
      }
    }
  });

  // Make charts take height nicely
  // (Chart.js needs container height when maintainAspectRatio:false)
  barCtx.parentElement.style.height = '320px';
  doughCtx.parentElement.style.height = '320px';
  if (window.matchMedia('(max-width:520px)').matches){
    barCtx.parentElement.style.height = '260px';
    doughCtx.parentElement.style.height = '260px';
  }
</script>

</body>
</html>
