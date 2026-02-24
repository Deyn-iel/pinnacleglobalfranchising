<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pinnacle Claims Portal (UI Mock)</title>

  <!-- Tailwind only (kept clean). If you still need Bootstrap, you can add it back. -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

  <!-- Icons (optional) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <style>
    /* Basic "anti-download" UX only (not bulletproof) */
    .no-select { user-select: none; -webkit-user-select: none; }
    .watermark {
      position: absolute; inset: 0; pointer-events: none;
      background-image: repeating-linear-gradient(
        -30deg,
        rgba(0,0,0,0.08) 0px,
        rgba(0,0,0,0.08) 1px,
        transparent 1px,
        transparent 36px
      );
      mix-blend-mode: multiply;
    }
    .wm-text {
      position: absolute; inset: 0; pointer-events: none;
      display: grid; place-items: center;
      transform: rotate(-20deg);
      opacity: .18;
      font-weight: 800;
      letter-spacing: .2em;
      text-transform: uppercase;
      font-size: clamp(18px, 3vw, 44px);
      text-align: center;
      white-space: pre-line;
    }

    /* tiny helper for nicer focus */
    :focus-visible { outline: 2px solid rgba(15,23,42,.35); outline-offset: 2px; }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          boxShadow: {
            soft: "0 10px 30px rgba(2,6,23,.08)",
          }
        }
      }
    }
  </script>
</head>

