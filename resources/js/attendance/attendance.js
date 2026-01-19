const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const placeholder = document.getElementById('placeholder');
const timeDisplay = document.getElementById('timeDisplay');

let messageTimer = null;
let currentStream = null;
let capturedBlob = null;

/* =========================
   🎥 START CAMERA
========================= */
function startCamera() {
    navigator.mediaDevices.getUserMedia({
        video: { facingMode: "user" },
        audio: false
    })
    .then(stream => {
        currentStream = stream;
        video.srcObject = stream;
        video.play();

        placeholder.style.display = 'none';
        video.style.display = 'block';
        canvas.hidden = true;
    })
    .catch(err => {
        alert('Camera access denied');
        console.error(err);
    });
}

/* =========================
   📸 CAPTURE PHOTO (FIXED)
========================= */
function capturePhoto() {
    if (!currentStream) {
        alert('Open camera first');
        return;
    }

    video.style.display = 'block';
    canvas.hidden = true;

    if (video.videoWidth === 0) {
        alert('Camera not ready yet. Please try again.');
        return;
    }

    const ctx = canvas.getContext('2d');

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;

    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // ✅ SHOW CAPTURED IMAGE
    video.style.display = 'none';
    canvas.hidden = false;


    canvas.toBlob(blob => {
    capturedBlob = blob;

    timeDisplay.innerText = 'Selfie captured successfully ✓';

    // reset classes
    timeDisplay.classList.remove('success', 'error', 'show');
    timeDisplay.classList.add('success');

    // show
    requestAnimationFrame(() => {
        timeDisplay.classList.add('show');
    });

    // fade after 5 seconds
    clearTimeout(messageTimer);
messageTimer = setTimeout(() => {
    timeDisplay.classList.remove('show');
}, 5000);


}, 'image/jpeg', 0.95);

}

/* =========================
   📤 SUBMIT ATTENDANCE
========================= */
function submitAttendance(type) {
    if (!capturedBlob) {
        alert('Capture selfie first');
        return;
    }

    const fd = new FormData();
    fd.append('type', type);
    fd.append('selfie', capturedBlob, 'selfie.jpg');

    fetch('/attendance/log', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content
        },
        body: fd
    })
    .then(async res => {
        const text = await res.text();

        try {
            const data = JSON.parse(text);
            timeDisplay.innerText = data.message;

// reset classes
timeDisplay.classList.remove('success', 'error', 'show');

// set color based on message
if (data.message.includes('✓')) {
    timeDisplay.classList.add('success');
} else if (data.message.includes('!')) {
    timeDisplay.classList.add('error');
}

// show
requestAnimationFrame(() => {
    timeDisplay.classList.add('show');
});

// auto fade after 5 seconds
clearTimeout(messageTimer);
messageTimer = setTimeout(() => {
    timeDisplay.classList.remove('show');
}, 5000);


        } catch (e) {
            console.error('NON-JSON RESPONSE:', text);
            alert('Server error. Check console.');
        }

        // reset
        capturedBlob = null;
        canvas.hidden = true;
        video.style.display = 'block';
    })
    .catch(err => {
        console.error(err);
        alert('Failed to submit attendance');
    });
}