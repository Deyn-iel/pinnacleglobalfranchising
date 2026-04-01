document.addEventListener('DOMContentLoaded', () => {
    // Tabs
    document.querySelectorAll('.tab').forEach(t => {
      t.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
        t.classList.add('active');
        applyFilters();
      });
    });

    // Inputs
    document.getElementById('searchInput')?.addEventListener('input', applyFilters);

    // Desktop filters
    document.getElementById('departmentFilter')?.addEventListener('change', applyFilters);
    document.getElementById('priorityFilter')?.addEventListener('change', applyFilters);

    // Mobile filters mirror (departmentFilter_m / priorityFilter_m)
    document.getElementById('departmentFilter_m')?.addEventListener('change', () => {
      syncMobileToDesktop();
      applyFilters();
    });
    document.getElementById('priorityFilter_m')?.addEventListener('change', () => {
      syncMobileToDesktop();
      applyFilters();
    });

    // Success alert fade out
    const alert = document.getElementById('successAlert');
    if(alert){
      setTimeout(() => alert.classList.remove('show'), 6500);
      setTimeout(() => alert.remove(), 7200);
    }

    applyFilters();
  });

  function syncMobileToDesktop(){
    const depM = document.getElementById('departmentFilter_m');
    const priM = document.getElementById('priorityFilter_m');
    const depD = document.getElementById('departmentFilter');
    const priD = document.getElementById('priorityFilter');

    // If desktop elements exist, keep value aligned
    if(depM && depD) depD.value = depM.value;
    if(priM && priD) priD.value = priM.value;
  }

  function activeStatus(){
    const tab = document.querySelector('.tab.active');
    return tab ? (tab.getAttribute('data-status') || '') : '';
  }

  function applyFilters(){
    const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();

    // Prefer desktop filters; if not available (or empty) use mobile ones
    const depD = (document.getElementById('departmentFilter')?.value || '').trim().toLowerCase();
    const priD = (document.getElementById('priorityFilter')?.value || '').trim().toLowerCase();
    const depM = (document.getElementById('departmentFilter_m')?.value || '').trim().toLowerCase();
    const priM = (document.getElementById('priorityFilter_m')?.value || '').trim().toLowerCase();

    const dep = depD || depM || '';
    const pri = priD || priM || '';

    const st  = activeStatus();

    const items = document.querySelectorAll('#ticketList .ticket-item');
    let visible = 0;

    items.forEach(item => {
      const tNo  = item.dataset.ticketNo || '';
      const subj = item.dataset.subject || '';
      const desc = item.dataset.description || '';
      const tDep = item.dataset.department || '';
      const tPri = item.dataset.priority || '';
      const tSt  = item.dataset.status || '';

      const matchesQuery = !q || (tNo.includes(q) || subj.includes(q) || desc.includes(q));
      const matchesDep = !dep || tDep === dep;
      const matchesPri = !pri || tPri === pri;
      const matchesSt  = !st || tSt === st;

      const show = matchesQuery && matchesDep && matchesPri && matchesSt;
      item.style.display = show ? '' : 'none';
      if(show) visible++;
    });

    document.getElementById('visibleCount').textContent = visible;
  }

