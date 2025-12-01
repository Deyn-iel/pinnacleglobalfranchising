<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Franchise Application Process</title>
  <style>
    :root{--accent:#0ea5e9;--muted:#6b7280;--bg:#f8fafc}
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Arial,sans-serif;margin:0;background:var(--bg);color:#0f172a}
    .container{max-width:1000px;margin:32px auto;padding:20px}
    header{display:flex;align-items:center;justify-content:space-between}
    h1{font-size:20px;margin:0}
    .lead{color:var(--muted);font-size:14px}

    .card{background:#fff;border-radius:12px;padding:18px;margin-top:18px;box-shadow:0 8px 22px rgba(2,6,23,0.06)}
    .grid{display:grid;grid-template-columns:1fr 360px;gap:18px}
    label{display:block;font-size:13px;color:var(--muted);margin-bottom:6px}
    input[type=text],input[type=email],input[type=tel],select,textarea{width:100%;padding:10px;border-radius:8px;border:1px solid #e6e9ef}
    textarea{min-height:110px;resize:vertical}
    .small{font-size:12px;color:var(--muted)}
    .btn{background:var(--accent);color:#fff;border:0;padding:10px 14px;border-radius:8px;cursor:pointer}
    .btn.ghost{background:#fff;color:var(--accent);border:1px solid #e6e9ef}

    .steps{display:flex;flex-direction:column;gap:8px}
    .step{display:flex;gap:12px;align-items:flex-start}
    .step .num{width:28px;height:28px;border-radius:8px;background:#eef9ff;color:var(--accent);display:flex;align-items:center;justify-content:center;font-weight:700}
    .step h4{margin:0;font-size:14px}
    .step p{margin:4px 0 0 0;font-size:13px;color:var(--muted)}

    .files{display:flex;flex-direction:column;gap:8px}
    .refs{display:flex;flex-direction:column;gap:8px;margin-top:8px}
    .ref-row{display:flex;gap:8px}
    .ref-row input{flex:1}

    .summary{background:#fafbff;padding:12px;border-radius:8px;border:1px solid #eef2ff}
    .summary h3{margin:0 0 8px 0;font-size:16px}

    @media (max-width:920px){.grid{grid-template-columns:1fr}}
    @media (max-width:520px){header{flex-direction:column;align-items:flex-start;gap:8px}}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Franchise Application Process</h1>
      <div class="lead">Apply to become an authorized franchise partner — simple, step-by-step</div>
    </header>

    <div class="grid">
      <main class="card">
        <h2 style="margin:0 0 12px 0;font-size:16px">Application Form</h2>
        <form id="franchiseForm">
          <fieldset style="border:0;padding:0;margin:0">
            <label for="company">Company / Applicant Name</label>
            <input id="company" type="text" placeholder="e.g. ABC Trading, Juan Dela Cruz" required />

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px">
              <div>
                <label for="contactName">Contact Person</label>
                <input id="contactName" type="text" placeholder="Full name" required />
              </div>
              <div>
                <label for="phone">Phone / Mobile</label>
                <input id="phone" type="tel" placeholder="0917xxxxxxx" required />
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px">
              <div>
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="name@company.com" required />
              </div>
              <div>
                <label for="location">Proposed Location</label>
                <input id="location" type="text" placeholder="City / Barangay / Address" required />
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px">
              <div>
                <label for="model">Franchise Model</label>
                <select id="model" required>
                  <option value="">-- choose model --</option>
                  <option>Single Branch</option>
                  <option>Area Development</option>
                  <option>Master Franchise</option>
                </select>
              </div>
              <div>
                <label for="investment">Estimated Investment</label>
                <select id="investment" required>
                  <option value="">-- estimate --</option>
                  <option>&lt; ₱500,000</option>
                  <option>₱500,000 - ₱2,000,000</option>
                  <option>&gt; ₱2,000,000</option>
                </select>
              </div>
            </div>

            <label style="margin-top:12px">Business Plan / Supporting Documents</label>
            <div class="files">
              <input id="docs" type="file" multiple />
              <div class="small">Allowed: pdf, docx, images. (This is a mock upload — in production the files would be uploaded.)</div>
            </div>

            <label style="margin-top:12px">Brief Business Description</label>
            <textarea id="description" placeholder="Short description of your plan, market, and operations" required></textarea>

            <label style="margin-top:12px">References</label>
            <div class="refs" id="refs">
              <div class="ref-row">
                <input placeholder="Reference name (e.g. supplier or partner)" class="ref-name" />
                <input placeholder="Contact info" class="ref-contact" />
                <button type="button" class="btn ghost removeRef">Remove</button>
              </div>
            </div>
            <div style="margin-top:8px;display:flex;gap:8px">
              <button type="button" id="addRef" class="btn ghost">+ Add reference</button>
            </div>

            <div style="margin-top:12px">
              <label><input type="checkbox" id="agree" /> I confirm that the information provided is accurate and I agree to the franchise terms.</label>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:14px">
              <button type="button" id="previewBtn" class="btn ghost">Preview</button>
              <button type="submit" class="btn">Submit Application</button>
            </div>
          </fieldset>
        </form>
      </main>

      <aside class="card">
        <section class="summary">
          <h3>Process Steps</h3>
          <div class="steps">
            <div class="step"><div class="num">1</div><div><h4>Submit Application</h4><p>Fill out the form and attach required documents.</p></div></div>
            <div class="step"><div class="num">2</div><div><h4>Initial Review</h4><p>Our team reviews eligibility and market fit.</p></div></div>
            <div class="step"><div class="num">3</div><div><h4>Interview / Site Visit</h4><p>We may schedule a call or visit the proposed site.</p></div></div>
            <div class="step"><div class="num">4</div><div><h4>Agreement &amp; Training</h4><p>Sign franchise agreement and complete onboarding.</p></div></div>
            <div class="step"><div class="num">5</div><div><h4>Launch Support</h4><p>We provide support during setup and launch.</p></div></div>
          </div>
        </section>

        <section style="margin-top:12px">
          <h3 style="margin:0 0 8px 0">Quick Tips</h3>
          <ul style="margin:0;padding-left:18px;color:var(--muted)">
            <li>Prepare a 1–2 page business summary.</li>
            <li>Attach proof of funds if available.</li>
            <li>Provide clear contact details for references.</li>
          </ul>
        </section>

        <section style="margin-top:12px">
          <h3 style="margin:0 0 8px 0">Estimated Timeline</h3>
          <div class="small">Initial review: 5–7 business days • Complete process: 4–8 weeks (subject to evaluation)</div>
        </section>
      </aside>
    </div>

    <section id="previewCard" class="card" style="display:none;margin-top:18px">
      <h3 style="margin:0 0 12px 0">Application Preview</h3>
      <div id="previewContent"></div>
    </section>
  </div>

  <script>
    const refsContainer = document.getElementById('refs');
    const addRefBtn = document.getElementById('addRef');
    const previewBtn = document.getElementById('previewBtn');
    const previewCard = document.getElementById('previewCard');
    const previewContent = document.getElementById('previewContent');
    const form = document.getElementById('franchiseForm');

    function addRefRow(name='',contact=''){
      const row = document.createElement('div');
      row.className = 'ref-row';
      row.innerHTML = `
        <input placeholder="Reference name (e.g. supplier or partner)" class="ref-name" value="${escapeHtml(name)}" />
        <input placeholder="Contact info" class="ref-contact" value="${escapeHtml(contact)}" />
        <button type="button" class="btn ghost removeRef">Remove</button>
      `;
      row.querySelector('.removeRef').addEventListener('click',()=>row.remove());
      refsContainer.appendChild(row);
    }

    addRefBtn.addEventListener('click',()=>addRefRow());
    // remove existing remove buttons (first one)
    refsContainer.querySelectorAll('.removeRef').forEach(b=>b.addEventListener('click',e=>e.target.closest('.ref-row').remove()));

    previewBtn.addEventListener('click',()=>{
      const data = collectForm();
      if(!data) return; // validation handled
      previewContent.innerHTML = `<strong>${escapeHtml(data.company)}</strong><br>`+
        `<div class="small">Contact: ${escapeHtml(data.contactName)} • ${escapeHtml(data.phone)} • ${escapeHtml(data.email)}</div><br>`+
        `<div>Location: ${escapeHtml(data.location)}</div>`+
        `<div>Model: ${escapeHtml(data.model)} • Investment: ${escapeHtml(data.investment)}</div><br>`+
        `<div><strong>Description</strong><div>${escapeHtml(data.description)}</div></div><br>`+
        `<div><strong>References</strong><ul>${data.references.map(r=>`<li>${escapeHtml(r.name)} — ${escapeHtml(r.contact)}</li>`).join('')}</ul></div>`+
        `<div class="small">Attached files: ${data.files.length} (mock)</div>`;
      previewCard.style.display = 'block';
      previewCard.scrollIntoView({behavior:'smooth'});
    });

    form.addEventListener('submit',e=>{
      e.preventDefault();
      const data = collectForm();
      if(!data) return;
      // mock submit
      console.log('Franchise application payload',data);
      alert('Application submitted (mock). Check console for payload.');
      form.reset();
      refsContainer.innerHTML = '';
      addRefRow();
      previewCard.style.display='none';
    });

    function collectForm(){
      const company = document.getElementById('company').value.trim();
      const contactName = document.getElementById('contactName').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const email = document.getElementById('email').value.trim();
      const location = document.getElementById('location').value.trim();
      const model = document.getElementById('model').value;
      const investment = document.getElementById('investment').value;
      const description = document.getElementById('description').value.trim();
      const agree = document.getElementById('agree').checked;

      if(!company||!contactName||!phone||!email||!location||!model||!investment||!description){
        alert('Please complete all required fields.');
        return null;
      }
      if(!agree){alert('Please confirm agreement to terms.');return null}

      const files = Array.from(document.getElementById('docs').files).map(f=>({name:f.name,size:f.size,type:f.type}));
      const references = Array.from(refsContainer.querySelectorAll('.ref-row')).map(r=>({
        name: r.querySelector('.ref-name').value.trim(),
        contact: r.querySelector('.ref-contact').value.trim()
      })).filter(r=>r.name||r.contact);

      return {company,contactName,phone,email,location,model,investment,description,files,references};
    }

    function escapeHtml(str){
      return String(str||'').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"})[m]);
    }

    // initial ref row
    refsContainer.innerHTML = '';
    addRefRow();
  </script>
</body>
</html>