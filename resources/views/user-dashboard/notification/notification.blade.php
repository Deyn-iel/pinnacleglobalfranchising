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

@php
  
  $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '';
  $laravelPublic = realpath(public_path()) ?: '';

  $publicRel = '';
  if ($docRoot && $laravelPublic && str_starts_with($laravelPublic, $docRoot)) {
      $publicRel = trim(str_replace($docRoot, '', $laravelPublic), DIRECTORY_SEPARATOR);
      $publicRel = $publicRel ? str_replace(DIRECTORY_SEPARATOR, '/', $publicRel) : '';
  }

  $storageBasePath = '/' . ($publicRel ? trim($publicRel, '/') . '/' : '') . 'storage';
  $storageBasePath = rtrim($storageBasePath, '/');

  $fixStorageUrl = function (?string $maybeUrl) use ($storageBasePath) {
      if (!$maybeUrl) return null;

      $path = parse_url($maybeUrl, PHP_URL_PATH) ?? $maybeUrl;

      $needle = '/storage/';
      $pos = strpos($path, $needle);

      if ($pos !== false) {
          $rest = substr($path, $pos + strlen($needle));
          return $storageBasePath . '/' . ltrim($rest, '/');
      }

      return $maybeUrl; 
  };

  $fromPath = function (?string $path) use ($storageBasePath) {
      return $path ? $storageBasePath . '/' . ltrim($path, '/') : null;
  };

  $isImage = function (?string $url) {
      if (!$url) return false;
      $p = strtolower(parse_url($url, PHP_URL_PATH) ?? '');
      return preg_match('/\.(jpe?g|png|gif|webp)$/i', $p) === 1;
  };
@endphp

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

              $meta = is_array($n->meta) ? $n->meta : [];

              $requestApprovalUrl = $fixStorageUrl($meta['request_approval_url'] ?? null)
                                  ?? $fromPath($meta['request_approval_path'] ?? null);

              $travelOrderUrl     = $fixStorageUrl($meta['travel_order_url'] ?? null)
                                  ?? $fromPath($meta['travel_order_path'] ?? null);

              $ticketUrl          = $fixStorageUrl($meta['registration_ticket_url'] ?? null)
                                  ?? $fromPath($meta['registration_ticket_path'] ?? null);
            @endphp

            <div class="notification-item {{ $n->read_at ? '' : 'unread' }}">
              <div class="notification-icon icon-{{ $type }}">
                <i class="fa-solid {{ $icon }}"></i>
              </div>

              <div class="notification-content">
                <h4>{{ $n->title }}</h4>
                <p>{{ $n->message }}</p>

                @php
  // ✅ find which doc exists in meta (ISA LANG dapat per notif)
  $docUrl = null;
  $docLabel = null;
  $docIcon = null;

  if (!empty($requestApprovalUrl)) {
      $docUrl = $requestApprovalUrl;
      $docLabel = 'Request Approval';
      $docIcon = 'fa-file-arrow-down';
  } elseif (!empty($travelOrderUrl)) {
      $docUrl = $travelOrderUrl;
      $docLabel = 'Travel Order';
      $docIcon = 'fa-file-arrow-down';
  } elseif (!empty($ticketUrl)) {
      $docUrl = $ticketUrl;
      $docLabel = 'Registration Ticket';
      $docIcon = 'fa-ticket';
  }
@endphp

@if($docUrl)
  {{-- ✅ ONE button only --}}
  <div style="margin-top:8px; display:flex; gap:10px; flex-wrap:wrap;">
    <a href="{{ $docUrl }}" target="_blank"
       class="btn btn-sm btn-outline-secondary rounded-pill"
       style="text-decoration:none;">
      <i class="fa-solid {{ $docIcon }} me-1"></i> {{ $docLabel }}
    </a>
  </div>

  {{-- ✅ ONE preview only (if image) --}}
  @if($isImage($docUrl))
    <div style="margin-top:10px; display:flex; gap:12px; flex-wrap:wrap;">
      <a href="{{ $docUrl }}" target="_blank" style="text-decoration:none;">
        <img src="{{ $docUrl }}"
             alt="{{ $docLabel }}"
             style="width:180px; height:auto; border-radius:12px; border:1px solid #e5e7eb; background:#f8fafc; display:block;"
             loading="lazy"
             onerror="this.style.display='none';">
      </a>
    </div>
  @endif
@endif


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
