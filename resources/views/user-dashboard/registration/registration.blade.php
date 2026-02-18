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
    'resources/js/user-dashboard/app.js',
    'resources/css/user-dashboard/registration.css'
  ])
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
                <input class="ud-input has-icon" type="email" name="email" value="{{ old('email') }}" required placeholder="name@gmail.com">
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
              <i class="fa-solid fa-rotate-left"></i> Clear
            </button>

            @if($myReg)
  <button class="ud-btn" type="button" disabled>
    <i class="fa-solid fa-lock"></i>
    Registration Already Submitted
  </button>
@else
  <button class="ud-btn" type="submit">
    <i class="fa-solid fa-paper-plane"></i>
    Submit Registration
  </button>
@endif

          </div>
        </form>

        <aside class="ud-card ud-sticky">
          <div class="ud-card-head">
            <h2 class="ud-card-title"><i class="fa-solid fa-circle-info"></i> Event Details</h2>
            <span class="ud-badge">Coffee Track</span>
          </div>

          {{-- ✅ EVENT DETAILS --}}
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

          {{-- ✅ YOUR SUBMISSION STATUS (latest) --}}
          @if($myReg)
            <div class="ud-card-head" style="margin-top:2px;">
              <h2 class="ud-card-title"><i class="fa-solid fa-file-circle-check"></i> Your Submission</h2>

              @php
                $st = strtolower($myReg->status ?? 'Pending'); // pending/approved/rejected/confirmed
                $st = in_array($st, ['pending','approved','rejected','confirmed']) ? $st : 'pending';
              @endphp

              <span class="ud-status {{ $st }}">
                {{ ucfirst($st) }}
              </span>
            </div>

            <div class="ud-preview">
              <div class="ud-preview-row">
                <span class="ud-preview-label">Applicant</span>
                <span class="ud-preview-value">{{ $myReg->full_name }}</span>
              </div>

              <div class="ud-preview-row">
                <span class="ud-preview-label">Email</span>
                <span class="ud-preview-value">{{ $myReg->email }}</span>
              </div>

              <div class="ud-preview-row">
                <span class="ud-preview-label">Session</span>
                <span class="ud-preview-value">
                  {{ $myReg->session_title ?? $myReg->session_datetime }}
                </span>
              </div>

              <div class="ud-preview-row">
                <span class="ud-preview-label">Package</span>
                <span class="ud-preview-value">
                  {{ $myReg->rate_type }} (₱{{ number_format($myReg->rate_amount, 2) }})
                </span>
              </div>

              <div class="ud-preview-row">
                <span class="ud-preview-label">Ref #</span>
                <span class="ud-preview-value">{{ $myReg->reference_no ?? '—' }}</span>
              </div>

              <div class="ud-preview-row">
                <span class="ud-preview-label">Submitted</span>
                <span class="ud-preview-value">
                  {{ optional($myReg->created_at)->format('M d, Y h:i A') ?? '—' }}
                </span>
              </div>
            </div>

            <div class="ud-preview" style="margin-top:10px;">
              <div class="ud-preview-row">
                <span class="ud-preview-label">Next step</span>
                <span class="ud-preview-value" 
      style="font-weight:600; color:#475569; text-align:left; max-width:100%; display:flex; align-items:flex-start; gap:8px;">

  @if(($myReg->status ?? 'Pending') === 'Pending')
    <i class="fa-solid fa-hourglass-half text-warning" style="margin-top:3px;"></i>
    <span>Please wait — your application is under review.</span>

  @elseif(($myReg->status ?? '') === 'Approved')
    <i class="fa-solid fa-circle-check text-success" style="margin-top:3px; color:#08a143;"></i>
    <span>Approved — please wait for confirmation or final instructions.</span>

  @elseif(($myReg->status ?? '') === 'Rejected')
    <i class="fa-solid fa-circle-xmark text-danger" style="margin-top:3px; color:#eb4343;"></i>
    <span>Rejected — you may submit again if allowed.</span>

  @else
    <i class="fa-solid fa-info-circle text-secondary" style="margin-top:3px;"></i>
    <span>Status will update soon.</span>
  @endif

</span>

              </div>
            </div>
          @else
            {{-- If wala pang submission --}}
            <div class="ud-preview" style="margin-top:10px;">
              <div class="ud-preview-row">
                <span class="ud-preview-label">Tip</span>
                <span class="ud-preview-value" style="font-weight:600; color:#475569; text-align:left; max-width:100%;">
                  After you submit, you’ll see your status here (Pending/Approved/Rejected).
                </span>
              </div>
            </div>
          @endif
        </aside>
      </div>
    </section>
  </main>
</body>
</html>
