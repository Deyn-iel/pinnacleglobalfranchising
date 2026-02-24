<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Service Provider Admin Dashboard (UI Mock)</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/admin/app.css'])
  <style>
    .no-select { user-select: none; -webkit-user-select: none; }
    .drawer-backdrop { background: rgba(0,0,0,.40); }
  </style>
</head>
@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')
<body class="bg-slate-50 text-slate-900">
  <!-- Topbar -->
  <header class="sticky top-0 z-40 border-b bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between gap-3">
      <div class="flex items-center gap-3">
        <div class="h-9 w-9 rounded-xl bg-slate-900 text-white grid place-items-center font-bold">SP</div>
        <div>
          <div class="font-semibold leading-tight">Service Provider Admin</div>
          <div class="text-xs text-slate-500 leading-tight">Claims Processing + Billing Dashboard • UI Mock</div>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <button id="navInbox" class="px-3 py-2 rounded-lg text-sm font-medium bg-slate-900 text-white" onclick="go('inbox')">Inbox</button>
        <button id="navBilling" class="px-3 py-2 rounded-lg text-sm font-medium bg-white border" onclick="go('billing')">Billing</button>
        <button class="px-3 py-2 rounded-lg text-sm font-medium bg-white border" onclick="toast('User management is mock-only.')">Users</button>
        <button class="px-3 py-2 rounded-lg text-sm font-medium bg-white border" onclick="toast('Config/thresholds are backend in real system.')">Config</button>
      </div>

      <div class="flex items-center gap-2">
        <div class="text-sm text-right hidden md:block">
          <div class="font-semibold" id="adminName">Admin - Service Provider</div>
          <div class="text-xs text-slate-500" id="adminEmail">admin.provider@example.com</div>
        </div>
        <div class="h-9 w-9 rounded-full bg-slate-200 grid place-items-center font-semibold">A</div>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-7xl px-4 py-6 space-y-6">

    <!-- ===================== INBOX PAGE ===================== -->
    <section id="page-inbox" class="space-y-6">

      <!-- KPIs -->
      <section class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="rounded-2xl border bg-white p-4">
          <div class="text-sm text-slate-500">Total Open</div>
          <div class="text-2xl font-bold mt-1" id="kpiOpen">0</div>
          <div class="text-xs text-slate-500 mt-1">All non-closed statuses</div>
        </div>
        <div class="rounded-2xl border bg-white p-4">
          <div class="text-sm text-slate-500">Submitted</div>
          <div class="text-2xl font-bold mt-1" id="kpiSubmitted">0</div>
          <div class="text-xs text-slate-500 mt-1">Needs acceptance</div>
        </div>
        <div class="rounded-2xl border bg-white p-4">
          <div class="text-sm text-slate-500">Reviewing</div>
          <div class="text-2xl font-bold mt-1" id="kpiReviewing">0</div>
          <div class="text-xs text-slate-500 mt-1">Assessment in progress</div>
        </div>
        <div class="rounded-2xl border bg-white p-4">
          <div class="text-sm text-slate-500">For Checking</div>
          <div class="text-2xl font-bold mt-1" id="kpiChecking">0</div>
          <div class="text-xs text-slate-500 mt-1">Sent to checker</div>
        </div>
        <div class="rounded-2xl border bg-white p-4">
          <div class="text-sm text-slate-500">Overdue</div>
          <div class="text-2xl font-bold mt-1 text-rose-600" id="kpiOverdue">0</div>
          <div class="text-xs text-slate-500 mt-1">Aging > 14 days</div>
        </div>
      </section>

      <!-- Filters -->
      <section class="rounded-2xl border bg-white p-4">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-3">
          <div class="md:col-span-2">
            <label class="text-xs font-semibold text-slate-600">Search</label>
            <input id="q" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm" placeholder="Claim ID, employee, company, benefit..." />
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Status</label>
            <select id="fStatus" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
              <option value="">All</option>
              <option>Submitted</option>
              <option>Accepted</option>
              <option>Reviewing</option>
              <option>For Checking</option>
              <option>Checker Returned</option>
              <option>Approved</option>
              <option>Ready to Download</option>
              <option>Recomputation Requested</option>
            </select>
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Company</label>
            <select id="fCompany" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
              <option value="">All</option>
              <option>Universal Leaf of the Philippines</option>
              <option>Pinnacle Client A</option>
            </select>
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Benefit</label>
            <select id="fBenefit" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
              <option value="">All</option>
              <option>Basic Medical</option>
              <option>Major Medical</option>
              <option>Dread Disease</option>
            </select>
          </div>
          <div class="flex items-end gap-2">
            <button id="btnApply" class="w-full px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold">Apply</button>
            <button id="btnClear" class="w-full px-4 py-2 rounded-xl border bg-white text-sm font-semibold">Clear</button>
          </div>
        </div>
      </section>

      <!-- Main grid -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Queue -->
        <div class="lg:col-span-2 rounded-2xl border bg-white overflow-hidden">
          <div class="p-4 flex items-center justify-between">
            <div>
              <div class="font-semibold">Claims Queue</div>
              <div class="text-xs text-slate-500">Open a claim to review documents, assessment, and upload analysis sheet.</div>
            </div>
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="toast('Bulk actions are mock-only.')">
              Bulk Actions
            </button>
          </div>

          <div class="overflow-auto">
            <table class="min-w-[980px] w-full text-sm">
              <thead class="bg-slate-50 text-slate-600">
                <tr>
                  <th class="text-left px-4 py-3 font-semibold">Claim</th>
                  <th class="text-left px-4 py-3 font-semibold">Company</th>
                  <th class="text-left px-4 py-3 font-semibold">Employee</th>
                  <th class="text-left px-4 py-3 font-semibold">Benefit</th>
                  <th class="text-left px-4 py-3 font-semibold">Status</th>
                  <th class="text-left px-4 py-3 font-semibold">Aging</th>
                  <th class="text-left px-4 py-3 font-semibold">Actions</th>
                </tr>
              </thead>
              <tbody id="tbody" class="divide-y"></tbody>
            </table>
          </div>
        </div>

        <!-- Right panel -->
        <aside class="rounded-2xl border bg-white p-5 space-y-4">
          <div class="font-semibold">Processing Guide</div>
          <div class="text-sm text-slate-700 space-y-2">
            <p><span class="font-semibold">Submitted → Accepted</span> once documents are present.</p>
            <p><span class="font-semibold">Accepted → Reviewing</span> start assessment tool / questionnaire.</p>
            <p><span class="font-semibold">Reviewing → For Checking</span> upload analysis sheet then send to checker.</p>
            <p><span class="font-semibold">Checker Returned</span> revise computation and re-submit for checking.</p>
            <p><span class="font-semibold">Recomputation Requested</span> create 2nd / 3rd analysis sheet version.</p>
          </div>

          <div class="rounded-2xl bg-slate-50 border p-4">
            <div class="text-xs font-semibold text-slate-600">Aging Rule</div>
            <div class="mt-2 text-sm text-slate-700">Beyond <b>14 days</b> = overdue (red).</div>
          </div>

          <div class="rounded-2xl bg-amber-50 border border-amber-200 p-4">
            <div class="text-xs font-semibold text-amber-900">Billing Note</div>
            <div class="mt-2 text-sm text-amber-900">
              Billing auto-compute (mock) includes <b>Approved / Ready to Download</b> claims only.
              Recomputation fee: <b>2%</b> if reason ≠ “Error in computation”.
            </div>
          </div>

          <button class="w-full px-4 py-3 rounded-xl bg-slate-900 text-white text-sm font-semibold" onclick="go('billing')">
            Go to Billing
          </button>
        </aside>
      </section>
    </section>

    <!-- ===================== BILLING PAGE ===================== -->
    <section id="page-billing" class="space-y-6 hidden">
      <div class="rounded-2xl border bg-white p-5">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <h1 class="text-xl md:text-2xl font-bold">Billing • Statement of Account (UI Mock)</h1>
            <p class="text-sm text-slate-600 mt-1">
              Auto-compute totals from eligible claims (mock). In real system: scheduled auto-generation every 1st of month & quarter.
            </p>
          </div>
          <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="toast('Email send is backend-only.')">Send SOA Email</button>
            <button class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold" onclick="toast('Export PDF is backend-only.')">Export SOA</button>
          </div>
        </div>
      </div>

      <!-- Billing filters -->
      <div class="rounded-2xl border bg-white p-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
          <div class="md:col-span-2">
            <label class="text-xs font-semibold text-slate-600">Company</label>
            <select id="billCompany" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm"></select>
          </div>

          <div>
            <label class="text-xs font-semibold text-slate-600">Period</label>
            <select id="billPeriod" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
              <option value="monthly">Monthly</option>
              <option value="quarterly">Quarterly</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-semibold text-slate-600">Month / Quarter Anchor</label>
            <input id="billAnchor" type="month" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm" />
            <div class="text-xs text-slate-500 mt-1">For quarterly, month chooses the quarter.</div>
          </div>

          <div class="flex items-end gap-2">
            <button class="w-full px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold" onclick="renderSOA()">Generate</button>
            <button class="w-full px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="resetBilling()">Reset</button>
          </div>
        </div>
      </div>

      <!-- SOA Overview -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 rounded-2xl border bg-white overflow-hidden">
          <div class="p-4 border-b flex items-center justify-between">
            <div>
              <div class="font-semibold">SOA Line Items</div>
              <div class="text-xs text-slate-500" id="soaSubtitle">—</div>
            </div>
            <div class="text-xs px-2 py-1 rounded-lg bg-slate-100 border" id="soaWindow">—</div>
          </div>

          <div class="overflow-auto">
            <table class="min-w-[980px] w-full text-sm">
              <thead class="bg-slate-50 text-slate-600">
                <tr>
                  <th class="text-left px-4 py-3 font-semibold">Claim ID</th>
                  <th class="text-left px-4 py-3 font-semibold">Employee</th>
                  <th class="text-left px-4 py-3 font-semibold">Benefit</th>
                  <th class="text-left px-4 py-3 font-semibold">Status</th>
                  <th class="text-right px-4 py-3 font-semibold">Claim Amount</th>
                  <th class="text-right px-4 py-3 font-semibold">Recomp Fee</th>
                  <th class="text-right px-4 py-3 font-semibold">Line Total</th>
                </tr>
              </thead>
              <tbody id="soaTbody" class="divide-y"></tbody>
            </table>
          </div>

          <div class="p-4 border-t bg-slate-50">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
              <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-slate-500">Claims Total</div>
                <div class="text-xl font-bold mt-1" id="soaClaimsTotal">₱ 0.00</div>
              </div>
              <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-slate-500">Recomputation Fees</div>
                <div class="text-xl font-bold mt-1" id="soaFeesTotal">₱ 0.00</div>
              </div>
              <div class="rounded-2xl border bg-white p-4">
                <div class="text-xs text-slate-500">Grand Total</div>
                <div class="text-xl font-bold mt-1" id="soaGrandTotal">₱ 0.00</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payments / Balance -->
        <aside class="rounded-2xl border bg-white p-5 space-y-4">
          <div class="font-semibold">Payments & Balance</div>

          <div class="rounded-2xl bg-slate-50 border p-4">
            <div class="text-xs font-semibold text-slate-600">Previous Balance</div>
            <div class="text-lg font-bold mt-1" id="prevBal">₱ 0.00</div>
            <div class="text-xs text-slate-500 mt-1">Mock only (in real: carried from last SOA)</div>
          </div>

          <div class="rounded-2xl border p-4">
            <div class="text-xs font-semibold text-slate-600">Total Payments</div>
            <div class="text-lg font-bold mt-1" id="payTotal">₱ 0.00</div>
            <div class="mt-3">
              <label class="text-xs font-semibold text-slate-600">Upload Proof of Payment</label>
              <input type="file" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm bg-white" />
              <button class="mt-2 w-full px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="mockAddPayment()">
                Add Payment (mock)
              </button>
            </div>
          </div>

          <div class="rounded-2xl border p-4">
            <div class="text-xs font-semibold text-slate-600">Outstanding Balance</div>
            <div class="text-2xl font-black mt-1" id="outBal">₱ 0.00</div>
            <div class="text-xs text-slate-500 mt-1">Outstanding = PrevBal + SOA Grand Total - Payments</div>
          </div>

          <div class="rounded-2xl border p-4">
            <div class="text-xs font-semibold text-slate-600">Payment History</div>
            <ul class="mt-2 space-y-2 text-sm text-slate-700" id="payHistory"></ul>
          </div>

          <div class="rounded-2xl bg-amber-50 border border-amber-200 p-4">
            <div class="text-xs font-semibold text-amber-900">Auto-Compute Rule</div>
            <div class="mt-2 text-sm text-amber-900">
              Recomputation fee is <b>2%</b> only if reason is <b>Change in Company Policy</b> or <b>Others</b>.
              If <b>Error in computation</b> → 0%.
            </div>
          </div>
        </aside>
      </div>
    </section>
  </main>

  <!-- Drawer (Claims Detail) -->
  <div id="drawerWrap" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 drawer-backdrop" onclick="closeDrawer()"></div>
    <div class="absolute right-0 top-0 h-full w-full max-w-2xl bg-white border-l shadow-2xl overflow-auto">
      <div class="p-5 border-b flex items-start justify-between gap-3">
        <div>
          <div class="text-xs text-slate-500">Claim Detail</div>
          <div class="text-xl font-bold" id="dTitle">—</div>
          <div class="text-sm text-slate-600 mt-1" id="dSub">—</div>
        </div>
        <button class="px-3 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="closeDrawer()">Close</button>
      </div>

      <div class="p-5 space-y-5">
        <!-- Status + actions -->
        <div class="rounded-2xl border p-4">
          <div class="flex items-center justify-between gap-3">
            <div>
              <div class="text-xs font-semibold text-slate-600">Current Status</div>
              <div class="mt-1" id="dStatusChip"></div>
            </div>
            <div class="text-right">
              <div class="text-xs font-semibold text-slate-600">Aging</div>
              <div class="mt-1 text-sm font-semibold" id="dAging">—</div>
            </div>
          </div>

          <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-2">
            <button class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold" onclick="act('accept')">Accept</button>
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="act('review')">Move to Reviewing</button>
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="act('send')">Send to Checker</button>
          </div>

          <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="act('revise')">Mark as Needs Revision</button>
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="toast('Email notification is backend-only.')">Send Email Notification</button>
          </div>

          <div class="mt-3 text-xs text-slate-500">
            Buttons are UI-only in this mock. Backend will enforce allowed transitions.
          </div>
        </div>

        <!-- Document checklist -->
        <div class="rounded-2xl border p-4">
          <div class="flex items-center justify-between">
            <div class="font-semibold">Documents Checklist</div>
            <button class="px-3 py-2 rounded-xl border bg-white text-xs font-semibold" onclick="toast('Document viewer is mock-only.')">Open Files</button>
          </div>
          <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3" id="docList"></div>
        </div>

        <!-- Assessment tool -->
        <div class="rounded-2xl border p-4">
          <div class="font-semibold">Assessment Tool / Questionnaire</div>
          <div class="text-sm text-slate-600 mt-1">Follow your “Analysis Sheet” format in real system.</div>

          <div class="mt-4 space-y-3">
            <div>
              <label class="text-xs font-semibold text-slate-600">Eligibility Checked</label>
              <select class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-semibold text-slate-600">Mandatory Docs Complete</label>
              <select class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-semibold text-slate-600">Notes</label>
              <textarea class="mt-1 w-full rounded-xl border px-3 py-2 text-sm" rows="3" placeholder="Write assessment notes (mock)"></textarea>
            </div>
            <button class="w-full px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="toast('Assessment saved (mock).')">
              Save Assessment
            </button>
          </div>
        </div>

        <!-- Analysis sheet upload + versioning -->
        <div class="rounded-2xl border p-4">
          <div class="flex items-center justify-between gap-3">
            <div>
              <div class="font-semibold">Analysis Sheet</div>
              <div class="text-sm text-slate-600">Upload computation sheet version (mock).</div>
            </div>
            <div class="text-xs px-2 py-1 rounded-lg bg-slate-100 border" id="verBadge">Version: —</div>
          </div>

          <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
              <label class="text-xs font-semibold text-slate-600">Version</label>
              <select id="verSelect" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm">
                <option value="1">1st Analysis Sheet</option>
                <option value="2">2nd Analysis Sheet</option>
                <option value="3">3rd Analysis Sheet</option>
                <option value="4">4th Analysis Sheet</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label class="text-xs font-semibold text-slate-600">Attach File</label>
              <input type="file" class="mt-1 w-full rounded-xl border px-3 py-2 text-sm bg-white"/>
            </div>
          </div>

          <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-2">
            <button class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold" onclick="toast('Analysis uploaded (mock).')">
              Upload Analysis
            </button>
            <button class="px-4 py-2 rounded-xl border bg-white text-sm font-semibold" onclick="toast('Submitted for checking (mock).')">
              Submit for Checking
            </button>
          </div>

          <div class="mt-3 rounded-2xl bg-slate-50 border p-4">
            <div class="text-xs font-semibold text-slate-600">Recomputation Rule Reminder</div>
            <div class="mt-1 text-sm text-slate-700">
              If reason is <b>Error in computation</b> → no 2% charge. Otherwise → 2% applies (backend).
            </div>
          </div>
        </div>

        <!-- Timeline -->
        <div class="rounded-2xl border p-4">
          <div class="font-semibold">History Timeline</div>
          <ul class="mt-3 space-y-2 text-sm text-slate-700" id="history"></ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="toast" class="fixed bottom-5 left-1/2 -translate-x-1/2 hidden z-50">
    <div class="rounded-2xl bg-slate-900 text-white px-4 py-3 text-sm shadow-xl" id="toastMsg"></div>
  </div>

  <script>
    // ===================== MOCK DATA =====================
    // NOTE: Added amounts, approval dates, and recomputation reasons for billing auto-compute
    const claims = [
      {
        id: "CLM-20031",
        dateSubmitted: "2026-02-02",
        agingDays: 22,
        company: "Universal Leaf of the Philippines",
        employee: "Juan Dela Cruz",
        benefit: "Major Medical",
        status: "Approved",
        approvedAt: "2026-02-07",
        claimAmount: 43950,
        isRecomputed: false,
        recomputationReason: null, // "Error in computation" | "Change in Company Policy" | "Others"
        docs: {
          "Policy Data Page (mandatory)": true,
          "Claim Form (mandatory)": true,
          "PhilHealth Deduction Statement (mandatory)": true,
          "Attending Physician Statement (mandatory)": true,
          "HR Endorsement": true,
          "SOA (itemized)": true,
          "Official Receipts": true,
          "Medical Abstract": false,
          "Surgical Report (if applicable)": false,
          "Doctor's Prescription": true
        },
        version: 1,
        history: [
          "2026-02-02 • Submitted by HR",
          "2026-02-03 • Accepted by Admin",
          "2026-02-05 • Reviewing • Assessment started",
          "2026-02-07 • Approved • Analysis sheet uploaded"
        ]
      },
      {
        id: "CLM-20032",
        dateSubmitted: "2026-02-12",
        agingDays: 12,
        company: "Universal Leaf of the Philippines",
        employee: "Maria Santos",
        benefit: "Basic Medical",
        status: "Submitted",
        approvedAt: null,
        claimAmount: 12800,
        isRecomputed: false,
        recomputationReason: null,
        docs: {
          "Policy Data Page (mandatory)": true,
          "Claim Form (mandatory)": false,
          "PhilHealth Deduction Statement (mandatory)": true,
          "Attending Physician Statement (mandatory)": false,
          "HR Endorsement": false,
          "SOA (itemized)": false,
          "Official Receipts": false,
          "Medical Abstract": false,
          "Doctor's Prescription": false
        },
        version: 0,
        history: ["2026-02-12 • Submitted by HR"]
      },
      {
        id: "CLM-20033",
        dateSubmitted: "2026-01-27",
        agingDays: 28,
        company: "Pinnacle Client A",
        employee: "Pedro Reyes",
        benefit: "Dread Disease",
        status: "Ready to Download",
        approvedAt: "2026-02-01",
        claimAmount: 76000,
        isRecomputed: true,
        recomputationReason: "Change in Company Policy", // triggers 2% fee
        docs: {
          "Policy Data Page (mandatory)": true,
          "Claim Form (mandatory)": true,
          "PhilHealth Deduction Statement (mandatory)": true,
          "Attending Physician Statement (mandatory)": true,
          "HR Endorsement": true,
          "SOA (itemized)": true,
          "Official Receipts": true,
          "Medical Abstract": true,
          "Doctor's Prescription": true
        },
        version: 2,
        history: [
          "2026-01-27 • Submitted by HR",
          "2026-01-28 • Accepted by Admin",
          "2026-02-01 • Approved by Checker",
          "2026-02-03 • HR requested recomputation • Change in policy",
          "2026-02-04 • Revised Analysis #2 uploaded"
        ]
      },
      {
        id: "CLM-20034",
        dateSubmitted: "2026-02-08",
        agingDays: 16,
        company: "Universal Leaf of the Philippines",
        employee: "Liza Gomez",
        benefit: "Major Medical",
        status: "For Checking",
        approvedAt: null,
        claimAmount: 32500,
        isRecomputed: false,
        recomputationReason: null,
        docs: {
          "Policy Data Page (mandatory)": true,
          "Claim Form (mandatory)": true,
          "PhilHealth Deduction Statement (mandatory)": true,
          "Attending Physician Statement (mandatory)": true,
          "HR Endorsement": true,
          "SOA (itemized)": true,
          "Official Receipts": true,
          "Medical Abstract": true,
          "Doctor's Prescription": true
        },
        version: 1,
        history: [
          "2026-02-08 • Submitted by HR",
          "2026-02-09 • Accepted by Admin",
          "2026-02-10 • Reviewing",
          "2026-02-12 • For Checking • Sent to checker"
        ]
      }
    ];

    // Mock payments per company (UI-only)
    const payments = [
      { company: "Universal Leaf of the Philippines", date: "2026-02-10", amount: 15000, ref: "OR-001 (mock)" },
      { company: "Pinnacle Client A", date: "2026-02-15", amount: 20000, ref: "OR-002 (mock)" },
    ];

    // Mock previous balance per company (UI-only)
    const prevBalances = {
      "Universal Leaf of the Philippines": 5000,
      "Pinnacle Client A": 12000
    };

    // ===================== HELPERS =====================
    function peso(n){
      return "₱ " + (Number(n||0)).toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});
    }
    function chip(status){
      const base = "inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border";
      const map = {
        "Submitted":"bg-slate-50 text-slate-700 border-slate-200",
        "Accepted":"bg-blue-50 text-blue-700 border-blue-200",
        "Reviewing":"bg-amber-50 text-amber-800 border-amber-200",
        "For Checking":"bg-indigo-50 text-indigo-700 border-indigo-200",
        "Checker Returned":"bg-rose-50 text-rose-700 border-rose-200",
        "Approved":"bg-emerald-50 text-emerald-700 border-emerald-200",
        "Ready to Download":"bg-slate-900 text-white border-slate-900",
        "Recomputation Requested":"bg-rose-50 text-rose-700 border-rose-200"
      };
      return `<span class="${base} ${map[status]||'bg-slate-50 text-slate-700 border-slate-200'}">${status}</span>`;
    }
    function toast(msg){
      const t = document.getElementById("toast");
      const m = document.getElementById("toastMsg");
      m.textContent = msg;
      t.classList.remove("hidden");
      setTimeout(()=>t.classList.add("hidden"), 2200);
    }
    function parseDate(d){ return d ? new Date(d+"T00:00:00") : null; }

    function quarterOf(monthIndex){ // 0-based
      return Math.floor(monthIndex / 3) + 1;
    }
    function quarterRangeFromAnchor(yyyy, mm1to12){
      const mIndex = mm1to12 - 1;
      const q = quarterOf(mIndex);
      const startMonth = (q-1)*3; // 0-based
      const endMonth = startMonth + 2;
      const start = new Date(Date.UTC(yyyy, startMonth, 1));
      const end = new Date(Date.UTC(yyyy, endMonth+1, 0)); // last day of endMonth
      return { q, start, end };
    }
    function monthRange(yyyy, mm1to12){
      const start = new Date(Date.UTC(yyyy, mm1to12-1, 1));
      const end = new Date(Date.UTC(yyyy, mm1to12, 0));
      return { start, end };
    }

    // ===================== NAV =====================
    function go(page){
      ["inbox","billing"].forEach(p=>{
        document.getElementById(`page-${p}`).classList.toggle("hidden", p!==page);
      });
      document.getElementById("navInbox").className =
        "px-3 py-2 rounded-lg text-sm font-medium " + (page==="inbox" ? "bg-slate-900 text-white" : "bg-white border");
      document.getElementById("navBilling").className =
        "px-3 py-2 rounded-lg text-sm font-medium " + (page==="billing" ? "bg-slate-900 text-white" : "bg-white border");
      window.scrollTo({top:0, behavior:"smooth"});
    }

    // ===================== INBOX RENDER =====================
    function render(list){
      const tbody = document.getElementById("tbody");
      tbody.innerHTML = "";
      list.forEach(c=>{
        const overdue = c.agingDays > 14;
        tbody.insertAdjacentHTML("beforeend", `
          <tr class="hover:bg-slate-50">
            <td class="px-4 py-3">
              <div class="font-semibold">${c.id}</div>
              <div class="text-xs text-slate-500">Submitted: ${c.dateSubmitted}</div>
            </td>
            <td class="px-4 py-3">${c.company}</td>
            <td class="px-4 py-3 font-semibold">${c.employee}</td>
            <td class="px-4 py-3">${c.benefit}</td>
            <td class="px-4 py-3">${chip(c.status)}</td>
            <td class="px-4 py-3">
              <span class="font-semibold ${overdue?'text-rose-600':''}">${c.agingDays} days</span>
              ${overdue?`<div class="text-xs text-rose-600 font-semibold">OVERDUE</div>`:""}
            </td>
            <td class="px-4 py-3">
              <div class="flex gap-2">
                <button class="px-3 py-2 rounded-xl border bg-white text-xs font-semibold" onclick="openDrawer('${c.id}')">Open</button>
                <button class="px-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold" onclick="toast('Assigning is mock-only.')">Assign</button>
              </div>
            </td>
          </tr>
        `);
      });
      updateKPIs();
    }

    function updateKPIs(){
      const open = claims.length;
      const submitted = claims.filter(x=>x.status==="Submitted").length;
      const reviewing = claims.filter(x=>x.status==="Reviewing").length;
      const checking = claims.filter(x=>x.status==="For Checking").length;
      const overdue = claims.filter(x=>x.agingDays>14).length;
      document.getElementById("kpiOpen").textContent = open;
      document.getElementById("kpiSubmitted").textContent = submitted;
      document.getElementById("kpiReviewing").textContent = reviewing;
      document.getElementById("kpiChecking").textContent = checking;
      document.getElementById("kpiOverdue").textContent = overdue;
    }

    // ===================== DRAWER =====================
    let current = null;
    function openDrawer(id){
      current = claims.find(x=>x.id===id);
      document.getElementById("dTitle").textContent = `${current.id} • ${current.employee}`;
      document.getElementById("dSub").textContent = `${current.company} • ${current.benefit} • Submitted: ${current.dateSubmitted}`;
      document.getElementById("dStatusChip").innerHTML = chip(current.status);
      document.getElementById("dAging").textContent = `${current.agingDays} days${current.agingDays>14 ? " • OVERDUE" : ""}`;

      // docs
      const docList = document.getElementById("docList");
      docList.innerHTML = "";
      Object.entries(current.docs).forEach(([k,v])=>{
        docList.insertAdjacentHTML("beforeend", `
          <div class="rounded-2xl border p-3 flex items-start justify-between gap-2">
            <div>
              <div class="text-sm font-semibold">${k}</div>
              <div class="text-xs text-slate-500">${v ? "Provided" : "Missing"}</div>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-lg border ${v ? "bg-emerald-50 text-emerald-700 border-emerald-200":"bg-rose-50 text-rose-700 border-rose-200"}">
              ${v ? "OK" : "REQ"}
            </span>
          </div>
        `);
      });

      // history
      document.getElementById("history").innerHTML = current.history.map(h=>
        `<li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-slate-400"></span><span>${h}</span></li>`
      ).join("");

      // version badge
      const v = current.version || 0;
      document.getElementById("verBadge").textContent = `Version: ${v ? "#" + v : "—"}`;
      document.getElementById("verSelect").value = String(Math.max(1, v || 1));

      document.getElementById("drawerWrap").classList.remove("hidden");
    }
    function closeDrawer(){
      document.getElementById("drawerWrap").classList.add("hidden");
      current = null;
    }

    function act(type){
      if(!current) return;
      const old = current.status;

      if(type==="accept"){
        current.status = "Accepted";
        current.history.push(`${today()} • Accepted by Admin (mock)`);
      }
      if(type==="review"){
        current.status = "Reviewing";
        current.history.push(`${today()} • Reviewing • Assessment started (mock)`);
      }
      if(type==="send"){
        current.status = "For Checking";
        current.history.push(`${today()} • For Checking • Sent to checker (mock)`);
      }
      if(type==="revise"){
        current.status = "Checker Returned";
        current.history.push(`${today()} • Checker Returned • Needs revision (mock)`);
      }

      toast(`Status: ${old} → ${current.status} (mock)`);
      openDrawer(current.id);
      applyFilters();
    }

    function today(){
      const d = new Date();
      const yyyy = d.getFullYear();
      const mm = String(d.getMonth()+1).padStart(2,"0");
      const dd = String(d.getDate()).padStart(2,"0");
      return `${yyyy}-${mm}-${dd}`;
    }

    // ===================== INBOX FILTERS =====================
    function applyFilters(){
      const q = document.getElementById("q").value.trim().toLowerCase();
      const fs = document.getElementById("fStatus").value;
      const fc = document.getElementById("fCompany").value;
      const fb = document.getElementById("fBenefit").value;

      const filtered = claims.filter(c=>{
        const hay = `${c.id} ${c.employee} ${c.company} ${c.benefit} ${c.status}`.toLowerCase();
        const okQ = !q || hay.includes(q);
        const okS = !fs || c.status === fs;
        const okC = !fc || c.company === fc;
        const okB = !fb || c.benefit === fb;
        return okQ && okS && okC && okB;
      });
      render(filtered);
    }
    document.getElementById("btnApply").addEventListener("click", applyFilters);
    document.getElementById("btnClear").addEventListener("click", ()=>{
      document.getElementById("q").value = "";
      document.getElementById("fStatus").value = "";
      document.getElementById("fCompany").value = "";
      document.getElementById("fBenefit").value = "";
      render(claims);
    });
    document.getElementById("verSelect").addEventListener("change", (e)=>{
      const v = e.target.value;
      document.getElementById("verBadge").textContent = `Version: #${v}`;
      toast(`Selected Analysis version: #${v} (mock)`);
    });

    // ===================== BILLING =====================
    function uniqueCompanies(){
      return [...new Set(claims.map(c=>c.company))].sort();
    }

    function initBillingUI(){
      const sel = document.getElementById("billCompany");
      sel.innerHTML = uniqueCompanies().map(c=>`<option>${c}</option>`).join("");

      // default anchor to current month (based on user's local time)
      const now = new Date();
      const ym = `${now.getFullYear()}-${String(now.getMonth()+1).padStart(2,"0")}`;
      document.getElementById("billAnchor").value = ym;

      renderSOA();
    }

    function eligibleForSOA(c){
      // Billing based on approved computations available:
      return c.status === "Approved" || c.status === "Ready to Download";
    }

    function recomputationFee(c){
      // 2% applies if recomputationReason is Change in Company Policy or Others
      if(!c.isRecomputed) return 0;
      if(c.recomputationReason === "Error in computation") return 0;
      if(c.recomputationReason === "Change in Company Policy" || c.recomputationReason === "Others") {
        return round2(c.claimAmount * 0.02);
      }
      return 0;
    }

    function round2(n){ return Math.round((n + Number.EPSILON) * 100) / 100; }

    function getWindow(){
      const company = document.getElementById("billCompany").value;
      const period = document.getElementById("billPeriod").value;
      const anchor = document.getElementById("billAnchor").value; // yyyy-mm
      if(!anchor) return { company, period, start:null, end:null, label:"Select an anchor month" };
      const [yyyyS, mmS] = anchor.split("-");
      const yyyy = Number(yyyyS);
      const mm = Number(mmS);

      if(period === "monthly"){
        const { start, end } = monthRange(yyyy, mm);
        return { company, period, start, end, label: `${yyyy}-${String(mm).padStart(2,"0")} (Monthly)` };
      } else {
        const { q, start, end } = quarterRangeFromAnchor(yyyy, mm);
        return { company, period, start, end, label: `Q${q} ${yyyy} (Quarterly)` };
      }
    }

    function isWithinApprovedDate(c, start, end){
      // Use approvedAt date to include in the SOA window
      if(!c.approvedAt) return false;
      const d = parseDate(c.approvedAt);
      if(!d) return false;
      const t = d.getTime();
      return t >= start.getTime() && t <= end.getTime();
    }

    function renderSOA(){
      const { company, start, end, label } = getWindow();
      const sub = document.getElementById("soaSubtitle");
      const win = document.getElementById("soaWindow");
      if(!start || !end){
        sub.textContent = "Pick company + period + anchor month.";
        win.textContent = "—";
        document.getElementById("soaTbody").innerHTML = "";
        setTotals(0,0,0);
        setPaymentPanel(company, 0);
        return;
      }

      sub.textContent = `Company: ${company} • Includes Approved/Ready to Download claims by Approved Date`;
      win.textContent = `${label}`;

      const items = claims
        .filter(c => c.company === company)
        .filter(eligibleForSOA)
        .filter(c => isWithinApprovedDate(c, start, end));

      const tbody = document.getElementById("soaTbody");
      tbody.innerHTML = "";

      let claimsTotal = 0;
      let feesTotal = 0;

      if(items.length === 0){
        tbody.innerHTML = `
          <tr>
            <td class="px-4 py-4 text-slate-500" colspan="7">
              No eligible claims found for this company and period (mock).
            </td>
          </tr>
        `;
      } else {
        items.forEach(c=>{
          const fee = recomputationFee(c);
          const line = round2(c.claimAmount + fee);
          claimsTotal += c.claimAmount;
          feesTotal += fee;
          tbody.insertAdjacentHTML("beforeend", `
            <tr class="hover:bg-slate-50">
              <td class="px-4 py-3 font-semibold">${c.id}<div class="text-xs text-slate-500">Approved: ${c.approvedAt}</div></td>
              <td class="px-4 py-3">${c.employee}</td>
              <td class="px-4 py-3">${c.benefit}</td>
              <td class="px-4 py-3">${chip(c.status)}</td>
              <td class="px-4 py-3 text-right">${peso(c.claimAmount)}</td>
              <td class="px-4 py-3 text-right">
                ${fee ? `<span class="font-semibold text-amber-800">${peso(fee)}</span><div class="text-xs text-slate-500">${c.recomputationReason || ""}</div>` : `<span class="text-slate-400">₱ 0.00</span>`}
              </td>
              <td class="px-4 py-3 text-right font-semibold">${peso(line)}</td>
            </tr>
          `);
        });
      }

      claimsTotal = round2(claimsTotal);
      feesTotal = round2(feesTotal);
      const grandTotal = round2(claimsTotal + feesTotal);

      setTotals(claimsTotal, feesTotal, grandTotal);
      setPaymentPanel(company, grandTotal);
    }

    function setTotals(claimsTotal, feesTotal, grandTotal){
      document.getElementById("soaClaimsTotal").textContent = peso(claimsTotal);
      document.getElementById("soaFeesTotal").textContent = peso(feesTotal);
      document.getElementById("soaGrandTotal").textContent = peso(grandTotal);
    }

    function paymentsFor(company){
      return payments.filter(p=>p.company===company).sort((a,b)=>parseDate(a.date)-parseDate(b.date));
    }

    function setPaymentPanel(company, soaGrand){
      const prev = Number(prevBalances[company] || 0);
      const payList = paymentsFor(company);
      const paid = payList.reduce((s,p)=>s + Number(p.amount||0), 0);
      const outstanding = round2(prev + soaGrand - paid);

      document.getElementById("prevBal").textContent = peso(prev);
      document.getElementById("payTotal").textContent = peso(paid);
      document.getElementById("outBal").textContent = peso(outstanding);

      const ul = document.getElementById("payHistory");
      ul.innerHTML = payList.length
        ? payList.map(p=>`<li class="flex items-start justify-between gap-3">
              <div>
                <div class="font-semibold">${peso(p.amount)}</div>
                <div class="text-xs text-slate-500">${p.date} • ${p.ref}</div>
              </div>
              <span class="text-xs px-2 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200">PAID</span>
           </li>`).join("")
        : `<li class="text-slate-500">No payments recorded (mock).</li>`;
    }

    function mockAddPayment(){
      const company = document.getElementById("billCompany").value;
      const amount = Math.floor(5000 + Math.random()*15000);
      const d = new Date();
      const yyyy = d.getFullYear();
      const mm = String(d.getMonth()+1).padStart(2,"0");
      const dd = String(d.getDate()).padStart(2,"0");
      payments.push({
        company,
        date: `${yyyy}-${mm}-${dd}`,
        amount,
        ref: `OR-${String(Math.floor(Math.random()*900)+100)} (mock)`
      });
      toast(`Payment added: ${peso(amount)} (mock)`);
      renderSOA();
    }
    window.mockAddPayment = mockAddPayment;

    function resetBilling(){
      initBillingUI();
      toast("Billing filters reset (mock).");
    }
    window.resetBilling = resetBilling;

    // ===================== INIT =====================
    // Inbox init
    render(claims);

    // Billing init
    initBillingUI();
  </script>
</body>
</html>