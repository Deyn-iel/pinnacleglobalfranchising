<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>SupportFlow | Announcement Hub</title>
    <!-- Google Fonts + Font Awesome 6 -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            overflow-x: hidden;
            color: #0f172a;
        }

        /* ---------- LAYOUT MASTER ---------- */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            position: relative;
        }

        /* ========= SIDEBAR (COLLAPSIBLE + RESPONSIVE) ========= */
        .sidebar {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e9edf2;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
            transition: transform 0.25s ease-in-out, width 0.2s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            transform: translateX(0);
        }

        .sidebar.mobile-closed {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 28px 24px;
            border-bottom: 1px solid #eff3f8;
            margin-bottom: 20px;
            position: relative;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: #0d3553;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 15px -6px rgba(37, 99, 235, 0.25);
        }

        .logo-icon i {
            font-size: 1.6rem;
            color: white;
        }

        .logo-text h2 {
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.4px;
            background: linear-gradient(120deg, #0f2b3d, #1e3a5f);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .logo-text span {
            font-size: 0.7rem;
            font-weight: 500;
            color: #5c6f91;
        }

        .nav-menu {
            flex: 1;
            padding: 0 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 0.95rem;
            color: #0d3553;
            transition: all 0.2s;
            cursor: pointer;
            margin: 2px 0;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            text-decoration: none;
        }

        .nav-item i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
            color: #0d3553;
        }

        .nav-item.active {
            background: #eef3ff;
            color: #0d3553;
        }

        .nav-item.active i {
            color: #0d3553;
        }

        .nav-item:hover:not(.active) {
            background: #f8fafc;
            color: #1e293b;
        }

        .sidebar-footer {
            padding: 24px 20px 28px;
            border-top: 1px solid #edf2f7;
            margin-top: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 44px;
            height: 44px;
            background: #0d3553;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-details p {
            font-weight: 700;
            font-size: 0.85rem;
        }

        .user-details small {
            font-size: 0.7rem;
            color: #6c86a3;
        }

        .logout-btn {
            all: unset;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 0.95rem;
            color: #636363;
            cursor: pointer;
            width: 85%;
            margin-top: 12px;
        }

        .logout-btn i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
        }

        .logout-btn:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* ========= MAIN CONTENT ========= */
        .main-content {
            flex: 1;
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: margin-left 0.25s ease, width 0.2s ease;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8fafd;
        }

        .main-content.expanded {
            margin-left: 0;
            width: 100%;
        }

        .top-header {
            background: white;
            padding: 16px 28px;
            border-bottom: 1px solid #eef2f8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
            backdrop-filter: blur(4px);
            background-color: rgba(255, 255, 255, 0.96);
        }

        .menu-toggle {
            display: none;
            background: #f1f5f9;
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 40px;
            font-size: 1.3rem;
            cursor: pointer;
            color: #1e293b;
            transition: 0.2s;
        }

        .page-title h1 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .page-title p {
            font-size: 0.8rem;
            color: #5b6e8c;
            margin-top: 4px;
        }

        .header-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .notification-bell {
            background: #f1f5f9;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 40px;
            cursor: pointer;
            transition: 0.2s;
        }

        /* Dashboard content */
        .dashboard-content {
            padding: 28px 32px;
            flex: 1;
        }

        /* stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 28px;
            padding: 22px 24px;
            border: 1px solid #eef3fa;
            transition: all 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .stat-title {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5b6e8c;
        }

        .stat-value {
            font-size: 2.4rem;
            font-weight: 800;
            margin: 12px 0 4px;
            color: #0f172a;
        }

        .section-card {
            background: white;
            border-radius: 28px;
            border: 1px solid #eef3fa;
            padding: 24px 28px;
            margin-bottom: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .badge-pill {
            background: #eef2ff;
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #2563eb;
        }

        .announcement-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .announcement-item {
            padding: 20px 0;
            border-bottom: 1px solid #f0f4fa;
            transition: background 0.2s;
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .announcement-badge {
            background: #f1f5f9;
            font-size: 0.65rem;
            padding: 4px 12px;
            border-radius: 40px;
            font-weight: 600;
            color: #2c3e66;
        }

        .announcement-badge.highlight {
            background: #fee2e2;
            color: #b91c1c;
        }

        .announcement-desc {
            font-size: 0.9rem;
            color: #334155;
            line-height: 1.45;
            margin-top: 6px;
        }

        .announcement-date {
            font-size: 0.7rem;
            color: #7e92b0;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ticket-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .ticket-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #f0f4fa;
        }

        .ticket-info {
            display: flex;
            gap: 14px;
            align-items: center;
            flex: 2;
        }

        .ticket-status {
            width: 10px;
            height: 10px;
            border-radius: 10px;
        }
        .status-open { background: #ff4d4d; box-shadow: 0 0 0 2px #ffe5e5; }
        .status-progress { background: #008cff; }
        .status-resolved { background: #10b981; }

        .ticket-title {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .ticket-priority {
            font-size: 0.7rem;
            background: #fee2e2;
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: 600;
            color: #b91c1c;
        }
        .priority-low { background: #e0f2fe; color: #0369a1; }
        .priority-medium { background: #fff3e3; color: #b45309; }

        .empty-state {
            text-align: center;
            padding: 32px;
            color: #8ba0bc;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .sidebar {
                width: 280px;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .top-header {
                padding: 12px 20px;
            }
            .page-title h1 {
                font-size: 1.3rem;
            }
            .dashboard-content {
                padding: 20px;
            }
            .stats-grid {
                gap: 16px;
            }
            .section-card {
                padding: 18px 20px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            .announcement-title {
                font-size: 0.95rem;
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 999;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active {
            display: block;
        }
        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="app-wrapper">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-area">
                <div class="logo-icon">
                    <i class="fas fa-megaphone"></i>
                </div>
                <div class="logo-text">
                    <h2>SupportFlow</h2>
                    <span>Announcement Central</span>
                </div>
            </div>
        </div>
        <div class="nav-menu">
            <button class="nav-item active" id="navAnnouncements">
                <i class="fas fa-bullhorn"></i>
                <span>Announcements</span>
            </button>
            <button class="nav-item" id="navTickets">
                <i class="fas fa-ticket-alt"></i>
                <span>Support Tickets</span>
            </button>
            <button class="nav-item" id="navAnalytics">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </button>
        </div>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="avatar">JD</div>
                <div class="user-details">
                    <p>Jessica Drake</p>
                    <small>Operations Manager</small>
                </div>
            </div>
            <button class="logout-btn" id="logoutSimulate">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign out</span>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content" id="mainContent">
        <header class="top-header">
            <button class="menu-toggle" id="menuToggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="page-title">
                <h1 id="dynamicHeaderTitle">Announcement Dashboard</h1>
                <p id="dynamicSubtitle">Latest updates & company news</p>
            </div>
            <div class="header-actions">
                <div class="notification-bell" id="notifyBell">
                    <i class="far fa-bell"></i>
                </div>
            </div>
        </header>

        <div class="dashboard-content" id="dashboardContent">
            <!-- DYNAMIC CONTENT WILL BE RENDERED HERE -->
        </div>
    </main>
</div>

<script>
    // ---------- MOCK DATA ----------
    const announcementsData = [
        { id: 1, title: "📢 New Support Portal Features", description: "We've launched AI-powered smart routing and real-time chat translation. Check the new knowledge base integration.", date: "2025-04-05", category: "Product Update", highlight: true },
        { id: 2, title: "⏰ Scheduled Maintenance", description: "Platform will undergo scheduled maintenance on April 12th from 2:00 AM - 4:00 AM EST. Expect brief downtime.", date: "2025-04-02", category: "Maintenance", highlight: false },
        { id: 3, title: "🏆 Team of the Month: Support Heroes", description: "Congratulations to our Customer Success team for outstanding CSAT scores! Celebrating excellence.", date: "2025-03-28", category: "Recognition", highlight: false },
        { id: 4, title: "📅 Webinar: Advanced Dashboard Tips", description: "Join us April 15th for a live walkthrough of analytics and announcement automation.", date: "2025-03-25", category: "Event", highlight: true }
    ];

    const ticketsData = [
        { id: "TK-1023", title: "Login timeout for EU region", status: "open", priority: "high", date: "2025-04-06" },
        { id: "TK-1089", title: "Dashboard loading slow on mobile", status: "progress", priority: "medium", date: "2025-04-05" },
        { id: "TK-1101", title: "Unable to attach files to announcement", status: "open", priority: "high", date: "2025-04-07" },
        { id: "TK-1112", title: "Notification bell not showing unread count", status: "resolved", priority: "low", date: "2025-04-03" }
    ];

    const stats = {
        activeAnnouncements: announcementsData.length,
        openTickets: ticketsData.filter(t => t.status !== 'resolved').length,
        resolvedThisWeek: 3,
        satisfaction: "94%"
    };

    // Helper format date
    function formatDate(dateStr) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateStr).toLocaleDateString(undefined, options);
    }

    // Render Announcements View
    function renderAnnouncements() {
        const container = document.getElementById('dashboardContent');
        if (!container) return;
        
        const statsHtml = `
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-title">Active Announcements</div><div class="stat-value">${stats.activeAnnouncements}</div><div style="font-size:0.75rem">📢 latest updates</div></div>
                <div class="stat-card"><div class="stat-title">Open Tickets</div><div class="stat-value">${stats.openTickets}</div><div style="font-size:0.75rem">🟡 awaiting response</div></div>
                <div class="stat-card"><div class="stat-title">Resolved (week)</div><div class="stat-value">${stats.resolvedThisWeek}</div><div style="font-size:0.75rem">✅ +12% vs last week</div></div>
                <div class="stat-card"><div class="stat-title">Satisfaction</div><div class="stat-value">${stats.satisfaction}</div><div style="font-size:0.75rem">⭐ based on feedback</div></div>
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-bullhorn" style="margin-right: 10px;"></i> All Announcements</h3>
                    <span class="badge-pill">Latest company news</span>
                </div>
                <div class="announcement-list">
                    ${announcementsData.map(ann => `
                        <div class="announcement-item">
                            <div class="announcement-title">
                                <strong>${ann.title}</strong>
                                <span class="announcement-badge ${ann.highlight ? 'highlight' : ''}">${ann.category}</span>
                            </div>
                            <div class="announcement-desc">${ann.description}</div>
                            <div class="announcement-date"><i class="far fa-calendar-alt"></i> ${formatDate(ann.date)}</div>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-life-ring"></i> Recent Support Activity</h3>
                    <span class="badge-pill">Need help?</span>
                </div>
                <div class="ticket-list">
                    ${ticketsData.slice(0, 3).map(ticket => `
                        <div class="ticket-row">
                            <div class="ticket-info">
                                <div class="ticket-status status-${ticket.status === 'open' ? 'open' : (ticket.status === 'progress' ? 'progress' : 'resolved')}"></div>
                                <div><span class="ticket-title">${ticket.title}</span><div class="ticket-id">${ticket.id}</div></div>
                            </div>
                            <div class="ticket-priority ${ticket.priority === 'low' ? 'priority-low' : (ticket.priority === 'medium' ? 'priority-medium' : '')}">${ticket.priority.toUpperCase()}</div>
                        </div>
                    `).join('')}
                    ${ticketsData.length > 3 ? `<div style="padding-top: 8px; text-align: right;"><small style="color:#5b6e8c;"><i class="fas fa-arrow-right"></i> +${ticketsData.length-3} more tickets</small></div>` : ''}
                </div>
            </div>
        `;
        container.innerHTML = statsHtml;
        document.getElementById('dynamicHeaderTitle').innerText = 'Announcement Dashboard';
        document.getElementById('dynamicSubtitle').innerText = 'Latest updates & company news';
    }

    // Tickets View (full tickets & announcement preview)
    function renderTickets() {
        const container = document.getElementById('dashboardContent');
        const openCount = ticketsData.filter(t => t.status !== 'resolved').length;
        const resolvedCount = ticketsData.filter(t => t.status === 'resolved').length;
        const ticketsHtml = `
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-title">Open Tickets</div><div class="stat-value">${openCount}</div><div style="font-size:0.75rem">⚡ active issues</div></div>
                <div class="stat-card"><div class="stat-title">Resolved</div><div class="stat-value">${resolvedCount}</div><div style="font-size:0.75rem">✅ this period</div></div>
                <div class="stat-card"><div class="stat-title">Avg Response</div><div class="stat-value">2.4h</div><div style="font-size:0.75rem">🚀 SLA performance</div></div>
                <div class="stat-card"><div class="stat-title">Priority High</div><div class="stat-value">${ticketsData.filter(t => t.priority === 'high').length}</div><div style="font-size:0.75rem">🔥 needs attention</div></div>
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-tasks"></i> All Support Tickets</h3>
                    <span class="badge-pill">sort by urgency</span>
                </div>
                <div class="ticket-list">
                    ${ticketsData.map(ticket => `
                        <div class="ticket-row">
                            <div class="ticket-info">
                                <div class="ticket-status status-${ticket.status === 'open' ? 'open' : (ticket.status === 'progress' ? 'progress' : 'resolved')}"></div>
                                <div><span class="ticket-title">${ticket.title}</span><div class="ticket-id">${ticket.id} • ${formatDate(ticket.date)}</div></div>
                            </div>
                            <div class="ticket-priority ${ticket.priority === 'low' ? 'priority-low' : (ticket.priority === 'medium' ? 'priority-medium' : '')}">${ticket.priority.toUpperCase()}</div>
                        </div>
                    `).join('')}
                </div>
                ${ticketsData.length === 0 ? '<div class="empty-state"><i class="fas fa-check-circle"></i> No tickets found</div>' : ''}
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-newspaper"></i> Latest Announcement Highlight</h3>
                    <span class="badge-pill">stay informed</span>
                </div>
                <div class="announcement-item" style="border-bottom: none;">
                    <div class="announcement-title"><strong>${announcementsData[0].title}</strong> <span class="announcement-badge">${announcementsData[0].category}</span></div>
                    <div class="announcement-desc">${announcementsData[0].description}</div>
                    <div class="announcement-date"><i class="far fa-clock"></i> ${formatDate(announcementsData[0].date)}</div>
                </div>
            </div>
        `;
        container.innerHTML = ticketsHtml;
        document.getElementById('dynamicHeaderTitle').innerText = 'Support Tickets';
        document.getElementById('dynamicSubtitle').innerText = 'Manage and track customer requests';
    }

    // Analytics View (KPI focused + announcements insights)
    function renderAnalytics() {
        const highPriorityTickets = ticketsData.filter(t => t.priority === 'high').length;
        const totalAnnouncements = announcementsData.length;
        const engagement = "1.2k views";
        const container = document.getElementById('dashboardContent');
        const analyticsHtml = `
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-title">Announcement CTR</div><div class="stat-value">68%</div><div style="font-size:0.75rem">📈 +7% vs last month</div></div>
                <div class="stat-card"><div class="stat-title">High Priority Tickets</div><div class="stat-value">${highPriorityTickets}</div><div style="font-size:0.75rem">⚠️ escalate soon</div></div>
                <div class="stat-card"><div class="stat-title">Total Announcements</div><div class="stat-value">${totalAnnouncements}</div><div style="font-size:0.75rem">📢 Q2 updates</div></div>
                <div class="stat-card"><div class="stat-title">Engagement</div><div class="stat-value">${engagement}</div><div style="font-size:0.75rem">👀 unique reads</div></div>
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-chart-simple"></i> Announcement Performance</h3>
                    <span class="badge-pill">last 30 days</span>
                </div>
                <div style="margin-top: 12px;">
                    ${announcementsData.map(ann => `
                        <div style="margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; font-size:0.85rem; margin-bottom: 6px;"><span><strong>${ann.title}</strong></span><span>⭐ ${Math.floor(Math.random() * 40 + 60)}% likes</span></div>
                            <div style="background: #eef2ff; border-radius: 20px; height: 8px; width: 100%;"><div style="width: ${Math.floor(Math.random() * 60 + 40)}%; background: #0d3553; height: 8px; border-radius: 20px;"></div></div>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-clock"></i> Upcoming Reminders</h3>
                    <span class="badge-pill">maintenance</span>
                </div>
                <div class="announcement-list">
                    <div class="announcement-item"><div class="announcement-title">🔔 Scheduled Maintenance - April 12</div><div class="announcement-desc">Plan ahead: system will be updated with new announcement workflows.</div><div class="announcement-date"><i class="fas fa-bell"></i> 5 days left</div></div>
                    <div class="announcement-item"><div class="announcement-title">📊 Monthly Reporting Webinar</div><div class="announcement-desc">April 20, 2025 - Deep dive into dashboard analytics.</div><div class="announcement-date"><i class="fas fa-calendar-week"></i> Register now</div></div>
                </div>
            </div>
        `;
        container.innerHTML = analyticsHtml;
        document.getElementById('dynamicHeaderTitle').innerText = 'Analytics Hub';
        document.getElementById('dynamicSubtitle').innerText = 'Performance metrics & insights';
    }

    // UI Active state & navigation
    function setActiveNav(activeId) {
        ['navAnnouncements', 'navTickets', 'navAnalytics'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) {
                if (id === activeId) btn.classList.add('active');
                else btn.classList.remove('active');
            }
        });
    }

    // Notification demo
    function showNotificationToast() {
        const bell = document.getElementById('notifyBell');
        const originalHtml = bell.innerHTML;
        bell.style.backgroundColor = "#eef3ff";
        bell.innerHTML = '<i class="fas fa-bell" style="color:#0d3553;"></i><span style="position:absolute; margin-top:-8px; margin-left:12px; background:#ef4444; color:white; font-size:10px; border-radius:20px; padding:2px 5px;">3</span>';
        setTimeout(() => {
            bell.style.backgroundColor = "#f1f5f9";
            bell.innerHTML = originalHtml;
            alert("🔔 New: Important announcement about platform updates!");
        }, 300);
    }

    // Event binding & responsive sidebar logic
    document.addEventListener("DOMContentLoaded", () => {
        // Initial render
        renderAnnouncements();
        
        // Sidebar elements
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");
        const menuBtn = document.getElementById("menuToggleBtn");
        const mainContent = document.getElementById("mainContent");

        function openSidebar() { sidebar.classList.remove("mobile-closed"); overlay.classList.add("active"); document.body.style.overflow = "hidden"; }
        function closeSidebar() { sidebar.classList.add("mobile-closed"); overlay.classList.remove("active"); document.body.style.overflow = ""; }
        function toggleSidebar() { sidebar.classList.contains("mobile-closed") ? openSidebar() : closeSidebar(); }
        function handleResize() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove("mobile-closed");
                overlay.classList.remove("active");
                document.body.style.overflow = "";
                mainContent.classList.remove("expanded");
            } else {
                sidebar.classList.add("mobile-closed");
                mainContent.classList.add("expanded");
            }
        }

        if (menuBtn) menuBtn.addEventListener("click", toggleSidebar);
        if (overlay) overlay.addEventListener("click", closeSidebar);
        window.addEventListener("resize", handleResize);
        handleResize();

        // Navigation buttons
        document.getElementById("navAnnouncements").addEventListener("click", () => {
            setActiveNav("navAnnouncements");
            renderAnnouncements();
        });
        document.getElementById("navTickets").addEventListener("click", () => {
            setActiveNav("navTickets");
            renderTickets();
        });
        document.getElementById("navAnalytics").addEventListener("click", () => {
            setActiveNav("navAnalytics");
            renderAnalytics();
        });
        
        // Logout simulation (just alert)
        const logoutBtn = document.getElementById("logoutSimulate");
        if (logoutBtn) {
            logoutBtn.addEventListener("click", () => alert("Sign-out demo — dashboard session would end."));
        }
        
        const bellIcon = document.getElementById("notifyBell");
        if (bellIcon) bellIcon.addEventListener("click", showNotificationToast);
    });
</script>
</body>
</html>