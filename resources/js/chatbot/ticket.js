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
  const st   = el.dataset.status || 'pending';

  document.getElementById('d_ticketNo').innerText = noEl?.innerText || '—';
  document.getElementById('d_subject').innerText = subjEl?.innerText || '—';

  const visibleDesc = el.querySelector('.ticket-desc')?.innerText || '';
  document.getElementById('d_description').innerText = visibleDesc || '—';

  document.getElementById('d_department').innerText = cap(dept);
  document.getElementById('d_priority').innerText = cap(pri);
  document.getElementById('d_statusText').innerText = (st || '').replace(/_/g,' ');

  // ✅ set dropdown
  const statusSelect = document.getElementById('d_statusSelect');
  if(statusSelect) statusSelect.value = st;

  // ✅ set form action route (Vite-safe)
  const form = document.getElementById('statusForm');
  if(form && ticketId){
    const baseUrl = document.querySelector('meta[name="base-url"]')?.content || '';
    form.action = baseUrl + "/tickets/" + ticketId + "/status";
  }

  new bootstrap.Modal(document.getElementById('ticketDetailsModal')).show();
}



  function cap(s){
    if(!s) return '';
    return s.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase());
  }