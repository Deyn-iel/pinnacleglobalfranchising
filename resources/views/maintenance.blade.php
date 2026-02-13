<!doctype html>
<html lang="tl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Under Maintenance — Pinnacle Global Franchising</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <meta name="description" content="Pinnacle Global Franchising is currently under maintenance. We'll be back soon." />
  <meta name="theme-color" content="#0d3553" />

  <style>
    :root{
      --bg:#0d3553;          /* requested solid theme */
      --card: rgba(255,255,255,.10);
      --stroke: rgba(255,255,255,.18);
      --text: rgba(255,255,255,.92);
      --muted: rgba(255,255,255,.72);
      --shadow: 0 28px 90px rgba(0,0,0,.45);
      --radius: 22px;
      --accent: rgba(255,255,255,.16);
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color: var(--text);
      background: var(--bg);
      overflow-x:hidden;
    }

    /* Subtle texture (keeps #0d3553 visible) */
    .bg-glow{
      position:fixed;
      inset:0;
      pointer-events:none;
      z-index:-3;
      background:
        radial-gradient(900px 650px at 25% 20%, rgba(255,255,255,.10), transparent 55%),
        radial-gradient(900px 650px at 80% 75%, rgba(0,0,0,.18), transparent 60%);
      mix-blend-mode: soft-light;
    }

    /* Layout */
    .shell{
      min-height:100%;
      display:flex;
      align-items:center;
      justify-content:center;
      padding: clamp(18px, 4vw, 52px);
    }

    .card{
      width:min(1040px, 100%);
      border-radius: var(--radius);
      background: linear-gradient(180deg, rgba(255,255,255,.12), rgba(255,255,255,.07));
      border:1px solid var(--stroke);
      box-shadow: var(--shadow);
      overflow:hidden;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .top{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:14px;
      padding: 18px clamp(18px, 3vw, 30px);
      border-bottom:1px solid rgba(255,255,255,.10);
    }

    /* Brand row (logo + name side-by-side) */
    .brand{
      display:flex;
      align-items:center;
      gap:12px;
      min-width:0;
    }

    .logo{
      width:44px;
      height:44px;
      border-radius:14px;
      background: rgba(255,255,255,.12);
      border:1px solid rgba(255,255,255,.18);
      display:grid;
      place-items:center;
      overflow:hidden;
      flex: 0 0 auto;
    }
    .logo img{
      width:100%;
      height:100%;
      object-fit:contain;
      padding:7px;
    }

    .brand-text{
      min-width:0;
      line-height:1.15;
    }
    .brand-text strong{
      display:block;
      font-weight:750;
      letter-spacing:.2px;
      font-size: 14.5px;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }
    .brand-text span{
      display:block;
      font-size: 12.5px;
      color: var(--muted);
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }

    .badge{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:8px 12px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.10);
      font-size:12.5px;
      color: rgba(255,255,255,.90);
      white-space:nowrap;
    }
    .dot{
      width:8px;height:8px;border-radius:99px;
      background: #c2c2c2;
      box-shadow: 0 0 0 6px rgba(255,211,106,.14);
    }

    .content{
      display:grid;
      grid-template-columns: 1.05fr .95fr;
      gap: clamp(16px, 3vw, 28px);
      padding: clamp(18px, 3.5vw, 34px);
      align-items:start;
    }

    .headline{
      font-size: clamp(30px, 4.6vw, 52px);
      margin:0 0 10px 0;
      letter-spacing:-.7px;
      line-height:1.05;
    }
    .subhead{
      margin:0 0 18px 0;
      color: var(--muted);
      font-size: clamp(14.5px, 1.7vw, 16.5px);
      line-height:1.6;
      max-width: 60ch;
    }

    .panel{
      border-radius: 18px;
      border:1px solid rgba(255,255,255,.16);
      background: rgba(0,0,0,.12);
      padding: 16px;
    }
    .panel h3{
      margin:0 0 10px 0;
      font-size:14px;
      color: rgba(255,255,255,.90);
      letter-spacing:.2px;
    }

    /* Vimeo embed (NOT background) */
    .video{
      position:relative;
      width:100%;
      aspect-ratio: 16 / 9;
      border-radius: 16px;
      overflow:hidden;
      border: 1px solid rgba(255,255,255,.18);
      background: rgba(0,0,0,.20);
    }
    .video iframe{
      position:absolute;
      inset:0;
      width:100%;
      height:100%;
      border:0;
    }

    .list{
      margin:0;
      padding-left: 18px;
      color: var(--muted);
      font-size: 13.5px;
      line-height:1.65;
    }

    .actions{
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      margin-top: 14px;
    }
    .btn{
      appearance:none;
      border:1px solid rgba(255,255,255,.20);
      background: rgba(255,255,255,.10);
      color: rgba(255,255,255,.92);
      border-radius: 999px;
      padding: 10px 14px;
      font-size: 13px;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:8px;
      cursor:pointer;
      transition: transform .12s ease, background .12s ease;
    }
    .btn:hover{ transform: translateY(-1px); background: rgba(255,255,255,.14); }
    .btn:active{ transform: translateY(0px); }

    .footer{
      display:flex;
      flex-wrap:wrap;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      padding: 14px clamp(18px, 3vw, 30px) 18px;
      border-top:1px solid rgba(255,255,255,.10);
      color: rgba(255,255,255,.68);
      font-size:12.5px;
    }

    .contact a{
      color: rgba(255,255,255,.88);
      text-decoration:none;
      border-bottom: 1px dashed rgba(255,255,255,.40);
    }
    .contact a:hover{ border-bottom-style: solid; }

    @media (max-width: 900px){
      .content{ grid-template-columns: 1fr; }
    }
    @media (max-width: 520px){
      .badge{ display:none; }
      .logo{ width:40px; height:40px; border-radius:12px; }
    }
  </style>