<body class="bg-slate-50 text-slate-900">
  <!-- Mobile Nav Drawer -->
  <div id="mobileOverlay" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40" onclick="toggleMobile(false)"></div>

    <aside class="absolute left-0 top-0 h-full w-[86%] max-w-sm bg-white shadow-soft border-r">
      <div class="p-4 border-b flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="h-9 w-9 rounded-xl bg-slate-900 text-white grid place-items-center font-bold">PG</div>
          <div>
            <div class="font-semibold leading-tight">Pinnacle Portal</div>
            <div class="text-xs text-slate-500 leading-tight">UI Mock</div>
          </div>
        </div>
        <button class="h-10 w-10 rounded-xl border grid place-items-center" onclick="toggleMobile(false)" aria-label="Close menu">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="p-4 space-y-2">
        <button data-nav="home" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-slate-900 text-white">
          <i class="fa-solid fa-house mr-2"></i> Home
        </button>
        <button data-nav="lodge" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white">
          <i class="fa-solid fa-file-circle-plus mr-2"></i> Lodge Claim
        </button>
        <button data-nav="analysis" class="navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border bg-white">
          <i class="fa-solid fa-chart-column mr-2"></i> Analysis Sheet
        </button>

        <div class="mt-4 rounded-2xl bg-slate-50 border p-4">
          <div class="text-xs text-slate-500">Signed in as</div>
          <div class="mt-1 font-semibold text-sm" id="mockUserMobile">HR - Universal Leaf</div>
          <div class="text-xs text-slate-500" id="mockEmailMobile">hr.universal@example.com</div>

          <div class="mt-3">
            <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
              @csrf
              <button type="submit" class="w-full px-4 py-2 rounded-xl bg-white border text-sm font-semibold">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </aside>
  </div>

  <!-- Top Bar -->
  <header class="sticky top-0 z-40 border-b bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between gap-3">
      <!-- Left -->
      <div class="flex items-center gap-3 min-w-0">
        <button class="md:hidden h-10 w-10 rounded-xl border grid place-items-center"
                onclick="toggleMobile(true)" aria-label="Open menu">
          <i class="fa-solid fa-bars"></i>
        </button>

        <div class="h-9 w-9 rounded-xl bg-slate-900 text-white grid place-items-center font-bold shrink-0">PG</div>
        <div class="min-w-0">
          <div class="font-semibold leading-tight truncate">Pinnacle Claims Portal</div>
          <div class="text-xs text-slate-500 leading-tight truncate">UI Mock (No Backend)</div>
        </div>
      </div>

      <!-- Center Nav (desktop) -->
      <nav class="hidden md:flex items-center gap-2">
        <button data-nav="home" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-slate-900 text-white">
          Home
        </button>
        <button data-nav="lodge" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white border">
          Lodge Claim
        </button>
        <button data-nav="analysis" class="navBtn px-3 py-2 rounded-xl text-sm font-semibold bg-white border">
          Analysis Sheet
        </button>
      </nav>

      <!-- Right -->
      <div class="hidden md:flex items-center gap-3">
        <div class="text-right">
          <div class="font-semibold text-sm leading-tight" id="mockUser">HR - Universal Leaf</div>
          <div class="text-xs text-slate-500 leading-tight" id="mockEmail">hr.universal@example.com</div>
        </div>
        <div class="h-9 w-9 rounded-full bg-slate-200 grid place-items-center font-semibold">HR</div>

        <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
          @csrf
          <button type="submit" class="h-10 px-4 rounded-xl border bg-white text-sm font-semibold" title="Logout">
            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="mx-auto max-w-7xl px-4 py-6">
    <!-- HOME -->
    <section id="page-home" class="space-y-6">
      <!-- Hero -->
      <div class="rounded-2xl border bg-white p-5 shadow-soft">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          <div>
            <h1 class="text-xl md:text-2xl font-bold">Home Portal</h1>
            <p class="text-sm text-slate-600 mt-1">View submitted requests, status, assessment, and aging.</p>
          </div>
          <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold"
                    onclick="go('lodge')">
              <i class="fa-solid fa-plus mr-2"></i> Lodge New Claim
            </button>
            <button class="px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                    onclick="toast('Export is UI-only in this mock.')">
              <i class="fa-solid fa-file-export mr-2"></i> Export
            </button>
          </div>
        </div>
      </div>

      <!-- Summary cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl border bg-white p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">Total Claims</div>
            <div class="h-9 w-9 rounded-xl bg-slate-50 border grid place-items-center">
              <i class="fa-solid fa-list-check text-slate-700"></i>
            </div>
          </div>
          <div class="text-2xl font-bold mt-2" id="sumTotal">12</div>
          <div class="text-xs text-slate-500 mt-1">This month</div>
        </div>

        <div class="rounded-2xl border bg-white p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">Overdue</div>
            <div class="h-9 w-9 rounded-xl bg-rose-50 border border-rose-100 grid place-items-center">
              <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
            </div>
          </div>
          <div class="text-2xl font-bold mt-2 text-rose-600" id="sumOverdue">2</div>
          <div class="text-xs text-slate-500 mt-1">Beyond 14 days</div>
        </div>

        <div class="rounded-2xl border bg-white p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">For Checking</div>
            <div class="h-9 w-9 rounded-xl bg-indigo-50 border border-indigo-100 grid place-items-center">
              <i class="fa-solid fa-user-check text-indigo-700"></i>
            </div>
          </div>
          <div class="text-2xl font-bold mt-2" id="sumChecking">3</div>
          <div class="text-xs text-slate-500 mt-1">With checker</div>
        </div>

        <div class="rounded-2xl border bg-white p-4 shadow-soft">
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">Ready for HR Review</div>
            <div class="h-9 w-9 rounded-xl bg-emerald-50 border border-emerald-100 grid place-items-center">
              <i class="fa-solid fa-circle-check text-emerald-700"></i>
            </div>
          </div>
          <div class="text-2xl font-bold mt-2" id="sumReady">4</div>
          <div class="text-xs text-slate-500 mt-1">Approved analysis available</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="rounded-2xl border bg-white p-4 shadow-soft">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
          <div class="md:col-span-5">
            <label class="text-xs font-semibold text-slate-600">Search</label>
            <div class="mt-1 relative">
              <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
              <input id="searchInput"
                     class="w-full rounded-xl border pl-9 pr-3 py-2.5 text-sm"
                     placeholder="Employee name, claim type, benefit, ID..." />
            </div>
          </div>

          <div class="md:col-span-3">
            <label class="text-xs font-semibold text-slate-600">Status</label>
            <select id="statusFilter" class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm">
              <option value="">All</option>
              <option>Submitted</option>
              <option>Accepted</option>
              <option>Reviewing</option>
              <option>For Checking</option>
              <option>Approved</option>
              <option>HR Review</option>
              <option>Recomputation Requested</option>
              <option>Ready to Download</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="text-xs font-semibold text-slate-600">Benefit</label>
            <select id="benefitFilter" class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm">
              <option value="">All</option>
              <option>Basic Medical</option>
              <option>Major Medical</option>
              <option>Dread Disease</option>
            </select>
          </div>

          <div class="md:col-span-2 flex items-end gap-2">
            <button class="w-full px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold"
                    id="applyFilters">
              Apply
            </button>
            <button class="w-full px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                    id="clearFilters">
              Clear
            </button>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="rounded-2xl border bg-white overflow-hidden shadow-soft">
        <div class="p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
          <div class="font-semibold">Submitted Requests</div>
          <div class="text-xs text-slate-500">Aging &gt; 14 days = overdue</div>
        </div>

        <div class="overflow-auto">
          <table class="min-w-[980px] w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
              <tr>
                <th class="text-left px-4 py-3 font-semibold">Date Submitted</th>
                <th class="text-left px-4 py-3 font-semibold">Aging</th>
                <th class="text-left px-4 py-3 font-semibold">Name</th>
                <th class="text-left px-4 py-3 font-semibold">Employment</th>
                <th class="text-left px-4 py-3 font-semibold">Claim Type</th>
                <th class="text-left px-4 py-3 font-semibold">Benefit</th>
                <th class="text-left px-4 py-3 font-semibold">Status</th>
                <th class="text-right px-4 py-3 font-semibold">Total</th>
                <th class="text-right px-4 py-3 font-semibold">Recomputed</th>
                <th class="text-left px-4 py-3 font-semibold">Actions</th>
              </tr>
            </thead>
            <tbody id="claimsTbody" class="divide-y"></tbody>
          </table>
        </div>
      </div>

      <!-- Drawer/Modal -->
      <div id="claimModal" class="fixed inset-0 hidden items-center justify-center bg-black/40 p-4 z-50">
        <div class="w-full max-w-3xl rounded-2xl bg-white border shadow-soft overflow-hidden">
          <div class="px-5 py-4 border-b flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="font-bold truncate" id="modalTitle">Claim Details</div>
              <div class="text-xs text-slate-500 truncate" id="modalSubtitle">History, assessment, remarks</div>
            </div>
            <button class="px-3 py-2 rounded-xl border bg-white text-sm font-semibold"
                    onclick="closeModal()">
              Close
            </button>
          </div>

          <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-2xl border p-4">
              <div class="text-xs font-semibold text-slate-600">History</div>
              <ul class="mt-2 text-sm text-slate-700 space-y-2" id="modalHistory"></ul>
            </div>

            <div class="rounded-2xl border p-4">
              <div class="text-xs font-semibold text-slate-600">Assessment</div>
              <div class="mt-2 text-sm text-slate-700" id="modalAssessment"></div>
              <div class="mt-4 text-xs font-semibold text-slate-600">Remarks</div>
              <div class="mt-2 text-sm text-slate-700" id="modalRemarks"></div>
            </div>
          </div>

          <div class="px-5 py-4 border-t flex flex-col md:flex-row gap-2 md:items-center md:justify-between">
            <div class="text-xs text-slate-500">This is a UI mock. Buttons show expected actions only.</div>
            <div class="flex flex-col sm:flex-row gap-2">
              <button class="px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                      onclick="toast('Open Analysis Sheet (mock)'); go('analysis')">
                View Analysis
              </button>
              <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold"
                      onclick="toast('Request Recomputation (mock)')">
                Request Recomputation
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LODGE CLAIM -->
    <section id="page-lodge" class="space-y-6 hidden">
      <div class="rounded-2xl border bg-white p-5 shadow-soft">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div>
            <h1 class="text-xl md:text-2xl font-bold">Lodge Claim Request</h1>
            <p class="text-sm text-slate-600 mt-1">Front-end form only (with basic validations).</p>
          </div>
          <button class="px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                  onclick="go('home')">
            Back to Home
          </button>
        </div>
      </div>

      <form id="claimForm" class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Left: Employee -->
        <div class="lg:col-span-2 space-y-4">
          <div class="rounded-2xl border bg-white p-5 shadow-soft">
            <div class="font-semibold">Employee Details</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
              <div>
                <label class="text-xs font-semibold text-slate-600">Surname</label>
                <input required class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="surname" placeholder="Dela Cruz" />
              </div>
              <div>
                <label class="text-xs font-semibold text-slate-600">Given Name</label>
                <input required class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="given" placeholder="Juan" />
              </div>
              <div>
                <label class="text-xs font-semibold text-slate-600">Middle Name</label>
                <input class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="middle" placeholder="Santos" />
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600">Date of Birth</label>
                <input required type="date" class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="dob" />
                <div class="text-xs text-slate-500 mt-1">Accepted: 18–65 years old</div>
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600">Civil Status</label>
                <select required class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="civil">
                  <option value="">Select…</option>
                  <option>Single</option>
                  <option>Married</option>
                </select>
              </div>

              <div>
                <label class="text-xs font-semibold text-slate-600">Employee Type</label>
                <select required class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="empType" id="empType">
                  <option value="">Select…</option>
                  <option>Regular / Probational Employee</option>
                  <option>Seasonal Employee</option>
                </select>
                <div class="text-xs text-slate-500 mt-1">Limits benefit entitlement in real system</div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl border bg-white p-5 shadow-soft">
            <div class="font-semibold">Claim Type</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
              <div class="rounded-2xl border p-4">
                <label class="flex items-center gap-2 text-sm font-semibold">
                  <input type="radio" name="claimType" value="Personal Claim" required />
                  Personal Claim
                </label>
                <p class="text-xs text-slate-500 mt-1">Employee is the claimant.</p>
              </div>
              <div class="rounded-2xl border p-4">
                <label class="flex items-center gap-2 text-sm font-semibold">
                  <input type="radio" name="claimType" value="Dependent's Claim" required id="depRadio"/>
                  Dependent's Claim
                </label>
                <p class="text-xs text-slate-500 mt-1">Parent / Spouse / Child.</p>
              </div>
            </div>

            <div id="dependentBox" class="mt-4 hidden">
              <div class="rounded-2xl bg-slate-50 border p-4">
                <div class="text-sm font-semibold">Dependent Details</div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div>
                    <label class="text-xs font-semibold text-slate-600">Dependent Full Name</label>
                    <input class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="depName" placeholder="Surname_Given_Middle" />
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-600">Relationship</label>
                    <select class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="depRel" id="depRel">
                      <option value="">Select…</option>
                      <option>Parent</option>
                      <option>Spouse</option>
                      <option>Children</option>
                    </select>
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-600">Dependent DOB</label>
                    <input type="date" class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm" name="depDob" id="depDob" />
                    <div class="text-xs text-slate-500 mt-1" id="depRule">Rules: children 14–21; spouse/parent 18–65</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl border bg-white p-5 shadow-soft">
            <div class="font-semibold">Benefit to Claim</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
              <label class="rounded-2xl border p-4 flex gap-2 items-start hover:bg-slate-50">
                <input type="radio" name="benefit" value="Basic Medical" required class="mt-1"/>
                <div>
                  <div class="font-semibold text-sm">Basic Medical</div>
                  <div class="text-xs text-slate-500">Standard outpatient/inpatient basic</div>
                </div>
              </label>
              <label class="rounded-2xl border p-4 flex gap-2 items-start hover:bg-slate-50">
                <input type="radio" name="benefit" value="Major Medical" required class="mt-1"/>
                <div>
                  <div class="font-semibold text-sm">Major Medical</div>
                  <div class="text-xs text-slate-500">Higher threshold benefits</div>
                </div>
              </label>
              <label class="rounded-2xl border p-4 flex gap-2 items-start hover:bg-slate-50">
                <input type="radio" name="benefit" value="Dread Disease" required class="mt-1"/>
                <div>
                  <div class="font-semibold text-sm">Dread Disease</div>
                  <div class="text-xs text-slate-500">Critical illness category</div>
                </div>
              </label>
            </div>
          </div>

          <div class="rounded-2xl border bg-white p-5 shadow-soft">
            <div class="font-semibold">Upload Forms</div>
            <p class="text-sm text-slate-600 mt-1">Mock upload inputs (no actual upload).</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
              <upload-field label="Policy Data Page" required></upload-field>
              <upload-field label="Duly Accomplished Claim Form" required></upload-field>
              <upload-field label="PhilHealth Benefit Deduction Statement" required></upload-field>
              <upload-field label="Attending Physician Statement" required></upload-field>

              <upload-field label="HR Endorsement"></upload-field>
              <upload-field label="Hospital Statement of Account (Itemized)"></upload-field>
              <upload-field label="Medical Abstract / Clinical Summary"></upload-field>
              <upload-field label="Surgical Report (if applicable)"></upload-field>

              <div class="rounded-2xl border p-4 md:col-span-2">
                <div class="flex items-center justify-between gap-3">
                  <div>
                    <div class="text-sm font-semibold">Official Receipts</div>
                    <div class="text-xs text-slate-500">
                      Categorize receipts: Medicine / Professional Fees / Hospital Billing / Surgical Fees / Others
                    </div>
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                  <div>
                    <label class="text-xs font-semibold text-slate-600">Category</label>
                    <select class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm">
                      <option>Medicine</option>
                      <option>Professional Fees</option>
                      <option>Hospital Billing</option>
                      <option>Surgical Fees</option>
                      <option>Others</option>
                    </select>
                  </div>
                  <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-slate-600">Attach Receipt(s)</label>
                    <input type="file" multiple class="mt-1 w-full rounded-xl border px-3 py-2.5 text-sm bg-white"/>
                  </div>
                </div>
              </div>

              <upload-field label="Doctor's Prescription (take-home medicines)"></upload-field>
              <upload-field label="Police/Barangay/Employee Report"></upload-field>
              <upload-field label="Others"></upload-field>
            </div>

            <div class="mt-4 rounded-2xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900">
              <div class="font-semibold">Note</div>
              <div class="mt-1">In the real system: HR can delete/reupload within <b>24 hours</b> after submission.</div>
            </div>
          </div>
        </div>

        <!-- Right: Submit -->
        <aside class="space-y-4">
          <div class="rounded-2xl border bg-white p-5 shadow-soft lg:sticky lg:top-20">
            <div class="font-semibold">Submit Notice</div>
            <p class="text-sm text-slate-600 mt-2">
              I hereby solemnly declare and certify, under penalty of perjury, that all information provided herein is true, complete, and accurate...
            </p>

            <label class="mt-4 flex items-start gap-2 text-sm">
              <input type="checkbox" required class="mt-1"/>
              <span>I agree and understand the consequences of misrepresentation.</span>
            </label>

            <div class="mt-4 rounded-2xl bg-slate-50 border p-4">
              <div class="text-xs font-semibold text-slate-600">Email Notification Recipients (mock)</div>
              <ul class="mt-2 text-xs text-slate-600 space-y-1">
                <li>johncedricktan@pinnacleglobalfranchising.com</li>
                <li>Admin@pinnacleglobalfranchising.com</li>
                <li>alenmarkfernandez@pinnacleglobalfranchising.com</li>
                <li>HR of Universal Leaf (TBD)</li>
              </ul>
            </div>

            <button type="submit"
                    class="mt-4 w-full px-4 py-3 rounded-xl bg-slate-900 text-white text-sm font-semibold">
              Submit Claim (UI Only)
            </button>

            <button type="button"
                    class="mt-2 w-full px-4 py-3 rounded-xl border bg-white text-sm font-semibold"
                    onclick="toast('Draft saved (mock).')">
              Save Draft
            </button>

            <div class="mt-4 text-xs text-slate-500">
              Duplicate name detection + “2nd/3rd claim” selection would be handled in backend.
            </div>
          </div>
        </aside>
      </form>
    </section>

    <!-- ANALYSIS SHEET VIEWER -->
    <section id="page-analysis" class="space-y-6 hidden">
      <div class="rounded-2xl border bg-white p-5 shadow-soft">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
          <div>
            <h1 class="text-xl md:text-2xl font-bold">Analysis Sheet Viewer (View-only Mock)</h1>
            <p class="text-sm text-slate-600 mt-1">No download/print until HR approves. Watermark overlay included.</p>
          </div>
          <div class="flex flex-col sm:flex-row gap-2">
            <button class="px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                    onclick="toast('Request recomputation (mock).')">
              Request Recomputation
            </button>
            <button class="px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold"
                    onclick="unlockDownload()">
              Confirm Computation Correct
            </button>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 rounded-2xl border bg-white overflow-hidden relative shadow-soft">
          <div class="px-5 py-4 border-b flex items-center justify-between">
            <div>
              <div class="font-semibold">Analysis Sheet #1</div>
              <div class="text-xs text-slate-500">Claim: Major Medical • Employee: Juan Dela Cruz</div>
            </div>
            <div class="text-xs px-2 py-1 rounded-lg bg-slate-100 border" id="viewMode">VIEW ONLY</div>
          </div>

          <!-- "Protected" area -->
          <div class="relative p-6 no-select" id="analysisCanvas">
            <div class="watermark"></div>
            <div class="wm-text" id="wmText"></div>

            <div class="rounded-2xl border overflow-hidden">
              <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                  <tr>
                    <th class="text-left px-4 py-3 font-semibold">Item</th>
                    <th class="text-left px-4 py-3 font-semibold">Category</th>
                    <th class="text-right px-4 py-3 font-semibold">Amount</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr><td class="px-4 py-3">Receipt #001</td><td class="px-4 py-3">Hospital Billing</td><td class="px-4 py-3 text-right">₱ 32,500.00</td></tr>
                  <tr><td class="px-4 py-3">Receipt #002</td><td class="px-4 py-3">Professional Fees</td><td class="px-4 py-3 text-right">₱ 8,000.00</td></tr>
                  <tr><td class="px-4 py-3">Receipt #003</td><td class="px-4 py-3">Medicine</td><td class="px-4 py-3 text-right">₱ 3,450.00</td></tr>
                </tbody>
                <tfoot class="bg-slate-50">
                  <tr>
                    <td class="px-4 py-3 font-semibold" colspan="2">Total Amount of Claim</td>
                    <td class="px-4 py-3 text-right font-bold">₱ 43,950.00</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="mt-4 rounded-2xl border p-4">
              <div class="text-xs font-semibold text-slate-600">Assessment Notes</div>
              <p class="mt-2 text-sm text-slate-700">
                Verified eligibility, completeness of mandatory documents, and applied benefit threshold (mock text).
              </p>
            </div>
          </div>
        </div>

        <div class="rounded-2xl border bg-white p-5 space-y-4 shadow-soft">
          <div>
            <div class="text-xs font-semibold text-slate-600">Claim Info</div>
            <div class="mt-2 space-y-2 text-sm">
              <div class="flex justify-between"><span class="text-slate-500">Submitted</span><span>2026-02-05</span></div>
              <div class="flex justify-between"><span class="text-slate-500">Status</span><span class="font-semibold">Approved</span></div>
              <div class="flex justify-between"><span class="text-slate-500">Aging</span><span>19 days</span></div>
              <div class="flex justify-between"><span class="text-slate-500">Overdue</span><span class="text-rose-600 font-semibold">Yes</span></div>
            </div>
          </div>

          <div class="rounded-2xl bg-slate-50 border p-4">
            <div class="text-xs font-semibold text-slate-600">Download/Print</div>
            <p class="mt-2 text-sm text-slate-700" id="dlNote">Locked until HR confirms computation is correct.</p>
            <div class="mt-3 grid grid-cols-2 gap-2">
              <button id="btnPrint" disabled class="px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold opacity-50">
                Print
              </button>
              <button id="btnDownload" disabled class="px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold opacity-50">
                Download
              </button>
            </div>
          </div>

          <div class="rounded-2xl border p-4">
            <div class="text-xs font-semibold text-slate-600">Recomputation Reason</div>
            <select class="mt-2 w-full rounded-xl border px-3 py-2.5 text-sm" id="recomputeReason">
              <option value="">Select…</option>
              <option>Error in computation</option>
              <option>Change in Company Policy</option>
              <option>Others</option>
            </select>
            <textarea class="mt-2 w-full rounded-xl border px-3 py-2.5 text-sm" rows="3" placeholder="Remarks / justification (mock)"></textarea>
            <div class="mt-2 text-xs text-slate-500" id="feeRule">2% applies if reason is not “Error in computation”.</div>
            <button class="mt-3 w-full px-4 py-2.5 rounded-xl border bg-white text-sm font-semibold"
                    onclick="toast('Recomputation requested (mock).')">
              Submit Recomputation Request
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-5 left-1/2 -translate-x-1/2 hidden z-50">
      <div class="rounded-2xl bg-slate-900 text-white px-4 py-3 text-sm shadow-soft" id="toastMsg"></div>
    </div>
  </main>

  <script>
    // ---- Mock data ----
    const claims = [
      {
        id: "CLM-10021",
        dateSubmitted: "2026-02-01",
        agingDays: 23,
        name: "Juan Dela Cruz",
        employment: "Regular",
        claimType: "Personal Claim",
        benefit: "Major Medical",
        status: "Approved",
        total: 43950,
        recomputed: 43950,
        history: [
          "2026-02-01 • Submitted by HR",
          "2026-02-02 • Accepted by Service Provider Admin",
          "2026-02-04 • Reviewing • Assessment started",
          "2026-02-06 • For Checking • Sent to Checker",
          "2026-02-07 • Approved • Analysis sheet uploaded"
        ],
        assessment: "Eligibility verified. Mandatory docs complete. Threshold applied (mock).",
        remarks: "No additional remarks."
      },
      {
        id: "CLM-10022",
        dateSubmitted: "2026-02-10",
        agingDays: 14,
        name: "Maria Santos",
        employment: "Seasonal",
        claimType: "Dependent's Claim",
        benefit: "Basic Medical",
        status: "For Checking",
        total: 12800,
        recomputed: 0,
        history: [
          "2026-02-10 • Submitted by HR",
          "2026-02-11 • Accepted",
          "2026-02-13 • Reviewing",
          "2026-02-16 • For Checking"
        ],
        assessment: "Awaiting checker review (mock).",
        remarks: "Dependent relationship verified (mock)."
      },
      {
        id: "CLM-10023",
        dateSubmitted: "2026-01-25",
        agingDays: 30,
        name: "Pedro Reyes",
        employment: "Regular",
        claimType: "Personal Claim",
        benefit: "Dread Disease",
        status: "Recomputation Requested",
        total: 78000,
        recomputed: 76000,
        history: [
          "2026-01-25 • Submitted",
          "2026-01-26 • Accepted",
          "2026-01-30 • Approved",
          "2026-02-02 • HR requested recomputation • Change in policy"
        ],
        assessment: "Recompute in progress (mock).",
        remarks: "Policy change affecting coverage."
      }
    ];

    // ---- UI Helpers ----
    function peso(n){
      return "₱ " + (n||0).toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});
    }
    function chip(status){
      const base = "inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-xs font-semibold border";
      const dot = (cls) => `<span class="h-2 w-2 rounded-full ${cls}"></span>`;
      const map = {
        "Submitted": { cls: "bg-slate-50 text-slate-700 border-slate-200", dot: "bg-slate-400" },
        "Accepted": { cls: "bg-blue-50 text-blue-700 border-blue-200", dot: "bg-blue-500" },
        "Reviewing": { cls: "bg-amber-50 text-amber-800 border-amber-200", dot: "bg-amber-500" },
        "For Checking": { cls: "bg-indigo-50 text-indigo-700 border-indigo-200", dot: "bg-indigo-500" },
        "Approved": { cls: "bg-emerald-50 text-emerald-700 border-emerald-200", dot: "bg-emerald-500" },
        "HR Review": { cls: "bg-teal-50 text-teal-700 border-teal-200", dot: "bg-teal-500" },
        "Recomputation Requested": { cls: "bg-rose-50 text-rose-700 border-rose-200", dot: "bg-rose-500" },
        "Ready to Download": { cls: "bg-slate-900 text-white border-slate-900", dot: "bg-white" }
      };
      const m = map[status] || { cls:"bg-slate-50 text-slate-700 border-slate-200", dot:"bg-slate-400" };
      return `<span class="${base} ${m.cls}">${dot(m.dot)}${status}</span>`;
    }

    function toast(msg){
      const t = document.getElementById("toast");
      const m = document.getElementById("toastMsg");
      m.textContent = msg;
      t.classList.remove("hidden");
      clearTimeout(window.__toastTimer);
      window.__toastTimer = setTimeout(()=>t.classList.add("hidden"), 2200);
    }

    // ---- Mobile drawer ----
    function toggleMobile(open){
      const el = document.getElementById("mobileOverlay");
      el.classList.toggle("hidden", !open);
      document.body.style.overflow = open ? "hidden" : "";
    }
    window.toggleMobile = toggleMobile;

    // ---- Simple navigation ----
    function go(page){
      ["home","lodge","analysis"].forEach(p=>{
        document.getElementById(`page-${p}`).classList.toggle("hidden", p!==page);
      });

      // desktop nav
      document.querySelectorAll(".navBtn").forEach(btn=>{
        const active = btn.dataset.nav === page;
        btn.className =
          "navBtn px-3 py-2 rounded-xl text-sm font-semibold " +
          (active ? "bg-slate-900 text-white" : "bg-white border hover:bg-slate-50");
      });

      // mobile nav
      document.querySelectorAll(".navBtnMobile").forEach(btn=>{
        const active = btn.dataset.nav === page;
        btn.className =
          "navBtnMobile w-full px-3 py-3 rounded-xl text-left text-sm font-semibold border " +
          (active ? "bg-slate-900 text-white" : "bg-white hover:bg-slate-50");
      });

      toggleMobile(false);
      window.scrollTo({top:0, behavior:"smooth"});
    }
    window.go = go;

    // ---- Render table ----
    function renderClaims(list){
      const tbody = document.getElementById("claimsTbody");
      tbody.innerHTML = "";

      if(!list.length){
        tbody.insertAdjacentHTML("beforeend", `
          <tr>
            <td colspan="10" class="px-4 py-10 text-center text-slate-500">
              No results found.
            </td>
          </tr>
        `);
        return;
      }

      list.forEach(c=>{
        const overdue = c.agingDays > 14;
        tbody.insertAdjacentHTML("beforeend", `
          <tr class="hover:bg-slate-50">
            <td class="px-4 py-3">
              <div class="font-medium">${c.dateSubmitted}</div>
              <div class="text-xs text-slate-500">${c.id}</div>
            </td>
            <td class="px-4 py-3">
              <span class="font-semibold ${overdue?'text-rose-600':''}">${c.agingDays} days</span>
              ${overdue?'<div class="text-xs text-rose-600 font-semibold">OVERDUE</div>':''}
            </td>
            <td class="px-4 py-3 font-semibold">${c.name}</td>
            <td class="px-4 py-3">${c.employment}</td>
            <td class="px-4 py-3">${c.claimType}</td>
            <td class="px-4 py-3">${c.benefit}</td>
            <td class="px-4 py-3">${chip(c.status)}</td>
            <td class="px-4 py-3 text-right font-medium">${peso(c.total)}</td>
            <td class="px-4 py-3 text-right">
              ${c.recomputed ? `<span class="font-medium">${peso(c.recomputed)}</span>` : `<span class="text-slate-400">—</span>`}
            </td>
            <td class="px-4 py-3">
              <div class="flex flex-col sm:flex-row gap-2">
                <button class="px-3 py-2 rounded-xl border bg-white text-xs font-semibold hover:bg-slate-50"
                        onclick="openModal('${c.id}')">
                  Details
                </button>
                <button class="px-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:opacity-95"
                        onclick="toast('Open claim (mock).')">
                  Open
                </button>
              </div>
            </td>
          </tr>
        `);
      });
    }

    // ---- Modal ----
    function openModal(id){
      const c = claims.find(x=>x.id===id);
      if(!c) return;
      document.getElementById("modalTitle").textContent = `${c.id} • ${c.name}`;
      document.getElementById("modalSubtitle").textContent = `${c.benefit} • ${c.claimType} • Status: ${c.status}`;
      document.getElementById("modalHistory").innerHTML =
        c.history.map(h=>`<li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-slate-400"></span><span>${h}</span></li>`).join("");
      document.getElementById("modalAssessment").textContent = c.assessment;
      document.getElementById("modalRemarks").textContent = c.remarks;
      const modal = document.getElementById("claimModal");
      modal.classList.remove("hidden");
      modal.classList.add("flex");
      document.body.style.overflow = "hidden";
    }
    function closeModal(){
      const m = document.getElementById("claimModal");
      m.classList.add("hidden");
      m.classList.remove("flex");
      document.body.style.overflow = "";
    }
    window.openModal = openModal;
    window.closeModal = closeModal;

    document.getElementById("claimModal").addEventListener("click", (e)=>{
      if(e.target.id==="claimModal") closeModal();
    });
    document.addEventListener("keydown", (e)=>{
      if(e.key === "Escape"){
        const m = document.getElementById("claimModal");
        if(!m.classList.contains("hidden")) closeModal();
        const mo = document.getElementById("mobileOverlay");
        if(!mo.classList.contains("hidden")) toggleMobile(false);
      }
    });

    // ---- Filters ----
    function applyFilters(){
      const q = document.getElementById("searchInput").value.trim().toLowerCase();
      const st = document.getElementById("statusFilter").value;
      const bf = document.getElementById("benefitFilter").value;

      const filtered = claims.filter(c=>{
        const hay = `${c.name} ${c.claimType} ${c.benefit} ${c.status} ${c.employment} ${c.id}`.toLowerCase();
        const okQ = !q || hay.includes(q);
        const okS = !st || c.status===st;
        const okB = !bf || c.benefit===bf;
        return okQ && okS && okB;
      });
      renderClaims(filtered);
    }
    document.getElementById("applyFilters").addEventListener("click", applyFilters);
    document.getElementById("clearFilters").addEventListener("click", ()=>{
      document.getElementById("searchInput").value = "";
      document.getElementById("statusFilter").value = "";
      document.getElementById("benefitFilter").value = "";
      renderClaims(claims);
    });

    // Live search (nice UX)
    document.getElementById("searchInput").addEventListener("input", ()=>{
      // lightweight debounce
      clearTimeout(window.__searchTimer);
      window.__searchTimer = setTimeout(applyFilters, 150);
    });

    // ---- Dependent toggle + rules ----
    const dependentBox = document.getElementById("dependentBox");
    document.querySelectorAll("input[name='claimType']").forEach(r=>{
      r.addEventListener("change", ()=>{
        const show = (r.value==="Dependent's Claim" && r.checked);
        dependentBox.classList.toggle("hidden", !show);
      });
    });
    document.getElementById("depRel").addEventListener("change", ()=>{
      const rel = document.getElementById("depRel").value;
      document.getElementById("depRule").textContent =
        rel==="Children" ? "Accepted If children: 14–21 years old only" : "Accepted If spouse/parent: 18–65 years old only";
    });

    // ---- Form submit validations (front-end only) ----
    function yearsBetween(dateStr){
      const d = new Date(dateStr);
      const now = new Date();
      let age = now.getFullYear() - d.getFullYear();
      const m = now.getMonth() - d.getMonth();
      if (m < 0 || (m===0 && now.getDate() < d.getDate())) age--;
      return age;
    }

    document.getElementById("claimForm").addEventListener("submit", (e)=>{
      e.preventDefault();
      const fd = new FormData(e.target);

      // Employee age rule 18–65
      const dob = fd.get("dob");
      if(dob){
        const age = yearsBetween(dob);
        if(age < 18 || age > 65){
          toast("Employee DOB invalid: accepted 18–65 only.");
          return;
        }
      }

      // Dependent rules if dependent claim
      const claimType = fd.get("claimType");
      if(claimType === "Dependent's Claim"){
        const rel = fd.get("depRel");
        const depDob = fd.get("depDob");
        if(!rel || !depDob){
          toast("Dependent details required.");
          return;
        }
        const a = yearsBetween(depDob);
        if(rel === "Children"){
          if(a < 14 || a > 21){ toast("Dependent child DOB invalid: 14–21 only."); return; }
        } else {
          if(a < 18 || a > 65){ toast("Dependent spouse/parent DOB invalid: 18–65 only."); return; }
        }
      }

      toast("Submitted (mock). In real system: send emails + lock edits for 24h.");
      go("home");
    });

    // ---- Analysis viewer protections (UX only) ----
    document.addEventListener("contextmenu", (e)=>{
      const canvas = document.getElementById("analysisCanvas");
      if(canvas && canvas.contains(e.target)){
        e.preventDefault();
        toast("Right-click disabled (mock).");
      }
    });

    // Watermark text
    function updateWatermark(){
      const email = document.getElementById("mockEmail")?.textContent || "user@example.com";
      const ts = new Date().toLocaleString();
      document.getElementById("wmText").textContent = `CONFIDENTIAL\n${email}\n${ts}`;
    }
    setInterval(updateWatermark, 5000);
    updateWatermark();

    // Unlock download/print after confirmation
    function unlockDownload(){
      const btnPrint = document.getElementById("btnPrint");
      const btnDownload = document.getElementById("btnDownload");
      btnPrint.disabled = false;
      btnDownload.disabled = false;
      btnPrint.classList.remove("opacity-50");
      btnDownload.classList.remove("opacity-50");
      document.getElementById("dlNote").textContent = "Unlocked: You may now print/download (mock).";
      document.getElementById("viewMode").textContent = "UNLOCKED";
      toast("Unlocked (mock).");
    }
    window.unlockDownload = unlockDownload;

    // ---- Web component: upload-field ----
    class UploadField extends HTMLElement {
      connectedCallback(){
        const label = this.getAttribute("label") || "Upload";
        const req = this.hasAttribute("required");
        this.innerHTML = `
          <div class="rounded-2xl border p-4 hover:bg-slate-50">
            <div class="flex items-start justify-between gap-3">
              <div>
                <div class="text-sm font-semibold">
                  ${label} ${req?'<span class="text-rose-600">*</span>':''}
                </div>
                <div class="text-xs text-slate-500">${req?'Mandatory':'Optional'}</div>
              </div>
              <div class="h-9 w-9 rounded-xl bg-slate-50 border grid place-items-center shrink-0">
                <i class="fa-solid fa-paperclip text-slate-700"></i>
              </div>
            </div>
            <input ${req?'required':''} type="file"
                   class="mt-3 w-full rounded-xl border px-3 py-2.5 text-sm bg-white"/>
          </div>
        `;
      }
    }
    customElements.define("upload-field", UploadField);

    // ---- Init ----
    renderClaims(claims);

    // Summaries
    const overdueCount = claims.filter(c=>c.agingDays>14).length;
    document.getElementById("sumOverdue").textContent = overdueCount;
    document.getElementById("sumTotal").textContent = claims.length;
    document.getElementById("sumChecking").textContent = claims.filter(c=>c.status==="For Checking").length;
    document.getElementById("sumReady").textContent = claims.filter(c=>c.status==="Approved").length;

    // nav buttons (desktop)
    document.querySelectorAll(".navBtn").forEach(btn=>{
      btn.addEventListener("click", ()=>go(btn.dataset.nav));
    });
    // nav buttons (mobile)
    document.querySelectorAll(".navBtnMobile").forEach(btn=>{
      btn.addEventListener("click", ()=>go(btn.dataset.nav));
    });

    // keep mobile profile in sync
    document.getElementById("mockUserMobile").textContent = document.getElementById("mockUser").textContent;
    document.getElementById("mockEmailMobile").textContent = document.getElementById("mockEmail").textContent;
  </script>
</body>
</html>