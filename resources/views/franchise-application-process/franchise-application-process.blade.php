<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kape-Ilokano Franchise Application</title>

  <style>
    :root {
    --accent: #0ea5e9;
    --accent-dark: #0284c7;
    --muted: #6b7280;
    --bg: #f8fafc;
    --heading: #0f172a;
    --card-bg: #ffffff;
    --border: #d1d5db;
}

/* GLOBAL */
* {
    box-sizing: border-box;
}

body {
    font-family: Inter, Arial, sans-serif;
    margin: 0;
    background: var(--bg);
    color: var(--heading);
    line-height: 1.6;
}

.container {
    max-width: 1100px;
    margin: 32px auto;
    padding: 20px;
}

/* TITLES */
h1 {
    font-size: 30px;
    margin-bottom: 10px;
    font-weight: 700;
}

.lead {
    color: var(--muted);
    font-size: 15px;
    margin-bottom: 20px;
}

/* CARD */
.card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 26px;
    margin-top: 22px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
    transition: 0.3s ease;
}

.card:hover {
    box-shadow: 0 16px 34px rgba(0, 0, 0, 0.1);
}

/* SECTION TITLE */
.section-title {
    font-size: 20px;
    font-weight: 700;
    margin-top: 10px;
    margin-bottom: 14px;
    color: var(--heading);
    border-left: 5px solid var(--accent);
    padding-left: 12px;
}

/* INPUTS */
label {
    display: block;
    margin-top: 15px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

input,
select,
textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid var(--border);
    margin-top: 6px;
    font-size: 15px;
    background: #ffffff;
    transition: 0.2s;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 6px rgba(14, 165, 233, 0.3);
    background: #f8feff;
}

textarea {
    min-height: 120px;
    resize: vertical;
}

/* SECTION WRAPPER */
.checkbox-section {
    margin-top: 20px;
}

/* BLOCK TEXT */
.text-block {
    font-size: 14px;
    line-height: 1.6;
    color: #374151;
    margin-bottom: 12px;
    text-align: justify;
}

/* TITLE */
.tick-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
}

/* CHECKBOX + LABEL */
.checkbox-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 15px;
    color: #0d3553;
    cursor: pointer;
    width: 100%;
}

.checkbox-row input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-top: 2px; /* aligns with text */
}

/* RESPONSIVE */
@media (max-width: 600px) {
    .text-block {
        font-size: 13px;
    }

    .checkbox-row {
        font-size: 14px;
        gap: 12px;
    }

    .checkbox-row input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }
}


/* BUTTON */
.btn {
    background: var(--accent);
    color: white;
    border: none;
    padding: 14px 20px;
    border-radius: 10px;
    margin-top: 22px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: 0.3s ease;
    width: 100%;
    max-width: 240px;
}

.btn:hover {
    background: var(--accent-dark);
    box-shadow: 0 6px 16px rgba(14, 165, 233, 0.35);
}

/* DIVIDER */
hr {
    margin: 30px 0;
    border: 0;
    border-top: 1px solid #e5e7eb;
}

/* GRID FIX */
@media (max-width: 700px) {
    .grid2 {
        display: block !important;
    }

    .container {
        padding: 15px;
    }

    .card {
        padding: 22px;
    }

    h1 {
        font-size: 24px;
    }

    .btn {
        width: 100%;
    }
}

  </style>
</head>

