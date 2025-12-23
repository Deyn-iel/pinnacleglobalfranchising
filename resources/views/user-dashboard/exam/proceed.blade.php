<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Exam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/proceed/app.css' ,
            
            // js files
            'resources/js/proceed/app.js'
            ])

</head>

<body>

<div class="confirm-container">
    <div class="confirm-header">
        <h1>Confirm Before Exam</h1>
        <p>
        <i class="fas fa-exclamation-triangle" style="color:#9e0000; margin-right:6px;"></i>
        Please read and confirm before proceeding
        </p>

    </div>

    <div class="rules">
        <p>• After the exam begins, pausing, exiting, or refreshing the page is not permitted.</p>
        <p>• Screenshots, screen recording, and tab switching are not allowed.</p>
        <p>• Opening a new tab or attempting to switch tabs will automatically submit your exam.</p>
        <p>• This exam allows a maximum of one attempt only. Please ensure that all answers are final.</p>
        <p>• Your exam will be automatically submitted when time expires.</p>
        <p>• Right-clicking the mouse on a PC or laptop will automatically submit your exam.</p>
        <p>• Once you proceed to the next question, you will no longer be able to change your previous answer.</p>
        <p>• Any violation may result in disqualification.</p>
    </div>

    <div class="confirm-check">
        <input type="checkbox" id="confirmCheck">
        <label for="confirmCheck">
            I have read and understood the rules and agree to proceed with the exam.
        </label>
    </div>
    <a href="{{ route('exam.select') }}" id="proceedBtn" class="confirm-btn disabled">
        Proceed to Exam
    </a>


    <div class="confirm-footer">
        Secure Online Examination System
    </div>
</div>

<script>



</script>


</body>
</html>
