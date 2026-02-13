<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite([
        'resources/css/user-dashboard/app.css',
        'resources/js/user-dashboard/app.js'
    ])

    <style>
        /* Enhanced, SIMPLE, WHITE, fully responsive */
        :root{
            --bg: #f6f8fb;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --stroke: #e5e7eb;
            --stroke-strong:#d1d5db;
            --primary: #0d3553;
            --primary-soft: rgba(13,53,83,.10);
            --shadow: 0 10px 30px rgba(15, 23, 42, .08);
            --radius: 16px;
        }

        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
            color: var(--text);
            background: var(--bg);
        }

        /* Background subtle pattern (clean) */
        .ud-main{
            padding: 24px;
            min-height: 100vh;
            background:
                radial-gradient(900px 600px at 20% 0%, rgba(13,53,83,.06), transparent 55%),
                radial-gradient(900px 600px at 90% 15%, rgba(2,132,199,.06), transparent 55%),
                var(--bg);
        }

        .ud-container{
            width: min(1120px, 100%);
            margin: 0 auto;
        }

        .ud-pagehead{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .ud-title-wrap{
            display:flex;
            align-items:flex-start;
            gap: 12px;
        }

        .ud-title-icon{
            width:44px;height:44px;
            border-radius: 14px;
            display:grid; place-items:center;
            background: var(--primary-soft);
            color: var(--primary);
            border: 1px solid rgba(13,53,83,.12);
            flex: 0 0 auto;
        }

        .ud-title{
            margin:0;
            font-size: clamp(22px, 2.6vw, 30px);
            letter-spacing: -0.3px;
            color: var(--text);
        }

        .ud-subtitle{
            margin: 6px 0 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.45;
        }

        .ud-chip{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: #fff;
            color: var(--text);
            font-size: 13px;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(15,23,42,.06);
        }
        .ud-dot{
            width:8px; height:8px;
            border-radius: 999px;
            background: #15588b;
            box-shadow: 0 0 0 6px #e4f3ff;
        }

        .ud-grid{
            display:grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 16px;
            align-items:start;
        }

        .ud-card{
            background: var(--card);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 18px;
        }

        /* section header inside cards */
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
            color: var(--text);
            display:flex;
            align-items:center;
            gap: 8px;
        }
        .ud-card-title i{ color: var(--primary); }

        .ud-card-sub{
            margin:0;
            font-size: 12.5px;
            color: var(--muted);
        }

        .ud-form .ud-row{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .ud-field{ margin-bottom: 12px; }
        .ud-label{
            display:block;
            margin: 0 0 6px 0;
            font-size: 12.5px;
            color: var(--muted);
        }

        .ud-input, .ud-select, .ud-textarea{
            width:100%;
            border-radius: 12px;
            border: 1px solid var(--stroke-strong);
            background: #fff;
            color: var(--text);
            padding: 11px 12px;
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        /* input with icon */
        .ud-inputwrap{
            position:relative;
        }
        .ud-inputwrap i{
            position:absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events:none;
            font-size: 14px;
        }
        .ud-inputwrap .ud-input{
            padding-left: 36px;
        }

        .ud-input::placeholder, .ud-textarea::placeholder{
            color: #94a3b8;
        }

        .ud-input:focus, .ud-select:focus, .ud-textarea:focus{
            border-color: rgba(13,53,83,.45);
            box-shadow: 0 0 0 4px rgba(13,53,83,.10);
        }

        .ud-textarea{
            resize: vertical;
            min-height: 120px;
        }

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
        }

        .ud-btn{
            border: 1px solid rgba(13,53,83,.22);
            background: var(--primary);
            color: #fff;
            border-radius: 999px;
            padding: 10px 14px;
            font-size: 13px;
            cursor:pointer;
            transition: transform .12s ease, filter .12s ease, box-shadow .12s ease;
            box-shadow: 0 8px 18px rgba(13,53,83,.15);
        }
        .ud-btn:hover{ transform: translateY(-1px); filter: brightness(1.05); }
        .ud-btn:active{ transform: translateY(0); }

        .ud-btn-ghost{
            background: #fff;
            color: var(--primary);
            border: 1px solid rgba(13,53,83,.25);
            box-shadow: none;
        }
        .ud-btn-ghost:hover{ filter: none; background: rgba(13,53,83,.04); }

        /* Right column becomes sticky on desktop (nice UX) */
        .ud-sticky{
            position: sticky;
            top: 16px;
        }

        /* Preview box */
        .ud-preview{
            border-radius: 14px;
            border: 1px solid var(--stroke);
            background: #fafafa;
            padding: 12px;
        }
        .ud-preview-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
            padding: 10px 6px;
            border-bottom: 1px solid var(--stroke);
        }
        .ud-preview-row:last-child{ border-bottom:0; }
        .ud-preview-label{ color: var(--muted); font-size: 12.5px; }
        .ud-preview-value{ font-size: 13px; color: var(--text); }

        .ud-badge{
            display:inline-flex;
            align-items:center;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: #fff;
            font-size: 12px;
            color: var(--text);
        }

        .ud-note{
            margin-top: 12px;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: #fff;
            padding: 10px 12px;
            color: var(--muted);
            font-size: 12.5px;
            line-height: 1.5;
        }

        .ud-tips{ margin-top: 14px; }
        .ud-mini-title{
            margin: 0 0 8px 0;
            font-size: 13px;
            color: var(--text);
            display:flex;
            align-items:center;
            gap: 8px;
        }
        .ud-mini-title i{ color: var(--primary); }
        .ud-ul{
            margin:0;
            padding-left: 18px;
            color: var(--muted);
            font-size: 12.8px;
            line-height: 1.6;
        }

        /* ✅ Responsive */
        @media (max-width: 980px){
            .ud-grid{ grid-template-columns: 1fr; }
            .ud-sticky{ position: static; }
        }
        @media (max-width: 640px){
            .ud-main{ padding: 16px; }
            .ud-form .ud-row{ grid-template-columns: 1fr; }
            .ud-pagehead{ flex-direction: column; align-items: flex-start; }
            .ud-chip{ align-self:flex-start; }
            .ud-title-icon{ width:40px; height:40px; border-radius: 12px; }
        }
    </style>
