<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Supplies Dashboard</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<style>
:root{
  --primary:#2563eb;
  --sidebar:#111827;
  --bg:#f8fafc;
  --card:#ffffff;
  --muted:#6b7280;
}
*{box-sizing:border-box}
body{
  margin:0;
  font-family:Inter,system-ui,Segoe UI,Arial,sans-serif;
  background:var(--bg);
  color:#0f172a;
}

/* ================= HEADER ================= */
.header{
  position:fixed;
  top:0;left:0;right:0;
  height:60px;
  background:#000000;
  color: #ffffff;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 16px;
  z-index:1000;
}
.header-left{
  display:flex;
  align-items:center;
  gap:12px;
}
.header h1{
  font-size:18px;
  margin:0;
}
.toggle-btn{
  display:none;
  font-size:22px;
  cursor:pointer;
}
.logout-btn{
  background:#ef4444;
  color:#fff;
  border:none;
  padding:8px 14px;
  border-radius:8px;
  cursor:pointer;
  font-weight:600;
}

/* ================= SIDEBAR ================= */
.sidebar{
  position:fixed;
  top:60px;
  left:0;
  width:240px;
  height:calc(100vh - 60px);
  background:var(--sidebar);
  padding:20px;
  transition:.3s ease;
}
.sidebar a{
  display:block;
  color:#d1d5db;
  text-decoration:none;
  padding:10px 12px;
  border-radius:8px;
  margin-bottom:6px;
  font-size:14px;
}
.sidebar a.active,
.sidebar a:hover{
  background:rgba(255,255,255,0.1);
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

/* ================= MAIN ================= */
.main{
  margin-left:240px;
  padding:90px 20px 28px;
  transition:.3s ease;
}

/* ================= STATS ================= */
.stats{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:16px;
  margin-bottom:24px;
}
.stat{
  background:#fff;
  border-radius:14px;
  padding:18px;
  box-shadow:0 10px 24px rgba(15,23,42,.06);
}
.stat span{
  font-size:13px;
  color:var(--muted);
}
.stat strong{
  font-size:22px;
}

/* ================= SUPPLIES GRID ================= */
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
  gap:18px;
}
.item{
  background:#fff;
  border-radius:16px;
  box-shadow:0 10px 24px rgba(15,23,42,.06);
  overflow:hidden;
  transition:.25s ease;
}
.item:hover{
  box-shadow:0 18px 32px rgba(15,23,42,.12);
}
.item img{
  width:100%;
  height:180px;
  object-fit:cover;
  background:#f1f5f9;
}
.item-body{
  padding:14px;
}
.item h3{
  margin:0;
  font-size:15px;
}
.unit{
  font-size:12px;
  color:var(--muted);
}
.cost{
  font-size:12px;
  color:#6b7280;
  margin-top:6px;
}
.price{
  font-weight:700;
  color:var(--primary);
  margin-top:2px;
}
.stock{
  margin-top:10px;
  display:inline-block;
  font-size:12px;
  padding:4px 10px;
  border-radius:999px;
  background:#e0e7ff;
  color:#3730a3;
}

/* ================= EMPTY ================= */
.empty{
  background:#fff;
  padding:40px;
  text-align:center;
  border-radius:14px;
  color:var(--muted);
  box-shadow:0 10px 24px rgba(15,23,42,.06);
}

/* ================= MOBILE ================= */
@media(max-width:900px){
  .toggle-btn{display:block}
  .sidebar{
    left:-260px;
  }
  .sidebar.open{
    left:0;
    z-index:999;
  }
  .overlay.show{
    display:block;
  }
  .main{
    margin-left:0;
  }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
  <div class="header-left">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <h1><i class="fas fa-boxes-stacked"></i> Supplies Dashboard</h1>
  </div>

  <form method="POST" action="{{ route('custom.logout') }}">
    @csrf
    <button class="logout-btn">Log out</button>
  </form>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <a class="active">Supplies</a>
</div>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- MAIN -->
<div class="main">

@php
  $totalStock = $supplies->sum('stock');
@endphp

<!-- STATS -->
<div class="stats">
  <div class="stat">
    <span>Total Supplies</span><br>
    <strong>{{ $supplies->count() }}</strong>
  </div>
  <div class="stat">
    <span>Total Stock</span><br>
    <strong>{{ $totalStock }}</strong>
  </div>
</div>

@if($supplies->isEmpty())
  <div class="empty">
    No supplies available yet.<br>
  </div>
@else
  <div class="grid">
    @foreach($supplies as $supply)
    <div class="item">
      <img src="{{ $supply->image ? Storage::url($supply->image) : 'https://via.placeholder.com/400x250?text=No+Image' }}">

      <div class="item-body">
        <h3>{{ $supply->name }}</h3>
        <div class="unit">{{ $supply->unit }}</div>

        <div class="cost">
          Cost Price: ₱{{ number_format($supply->cost_price,2) }}
        </div>
        <div class="price">
          Selling Price: ₱{{ number_format($supply->selling_price,2) }}
        </div>

        <span class="stock">Stock: {{ $supply->stock }}</span>
      </div>
    </div>
    @endforeach
  </div>
@endif

</div>

<!-- TOGGLE SCRIPT -->
<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('overlay').classList.toggle('show');
}
</script>

</body>
</html>
