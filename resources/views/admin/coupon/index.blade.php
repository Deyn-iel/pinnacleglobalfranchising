<!-- resources/views/admin/coupon/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Coupons</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
:root{
    --bg:#f5f7fb;
    --card:#ffffff;
    --line:#e6ebf2;
    --text:#0f172a;
    --muted:#64748b;
    --primary:#0d6efd;
    --success:#198754;
    --warning:#f59e0b;
    --danger:#dc3545;
    --soft-blue:#eef5ff;
    --soft-green:#eaf8f0;
    --soft-yellow:#fff7df;
    --soft-red:#ffe9ec;
    --radius:18px;
    --shadow:0 14px 35px rgba(15,23,42,.06);
}

/* =========================
   RESET
========================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html,body{
    width:100%;
    min-height:100%;
}

body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--text);
    overflow-x:hidden;
}

/* =========================
   DESKTOP / LAPTOP ONLY
========================= */
.admin-page{
    margin-left:270px;
    width:calc(100% - 270px);
    padding:28px;
    min-height:100vh;
}

/* =========================
   TOP
========================= */
.page-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:22px;
}

.page-title{
    font-size:34px;
    font-weight:800;
    line-height:1.15;
    display:flex;
    align-items:center;
    gap:14px;
    letter-spacing:-0.4px;
}

.page-subtitle{
    margin-top:10px;
    font-size:15px;
    color:var(--muted);
    max-width:900px;
    line-height:1.6;
}

/* =========================
   GRID
========================= */
.grid{
    display:grid;
    grid-template-columns:repeat(12,minmax(0,1fr));
    gap:22px;
    width:100%;
}

.col-12{grid-column:span 12;}
.col-6{grid-column:span 6;}
.col-4{grid-column:span 4;}
.col-3{grid-column:span 3;}

/* =========================
   CARDS
========================= */
.card-box{
    background:var(--card);
    border:1px solid var(--line);
    border-radius:22px;
    box-shadow:var(--shadow);
    padding:24px;
    width:100%;
}

.card-title{
    font-size:30px;
    font-weight:800;
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:10px;
    line-height:1.2;
}

.card-subtitle{
    font-size:15px;
    color:var(--muted);
    margin-bottom:22px;
    line-height:1.6;
}

/* =========================
   FORM
========================= */
.form-group label{
    display:block;
    margin-bottom:9px;
    font-size:13px;
    font-weight:800;
    color:#334155;
    text-transform:uppercase;
    letter-spacing:.04em;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    border:1px solid #d7dfeb;
    border-radius:14px;
    padding:0 16px;
    background:#fff;
    font-size:15px;
    outline:none;
    transition:.2s ease;
}

.form-group input,
.form-group select{
    height:54px;
}

.form-group textarea{
    min-height:120px;
    padding:15px;
    resize:vertical;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(13,110,253,.08);
}

/* =========================
   BUTTONS
========================= */
.btn-wrap{
    margin-top:22px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.btn-custom{
    border:none;
    border-radius:14px;
    padding:14px 22px;
    min-height:52px;
    font-size:15px;
    font-weight:800;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    text-decoration:none;
    cursor:pointer;
    transition:.2s ease;
}

.btn-custom:hover{
    transform:translateY(-1px);
}

.btn-custom:disabled{
    opacity:.7;
    cursor:not-allowed;
    transform:none;
}

.btn-primary-custom{
    background:var(--primary);
    color:#fff;
}

.btn-success-custom{
    background:var(--success);
    color:#fff;
}

.btn-warning-custom{
    background:var(--warning);
    color:#fff;
}

.btn-danger-custom{
    background:var(--danger);
    color:#fff;
}

.btn-light-custom{
    background:#fff;
    border:1px solid var(--line);
    color:var(--text);
}

/* =========================
   ALERTS
========================= */
.alert{
    border:none;
    border-radius:16px;
    padding:15px 18px;
    margin-bottom:18px;
    font-size:15px;
    font-weight:700;
}

.alert-success{
    background:#eaf8f0;
    color:#146c43;
}

.alert-danger{
    background:#ffe9ec;
    color:#b42318;
}

.alert-hide{
    opacity:0;
    transition:opacity .5s ease;
}

/* =========================
   STATS
========================= */
.stat-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:24px;
}

.stat-card{
    background:#fff;
    border:1px solid var(--line);
    border-radius:20px;
    padding:22px;
    box-shadow:var(--shadow);
}

.stat-label{
    font-size:13px;
    font-weight:800;
    color:var(--muted);
    text-transform:uppercase;
    margin-bottom:10px;
}

.stat-value{
    font-size:42px;
    font-weight:800;
    line-height:1;
}

