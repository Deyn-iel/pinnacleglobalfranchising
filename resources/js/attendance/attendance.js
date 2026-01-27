document.addEventListener('DOMContentLoaded', () => {

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

function getLocation() {
    return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
            reject('Geolocation not supported');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            position => {
                resolve({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                    accuracy: position.coords.accuracy
                });
            },
            error => reject(error.message),
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    });
}


/* =========================
   📤 SUBMIT ATTENDANCE
========================= */
async function submitAttendance(type) {
    if (!capturedBlob) {
        alert('Capture selfie first');
        return;
    }

    let location;
    try {
        location = await getLocation();
    } catch (e) {
        alert('Location permission is required');
        return;
    }

    const fd = new FormData();
    fd.append('type', type);
    fd.append('selfie', capturedBlob, 'selfie.jpg');
    fd.append('lat', location.lat);
    fd.append('lng', location.lng);
    fd.append('accuracy', location.accuracy);

    fetch('/attendance/log', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]').content
    },
    body: fd
})
.then(async res => {
    const data = await res.json();
    if (!res.ok) throw data;
    return data;
})
.then(data => {
    timeDisplay.innerText = data.message;

    timeDisplay.classList.remove('error');
    timeDisplay.classList.add('success', 'show');

    resetAfterSubmit(); // 🔥 auto reset
})
.catch(err => {
    timeDisplay.innerText = err.message || 'Attendance failed';

    timeDisplay.classList.remove('success');
    timeDisplay.classList.add('error', 'show');

    clearTimeout(messageTimer);
    messageTimer = setTimeout(() => {
        timeDisplay.classList.remove('show');
    }, 5000);
});


}

function resetAfterSubmit() {
    // ❌ remove previous capture
    capturedBlob = null;

    // 🧼 reset canvas
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    canvas.hidden = true;

    // 🎥 force video preview back
    if (currentStream) {
        video.srcObject = currentStream; // 🔥 important
        video.play();
        video.style.display = 'block';
    }

    placeholder.style.display = 'none';

    // 🕒 auto-hide message
    clearTimeout(messageTimer);
    messageTimer = setTimeout(() => {
        timeDisplay.classList.remove('show', 'success', 'error');
    }, 5000);
}

    // expose functions to global scope
    window.startCamera = startCamera;
    window.capturePhoto = capturePhoto;
    window.submitAttendance = submitAttendance;
});