</head>

<body>
  <div class="bg-glow" aria-hidden="true"></div>

  <main class="shell">
    <section class="card" role="region" aria-label="Maintenance notice">
      <header class="top">
        <div class="brand">
          <div class="logo" aria-label="Pinnacle Global Franchising logo">
            <!-- ✅ Palitan ito ng actual logo path/link -->
            <img
              src="{{ asset('img/logo1-removebg-preview.png') }}"
              alt="Pinnacle Global Franchising"
              onerror="this.style.display='none'; this.parentElement.textContent='PGF'; this.parentElement.style.fontWeight='800'; this.parentElement.style.letterSpacing='.5px';"
            />
          </div>

          <div class="brand-text">
            <strong>Pinnacle Global Franchising</strong>
            <span>Maintenance mode</span>
          </div>
        </div>

        <div class="badge" aria-label="status">
          <span class="dot" aria-hidden="true"></span>
          Under Maintenance
        </div>
      </header>

      <div class="content">
        <!-- Left -->
        <div>
          <h1 class="headline">Under Maintenance</h1>
          <p class="subhead">
            We’re currently making updates to improve the design and performance of our website. Please check back again soon.
          </p>

          <div class="panel">
            <h3>Updates in progress</h3>
            <ul class="list">
              <li>Performance improvements</li>
              <li>Design & content updates</li>
              <li>Stability checks</li>
              <li>Fixing Database</li>
            </ul>
          </div>
        </div>

        <!-- Right -->
        <aside class="panel">

          <!-- ✅ Vimeo embed is NOT background -->
          <div class="video">
            <iframe
              src="https://player.vimeo.com/video/1101086567?h=fada1a13bc&autoplay=1&loop=1&autopause=0&muted=1&title=0&byline=0&portrait=0&controls=0"
              allow="autoplay; fullscreen; picture-in-picture"
              allowfullscreen
              title="Maintenance Video"
            ></iframe>
          </div>

          <p class="contact" style="margin:12px 0 0 0; color: rgba(255,255,255,.80); font-size:13px; line-height:1.6;">
            Email: <a href="mailto:info@pinnacleglobalfranchising.com">support@pinnacleglobalfranchising.com</a>   
          </p>
        </aside>
      </div>

      <footer class="footer">
        <span>© <span id="year"></span> Pinnacle Global Franchising</span>
      </footer>
    </section>
  </main>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