/* =========================
   TABLE
========================= */
.table-wrap{
    width:100%;
    overflow-x:auto;
    border:1px solid var(--line);
    border-radius:18px;
}

table{
    width:100%;
    min-width:1450px;
    border-collapse:collapse;
}

thead{
    background:#f8fafc;
}

th{
    padding:16px;
    text-align:left;
    font-size:13px;
    font-weight:800;
    color:#334155;
    white-space:nowrap;
    border-bottom:1px solid var(--line);
}

td{
    padding:16px;
    font-size:14px;
    border-bottom:1px solid #edf1f6;
    vertical-align:top;
    line-height:1.5;
}

tbody tr:hover{
    background:#fafcff;
}

/* =========================
   BADGES
========================= */
.badge-pill{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:800;
    white-space:nowrap;
}

.badge-success{
    background:var(--soft-green);
    color:var(--success);
}

.badge-warning{
    background:var(--soft-yellow);
    color:#9a6700;
}

.badge-primary{
    background:var(--soft-blue);
    color:var(--primary);
}

.badge-danger{
    background:var(--soft-red);
    color:var(--danger);
}

/* =========================
   REWARD LIST
========================= */
.reward-list{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:14px;
}

.reward-item{
    border:1px solid var(--line);
    border-radius:16px;
    padding:16px;
    background:#fff;
    font-size:15px;
    font-weight:700;
}

.reward-item small{
    display:block;
    margin-top:7px;
    color:var(--muted);
    font-size:13px;
    font-weight:500;
}

/* =========================
   CODE BOX
========================= */
.inline-code{
    display:inline-block;
    padding:8px 12px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid var(--line);
    font-family:monospace;
    font-size:14px;
    font-weight:800;
    letter-spacing:.3px;
}

/* =========================
   NOTE
========================= */
.section-note{
    background:#f8fafc;
    border:1px dashed #d7dfeb;
    border-radius:14px;
    padding:15px;
    font-size:14px;
    color:#475569;
    line-height:1.6;
}

/* =========================
   LOADING
========================= */
.spin-icon{
    animation:spinIcon .8s linear infinite;
}

@keyframes spinIcon{
    from{transform:rotate(0deg);}
    to{transform:rotate(360deg);}
}