<body>
<div class="container">

  <h1>KAPE-ILOKANO CAFE CORPORATION</h1>
  <p class="lead">
    Thank you for your interest in franchising Kape-Ilokano Cafe!  
    This form is the complete official franchise application.
  </p>

  <form>

    <!-- INTRO -->
    <div class="card">
      <p>
        At Kape-Ilokano, we take pride in sharing the rich flavors of Ilokano coffee culture.
        With over <b>18 partners nationwide</b>, we continue to grow,  bringing the authentic taste of locally sourced 
      coffee to more communities. <br><br>
       Submitting a franchise application is simply the first step in our process and does not create 
      any obligations for either party. Once received, we will carefully review your application and 
      evaluate your proposal. <br><br>
       Our franchise packages range from <b>P250,000 to P1,500,000</b>, depending on the store model 
      and location. Upon approval, we’ll discuss the investment details, potential returns, and 
      everything you need to know to start your journey with us. <br><br>
       We’re excited about the possibility of welcoming you to the Kape-Ilokano family. <b>Let’s brew 
      success, Ilokano-style!</b>
      </p>

     
      <div class="checkbox-section">

    <p class="text-block">
        I tender the following information as my complete and true personal & financial
        condition as the date shown below. I expressly authorize Pinnacle Global
        Franchising Group Inc. to conduct verification and investigation as part of the
        procedure for processing my application with Kape-Ilokano Cafe. I understand that
        the investigative report may be made whereby information is obtained through
        personal interviews with third parties, such as business associates, financial
        sources, friends, neighbors, or others with whom I am acquainted. This inquiry
        includes information as to my character, general reputation, personal
        characteristics, & manner of living, whichever may be applicable. I agree to supply a
        statement for a complete and accurate disclosure of additional information
        concerning the nature and scope of the investigation.
    </p>

    <p class="tick-title">Tick all that apply.</p>

    <label class="checkbox-row">
        <input type="checkbox" required>
        <span>I fully consent and agree.</span>
    </label>