</head>

<body>
    @include('user-dashboard.partials-dashboard.sidebar')
    @include('user-dashboard.partials-dashboard.header')

    <main class="ud-main">
        <section class="ud-container">
            <header class="ud-pagehead">
                <div class="ud-title-wrap">
                    <div class="ud-title-icon" aria-hidden="true">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h1 class="ud-title">Registration Form</h1>
                        <p class="ud-subtitle">Please fill out the details below. (Design only — no backend yet)</p>
                    </div>
                </div>

                <div class="ud-chip">
                    <span class="ud-dot"></span>
                    Draft
                </div>
            </header>

            <div class="ud-grid">
                {{-- LEFT: FORM --}}
                <form class="ud-card ud-form" action="javascript:void(0)" method="post" novalidate>
                    <div class="ud-card-head">
                        <h2 class="ud-card-title"><i class="fa-solid fa-id-card"></i> Applicant Information</h2>
                        <p class="ud-card-sub">Basic details</p>
                    </div>

                    <div class="ud-row">
                        <div class="ud-field">
                            <label class="ud-label" for="first_name">First name</label>
                            <div class="ud-inputwrap">
                                <i class="fa-regular fa-user"></i>
                                <input class="ud-input" id="first_name" name="first_name" type="text" placeholder="John" />
                            </div>
                        </div>
                        <div class="ud-field">
                            <label class="ud-label" for="last_name">Last name</label>
                            <div class="ud-inputwrap">
                                <i class="fa-regular fa-user"></i>
                                <input class="ud-input" id="last_name" name="last_name" type="text" placeholder="Doe" />
                            </div>
                        </div>
                    </div>

                    <div class="ud-row">
                        <div class="ud-field">
                            <label class="ud-label" for="email">Email address</label>
                            <div class="ud-inputwrap">
                                <i class="fa-regular fa-envelope"></i>
                                <input class="ud-input" id="email" name="email" type="email" placeholder="john@example.com" />
                            </div>
                        </div>
                        <div class="ud-field">
                            <label class="ud-label" for="phone">Phone number</label>
                            <div class="ud-inputwrap">
                                <i class="fa-solid fa-phone"></i>
                                <input class="ud-input" id="phone" name="phone" type="tel" placeholder="+63 9XX XXX XXXX" />
                            </div>
                        </div>
                    </div>

                    <div class="ud-row">
                        <div class="ud-field">
                            <label class="ud-label" for="country">Country</label>
                            <select class="ud-select" id="country" name="country">
                                <option selected disabled>Select country</option>
                                <option>Philippines</option>
                                <option>United States</option>
                                <option>Canada</option>
                                <option>United Kingdom</option>
                                <option>Australia</option>
                            </select>
                        </div>
                        <div class="ud-field">
                            <label class="ud-label" for="city">City</label>
                            <div class="ud-inputwrap">
                                <i class="fa-solid fa-location-dot"></i>
                                <input class="ud-input" id="city" name="city" type="text" placeholder="Manila" />
                            </div>
                        </div>
                    </div>

                    <div class="ud-field">
                        <label class="ud-label" for="address">Address</label>
                        <div class="ud-inputwrap">
                            <i class="fa-solid fa-map-pin"></i>
                            <input class="ud-input" id="address" name="address" type="text" placeholder="Street, Barangay, City, Province" />
                        </div>
                    </div>

                    <hr class="ud-hr" />

                    <div class="ud-card-head" style="margin-top:2px;">
                        <h2 class="ud-card-title"><i class="fa-solid fa-briefcase"></i> Business Preferences</h2>
                        <p class="ud-card-sub">Your plan</p>
                    </div>

                    <div class="ud-row">
                        <div class="ud-field">
                            <label class="ud-label" for="franchise_type">Franchise type</label>
                            <select class="ud-select" id="franchise_type" name="franchise_type">
                                <option selected disabled>Select type</option>
                                <option>Food & Beverage</option>
                                <option>Retail</option>
                                <option>Services</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="ud-field">
                            <label class="ud-label" for="investment">Estimated investment</label>
                            <select class="ud-select" id="investment" name="investment">
                                <option selected disabled>Select range</option>
                                <option>₱50,000 – ₱200,000</option>
                                <option>₱200,000 – ₱500,000</option>
                                <option>₱500,000 – ₱1,000,000</option>
                                <option>₱1,000,000+</option>
                            </select>
                        </div>
                    </div>

                    <div class="ud-row">
                        <div class="ud-field">
                            <label class="ud-label" for="preferred_location">Preferred location</label>
                            <div class="ud-inputwrap">
                                <i class="fa-solid fa-location-crosshairs"></i>
                                <input class="ud-input" id="preferred_location" name="preferred_location" type="text" placeholder="e.g., Makati / Cebu / Davao" />
                            </div>
                        </div>
                        <div class="ud-field">
                            <label class="ud-label" for="timeline">Target timeline</label>
                            <select class="ud-select" id="timeline" name="timeline">
                                <option selected disabled>Select timeline</option>
                                <option>ASAP</option>
                                <option>1–3 months</option>
                                <option>3–6 months</option>
                                <option>6+ months</option>
                            </select>
                        </div>
                    </div>

                    <div class="ud-field">
                        <label class="ud-label" for="message">Message / Notes</label>
                        <textarea class="ud-textarea" id="message" name="message" rows="4" placeholder="Tell us a bit about your background and goals..."></textarea>
                    </div>

                    <div class="ud-actions">
                        <button class="ud-btn ud-btn-ghost" type="reset">
                            <i class="fa-solid fa-rotate-left" style="margin-right:6px;"></i> Clear
                        </button>
                        <button class="ud-btn" type="button">
                            <i class="fa-solid fa-floppy-disk" style="margin-right:6px;"></i> Save (UI only)
                        </button>
                    </div>
                </form>

                {{-- RIGHT: PREVIEW / INFO --}}
                <aside class="ud-card ud-sticky">
                    <div class="ud-card-head">
                        <h2 class="ud-card-title"><i class="fa-solid fa-eye"></i> Preview</h2>
                        <span class="ud-badge">Draft</span>
                    </div>

                    <div class="ud-preview">
                        <div class="ud-preview-row">
                            <span class="ud-preview-label">Status</span>
                            <span class="ud-badge">Draft</span>
                        </div>
                        <div class="ud-preview-row">
                            <span class="ud-preview-label">Applicant</span>
                            <span class="ud-preview-value">—</span>
                        </div>
                        <div class="ud-preview-row">
                            <span class="ud-preview-label">Email</span>
                            <span class="ud-preview-value">—</span>
                        </div>
                        <div class="ud-preview-row">
                            <span class="ud-preview-label">Phone</span>
                            <span class="ud-preview-value">—</span>
                        </div>

                        <div class="ud-note">
                            <strong>Note:</strong> This is a front-end layout only. Validation and saving will be added later.
                        </div>
                    </div>

                    <div class="ud-tips">
                        <h3 class="ud-mini-title"><i class="fa-solid fa-circle-info"></i> Tips</h3>
                        <ul class="ud-ul">
                            <li>Keep fields concise and easy to scan.</li>
                            <li>Use dropdowns for ranges and timelines.</li>
                            <li>We can add file upload + e-sign later.</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</body>
</html>