window.openTicketDetails = function openTicketDetails(el){
  const noEl = el.querySelector('.ticket-no');
  const subjEl = el.querySelector('.ticket-title');

  const ticketId = el.dataset.id;
  const dept = el.dataset.department || '';
  const pri  = el.dataset.priority || '';
  const badge = el.querySelector('.badge-status');
const st = badge ? badge.innerText.trim().replace(' ', '_').toLowerCase() : 'pending';

// ==========================
// ✅ APPROVAL UI SWITCH
// ==========================
const approvalRequested = el.dataset.approvalRequested == "1";

const normalWrap = document.getElementById('normalStatusWrap');
const approvalWrap = document.getElementById('approvalActionsWrap');

// reset
normalWrap.classList.remove('d-none');
approvalWrap.classList.add('d-none');

// if may approval request at resolved
if(approvalRequested){
    normalWrap.classList.add('d-none');   // hide dropdown
    approvalWrap.classList.remove('d-none'); // show buttons
}

  document.getElementById('d_ticketNo').innerText = noEl?.innerText || '—';
  document.getElementById('d_subject').innerText = subjEl?.innerText || '—';

  const visibleDesc = el.querySelector('.ticket-desc')?.innerText || '';
  document.getElementById('d_description').innerText = visibleDesc || '—';

  document.getElementById('d_department').innerText = cap(dept);
  document.getElementById('d_priority').innerText = cap(pri);
  document.getElementById('d_statusText').innerText = (st || '').replace(/_/g,' ');
  document.getElementById('d_time').innerText = el.dataset.time || '';

  // ✅ set dropdown
const statusSelect = document.getElementById('d_statusSelect');
const resolveWrap = document.getElementById('resolveJustificationWrap');

if(statusSelect){
  statusSelect.onchange = function(){

  if(this.value === 'resolved'){

    // 🔥 HIDE DROPDOWN
    document.getElementById('normalStatusWrap').classList.add('d-none');

    // 🔥 SHOW ACCEPT / DECLINE
    document.getElementById('approvalActionsWrap').classList.remove('d-none');

  } else {

    // balik normal
    document.getElementById('normalStatusWrap').classList.remove('d-none');
    document.getElementById('approvalActionsWrap').classList.add('d-none');

  }

};
}

if(statusSelect){

  statusSelect.innerHTML = '';

  if(st === "pending"){
  statusSelect.innerHTML = `
    <option value="pending" selected>Pending</option>
  `;
}
else if(st === "in_progress"){
  statusSelect.innerHTML = `
    <option value="in_progress" selected>In Progress</option>
    <option value="resolved">Resolved</option>
  `;
}
else{
  statusSelect.innerHTML = `
    <option value="resolved" selected>Resolved</option>
  `;
}

}

  // ✅ set form action route (Vite-safe)
  const form = document.getElementById('statusForm');
  form.onsubmit = function(e){

  const status = document.getElementById('d_statusSelect')?.value;
  const justification = document.getElementById('resolveJustification')?.value.trim();

  // 🔥 PAG RESOLVED → wag mag normal submit
  if(status === 'resolved'){

    e.preventDefault(); // STOP normal submit

    if(!justification){
      alert('⚠️ Justification is required before resolving this ticket.');
      return;
    }

    const action = form.action;
    const parts = action.split('/');
    const ticketId = parts[parts.length - 2];

    const baseUrl = document.querySelector('meta[name="base-url"]').content;

    // 🔥 CALL REQUEST APPROVAL
    fetch(`${baseUrl}/tickets/${ticketId}/request-approval`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        justification: justification
      })
    })
    .then(res => res.json())
    .then(() => {
      alert('⏳ Waiting for user approval...');

      // 🔥 SWITCH UI AGAD
      document.getElementById('normalStatusWrap').classList.add('d-none');
      document.getElementById('approvalActionsWrap').classList.remove('d-none');

      // OPTIONAL reload
      location.reload();
    });

  }

};
  if(form && ticketId){
    const baseUrl = document.querySelector('meta[name="base-url"]')?.content || '';
    form.action = baseUrl + "/tickets/" + ticketId + "/status";
  }

  new bootstrap.Modal(document.getElementById('ticketDetailsModal')).show();

  const saveBtn = document.getElementById('saveBtn');

if(saveBtn){
  if(approvalRequested){
      saveBtn.style.display = 'none';
  }else{
      saveBtn.style.display = '';
  }
}

}



  function cap(s){
    if(!s) return '';
    return s.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase());
  }

document.getElementById('cancelTicket')?.addEventListener('click', function(){

  const wrap = document.getElementById('cancelJustificationWrap');
  const textarea = document.getElementById('cancelJustification');

  // show first
  if(wrap.classList.contains('d-none')){
    wrap.classList.remove('d-none');
    textarea.focus();
    return; // STOP muna dito
  }

  // second click = submit
  if(!textarea.value.trim()){
    alert('⚠️ Please provide a reason for rejection.');
    textarea.focus();
    return;
  }

  const form = document.getElementById('statusForm');
  const action = form.action;
  const parts = action.split('/');
  const ticketId = parts[parts.length - 2];

  const baseUrl = document.querySelector('meta[name="base-url"]').content;

fetch(`${baseUrl}/tickets/${ticketId}/decline`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      reason: textarea.value
    })
  })
  .then(res => res.json())
  .then(() => {
    alert('❌ Ticket rejected.');
    location.reload();
  });

});

document.getElementById('acceptTicket')?.addEventListener('click', function(){

  const form = document.getElementById('statusForm');
  const action = form.action;
  const parts = action.split('/');
  const ticketId = parts[parts.length - 2];

  const baseUrl = document.querySelector('meta[name="base-url"]').content;

fetch(`${baseUrl}/tickets/${ticketId}/approve`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
  })
  .then(res => res.json())
  .then(() => {
    alert('✅ Ticket approved!');
    location.reload();
  });

});

  