</div>


      <label>Email Address *</label>
      <input type="email" required>

      <label>Lead Source *</label>
      <select required>
        <option>FACEBOOK</option>
        <option>WEBSITE</option>
        <option>WALK-IN</option>
        <option>REFERRAL FROM EXISTING FRANCHISEE</option>
        <option>RENEWAL</option>
        <option>EXPANSION</option>
        <option>EXPO</option>
        <option>OTHERS</option>
      </select>
    </div>

    <!-- PERSONAL DETAILS -->
    <div class="card">
      <div class="section-title">Personal Details</div>
      <p> We'd like to know you better.</p>

      <label>Complete Name (Surname, Given Name, Middle Name) *</label>
      <input type="text" required>

      <label> Please Attach Latest 2x2 Colored Picture or Selfie in White Background *</label>
      <input type="file" required>

      <label>Gender *</label>
      <select required>
        <option>MALE</option>
        <option>FEMALE</option>
      </select>

      <label>Civil Status *</label>
      <select required>
        <option>SINGLE</option>
        <option>MARRIED</option>
        <option>WIDOWED</option>
        <option>LEGALLY SEPARATED</option>
      </select>

      <label>Age *</label>
      <input type="number" required>

      <label>Country of Birth *</label>
      <input type="text" required>

      <label>Nationality/Citizenship *</label>
      <input type="text" required>

      <label>Country of Current Residence *</label>
      <input type="text">

      <label>Primary Home Address *</label>
      <input type="text" required>

      <label>Mobile or Residence Number (Please include + area code) *</label>
      <input type="text" required>

      <label>TIN No. *</label>
      <input type="text" required>

      <label>Religion *</label>
      <input type="text" required>

      <label>Hobbies *</label>
      <input type="text">

      <label>Spouse/Partner's Name (Surname, Given Name, Middle Name) *</label>
      <input type="text">

      <label>Dependents (Name & Age) *</label>
      <textarea></textarea>
    </div>

    <!-- PROFESSIONAL BACKGROUND -->
    <div class="card">
      <div class="section-title">Professional Background</div>

      <p> As part of our franchise application process, we would like to get to know you better. Please 
      provide details about your <b>personal background, professional experience, and business 
      interests.</b> This will help us understand your qualifications, entrepreneurial mindset, and 
      alignment with <b>Kape-Ilokano Cafe’s</b> vision of promoting Ilokano coffee culture.</p>


      <label>Educational Attainment *</label>
      <select required>
        <option>College</option>
        <option>Post Graduate</option>
      </select>

      <label>School Attended & Year *</label>
      <input type="text" required>

      <label>Employment *</label>
      <select required>
        <option>Employed</option>
        <option>Self Employed</option>
      </select>

      <label>Present Occupation & Position *</label>
      <select required>
        <option>Proprietor</option>
        <option>Supervisor</option>
        <option>Rank and File Employee</option>
      </select>

      <label>Job Title / Description *</label>
      <input type="text" required>

      <label>Name of Company / Business *</label>
      <input type="text" required>

      <label>Number of Years in the Company/Business *</label>
      <input type="text" required>

      <label>Company / Business Address *</label>
      <input type="text" required>

      <label>Responsibilities *</label>
      <textarea></textarea>

      <label>Nature of Business *</label>
      <input type="text">

      <label>Company Contact Number *</label>
      <input type="text">
    </div>

    <!-- BUSINESS BACKGROUND -->
    <div class="card">
      <div class="section-title">Business Background</div>

      <p> We would also like to know if you have any <b>prior experience in running a business,</b> 
      particularly in the food and beverage industry or related fields. <br><br>
     Understanding your background will help us assess how we can best support and guide you 
      in building a thriving business with <b>Kape-Ilokano Cafe Corporation.</b></p>

      <label>Do you have business experience in the Philippines *</label>
      <select>
        <option>yes</option>
        <option>no</option>
      </select>

      <label>Name of Business *</label>
      <input type="text">

      <label>Years of Experience *</label>
      <input type="text">

      <label>Business Industry *</label>
      <input type="text">

      <label>Have you ever <b>closed or discontinued</b> a business? *</label>
      <select>
        <option>yes</option>
        <option>no</option>
      </select>

      <label>If yes, we’d appreciate it if you could share the reasons behind the closure. This
      helps us understand your entrepreneurial journey and how we can better support
      you in your Kape-Ilokano Cafe franchise. *</label>
      <textarea></textarea>

      <label> Kindly share details about your past or current ventures, your role in managing
      them, and how your experience can contribute to the success of your Kape
      Ilokano Cafe franchise. *</label>
      <textarea></textarea>
    </div>

    <!-- KAPE-ILOKANO BACKGROUND -->
    <div class="card">
      <div class="section-title">Kape-Ilokano Background</div>

      <p> We’d like to understand your background and experience with Kape-Ilokano—whether as a 
      coffee enthusiast, a business owner, or someone who shares our passion for promoting 
      Ilokano culture. This helps us assess how we can best support you in your franchising 
      journey.</p>

      <label>Have you been a customer of Kape-Ilokano Cafe? *</label>
      <select>
        <option>yes</option>
        <option>no</option>
      </select>

      <label>Are you affiliated with any Kape-Ilokano Cafe Branch?  *</label>
      <select>
        <option>yes</option>
        <option>no</option>
      </select>

      <label> If Yes, kindly state which Branch or Person you are connected to. *</label>
      <input type="text">

      <label>Do you have an existing coffee shop business?</label>
      <select><option>yes</option><option>no</option></select>

      <label>Do you have knowledge in Coffee Industry?</label>
      <select><option>yes</option><option>no</option></select>

      <label>Do you have passion for Coffee?</label>
      <select><option>yes</option><option>no</option></select>

      <label>How eager are you to have your own cafe business? (Rate it from 1 to 10. 10 is
      the highest, 1 is the lowest.)</label>
      <input type="number" min="1" max="10">
    </div>

    <!-- BUSINESS PROPOSAL -->
    <div class="card">
      <div class="section-title">Business Partnership Proposal</div>

      <p> We’d like to understand your Business plan for Kape-Ilokano—your vision, target market, and 
      location preferences. This helps us evaluate alignment with our brand values and determine 
      how we can best support you in building a successful franchise</p>

      <label>Target Location (Please indicate the complete address) *</label>
      <input type="text">

      <label>What is your main reason for considering a Kape-Ilokano Cafe Franchise? *</label>
      <textarea></textarea>

      <label> What are your expectations in having a Kape-Ilokano Cafe Franchise? *</label>
      <textarea></textarea>

      <label> To what extent will you be involved in the day-to-day operations of the franchised
      branch? *</label>
      <textarea></textarea>

      <label>What is your management Philosophy *</label>
      <textarea></textarea>

      <label>Other business interests *</label>
      <textarea></textarea>

      <label><b>Socio-civic Affiliations</b> (E.g. Rotary, Lions, Freemason, Others, Etc.) Name 
      Years in Membership *</label>
      <textarea></textarea>
    </div>

    <!-- FINANCIAL -->
    <div class="card">
      <div class="section-title">Financial Aspect</div>

      <p> We’d like to understand your <b>business plan for Kape-Ilokano, including your financial 
      capacity and strategy.</b> This helps us assess your preparedness and ensure that we can guide 
      you effectively in launching a successful franchise. We may ask about your available capital, 
      funding sources, and financial projections to align expectations and provide the best support 
      possible.</p>

      <label>How much are you willing to invest? *</label>
      <input type="text">

      <label>Expected daily sales *</label>
      <input type="text">

      <label>Expected ROI timeline *</label>
      <input type="text">
    </div>

    <!-- CHARACTER REFERENCE -->
    <div class="card">
      <div class="section-title">Character Reference</div>

      <p> For <b>verification purposes,</b> we appreciate you providing us reliable character references to 
      further process your franchise application with us.</p>

      <label>Please provide three (3) Character References including the following <br>
        information: <br>
        Contact Person's name (non-family): <br>
        Contact Number: <br>
        E-mail Address: *</label>
      <textarea placeholder="Name / Contact / Email"></textarea>
    </div>

    <!-- CONSENT -->
    <div class="card">
      <div class="section-title">Consent Form</div>

      <p> By submitting your application, you <b>consent</b> to Kape-Ilokano Cafe Corporation collecting and 
      evaluating the provided information solely for the purpose of franchise assessment. Rest 
      assured, all details will be kept confidential and used only within the scope of our franchise 
      application process.</p>

      <p><b> I hereby represent that all the information provided in this application is true
      and correct to the best of my knowledge and belief.</b>
    <br><br>  I acknowledge that <b>Pinnacle Global Franchising Group Inc.</b>, as the franchisor
              of <b>Kape-Ilokano Cafe</b>, is not obligated to offer a franchise to me solely based on
              the submission of this application. I understand that providing <b>false or
              misleading information</b> may result in the denial of my application or the
              termination of any potential agreement. <br><br>

               Furthermore, I understand that <b>Pinnacle Global Franchising Group Inc.</b> may
              conduct necessary inquiries regarding my <b>business background, character,
              financial capacity, and other relevant factors</b> as part of the franchise
              evaluation process. I consent to such verification to ensure transparency and
              alignment with the company’s standards.
    </p>

      <div class="checkbox-row">
        <input type="checkbox" required> I hereby acknowledge and agree.
      </div>

      <label>Picture of Government Issued Valid ID with 3 Specimen Signature *</label>
      <input type="file" required>

      <p><b>I consent to the processing of my personal and sensitive information
        provided in this application form and in any supporting documents
        submitted for my franchise application.</b> <br><br>
        
        I understand that <b>Pinnacle Global Franchising Group Inc., Kape-Ilokano Cafe
        Corporation</b> and its authorized representatives may collect, verify, and process
        this information for the purpose of <b>assessing my qualifications as a potential
        franchisee, verifying my identity, and evaluating my application.</b> <br><br>

         I acknowledge that all information provided will be handled with <b>strict
        confidentiality</b> and used solely for the franchise application process in
        accordance with applicable data privacy laws and company policies.
              </p>
      <div class="checkbox-row">
        <input type="checkbox" required>  I Hereby Acknowledge and Agree.
      </div>
    </div>

    <button class="btn">Submit Application</button>

  </form>

</div>
</body>
</html>

{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
</html> --}}