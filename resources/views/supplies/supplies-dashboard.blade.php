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
  --primary:#2563eb;
  --accent:#38bdf8;
  --danger:#ef4444;
  --success:#22c55e;
  --warning:#f59e0b;
  --dark:#020617;
  --panel:#ffffff;
  --bg:#f1f5f9;
  --muted:#64748b;
}
* {
    box-sizing: border-box;
}

html, body {
    overflow-x: hidden;
}
body{
  margin:0;
  font-family:Inter,system-ui,Segoe UI,sans-serif;
  background:var(--bg);
  color:#020617;
  overflow-x:hidden;
}

/* ================= TOPBAR ================= */
.topbar{
  position:fixed;
  top:0;left:0;right:0;
  height:68px;
  background:linear-gradient(135deg,#020617,#0f172a);
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 22px;
  z-index:1000;
  box-shadow:0 10px 40px rgba(2,6,23,.6);
}
.topbar-left{
  display:flex;
  align-items:center;
  gap:14px;
}
.toggle-btn{
  font-size:22px;
  cursor:pointer;
  display:none;
}
.topbar h1{
  font-size:18px;
  margin:0;
  font-weight:800;
}
.logout{
  background:var(--danger);
  border:none;
  color:#fff;
  padding:8px 18px;
  border-radius:999px;
  font-weight:700;
  cursor:pointer;
}

/* ================= SIDEBAR ================= */
.sidebar{
  position:fixed;
  top:68px;
  left:0;
  width:270px;
  height:calc(100vh - 68px);
  background:linear-gradient(180deg,#020617,#0f172a);
  padding:20px;
  transition:.3s ease;
  z-index:999;
}
.sidebar a{
  display:flex;
  align-items:center;
  gap:14px;
  padding:12px 14px;
  border-radius:12px;
  text-decoration:none;
  color:#cbd5f5;
  font-weight:600;
}
.sidebar a.active,
.sidebar a:hover{
  background:rgba(56,189,248,.18);
  color:#fff;
}

/* ================= OVERLAY ================= */
.overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.45);
  z-index:998;
  display:none;
}
.overlay.show{display:block}

/* ================= MAIN ================= */
.main{
  margin-left:270px;
  padding:96px 30px 40px;
  transition:.3s ease;
}

/* ================= KPI ================= */
.kpis{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:22px;
  margin-bottom:28px;
}
.kpi{
  background:var(--panel);
  border-radius:18px;
  padding:22px;
  box-shadow:0 20px 40px rgba(15,23,42,.08);
}
.kpi span{
  font-size:13px;
  color:var(--muted);
}
.kpi strong{
  font-size:30px;
  display:block;
  margin-top:4px;
}

/* ================= ANALYTICS ================= */
.analytics{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:24px;
  margin-bottom:30px;
}
.chart-card{
  background:var(--panel);
  border-radius:18px;
  padding:22px;
  box-shadow:0 20px 40px rgba(15,23,42,.08);
}
.chart-title{
  font-weight:800;
  margin-bottom:12px;
}

/* ================= SEARCH ================= */
.search{
  margin-bottom:26px;
  position:relative;
}
.search input{
  border-radius:999px;
  padding:12px 22px 12px 44px;
  box-shadow:0 12px 30px rgba(15,23,42,.08);
  font-size:14px;
}
.search i{
  position:absolute;
  top:50%;
  left:16px;
  transform:translateY(-50%);
  color:#94a3b8;
}

