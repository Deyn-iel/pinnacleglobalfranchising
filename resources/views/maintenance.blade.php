    <!DOCTYPE html>
    <html lang="tl">
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
      <title>Under Maintenance — Pinnacle Global Franchising</title>
      <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
      <meta name="description" content="Pinnacle Global Franchising is currently under maintenance. We'll be back soon with a refreshed experience." />
      <meta name="theme-color" content="#0d3553" />

      <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        :root {
          --bg-deep: #0d3553;
          --card-bg: rgba(255, 255, 255, 0.08);
          --border-light: rgba(255, 255, 255, 0.12);
          --border-glow: rgba(255, 255, 255, 0.2);
          --text-primary: rgba(255, 255, 255, 0.94);
          --text-secondary: rgba(255, 255, 255, 0.72);
          --text-muted: rgba(255, 255, 255, 0.55);
          --accent-gold: #e9c46a;
          --accent-gold-soft: rgba(233, 196, 106, 0.2);
          --shadow-xl: 0 30px 50px -20px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.02) inset;
          --radius-2xl: 2rem;
          --radius-xl: 1.25rem;
          --radius-lg: 1rem;
          --transition-smooth: all 0.2s ease-out;
        }

        body {
          background: var(--bg-deep);
          font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, 'Apple Color Emoji', sans-serif;
          color: var(--text-primary);
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          position: relative;
          overflow-x: hidden;
        }

        body::before {
          content: "";
          position: fixed;
          inset: 0;
          background: radial-gradient(circle at 20% 30%, rgba(255, 248, 225, 0.05) 0%, rgba(0, 0, 0, 0.1) 90%);
          pointer-events: none;
          z-index: -2;
        }

        body::after {
          content: "";
          position: fixed;
          inset: 0;
          background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.045'/%3E%3C/svg%3E");
          opacity: 0.4;
          pointer-events: none;
          z-index: -1;
        }

        .maintenance-container {
          width: 100%;
          max-width: 1300px;
          margin: 2rem 1.5rem;
          backdrop-filter: blur(2px);
        }

        .glass-card {
          background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
          backdrop-filter: blur(14px);
          border-radius: var(--radius-2xl);
          border: 1px solid var(--border-light);
          box-shadow: var(--shadow-xl);
          overflow: hidden;
          transition: transform 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .card-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          flex-wrap: wrap;
          gap: 1rem;
          padding: 1.25rem 2rem;
          border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .brand-group {
          display: flex;
          align-items: center;
          gap: 1rem;
        }

        .logo-wrapper {
          width: 52px;
          height: 52px;
          background: rgba(255, 255, 255, 0.1);
          border-radius: 18px;
          display: flex;
          align-items: center;
          justify-content: center;
          border: 1px solid rgba(255, 255, 255, 0.2);
          transition: var(--transition-smooth);
          box-shadow: 0 6px 12px -8px rgba(0,0,0,0.3);
        }

        .logo-wrapper img {
          width: 70%;
          height: 70%;
          object-fit: contain;
        }

        .brand-text h2 {
          font-size: 1.3rem;
          font-weight: 600;
          letter-spacing: -0.2px;
          line-height: 1.2;
        }

        .brand-text p {
          font-size: 0.75rem;
          color: var(--text-secondary);
          letter-spacing: 0.3px;
        }

        .status-badge {
          display: inline-flex;
          align-items: center;
          gap: 8px;
          background: rgba(233, 196, 106, 0.12);
          backdrop-filter: blur(4px);
          padding: 0.5rem 1.2rem;
          border-radius: 100px;
          border: 1px solid rgba(233, 196, 106, 0.35);
        }

        .pulse-dot {
          width: 9px;
          height: 9px;
          background: #e9c46a;
          border-radius: 50%;
          box-shadow: 0 0 0 0 rgba(233, 196, 106, 0.7);
          animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
          0% { box-shadow: 0 0 0 0 rgba(233, 196, 106, 0.5); }
          70% { box-shadow: 0 0 0 6px rgba(233, 196, 106, 0); }
          100% { box-shadow: 0 0 0 0 rgba(233, 196, 106, 0); }
        }

        .badge-text {
          font-size: 0.8rem;
          font-weight: 500;
          letter-spacing: 0.3px;
          color: #f5e3b6;
        }

        /* main grid */
        .main-grid {
          display: grid;
          grid-template-columns: 1fr 0.9fr;
          gap: 1.8rem;
          padding: 2rem;
        }

        .headline-section h1 {
          font-size: clamp(2.2rem, 5vw, 3.6rem);
          font-weight: 700;
          letter-spacing: -0.02em;
          line-height: 1.2;
          background: linear-gradient(135deg, #ffffff 0%, #e0e9f0 100%);
          background-clip: text;
          -webkit-background-clip: text;
          color: transparent;
          margin-bottom: 0.9rem;
        }

        .description-text {
          font-size: 1rem;
          line-height: 1.5;
          color: var(--text-secondary);
          margin-bottom: 1.8rem;
          max-width: 90%;
        }

        .info-panel {
          background: rgba(0, 0, 0, 0.25);
          border-radius: var(--radius-xl);
          padding: 1.25rem 1.5rem;
          border: 1px solid rgba(255, 255, 255, 0.08);
          transition: var(--transition-smooth);
        }

        .info-panel:hover {
          border-color: rgba(255, 255, 255, 0.18);
          background: rgba(0, 0, 0, 0.3);
        }

        .info-panel h3 {
          font-size: 0.9rem;
          text-transform: uppercase;
          letter-spacing: 1px;
          font-weight: 600;
          color: var(--accent-gold);
          margin-bottom: 1rem;
        }

        .task-list {
          list-style: none;
          display: flex;
          flex-direction: column;
          gap: 0.7rem;
        }

        .task-list li {
          display: flex;
          align-items: center;
          gap: 0.7rem;
          font-size: 0.9rem;
          color: var(--text-secondary);
        }

        .task-list li::before {
          content: "▹";
          color: var(--accent-gold);
          font-size: 0.9rem;
          opacity: 0.9;
        }

        .video-wrapper {
          border-radius: var(--radius-xl);
          overflow: hidden;
          background: #00000022;
          border: 1px solid var(--border-light);
          transition: var(--transition-smooth);
          box-shadow: 0 12px 20px -12px rgba(0, 0, 0, 0.4);
        }

        .video-wrapper iframe {
          width: 100%;
          aspect-ratio: 16 / 9;
          display: block;
          border: none;
        }

        .contact-card {
          margin-top: 1rem;
          background: rgba(255, 255, 255, 0.04);
          border-radius: var(--radius-lg);
          padding: 1rem 1.2rem;
          display: flex;
          align-items: center;
          justify-content: space-between;
          flex-wrap: wrap;
          gap: 0.6rem;
          border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .contact-email {
          display: flex;
          align-items: center;
          gap: 0.6rem;
          font-size: 0.85rem;
          color: var(--text-secondary);
        }

        .contact-email a {
          color: var(--accent-gold);
          text-decoration: none;
          font-weight: 500;
          border-bottom: 1px dashed rgba(233, 196, 106, 0.4);
          transition: all 0.2s;
        }

        .contact-email a:hover {
          color: #f4d58c;
          border-bottom-style: solid;
        }

        .support-btn {
          background: rgba(255, 255, 255, 0.08);
          border: 1px solid rgba(255, 255, 255, 0.2);
          padding: 0.5rem 1rem;
          border-radius: 40px;
          font-size: 0.75rem;
          font-weight: 500;
          display: inline-flex;
          align-items: center;
          gap: 6px;
          color: white;
          text-decoration: none;
          transition: var(--transition-smooth);
        }

        .support-btn:hover {
          background: rgba(233, 196, 106, 0.2);
          border-color: rgba(233, 196, 106, 0.5);
          transform: translateY(-1px);
        }

        .card-footer {
          padding: 1rem 2rem 1.4rem;
          border-top: 1px solid rgba(255, 255, 255, 0.06);
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          align-items: center;
          gap: 0.8rem;
          font-size: 0.75rem;
          color: var(--text-muted);
        }

        .footer-links {
          display: flex;
          gap: 1.5rem;
        }

        .footer-links a {
          color: var(--text-muted);
          text-decoration: none;
          transition: color 0.2s;
          font-size: 0.75rem;
        }

        .footer-links a:hover {
          color: var(--accent-gold);
        }

        .floating-accent {
          position: fixed;
          width: 260px;
          height: 260px;
          background: radial-gradient(circle, rgba(233,196,106,0.12) 0%, rgba(233,196,106,0) 70%);
          border-radius: 50%;
          bottom: -100px;
          right: -80px;
          pointer-events: none;
          z-index: -2;
        }

        .floating-accent-left {
          position: fixed;
          width: 320px;
          height: 320px;
          background: radial-gradient(circle, rgba(100, 150, 200, 0.08) 0%, rgba(0,0,0,0) 70%);
          top: -120px;
          left: -100px;
          pointer-events: none;
          z-index: -2;
        }

        @media (max-width: 880px) {
          .main-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 1.5rem;
          }
          .description-text {
            max-width: 100%;
          }
          .card-header {
            padding: 1rem 1.5rem;
          }
        }

        @media (max-width: 520px) {
          .maintenance-container {
            margin: 1rem;
          }
          .status-badge .badge-text {
            font-size: 0.7rem;
          }
          .logo-wrapper {
            width: 44px;
            height: 44px;
          }
          .brand-text h2 {
            font-size: 1rem;
          }
          .contact-card {
            flex-direction: column;
            align-items: flex-start;
          }
          .card-footer {
            flex-direction: column;
            text-align: center;
          }
        }

        ::-webkit-scrollbar {
          width: 5px;
        }
        ::-webkit-scrollbar-track {
          background: #0a2a42;
        }
        ::-webkit-scrollbar-thumb {
          background: #e9c46a80;
          border-radius: 20px;
        }
      </style>
    </head>
    <body>
      <div class="floating-accent" aria-hidden="true"></div>
      <div class="floating-accent-left" aria-hidden="true"></div>

      <div class="maintenance-container">
        <div class="glass-card">
          <!-- header -->
          <div class="card-header">
            <div class="brand-group">
              <div class="logo-wrapper">
                <img 
                  src="{{ asset('img/logo1-removebg-preview.png') }}" 
                  alt="Pinnacle Global Franchising Logo"
                  onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:26px;font-weight:800;\'>PGF</span>';"
                />
              </div>
              <div class="brand-text">
                <h2>Pinnacle Global Franchising</h2>
                <p>Excellence in franchising solutions</p>
              </div>
            </div>
            <div class="status-badge">
              <span class="pulse-dot"></span>
              <span class="badge-text">Scheduled maintenance</span>
            </div>
          </div>

          <div class="main-grid">
            <div class="headline-section">
              <h1>Under<br>Maintenance</h1>
              <p class="description-text">
                We're refining our platform to deliver a faster, smarter experience. 
                Our team is working hard to bring you an improved interface and enhanced backend stability. 
                Thank you for your patience — we'll be back online shortly.
              </p>
              <div class="info-panel">
                <h3>⚡ current improvements</h3>
                <ul class="task-list">
                  <li>Next-generation performance tuning</li>
                  <li>Refined user interface & accessibility</li>
                  <li>Database optimization & security patches</li>
                  <li>Enhanced franchise management tools</li>
                  <li>Zero-downtime architecture upgrade</li>
                </ul>
              </div>
            </div>
            <aside>
              <div class="video-wrapper">
                <iframe 
                  src="https://player.vimeo.com/video/1101086567?h=fada1a13bc&autoplay=1&loop=1&autopause=0&muted=1&title=0&byline=0&portrait=0&controls=0&background=0" 
                  allow="autoplay; fullscreen; picture-in-picture" 
                  allowfullscreen 
                  title="Pinnacle Global Franchising - maintenance preview video"
                  loading="lazy"
                ></iframe>
              </div>
              <div class="contact-card">
                <div class="contact-email">
                  <span>📧</span> 
                  <a href="mailto:support@pinnacleglobalfranchising.com">support@pinnacleglobalfranchising.com</a>
                </div>
              </div>
            </aside>
          </div>
          <div class="card-footer">
            <span>© <span id="year"></span> Pinnacle Global Franchising — All rights reserved</span>
            <div class="footer-links">
              <a href="#" aria-label="Contact support (simulated)">Support Center</a>
              <a href="#" aria-label="Status page (simulated)">System Status</a>
              <a href="#" aria-label="Updates log (simulated)">Release Notes</a>
            </div>
          </div>
        </div>
      </div>

      <script>
        (function() {
          const yearSpan = document.getElementById('year');
          if (yearSpan) yearSpan.textContent = new Date().getFullYear();
          const notifyBtn = document.getElementById('notifyBtn');
          if (notifyBtn) {
            notifyBtn.addEventListener('click', (e) => {
              e.preventDefault();
              const toast = document.createElement('div');
              toast.textContent = '✨ We’ll notify you once maintenance is complete. Stay tuned!';
              toast.style.position = 'fixed';
              toast.style.bottom = '24px';
              toast.style.left = '50%';
              toast.style.transform = 'translateX(-50%)';
              toast.style.backgroundColor = '#1e2f3e';
              toast.style.backdropFilter = 'blur(12px)';
              toast.style.color = '#f5e3b6';
              toast.style.padding = '10px 20px';
              toast.style.borderRadius = '60px';
              toast.style.fontSize = '0.8rem';
              toast.style.border = '1px solid rgba(233,196,106,0.5)';
              toast.style.zIndex = '999';
              toast.style.fontWeight = '500';
              toast.style.boxShadow = '0 10px 20px rgba(0,0,0,0.2)';
              toast.style.pointerEvents = 'none';
              toast.style.opacity = '0';
              toast.style.transition = 'opacity 0.2s';
              document.body.appendChild(toast);
              setTimeout(() => { toast.style.opacity = '1'; }, 10);
              setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
              }, 2800);
            });
          }

          const fakeLinks = document.querySelectorAll('.footer-links a');
          fakeLinks.forEach(link => {
            link.addEventListener('click', (e) => {
              e.preventDefault();
              const msg = document.createElement('div');
              msg.textContent = '🔧 Full site features will resume after maintenance.';
              msg.style.position = 'fixed';
              msg.style.bottom = '20px';
              msg.style.left = '20px';
              msg.style.background = 'rgba(0,0,0,0.6)';
              msg.style.backdropFilter = 'blur(8px)';
              msg.style.color = '#e9c46a';
              msg.style.fontSize = '0.7rem';
              msg.style.padding = '6px 12px';
              msg.style.borderRadius = '40px';
              msg.style.border = '1px solid rgba(255,215,0,0.3)';
              msg.style.zIndex = '999';
              msg.style.opacity = '0';
              msg.style.transition = 'opacity 0.2s';
              document.body.appendChild(msg);
              setTimeout(() => { msg.style.opacity = '1'; }, 10);
              setTimeout(() => {
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 400);
              }, 1800);
            });
          });
        })();
      </script>
    </body>
    </html>