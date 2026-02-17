<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite([
    'resources/css/user-dashboard/app.css',
    'resources/css/notifications/app.css',
    'resources/js/user-dashboard/app.js'
])
</head>

<body>

<div class="wrapper">
  @include('user-dashboard.partials-dashboard.sidebar')

  <div class="main">
    @include('user-dashboard.partials-dashboard.header')

    <div class="content">
      <div class="notification-container">

        <div class="notification-header">
          <h2>Notifications</h2>
          <span>{{ $items->total() }} total</span>
        </div>

        {{-- flash success --}}
        @if(session('success'))
          <div style="margin: 10px 0; padding: 12px; border-radius: 12px; background: #ecfdf5; border: 1px solid #bbf7d0; color:#166534;">
            <i class="fa-solid fa-circle-check" style="margin-right:8px;"></i>
            {{ session('success') }}
          </div>
        @endif

        <div class="notification-list">

          @forelse($items as $n)
            @php
              $type = $n->type ?? 'info';
              $icon = match($type){
                'success' => 'fa-circle-check',
                'warning' => 'fa-triangle-exclamation',
                'danger'  => 'fa-circle-xmark',
                default   => 'fa-circle-info',
              };

              $meta = $n->meta ?? [];
            @endphp

            <div class="notification-item {{ $n->read_at ? '' : 'unread' }}">
              <div class="notification-icon icon-{{ $type }}">
                <i class="fa-solid {{ $icon }}"></i>
              </div>

              <div class="notification-content">
                <h4>{{ $n->title }}</h4>
                <p>{{ $n->message }}</p>

                {{-- ✅ Show file links if present --}}
                <div style="margin-top:8px; display:flex; gap:10px; flex-wrap:wrap;  ">
                  @if(!empty($meta['request_approval_url']))
                    <a href="{{ $meta['request_approval_url'] }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill" style="text-decoration: none;">
                      <i class="fa-solid fa-file-arrow-down me-1"></i> Request Approval
                    </a>
                  @endif

                  @if(!empty($meta['travel_order_url']))
                    <a href="{{ $meta['travel_order_url'] }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill" style="text-decoration: none;">
                      <i class="fa-solid fa-file-arrow-down me-1"></i> Travel Order
                    </a>
                  @endif

                  @if(!empty($meta['registration_ticket_url']))
                    <a href="{{ $meta['registration_ticket_url'] }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill" style="text-decoration: none;">
                      <i class="fa-solid fa-ticket me-1"></i> Registration Ticket
                    </a>
                  @endif
                </div>

                <div class="notification-time">
                  {{ $n->created_at->diffForHumans() }}
                </div>
              </div>
            </div>

          @empty
            <div style="padding: 14px; color:#64748b;">
              No notifications yet.
            </div>
          @endforelse

        </div>

        <div style="margin-top:14px;">
          {{ $items->links() }}
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>