/* ================= GRID ================= */
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
  gap:24px;
}
.card-item{
  background:var(--panel);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 22px 44px rgba(15,23,42,.1);
  transition:.35s ease;
}
.card-item:hover{
  box-shadow:0 30px 60px rgba(15,23,42,.18);
}
.card-item img{
  width:100%;
  height:190px;
  object-fit:cover;
}
.card-body{
  padding:18px;
}
.card-body h3{
  margin:0;
  font-size:17px;
  font-weight:800;
}
.meta{
  font-size:12px;
  color:var(--muted);
}
.price{
  color:var(--primary);
  font-weight:900;
  margin-top:6px;
}
.badge-stock{
  margin-top:10px;
  display:inline-block;
  padding:6px 14px;
  border-radius:999px;
  font-size:12px;
  font-weight:700;
}
.ok{background:#dcfce7;color:#166534}
.low{background:#fef3c7;color:#92400e}
.out{background:#fee2e2;color:#991b1b}

/* ================= RESPONSIVE ================= */
@media(max-width:1024px){
  .toggle-btn{display:block}
  .sidebar{left:-280px}
  .sidebar.open{left:0}
  .main{margin-left:0}
  .analytics{grid-template-columns:1fr}
}

/* ======================================================
   GLOBAL CONTENT WIDTH FIX (DESKTOP FRIENDLY)
====================================================== */
.main {
    max-width: 1400px;          /* sakto lang sa desktop */
    margin-right: auto;
}

/* ultra-wide screens (2k / 4k) */
@media (min-width: 1600px) {
    .main {
        max-width: 1500px;
    }
}

/* ======================================================
   KPI REFINEMENT (PREVENT OVERSIZE)
====================================================== */
.kpi {
    padding: clamp(16px, 1.5vw, 22px);
}

.kpi strong {
    font-size: clamp(22px, 2vw, 28px);
}

/* ======================================================
   ANALYTICS RESPONSIVENESS (MAIN FIX)
====================================================== */
.analytics {
    grid-template-columns: 1.6fr 1fr; /* balanced ratio */
    align-items: stretch;
}

/* chart card sizing */
.chart-card {
    padding: clamp(16px, 2vw, 22px);
}

/* prevent canvas overflow */
.chart-card canvas {
    width: 100% !important;
    max-height: 320px;      /* desktop safe height */
}

/* ======================================================
   LAPTOP BREAKPOINTS
====================================================== */
@media (max-width: 1366px) {
    .main {
        max-width: 1200px;
    }

    .analytics {
        grid-template-columns: 1fr 1fr;
    }

    .chart-card canvas {
        max-height: 280px;
    }
}

/* ======================================================
   TABLET / SMALL LAPTOP
====================================================== */
@media (max-width: 1024px) {
    .analytics {
        grid-template-columns: 1fr;
    }

    .chart-card canvas {
        max-height: 260px;
    }
}

/* ======================================================
   SEARCH BAR SCALE
====================================================== */
.search input {
    font-size: clamp(13px, 1vw, 14px);
}

/* ======================================================
   GRID CARD SCALE (DESKTOP SAFE)
====================================================== */
.grid {
    grid-template-columns: repeat(
        auto-fill,
        minmax(240px, 1fr)
    );
}

/* ======================================================
   CHART TITLE SCALE
====================================================== */
.chart-title {
    font-size: clamp(14px, 1.1vw, 16px);
}
/* ======================================================
   FORCE SECTION ORDER (GRID ABOVE ANALYTICS)
====================================================== */

/* make main a flex container */
.main {
    display: flex;
    flex-direction: column;
}

/* explicit ordering */
.search {
    order: 1;
}

.grid {
    order: 2;          /* GRID NOW ABOVE */
}

.analytics {
    order: 3;          /* DATA / CHARTS NOW BELOW */
}

/* spacing polish */
.grid {
    margin-top: 10px;
}

.analytics {
    margin-top: 36px;
}
/* FULL-WIDTH EMPTY STATE */
.grid-full {
    grid-column: 1 / -1;   /* span all columns */
}

.empty-state {
    background: var(--panel);
    border-radius: 20px;
    padding: 60px 20px;
    box-shadow: 0 22px 44px rgba(15,23,42,.1);
    text-align: center;
}

</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-left">
    <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
    <h1><i class="fas fa-boxes-stacked me-2"></i></h1>
  </div>

  <form method="POST" action="{{ route('custom.logout') }}">
    @csrf
    <button class="logout">Logout</button>
  </form>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <a class="active"><i class="fas fa-boxes-stacked"></i> Supplies</a>
</div>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

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

<!-- ANALYTICS -->
<div class="analytics">
  <div class="chart-card">
    <div class="chart-title"><i class="fas fa-chart-line"></i>
 Stock per Supply</div>
    <canvas id="stockBarChart"></canvas>
  </div>

  <div class="chart-card">
    <div class="chart-title"><i class="fas fa-chart-simple"></i> Stock Status</div>
    <canvas id="stockStatusChart"></canvas>
  </div>
</div>

<!-- GRID -->
<div class="grid">

@forelse($supplies as $s)
    @php
        $state = $s->stock == 0 ? 'out' : ($s->stock <= 10 ? 'low' : 'ok');
    @endphp

    <div class="card-item" data-name="{{ strtolower($s->name) }}">
        <img src="{{ $s->image ? Storage::url($s->image) : 'https://via.placeholder.com/400x250' }}">
        <div class="card-body">
            <h3>{{ $s->name }}</h3>
            <div class="meta">{{ $s->unit }}</div>
            <div class="price">₱{{ number_format($s->selling_price,2) }}</div>
            <span class="badge-stock {{ $state }}">
                Stock: {{ $s->stock }}
            </span>
        </div>
    </div>

@empty
    <!-- FULL WIDTH EMPTY -->
    <div class="grid-full empty-state">
        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
        <h4 class="fw-bold text-muted">No supplies available</h4>
        <p class="text-muted mb-0">
            Stocks will appear here once added.
        </p>
    </div>
@endforelse

</div>

<!-- FULL WIDTH NO SEARCH RESULTS -->
<div id="noResults" class="grid grid-full" style="display:none;">
    <div class="grid-full empty-state">
        <i class="fas fa-magnifying-glass fa-2x text-muted mb-2"></i>
        <h5 class="fw-bold text-muted">No matching supplies</h5>
    </div>
</div>



</div>

</div>

</div>

<!-- SCRIPTS -->
<script>
function toggleSidebar(){
  sidebar.classList.toggle('open');
  overlay.classList.toggle('show');
}

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
    visible === 0 && q.length ? 'block' : 'none';
});


/* CHARTS */
new Chart(stockBarChart,{
  type:'bar',
  data:{
    labels:[{!! $supplies->pluck('name')->map(fn($n)=>"'$n'")->join(',') !!}],
    datasets:[{
      data:[{!! $supplies->pluck('stock')->join(',') !!}],
      backgroundColor:'#38bdf8'
    }]
  },
  options:{plugins:{legend:{display:false}}}
});

new Chart(stockStatusChart,{
  type:'doughnut',
  data:{
    labels:['OK','Low','Out'],
    datasets:[{
      data:[{{ $supplies->where('stock','>',10)->count() }},{{ $lowStock }},{{ $outStock }}],
      backgroundColor:['#22c55e','#f59e0b','#ef4444']
    }]
  },
  options:{plugins:{legend:{position:'bottom'}}}
});
</script>

</body>
</html>
