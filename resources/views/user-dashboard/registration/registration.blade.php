<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  @vite([
    'resources/css/user-dashboard/app.css',
    'resources/js/user-dashboard/app.js'
  ])

  <style>
    :root{
      --sidebar-w: 260px;

      --bg: #f6f8fb;
      --card: #ffffff;
      --text: #0f172a;
      --muted: #64748b;

      --stroke: #e5e7eb;
      --stroke-strong:#d1d5db;

      --primary: #0d3553;
      --primary-2: #0b4a7a;
      --primary-soft: rgba(13,53,83,.10);

      --shadow: 0 10px 30px rgba(15, 23, 42, .08);
      --shadow-hover: 0 22px 60px rgba(15, 23, 42, .14);

      --radius: 18px;
      --radius-sm: 14px;

      --content-pad: 24px;
      --container-max: 1120px;
      --right-col: 420px;
      --gap: 16px;

      --anim-dur: 600ms;
      --anim-ease: cubic-bezier(.2,.8,.2,1);

      /* alerts */
      --ok-bg: rgba(34,197,94,.12);
      --ok-bd: rgba(34,197,94,.25);
      --ok-tx: #166534;

      --err-bg: rgba(239,68,68,.10);
      --err-bd: rgba(239,68,68,.22);
      --err-tx: #991b1b;

      /* focus ring */
      --ring: 0 0 0 4px rgba(13,53,83,.12);
    }

    *{ box-sizing:border-box; }
    html, body{ height:100%; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color: var(--text);
      background: var(--bg);
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* =========================================================
       ✅ Animations
       ========================================================= */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to { opacity: 1; transform: translateY(0); }
    }

    main.ud-main .ud-container,
    main.ud-main .ud-card{
      opacity: 0;
      animation: fadeUp var(--anim-dur) var(--anim-ease) forwards;
    }
    main.ud-main .ud-card:nth-of-type(1){ animation-delay: 120ms; }
    main.ud-main .ud-card:nth-of-type(2){ animation-delay: 240ms; }

    @media (prefers-reduced-motion: reduce){
      main.ud-main .ud-container,
      main.ud-main .ud-card{
        animation: none !important;
        opacity: 1 !important;
        transform: none !important;
      }
    }

    /* =========================================================
       ✅ Layout
       ========================================================= */
    main.ud-main{
      min-height: 100vh;
      padding: var(--content-pad);
      margin-left: var(--sidebar-w);
      max-width: calc(100vw - var(--sidebar-w));
      background:
        radial-gradient(900px 600px at 20% 0%, rgba(13,53,83,.07), transparent 55%),
        radial-gradient(900px 600px at 90% 15%, rgba(2,132,199,.06), transparent 55%),
        radial-gradient(700px 500px at 50% 80%, rgba(14,116,144,.05), transparent 55%),
        var(--bg);
    }

    .ud-container{
      width: min(var(--container-max), 100%);
      margin: 0 auto;
      min-width: 0;
    }

    .ud-pagehead{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap: 14px;
      margin-bottom: 14px;
    }

    .ud-title-wrap{
      display:flex;
      align-items:flex-start;
      gap: 12px;
      min-width: 0;
    }

    .ud-title-icon{
      width:46px;height:46px;
      border-radius: 16px;
      display:grid; place-items:center;
      background:
        linear-gradient(135deg, rgba(13,53,83,.12), rgba(2,132,199,.10));
      color: var(--primary);
      border: 1px solid rgba(13,53,83,.12);
      flex: 0 0 auto;
      box-shadow: 0 10px 18px rgba(13,53,83,.10);
    }

    .ud-title{
      margin:0;
      font-size: clamp(22px, 2.6vw, 32px);
      letter-spacing: -0.4px;
      line-height: 1.15;
    }

    .ud-subtitle{
      margin: 6px 0 0 0;
      color: var(--muted);
      font-size: 14px;
      line-height: 1.5;
    }

    .ud-grid{
      display:grid;
      grid-template-columns: minmax(560px, 1fr) var(--right-col);
      gap: var(--gap);
      align-items:start;
      min-width: 0;
    }

    .ud-card{
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 18px;
      min-width: 0;
      transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
      position: relative;
      overflow: hidden;
    }

    /* subtle top highlight */
    .ud-card::before{
      content:"";
      position:absolute;
      top:0; left:0; right:0;
      height: 3px;
      background: linear-gradient(90deg, rgba(13,53,83,.55), rgba(2,132,199,.35), rgba(34,197,94,.22));
      opacity: .35;
      pointer-events:none;
    }

    .ud-card:hover{
      transform: translateY(-3px);
      box-shadow: var(--shadow-hover);
      border-color: rgba(13,53,83,.18);
    }

    .ud-card-head{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 10px;
      margin-bottom: 12px;
    }

    .ud-card-title{
      margin:0;
      font-size: 14px;
      letter-spacing: .2px;
      display:flex;
      align-items:center;
      gap: 8px;
      font-weight: 800;
    }
    .ud-card-title i{ color: var(--primary); }

    .ud-card-sub{
      margin:0;
      font-size: 12.5px;
      color: var(--muted);
      white-space: nowrap;
    }

    /* =========================================================
       ✅ Form (better UI + fully responsive)
       ========================================================= */
    .ud-form .ud-row{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      min-width: 0;
    }

    .ud-field{ margin-bottom: 12px; min-width:0; }

    .ud-label{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 10px;
      margin: 0 0 6px 0;
      font-size: 12.5px;
      color: var(--muted);
    }

    .ud-hint{
      font-size: 11.5px;
      color: #94a3b8;
      white-space: nowrap;
    }

    /* input group (icon inside) */
    .ud-input-wrap{
      position: relative;
      min-width: 0;
    }

    .ud-input-icon{
      position:absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 14px;
      pointer-events:none;
    }

    .ud-input, .ud-select, .ud-textarea{
      width:100%;
      border-radius: 14px;
      border: 1px solid var(--stroke-strong);
      background: #fff;
      color: var(--text);
      padding: 11px 12px;
      outline: none;
      transition: border-color .15s ease, box-shadow .15s ease, transform .12s ease;
      appearance: none;
    }

    /* when with icon */
    .ud-input.has-icon{ padding-left: 36px; }

    .ud-input::placeholder, .ud-textarea::placeholder{ color: #94a3b8; }

    .ud-input:focus, .ud-select:focus, .ud-textarea:focus{
      border-color: rgba(13,53,83,.55);
      box-shadow: var(--ring);
    }
    .ud-input:focus{ transform: translateY(-1px); }

    /* select arrow */
    .ud-select-wrap{
      position: relative;
      min-width: 0;
    }
    .ud-select-wrap::after{
      content:"\f078";
      font-family:"Font Awesome 6 Free";
      font-weight: 900;
      position:absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color:#94a3b8;
      font-size: 12px;
      pointer-events:none;
    }
    .ud-select{ padding-right: 38px; }

    .ud-textarea{ resize: vertical; min-height: 120px; }

    .ud-hr{
      border:0;
      height:1px;
      background: var(--stroke);
      margin: 14px 0;
    }

    .ud-actions{
      display:flex;
      justify-content:flex-end;
      gap: 10px;
      padding-top: 6px;
      flex-wrap: wrap;
    }

    .ud-btn{
      border: 1px solid rgba(13,53,83,.22);
      background: linear-gradient(135deg, var(--primary), var(--primary-2));
      color: #fff;
      border-radius: 999px;
      padding: 10px 14px;
      font-size: 13px;
      font-weight: 800;
      cursor:pointer;
      transition: transform .14s ease, filter .14s ease, box-shadow .14s ease;
      box-shadow: 0 10px 22px rgba(13,53,83,.18);
      white-space: nowrap;
    }
    .ud-btn:hover{ transform: translateY(-2px); filter: brightness(1.05); }
    .ud-btn:active{ transform: translateY(0); }

    .ud-btn-ghost{
      background: #fff;
      color: var(--primary);
      border: 1px solid rgba(13,53,83,.25);
      box-shadow: none;
    }
    .ud-btn-ghost:hover{ background: rgba(13,53,83,.04); filter:none; }

    /* =========================================================
       ✅ Aside / Preview (nicer + mobile friendly)
       ========================================================= */
    .ud-sticky{ position: sticky; top: 16px; }

    .ud-preview{
      border-radius: 16px;
      border: 1px solid var(--stroke);
      background:
        linear-gradient(180deg, rgba(248,250,252,.90), rgba(248,250,252,.60));
      padding: 12px;
      overflow: hidden;
    }

    .ud-preview-row{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap: 12px;
      padding: 10px 6px;
      border-bottom: 1px solid var(--stroke);
    }
    .ud-preview-row:last-child{ border-bottom:0; }

    .ud-preview-label{
      color: var(--muted);
      font-size: 12.5px;
      white-space: nowrap;
    }
    .ud-preview-value{
      font-size: 13px;
      text-align:right;
      color: var(--text);
      font-weight: 700;
      word-break: break-word;
    }

    .ud-badge{
      display:inline-flex;
      align-items:center;
      gap: 8px;
      padding: 7px 10px;
      border-radius: 999px;
      border: 1px solid var(--stroke);
      background: #fff;
      font-size: 12px;
      white-space: nowrap;
      box-shadow: 0 10px 18px rgba(2, 6, 23, .04);
    }

    .ud-badge::before{
      content:"";
      width: 8px; height: 8px;
      border-radius: 999px;
      background: rgba(34,197,94,.75);
      box-shadow: 0 0 0 3px rgba(34,197,94,.15);
    }

    /* =========================================================
       ✅ Alerts (kept + improved spacing)
       ========================================================= */
    @keyframes alertIn { from{opacity:0; transform:translateY(-6px);} to{opacity:1; transform:translateY(0);} }
    @keyframes alertOut{ from{opacity:1; transform:translateY(0);} to{opacity:0; transform:translateY(-6px);} }

    .ud-alert{
      display:flex;
      align-items:flex-start;
      gap: 10px;
      width: 100%;
      border-radius: 16px;
      padding: 12px 12px;
      border: 1px solid var(--stroke);
      background: #fff;
      animation: alertIn 280ms ease both;
      margin-bottom: 14px;
    }
    .ud-alert.is-leaving{ animation: alertOut 220ms ease forwards; }

    .ud-alert-icon{
      width: 30px; height: 30px;
      border-radius: 999px;
      display:grid; place-items:center;
      flex: 0 0 auto;
      margin-top: 2px;
      font-size: 13px;
    }

    .ud-alert-content{ flex: 1; min-width: 0; }
    .ud-alert-title{
      margin: 0;
      font-weight: 900;
      font-size: 13px;
      line-height: 1.2;
    }
    .ud-alert-msg{
      margin: 2px 0 0 0;
      font-size: 13px;
      line-height: 1.35;
      color: var(--muted);
      word-break: break-word;
    }

    .ud-alert-success{
      background: var(--ok-bg);
      border-color: var(--ok-bd);
    }
    .ud-alert-success .ud-alert-icon{
      background: rgba(34,197,94,.20);
      color: var(--ok-tx);
    }
    .ud-alert-success .ud-alert-title{ color: var(--ok-tx); }

    .ud-alert-danger{
      background: var(--err-bg);
      border-color: var(--err-bd);
    }
    .ud-alert-danger .ud-alert-icon{
      background: rgba(239,68,68,.18);
      color: var(--err-tx);
    }
    .ud-alert-danger .ud-alert-title{ color: var(--err-tx); }

    .ud-alert-list{
      margin: 6px 0 0 0;
      padding-left: 18px;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.45;
    }

    /* =========================================================
       ✅ Mobile / Responsive (improved)
       ========================================================= */
    @media (min-width: 1600px){
      :root{
        --container-max: 1260px;
        --right-col: 460px;
        --content-pad: 34px;
      }
    }

    @media (max-width: 1366px){
      :root{
        --sidebar-w: 250px;
        --right-col: 390px;
        --content-pad: 22px;
      }
      main.ud-main{
        margin-left: var(--sidebar-w);
        max-width: calc(100vw - var(--sidebar-w));
      }
    }

    @media (max-width: 1280px){
      :root{
        --right-col: 360px;
        --content-pad: 20px;
      }
      .ud-card{ padding: 16px; }
    }

    @media (max-width: 1024px){
      :root{
        --sidebar-w: 240px;
        --content-pad: 18px;
        --right-col: 360px;
      }
      main.ud-main{
        margin-left: var(--sidebar-w);
        max-width: calc(100vw - var(--sidebar-w));
      }
      .ud-grid{ grid-template-columns: 1fr; }
      .ud-sticky{ position: static; }
    }

    @media (max-width: 768px){
      main.ud-main{
        margin-left: 0;
        max-width: 100%;
      }
      .ud-form .ud-row{ grid-template-columns: 1fr; }
      .ud-pagehead{ flex-direction: column; align-items:flex-start; }
      .ud-title-icon{ width:42px; height:42px; border-radius: 14px; }
      .ud-preview-value{ text-align:left; }
      .ud-preview-row{ flex-direction: column; gap: 6px; }
    }

    @media (max-width: 420px){
      :root{ --content-pad: 14px; }
      .ud-actions{ justify-content: stretch; }
      .ud-btn{ width: 100%; justify-content: center; }
      .ud-card{ padding: 14px; }
    }

    /* =========================================================
       ✅ Nice small touches
       ========================================================= */
    .sr-only{
      position:absolute;
      width:1px;height:1px;
      padding:0;margin:-1px;
      overflow:hidden;clip:rect(0,0,0,0);
      white-space:nowrap;border:0;
    }
  </style>
</head>

<body>
  <!-- DO NOT TOUCH -->
  @include('user-dashboard.partials-dashboard.sidebar')
  @include('user-dashboard.partials-dashboard.header')

  <main class="ud-main">
    <section class="ud-container">

      {{-- ✅ SUCCESS --}}
      @if(session('success'))
        <div
          x-data="{ show:true, leaving:false }"
          x-show="show"
          x-transition.opacity.duration.200ms
          class="ud-alert ud-alert-success"
          :class="leaving ? 'is-leaving' : ''"
          x-init="setTimeout(() => { leaving=true; setTimeout(()=> show=false, 220) }, 3500)"
        >
          <div class="ud-alert-icon">
            <i class="fa-solid fa-check"></i>
          </div>

          <div class="ud-alert-content">
            <p class="ud-alert-title">Success</p>
            <p class="ud-alert-msg">{{ session('success') }}</p>
          </div>
        </div>
      @endif

      {{-- ✅ ERRORS --}}
      @if($errors->any())
        <div
          x-data="{ show:true, leaving:false }"
          x-show="show"
          x-transition.opacity.duration.200ms
          class="ud-alert ud-alert-danger"
          :class="leaving ? 'is-leaving' : ''"
        >
          <div class="ud-alert-icon">
            <i class="fa-solid fa-exclamation"></i>
          </div>

          <div class="ud-alert-content">
            <p class="ud-alert-title">Please check the form</p>
            <ul class="ud-alert-list">
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <header class="ud-pagehead">
        <div class="ud-title-wrap">
          <div class="ud-title-icon"><i class="fa-solid fa-clipboard-list"></i></div>
          <div>
            <h1 class="ud-title">WOFEX Coffee Track Registration</h1>
            <p class="ud-subtitle">
              {{ $event['date_range'] }} · {{ $event['venue'] }}
            </p>
          </div>
        </div>
      </header>

      <div class="ud-grid">

        <form class="ud-card ud-form" action="{{ route('user.coffee-registration.store') }}" method="POST">
          @csrf

          <div class="ud-card-head">
            <h2 class="ud-card-title"><i class="fa-solid fa-id-card"></i> Applicant Information</h2>
            <p class="ud-card-sub">Required</p>
          </div>

          <div class="ud-row">
            <div class="ud-field">
              <label class="ud-label">
                <span>First name</span>
                <span class="ud-hint">Given name</span>
              </label>
              <div class="ud-input-wrap">
                <i class="fa-solid fa-user ud-input-icon" aria-hidden="true"></i>
                <input class="ud-input has-icon" name="first_name" value="{{ old('first_name') }}" required placeholder="e.g. Juan">
              </div>
            </div>

            <div class="ud-field">
              <label class="ud-label">
                <span>Last name</span>
                <span class="ud-hint">Surname</span>
              </label>
              <div class="ud-input-wrap">
                <i class="fa-solid fa-user ud-input-icon" aria-hidden="true"></i>
                <input class="ud-input has-icon" name="last_name" value="{{ old('last_name') }}" required placeholder="e.g. Dela Cruz">
              </div>
            </div>
          </div>

          <div class="ud-row">
            <div class="ud-field">
              <label class="ud-label">
                <span>Email</span>
                <span class="ud-hint">We’ll send confirmation</span>
              </label>
              <div class="ud-input-wrap">
                <i class="fa-solid fa-envelope ud-input-icon" aria-hidden="true"></i>
                <input class="ud-input has-icon" type="email" name="email" value="{{ old('email') }}" required placeholder="name@email.com">
              </div>
            </div>

            <div class="ud-field">
              <label class="ud-label">
                <span>Phone</span>
                <span class="ud-hint">Optional</span>
              </label>
              <div class="ud-input-wrap">
                <i class="fa-solid fa-phone ud-input-icon" aria-hidden="true"></i>
                <input class="ud-input has-icon" name="phone" value="{{ old('phone') }}" placeholder="09xx xxx xxxx">
              </div>
            </div>
          </div>

          <hr class="ud-hr" />

          <div class="ud-card-head" style="margin-top:2px;">
            <h2 class="ud-card-title"><i class="fa-solid fa-mug-hot"></i> Coffee Track Session</h2>
            <p class="ud-card-sub">Choose 1</p>
          </div>

          <div class="ud-field">
            <label class="ud-label">
              <span>Session</span>
              <span class="ud-hint">Required</span>
            </label>
            <div class="ud-select-wrap">
              <select class="ud-select" name="session_key" required>
                <option disabled {{ old('session_key')==='' ? 'selected':'' }}>Select session</option>
                @foreach($sessions as $i => $s)
                  <option value="{{ $i }}" @selected(old('session_key')==(string)$i)>
                    {{ $s['datetime'] }} — {{ $s['title'] }} ({{ $s['speaker'] }})
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="ud-field">
            <label class="ud-label">
              <span>Rates & Packages</span>
              <span class="ud-hint">Required</span>
            </label>
            <div class="ud-select-wrap">
              <select class="ud-select" name="rate_key" required>
                <option disabled {{ old('rate_key')==='' ? 'selected':'' }}>Select package</option>
                @foreach($rates as $i => $r)
                  <option value="{{ $i }}" @selected(old('rate_key')==(string)$i)>
                    {{ $r['type'] }} — ₱{{ number_format($r['amount'], 2) }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="ud-row">
            <div class="ud-field">
              <label class="ud-label">
                <span>Payment method</span>
                <span class="ud-hint">Optional</span>
              </label>
              <div class="ud-select-wrap">
                <select class="ud-select" name="payment_method">
                  <option value="" selected>—</option>
                  <option value="GCash" @selected(old('payment_method')=='GCash')>GCash</option>
                  <option value="Bank Transfer" @selected(old('payment_method')=='Bank Transfer')>Bank Transfer</option>
                  <option value="Onsite" @selected(old('payment_method')=='Onsite')>Onsite</option>
                </select>
              </div>
            </div>

            <div class="ud-field">
              <label class="ud-label">
                <span>Reference No.</span>
                <span class="ud-hint">Optional</span>
              </label>
              <div class="ud-input-wrap">
                <i class="fa-solid fa-hashtag ud-input-icon" aria-hidden="true"></i>
                <input class="ud-input has-icon" name="reference_no" value="{{ old('reference_no') }}" placeholder="e.g. 1234567890">
              </div>
            </div>
          </div>

          <div class="ud-field">
            <label class="ud-label">
              <span>Notes</span>
              <span class="ud-hint">Optional</span>
            </label>
            <textarea class="ud-textarea" name="notes" placeholder="Any special notes or concerns...">{{ old('notes') }}</textarea>
          </div>

          <div class="ud-actions">
            <button class="ud-btn ud-btn-ghost" type="reset">
              <i class="fa-solid fa-rotate-left" style="margin-right:8px;"></i> Clear
            </button>
            <button class="ud-btn" type="submit">
              <i class="fa-solid fa-paper-plane" style="margin-right:8px;"></i> Submit Registration
            </button>
          </div>
        </form>

        <aside class="ud-card ud-sticky">
          <div class="ud-card-head">
            <h2 class="ud-card-title"><i class="fa-solid fa-circle-info"></i> Event Details</h2>
            <span class="ud-badge">Coffee Track</span>
          </div>

          <div class="ud-preview">
            <div class="ud-preview-row">
              <span class="ud-preview-label">Event</span>
              <span class="ud-preview-value">{{ $event['name'] }}</span>
            </div>
            <div class="ud-preview-row">
              <span class="ud-preview-label">Date</span>
              <span class="ud-preview-value">{{ $event['date_range'] }}</span>
            </div>
            <div class="ud-preview-row">
              <span class="ud-preview-label">Venue</span>
              <span class="ud-preview-value">{{ $event['venue'] }}</span>
            </div>
          </div>

          <hr class="ud-hr" />

          <div class="ud-preview" style="margin-top:10px;">
            <div class="ud-preview-row">
              <span class="ud-preview-label">Tip</span>
              <span class="ud-preview-value" style="font-weight:600; color:#475569;">
                Double-check your email before submitting.
              </span>
            </div>
          </div>
        </aside>

      </div>
    </section>
  </main>
</body>
</html>
