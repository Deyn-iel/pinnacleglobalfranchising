<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <title>Franchise Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@vite(['resources/css/franchise-app/app.css', 
        'resources/js/franchise-app/app.js',
        'resources/js/app.js'])
</head>

<body>
  

<div class="container">
  
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" 
     role="alert"
     style="background:#4caf50; color:white; border:none; font-size:16px;">
    <strong>✔ Success!</strong> {{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif


  <div class="container header-flex">
    <h1>KAPE-ILOKANO CAFE CORPORATION</h1>
    <a href="{{ url('/') }}" class="link-small"> < Back</a>
</div>


  <div class="img-container">
    <img src="{{ asset('img/KI WALLPAPER 1.jpg') }}" alt="">
</div>
  <p class="lead">
    Thank you for your interest in franchising Kape-Ilokano Cafe!  
    This form is the complete official franchise application.
  </p>

<form 
    action="{{ route('franchise.submit') }}" 
    method="POST" 
    enctype="multipart/form-data"
>
@csrf
    <!-- INTRO -->
    <div class="card">
      <p>
        At Kape-Ilokano, we take pride in sharing the rich flavors of Ilokano coffee culture. With over <b>18 partners nationwide</b>, we continue to grow,  bringing the authentic taste of locally sourced coffee to more communities. <br><br>
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
        <input type="checkbox" name="consent_intro" required>
        <span>I fully consent and agree.</span>
    </label>

</div>


      <label>Email Address *</label>
      <input type="email" name="email" required>

      <label>Lead Source *</label>
      <select name="lead_source" required>
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
      <input type="text" name="personal_full_name" required>

      <label> Please Attach Latest 2x2 Colored Picture or Selfie in White Background *</label>
      <input type="file" name="personal_photo" multiple>


      <label>Gender *</label>
      <select name="personal_gender" required>
        <option>MALE</option>
        <option>FEMALE</option>
      </select>

      <label>Civil Status *</label>
      <select name="personal_civil_status" required>
        <option>SINGLE</option>
        <option>MARRIED</option>
        <option>WIDOWED</option>
        <option>LEGALLY SEPARATED</option>
      </select>

      <label>Age *</label>
    <input type="number" name="personal_age" required>

    <label>Country of Birth *</label>
    <input type="text" name="personal_country_birth" required>

    <label>Nationality *</label>
    <input type="text" name="personal_nationality" required>

    <label>Country of Residence *</label>
    <input type="text" name="personal_residence">

    <label>Primary Address *</label>
    <input type="text" name="personal_address" required>

      <label>Mobile or Residence Number (Please include + area code) *</label>
      <input type="text" name="personal_contact" required>

      <label>TIN *</label>
    <input type="text" name="personal_tin" required>

    <label>Religion *</label>
    <input type="text" name="personal_religion" required>

    <label>Hobbies *</label>
    <input type="text" name="personal_hobbies">

      <label>Spouse/Partner's Name (Surname, Given Name, Middle Name) *</label>
      <input type="text" name="personal_spouse">

      <label>Dependents (Name & Age) *</label>
      <textarea name="personal_dependents" required></textarea>
    </div>

    <!-- PROFESSIONAL BACKGROUND -->
    <div class="card">
      <div class="section-title">Professional Background</div>

      <p> As part of our franchise application process, we would like to get to know you better. Please 
      provide details about your <b>personal background, professional experience, and business 
      interests.</b> This will help us understand your qualifications, entrepreneurial mindset, and 
      alignment with <b>Kape-Ilokano Cafe’s</b> vision of promoting Ilokano coffee culture.</p>


      <label>Educational Attainment *</label>
      <select name="professional_education"required>
        <option>College</option>
        <option>Post Graduate</option>
      </select>

      <label>School Attended & Year *</label>
      <input type="text" name="professional_school"required>

      <label>Employment *</label>
      <select name="professional_employment"required>
        <option>Employed</option>
        <option>Self Employed</option>
      </select>

      <label>Present Occupation & Position *</label>
      <select name="professional_occupation"required>
        <option>Proprietor</option>
        <option>Supervisor</option>
        <option>Rank and File Employee</option>
      </select>

      <label>Job Title / Description *</label>
      <input type="text" name="professional_job_title" required>

      <label>Name of Company / Business *</label>
      <input type="text" name="professional_company" required>

      <label>Number of Years in the Company/Business *</label>
      <input type="text" name="professional_years" required>

      <label>Company / Business Address *</label>
      <input type="text" name="professional_company_address" required>

      <label>Responsibilities *</label>
      <textarea id="description" name="professional_responsibilities" required></textarea>


      <label>Nature of Business *</label>
      <input type="text" name="professional_business_nature">

      <label>Company Contact Number *</label>
      <input type="text" name="professional_company_contact" required>
    </div>

    <!-- BUSINESS BACKGROUND -->
    <div class="card">
      <div class="section-title">Business Background</div>

      <p> We would also like to know if you have any <b>prior experience in running a business,</b> 
      particularly in the food and beverage industry or related fields. <br><br>
     Understanding your background will help us assess how we can best support and guide you 
      in building a thriving business with <b>Kape-Ilokano Cafe Corporation.</b></p>

      <label>Do you have business experience in the Philippines *</label>
      <select name="business_experience" required>
        <option>yes</option>
        <option>no</option>
      </select>

      <label>Name of Business *</label>
      <input type="text" name="business_name">

      <label>Years of Experience *</label>
      <input type="text" name="business_years">

      <label>Business Industry *</label>
      <input type="text" name="business_industry">

      <label>Have you ever <b>closed or discontinued</b> a business? *</label>
      <select name="business_closed">
        <option>yes</option>
        <option>no</option>
      </select>

      <label>If yes, we’d appreciate it if you could share the reasons behind the closure. This
      helps us understand your entrepreneurial journey and how we can better support
      you in your Kape-Ilokano Cafe franchise. *</label>
      <textarea name="business_closure_reason" required></textarea>


      <label> Kindly share details about your past or current ventures, your role in managing
      them, and how your experience can contribute to the success of your Kape
      Ilokano Cafe franchise. *</label>
      <textarea name="business_venture_description" required></textarea>

    </div>

    <!-- KAPE-ILOKANO BACKGROUND -->
    <div class="card">
      <div class="section-title">Kape-Ilokano Background</div>

      <p> We’d like to understand your background and experience with Kape-Ilokano—whether as a 
      coffee enthusiast, a business owner, or someone who shares our passion for promoting 
      Ilokano culture. This helps us assess how we can best support you in your franchising 
      journey.</p>

      <label>Have you been a customer of Kape-Ilokano Cafe? *</label>
      <select name="ki_customer">
        <option>yes</option>
        <option>no</option>
      </select>

      <label>Are you affiliated with any Kape-Ilokano Cafe Branch?  *</label>
      <select name="ki_affiliated">
        <option>yes</option>
        <option>no</option>
      </select>

      <label> If Yes, kindly state which Branch or Person you are connected to. *</label>
      <input type="text" name="ki_affiliated_details">

      <label>Do you have an existing coffee shop business?</label>
      <select name="ki_has_coffee_shop"><option>yes</option><option>no</option></select>

      <label>Do you have knowledge in Coffee Industry?</label>
      <select name="ki_industry_knowledge"><option>yes</option><option>no</option></select>

      <label>Do you have passion for Coffee?</label>
      <select name="ki_passion"><option>yes</option><option>no</option></select>

      <label>How eager are you to have your own cafe business? (Rate it from 1 to 10. 10 is
      the highest, 1 is the lowest.)</label>
      <input type="number" name="ki_eagerness" min="1" max="10">
    </div>

    <!-- BUSINESS PROPOSAL -->
    <div class="card">
      <div class="section-title">Business Partnership Proposal</div>

      <p> We’d like to understand your Business plan for Kape-Ilokano—your vision, target market, and 
      location preferences. This helps us evaluate alignment with our brand values and determine 
      how we can best support you in building a successful franchise</p>

      <label>Target Location (Please indicate the complete address) *</label>
      <input type="text" name="proposal_location" required>

      <label>What is your main reason for considering a Kape-Ilokano Cafe Franchise? *</label>
      <textarea name="proposal_reason" required></textarea>


      <label> What are your expectations in having a Kape-Ilokano Cafe Franchise? *</label>
      <textarea name="proposal_expectations" required></textarea>


      <label> To what extent will you be involved in the day-to-day operations of the franchised
      branch? *</label>
      <textarea name="proposal_involvement" required></textarea>


      <label>What is your management Philosophy *</label>
      <textarea name="proposal_philosophy" required></textarea>
      <label>Other business interests *</label>
      <textarea name="proposal_interests" required></textarea>

      <label><b>Socio-civic Affiliations</b> (E.g. Rotary, Lions, Freemason, Others, Etc.) Name 
      Years in Membership *</label>
      <textarea name="proposal_affiliations" required></textarea>
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
      <input type="text" name="financial_investment" required>

      <label>Expected daily sales *</label>
      <input type="text" name="financial_expected_sales" required>

      <label>Expected ROI timeline *</label>
      <input type="text" name="financial_roi" required>
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
      <textarea name="references" placeholder="Name / Contact / Email"></textarea>
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
        <input type="checkbox" name="consent_final" required> I hereby acknowledge and agree.
      </div>

      <label>Picture of Government Issued Valid ID with 3 Specimen Signature *</label>
      <input type="file" name="government_id" multiple>

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
      {{-- <div class="checkbox-row">
        <input type="checkbox" name="consent_final" required>  I Hereby Acknowledge and Agree.
      </div> --}}
    </div>

        <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">
        <button type="button" id="previewBtn" class="btn ghost">Preview Application</button>
        <button type="submit" class="btn">Submit Application</button>
    </div>




  </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- PREVIEW MODAL -->
<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-scrollable">
    <div class="modal-content" style="border-radius:12px;">
      
      <div class="modal-header" style="background:#0d3553; color:white;">
        <h5 class="modal-title">Application Preview</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="previewContent" style="font-size:15px; line-height:1.6;">
        <!-- Preview content inserts here -->
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn">Submit Application</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>
