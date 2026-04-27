<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>PinnacleSupport</title>
    <!-- Google Fonts + Font Awesome 6 -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/chatbot/main-ticket.css'])
</head>

<body>

    @include('ticket.ticket-partials.sidebar')
    <div class="app-wrapper">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>



        <main class="main-content" id="mainContent">
            @include('ticket.ticket-partials.header')

            <div class="dashboard-content" id="mainContentArea">

                <div id="dashboardPanel">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-title">TICKETS</div>
                            <div class="stat-value">{{ \App\Models\Ticket::where('user_id', Auth::id())->count() }}
                            </div>
                            <span class="stat-trend" style="color:#2d9c6b;"><i class="fas fa-chart-line"></i>
                                Submitted</span>
                        </div>


                        <div class="stat-card">
                            <div class="stat-title">Pending</div>
                            <div class="stat-value">
                                {{ \App\Models\Ticket::where('user_id', Auth::id())->where('status', 'pending')->count() }}
                            </div>


                            <span class="stat-trend">
                                <i class="fas fa-clock"></i> Waiting for response
                            </span>
                        </div>


                        <div class="stat-card">
                            <div class="stat-title">In Progress</div>
                            <div class="stat-value">
                                {{ \App\Models\Ticket::where('user_id', Auth::id())->where('status', 'in_progress')->count() }}
                            </div>


                            <span class="stat-trend">
                                <i class="fas fa-sync-alt"></i> Being processed
                            </span>
                        </div>


                        <div class="stat-card">
                            <div class="stat-title">RESOLVED</div>
                            <div class="stat-value">
                                {{ \App\Models\Ticket::where('user_id', Auth::id())->whereMonth('resolved_at', now()->month)->count() }}
                            </div>
                            @php
                                $total = \App\Models\Ticket::where('user_id', Auth::id())->count();
                                $resolved = \App\Models\Ticket::where('user_id', Auth::id())
                                    ->where('status', 'resolved')
                                    ->count();

                                $percent = $total > 0 ? round(($resolved / $total) * 100) : 0;
                            @endphp

                            <span class="stat-trend">
                                <i class="fas fa-check-circle"></i> {{ $percent }}%
                            </span>
                        </div>

                        {{-- <div class="stat-card">
                        <div class="stat-title">ACTIVE ANNOUNCEMENTS</div>
                        <div class="stat-value">0</div>
                        <span class="stat-trend">latest update today</span>
                    </div> --}}
                        <div class="stat-card">
                            <div class="stat-title">STATUS</div>

                            <div class="stat-value" style="font-size:1.6rem;">
                                @if (Auth::check())
                                    <span style="color:#10b981;">● ONLINE</span>
                                @else
                                    <span style="color:#ef4444;">● OFFLINE</span>
                                @endif
                            </div>

                            <span class="stat-trend" style="color:{{ Auth::check() ? '#10b981' : '#ef4444' }};">
                                <i class="fas fa-signal"></i>
                                {{ Auth::check() ? 'Active now' : 'Not connected' }}
                            </span>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-ticket"></i> Recent support tickets</h2>
                        </div>
                        <div class="ticket-list">
                            @php
                                $recentTickets = \App\Models\Ticket::where('user_id', Auth::id())
                                    ->latest()
                                    ->take(5)
                                    ->get();
                            @endphp

                            @forelse($recentTickets as $ticket)
                                <div class="ticket-row">
                                    <div class="ticket-info">
                                        <div
                                            class="ticket-status 
                    {{ $ticket->status == 'pending' ? 'status-open' : '' }}
                    {{ $ticket->status == 'in_progress' ? 'status-progress' : '' }}
                    {{ $ticket->status == 'resolved' ? 'status-resolved' : '' }}">
                                        </div>

                                        <div>
                                            <div class="ticket-title">{{ $ticket->subject }}</div>

                                            <div class="ticket-id">
                                                {{ $ticket->ticket_no }}
                                                •
                                                <span
                                                    class="ticket-status-text 
        {{ $ticket->status == 'pending' ? 'text-warning' : '' }}
        {{ $ticket->status == 'in_progress' ? 'text-primary' : '' }}
        {{ $ticket->status == 'resolved' ? 'text-success' : '' }}">

                                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="ticket-priority 
                {{ $ticket->priority == 'low' ? 'priority-low' : '' }}
                {{ $ticket->priority == 'medium' ? 'priority-medium' : '' }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </div>
                                </div>
                            @empty
                                <p style="color: gray;">No recent tickets</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-bullhorn"></i> Announcements</h2>
                            <div class="badge-pill">Soon</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");
        const menuBtn = document.getElementById("menuToggleBtn");
        const mainContent = document.getElementById("mainContent");
        const closeBtn = document.getElementById("closeSidebarBtn");

        if (closeBtn) {
            closeBtn.addEventListener("click", closeSidebar);
        }

        function openSidebar() {
            sidebar.classList.remove("mobile-closed");
            overlay.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        function closeSidebar() {
            sidebar.classList.add("mobile-closed");
            overlay.classList.remove("active");
            document.body.style.overflow = "";
        }

        function toggleSidebar() {
            if (sidebar.classList.contains("mobile-closed")) {
                openSidebar();
            } else {
                closeSidebar();
            }
        }

        function handleResize() {
            if (window.innerWidth > 967) {
                sidebar.classList.remove("mobile-closed");
                overlay.classList.remove("active");
                document.body.style.overflow = "";
                mainContent.classList.remove("expanded");
            } else {
                sidebar.classList.add("mobile-closed");
                mainContent.classList.add("expanded");
            }
        }

        document.addEventListener("DOMContentLoaded", () => {

            handleResize();

            if (menuBtn) {
                menuBtn.addEventListener("click", toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener("click", closeSidebar);
            }

            window.addEventListener("resize", handleResize);
        });
    </script>
</body>

</html>
