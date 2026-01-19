<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Uploading of Requirements</title>
  <style>
    :root{--accent:#6366f1;--muted:#6b7280;--bg:#f9fafb}
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Arial,sans-serif;margin:0;background:var(--bg);color:#0f172a}
    .container{max-width:900px;margin:32px auto;padding:20px}
    header{display:flex;align-items:center;justify-content:space-between}
    h1{margin:0;font-size:20px}
    .lead{font-size:14px;color:var(--muted)}

    .card{background:#fff;border-radius:12px;padding:20px;margin-top:18px;box-shadow:0 6px 20px rgba(0,0,0,0.06)}

    .req-list{margin:0;padding-left:20px;color:var(--muted);font-size:14px}
    .req-list li{margin-bottom:6px}

    label{font-size:13px;color:var(--muted);margin-top:12px;display:block}
    input[type=file]{margin-top:6px}

    .file-group{margin-top:14px;padding:12px;border:1px solid #e5e7eb;border-radius:8px;background:#fdfdfd}

    .btn{background:var(--accent);color:#fff;border:0;padding:10px 14px;border-radius:8px;cursor:pointer;margin-top:14px}
    .btn.ghost{background:#fff;color:var(--accent);border:1px solid #e6e9ef}

    #previewCard{display:none}
    #previewContent{font-size:14px;color:#0f172a}

    @media(max-width:600px){header{flex-direction:column;align-items:flex-start;gap:8px}}
  </style>
</head>
<body>
  <div class="container">

    <header>
      <h1>Uploading of Requirements</h1>
      <div class="lead">Submit your documents for verification</div>
    </header>

    <section class="card">
      <h2 style="margin:0 0 14px 0;font-size:16px">Required Documents</h2>
      <ul class="req-list">
        <li>Valid ID (Government-issued)</li>
        <li>Proof of Billing</li>
        <li>Business Permit / Barangay Permit</li>
        <li>2×2 Photo (Recent)</li>
        <li>Additional supporting documents (optional)</li>
      </ul>
    </section>

    <section class="card">
      <h2 style="margin:0 0 14px 0;font-size:16px">Upload Files</h2>

      <form id="uploadForm">
        <div class="file-group">
          <label>Valid ID</label>
          <input type="file" id="idFile" accept="image/*,application/pdf" required>
        </div>

        <div class="file-group">
          <label>Proof of Billing</label>
          <input type="file" id="billingFile" accept="image/*,application/pdf" required>
        </div>

        <div class="file-group">
          <label>Business Permit</label>
          <input type="file" id="permitFile" accept="image/*,application/pdf" required>
        </div>

        <div class="file-group">
          <label>2×2 Photo</label>
          <input type="file" id="photoFile" accept="image/*" required>
        </div>

        <div class="file-group">
          <label>Supporting Documents (optional)</label>
          <input type="file" id="supportFile" multiple>
        </div>

        <div style="display:flex;gap:8px;margin-top:14px;justify-content:flex-end">
          <button type="button" id="previewBtn" class="btn ghost">Preview</button>
          <button type="submit" class="btn">Submit</button>
        </div>
      </form>
    </section>

    <section id="previewCard" class="card">
      <h3 style="margin-top:0">Preview of Uploaded Files</h3>
      <div id="previewContent"></div>
    </section>

  </div>

  <script>
    const previewBtn = document.getElementById('previewBtn');
    const previewCard = document.getElementById('previewCard');
    const previewContent = document.getElementById('previewContent');
    const form = document.getElementById('uploadForm');

    function getFileInfo(fileInput){
      if(!fileInput.files.length) return 'No file uploaded';
      return Array.from(fileInput.files).map(f=>`${f.name} (${Math.round(f.size/1024)} KB)`).join('<br>');
    }

    previewBtn.addEventListener('click',()=>{
      previewContent.innerHTML = `
        <strong>Valid ID:</strong><br>${getFileInfo(idFile)}<br><br>
        <strong>Proof of Billing:</strong><br>${getFileInfo(billingFile)}<br><br>
        <strong>Business Permit:</strong><br>${getFileInfo(permitFile)}<br><br>
        <strong>2×2 Photo:</strong><br>${getFileInfo(photoFile)}<br><br>
        <strong>Supporting Documents:</strong><br>${getFileInfo(supportFile)}
      `;
      previewCard.style.display = 'block';
      previewCard.scrollIntoView({behavior:'smooth'});
    });

    form.addEventListener('submit',e=>{
      e.preventDefault();
      alert('Requirements submitted successfully (mock).');
      form.reset();
      previewCard.style.display='none';
    });
  </script>

</body>
</html>