/* =========================
   ONLY FOR PC/LAPTOP
========================= */
@media (max-width:1199px){
    .admin-page{
        margin-left:270px;
        width:calc(100% - 270px);
        padding:20px;
    }

    .page-title{
        font-size:28px;
    }

    .card-title{
        font-size:24px;
    }

    .stat-value{
        font-size:34px;
    }
}
</style>
</head>
<body>
@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<div class="admin-page">

    <div class="page-top">
        <div>
            <div class="page-title">
                <i class="fas fa-tags"></i> Create Coupon's
            </div>
            <div class="page-subtitle">
                Generate coupon codes for coded rewards and manage free rewards with no code required.
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $totalCoupons = $coupons->count();
        $soldCoupons = $coupons->where('selling_status', 'Sold')->count();
        $claimedCoupons = $coupons->where('claim_status', 'Claimed')->count();
        $activeCoupons = $coupons->where('coupon_status', 'Active')->count();

        $codedRewards = collect($rewardTypes)->where('requires_code', true);
        $freeRewards = collect($rewardTypes)->where('requires_code', false);
    @endphp

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Total Coupons</div>
            <div class="stat-value">{{ $totalCoupons }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Sold</div>
            <div class="stat-value">{{ $soldCoupons }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Claimed</div>
            <div class="stat-value">{{ $claimedCoupons }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Active</div>
            <div class="stat-value">{{ $activeCoupons }}</div>
        </div>
    </div>

    <div class="grid">

        <!-- COUPON GENERATOR -->
        <div class="col-12">
            <div class="card-box">
                <div class="card-title">
                    <i class="fas fa-barcode"></i>
                    Coupon Generator
                </div>
                <div class="card-subtitle">
                    Use this section for rewards that require an auto-generated code.
                </div>

                <form action="{{ route('admin.coupons.store') }}" method="POST">
    @csrf

    <div class="grid">
        <div class="form-group col-4">
            <label>Booklet</label>
            <input type="text" value="Auto-generated" readonly>
        </div>

        <div class="form-group col-4">
            <label>Coupon Reward</label>
            <select name="claimable_item" id="claimable_item" required>
                <option value="">Select Reward</option>
                @foreach($codedRewards as $reward)
                    <option
                        value="{{ $reward['name'] }}"
                        data-requires-code="1"
                        {{ old('claimable_item') == $reward['name'] ? 'selected' : '' }}>
                        {{ $reward['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        

        <div class="form-group col-12">
            <label>Coupon Status</label>
            <select name="coupon_status" required>
                <option value="Active" {{ old('coupon_status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('coupon_status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group col-12">
            <label>Generated Code Format</label>
            <div class="inline-code">
                AUTO-GENERATED • 8 CHARACTERS • UPPERCASE • LETTERS + NUMBERS
            </div>
        </div>

        <input type="hidden" name="requires_code" id="requires_code" value="1">
    </div>

                    <div class="btn-wrap">
                        <button type="submit" class="btn-custom btn-primary-custom">
                            <i class="fas fa-wand-magic-sparkles"></i> Generate Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>

        

        <!-- MASTER LIST -->
        <div class="col-12">
            <div class="card-box">
                <div class="card-title">
                    <i class="fas fa-table-list"></i>
                    Master List of Generated Coupons
                </div>
                <div class="card-subtitle">
                    Only rewards with coupon codes will appear here.
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Booklet Serial</th>
                                <th>Unique Code</th>
                                <th>Claimable Item</th>
                                <th>Coupon Status</th>
                                <th>Claim Status</th>
                                <th>Selling Status</th>
                                <th>Buyer Details</th>
                                <th>Paid Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons->whereNotNull('unique_code') as $coupon)
                                <tr>
                                    <td>{{ $coupon->booklet_serial_number ?? '—' }}</td>
                                    <td>
                                        <span class="inline-code">
                                            {{ $coupon->unique_code }}
                                        </span>
                                    </td>
                                    <td>{{ $coupon->claimable_item }}</td>
                                    <td>
                                        <span class="badge-pill {{ $coupon->coupon_status === 'Active' ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $coupon->coupon_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-pill {{ $coupon->claim_status === 'Claimed' ? 'badge-success' : 'badge-warning' }}">
                                            {{ $coupon->claim_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-pill {{ $coupon->selling_status === 'Sold' ? 'badge-success' : 'badge-primary' }}">
                                            {{ $coupon->selling_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $coupon->buyer_name ?? '—' }}</strong><br>
                                        <small>{{ $coupon->buyer_address ?? '—' }}</small><br>
                                        <small>{{ $coupon->buyer_email ?? '—' }}</small><br>
                                        <small>{{ $coupon->buyer_contact ?? '—' }}</small>
                                    </td>
                                    <td>
    <span class="text-muted">—</span>
</td>
                                    <td>
                                        @if($coupon->selling_status !== 'Sold')
                                            <form action="{{ route('admin.coupons.tagSold', $coupon->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-custom btn-success-custom" style="padding:10px 14px;font-size:13px;">
                                                    <i class="fas fa-check"></i> Tag Sold
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge-pill badge-success">Sold</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">No generated coupons found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- AVAILABLE CODED REWARDS -->
        <div class="col-12">
            <div class="card-box">
                <div class="card-title">
                    <i class="fas fa-tags"></i>
                    Rewards That Require Coupon Codes
                </div>

                <div class="reward-list">
                    @foreach($codedRewards as $reward)
                        <div class="reward-item">
                            {{ $reward['name'] }}
                            <small>Auto-Generated Code Required</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- FREE REWARDS -->
        <div class="col-12">
            <div class="card-box">
                <div class="card-title">
                    <i class="fas fa-gift"></i>
                    Free Rewards (No Code Required)
                </div>
                <div class="card-subtitle">
                    These rewards do not need a coupon code. They are manually granted by admin.
                </div>

                <div class="section-note">
                    Examples:
                    <strong>Free Shuttle to Nearest Store</strong>,
                    <strong>Free Kit</strong>,
                    <strong>Isabela Coffee</strong>
                </div>

                <div class="reward-list mt-3">
                    @foreach($freeRewards as $reward)
                        <div class="reward-item">
                            {{ $reward['name'] }}
                            <small>No Code Required</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* auto fade success + danger alerts */
    const alerts = document.querySelectorAll('.alert-success, .alert-danger');

    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('alert-hide');

            setTimeout(() => {
                alert.remove();
            }, 500);

        }, 3000);
    });

    /* keep hidden value */
    const requiresCode = document.getElementById('requires_code');
    if (requiresCode) {
        requiresCode.value = 1;
    }

    /* loading animation for Generate Coupon */
    const generateForm = document.querySelector('form[action*="coupons/store"]');

    if(generateForm){
        generateForm.addEventListener('submit', function(){

            const btn = generateForm.querySelector('button[type="submit"]');

            if(btn){
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Generating...';
            }

        });
    }

});
</script>

</body>
</html>