<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ordering of Supplies to Registered Partners</title>
  <style>
    :root{--accent:#2563eb;--muted:#6b7280}
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Arial, sans-serif;margin:0;background:#f8fafc;color:#0f172a}
    .container{max-width:1000px;margin:36px auto;padding:20px}
    header{display:flex;align-items:center;justify-content:space-between}
    h1{font-size:20px;margin:0}
    .card{background:#fff;border-radius:10px;padding:18px;margin-top:18px;box-shadow:0 6px 18px rgba(15,23,42,0.06)}

    form .row{display:flex;gap:12px;align-items:center}
    .row + .row{margin-top:12px}
    label{font-size:13px;color:var(--muted);min-width:120px}
    select,input[type=text],input[type=number]{flex:1;padding:10px;border-radius:8px;border:1px solid #e6e9ef}
    button{background:var(--accent);color:#fff;border:0;padding:10px 14px;border-radius:8px;cursor:pointer}
    button.ghost{background:#fff;color:var(--accent);border:1px solid #e6e9ef}

    table{width:100%;border-collapse:collapse;margin-top:14px}
    th,td{padding:10px;text-align:left;border-bottom:1px solid #eef2f6}
    th{font-weight:600;color:var(--muted)}

    .actions{display:flex;gap:8px}
    .totals{display:flex;justify-content:flex-end;margin-top:12px;font-weight:600}

    @media (max-width:720px){
      .row{flex-direction:column;align-items:stretch}
      label{min-width:unset}
      header{flex-direction:column;align-items:flex-start;gap:10px}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Ordering of Supplies to Registered Partners</h1>
      <div style="color:var(--muted);font-size:13px">Simple ordering page • responsive</div>
    </header>

    <section class="card">
      <form id="orderForm">
        <div class="row">
          <label for="partner">Select Registered Partner</label>
          <select id="partner" required>
            <option value="">-- choose partner --</option>
            <option value="partner-a">Partner A (Local Retailer)</option>
            <option value="partner-b">Partner B (Distributor)</option>
            <option value="partner-c">Partner C (NGO)</option>
          </select>
        </div>

        <div class="row" style="margin-top:14px;align-items:flex-start;">
          <label>Order items</label>
          <div style="flex:1">
            <table id="itemsTable">
              <thead>
                <tr>
                  <th style="width:40%">Item</th>
                  <th style="width:20%">Unit</th>
                  <th style="width:20%">Qty</th>
                  <th style="width:20%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- rows inserted by JS -->
              </tbody>
            </table>

            <div style="margin-top:10px;display:flex;gap:8px;">
              <button type="button" id="addRow">+ Add item</button>
              <button type="button" id="clearRows" class="ghost">Clear items</button>
            </div>
          </div>
        </div>

        <div class="row">
          <label for="notes">Delivery Notes</label>
          <input type="text" id="notes" placeholder="e.g. deliver to warehouse gate B" />
        </div>

        <div class="totals" id="summary">Items: 0</div>

        <div style="display:flex;justify-content:flex-end;margin-top:14px;gap:8px">
          <button type="button" id="preview" class="ghost">Preview</button>
          <button type="submit">Submit Order</button>
        </div>
      </form>
    </section>

    <section class="card" id="previewCard" style="display:none">
      <h3 style="margin:0 0 12px 0">Order Preview</h3>
      <div id="previewContent" style="font-size:14px;color:#0f172a"></div>
    </section>
  </div>

  <script>
    const itemsTableBody = document.querySelector('#itemsTable tbody');
    const addRowBtn = document.getElementById('addRow');
    const clearRowsBtn = document.getElementById('clearRows');
    const summaryEl = document.getElementById('summary');
    const previewBtn = document.getElementById('preview');
    const previewCard = document.getElementById('previewCard');
    const previewContent = document.getElementById('previewContent');
    const orderForm = document.getElementById('orderForm');

    function createRow(item='',unit='',qty=1){
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><input type="text" class="item-name" value="${escapeHtml(item)}" placeholder="Item name"></td>
        <td><input type="text" class="item-unit" value="${escapeHtml(unit)}" placeholder="pc/box/kg"></td>
        <td><input type="number" class="item-qty" value="${qty}" min="1"></td>
        <td class="actions"><button type="button" class="remove">Remove</button></td>
      `;
      tr.querySelector('.remove').addEventListener('click',()=>{tr.remove();updateSummary();});
      tr.querySelector('.item-qty').addEventListener('input',updateSummary);
      tr.querySelector('.item-name').addEventListener('input',updateSummary);
      itemsTableBody.appendChild(tr);
      updateSummary();
    }

    function updateSummary(){
      const rows = Array.from(itemsTableBody.querySelectorAll('tr'));
      let count = 0;
      rows.forEach(r=>{
        const q = Number(r.querySelector('.item-qty').value) || 0;
        count += q;
      });
      summaryEl.textContent = `Items: ${rows.length} • Total qty: ${count}`;
    }

    addRowBtn.addEventListener('click',()=>createRow());
    clearRowsBtn.addEventListener('click',()=>{itemsTableBody.innerHTML='';updateSummary();});

    previewBtn.addEventListener('click',()=>{
      const partner = document.getElementById('partner').value;
      if(!partner){alert('Please select a registered partner first.');return}
      const rows = Array.from(itemsTableBody.querySelectorAll('tr'));
      if(rows.length===0){alert('Add at least one item.');return}
      previewContent.innerHTML = `Partner: <strong>${escapeHtml(document.getElementById('partner').options[document.getElementById('partner').selectedIndex].text)}</strong><br><br>`;
      const ul = document.createElement('ul');
      rows.forEach(r=>{
        const name = r.querySelector('.item-name').value || '—';
        const unit = r.querySelector('.item-unit').value || '';
        const qty = r.querySelector('.item-qty').value || '0';
        const li = document.createElement('li');
        li.textContent = `${name} — ${qty} ${unit}`;
        ul.appendChild(li);
      });
      previewContent.appendChild(ul);
      const notes = document.getElementById('notes').value;
      if(notes) previewContent.innerHTML += `<br>Notes: ${escapeHtml(notes)}`;
      previewCard.style.display = 'block';
      previewCard.scrollIntoView({behavior:'smooth'});
    });

    orderForm.addEventListener('submit',e=>{
      e.preventDefault();
      const partner = document.getElementById('partner').value;
      if(!partner){alert('Please select a partner.');return}
      const rows = Array.from(itemsTableBody.querySelectorAll('tr'));
      if(rows.length===0){alert('Add at least one item to order.');return}
      // collect data
      const payload = {
        partner: partner,
        items: rows.map(r=>({
          name: r.querySelector('.item-name').value,
          unit: r.querySelector('.item-unit').value,
          qty: Number(r.querySelector('.item-qty').value) || 0
        })),
        notes: document.getElementById('notes').value
      };
      // here you would send `payload` to your server via fetch/ajax.
      console.log('Order payload',payload);
      alert('Order submitted (mock). Check console for payload.');
      // reset
      orderForm.reset();
      itemsTableBody.innerHTML='';
      updateSummary();
      previewCard.style.display='none';
    });

    // helper
    function escapeHtml(str){
      return String(str).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"})[m]);
    }

    // add one starter row
    createRow('Sample item','pc',1);
  </script>
</body>
</html>
