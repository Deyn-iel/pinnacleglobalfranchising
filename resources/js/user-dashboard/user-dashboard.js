document.addEventListener("DOMContentLoaded", () => {

    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menuBtn");
    const closeSidebar = document.getElementById("closeSidebar");
    const loginOverlay = document.getElementById("loginOverlay");
    const timeText = document.getElementById("loginTimeText");
    const alert = document.getElementById("alertError");

    const justLoggedIn = document.body.dataset.justLoggedIn === "1";

    /* ================= LOGIN OVERLAY ================= */
    if (loginOverlay) {

        // reset flags ONLY after real login
        if (justLoggedIn) {
            localStorage.removeItem("hasLoggedIn");
            localStorage.removeItem("loginTime");
        }

        if (!localStorage.getItem("hasLoggedIn")) {

            loginOverlay.style.display = "flex";

            setTimeout(() => {
                loginOverlay.classList.add("fade-out");
            }, 1800);

            setTimeout(() => {
                loginOverlay.style.display = "none";
                loginOverlay.classList.remove("fade-out");
                localStorage.setItem("hasLoggedIn", "true");
            }, 2600);

        } else {
            loginOverlay.style.display = "none";
        }
    }

    /* ================= ALERT FADE ================= */
    if (alert) {
        setTimeout(() => {
            alert.classList.add("fade-out");
            setTimeout(() => alert.remove(), 600);
        }, 5000);
    }

    /* ================= SIDEBAR ================= */
    if (menuBtn && sidebar) {
        menuBtn.onclick = () => sidebar.classList.toggle("show");
    }

    if (closeSidebar && sidebar) {
        closeSidebar.onclick = () => sidebar.classList.remove("show");
    }

    /* ================= LOGIN TIME ================= */
    if (!localStorage.getItem("loginTime")) {
        localStorage.setItem("loginTime", Date.now());
    }

    function timeAgo(diff) {
        const units = [
            { label: "day", secs: 86400 },
            { label: "hr", secs: 3600 },
            { label: "min", secs: 60 }
        ];

        for (const unit of units) {
            const value = Math.floor(diff / unit.secs);
            if (value >= 1) {
                return `${value} ${unit.label}${value > 1 ? "s" : ""} ago`;
            }
        }

        return "Just now";
    }

    function updateLoginTime() {
        if (!timeText) return;

        const loginTime = parseInt(localStorage.getItem("loginTime"));
        if (!loginTime) return;

        const diff = Math.floor((Date.now() - loginTime) / 1000);
        timeText.textContent = timeAgo(diff);
    }

    updateLoginTime();
    setInterval(updateLoginTime, 60000);
});

/* ================= LOGOUT ================= */
window.handleLogout = function (event) {
    event.preventDefault();

    localStorage.removeItem("hasLoggedIn");
    localStorage.removeItem("loginTime");

    setTimeout(() => {
        event.target.submit();
    }, 300);
};

// /* ================= DOM ELEMENTS ================= */
// document.addEventListener("DOMContentLoaded", () => {

//     const sidebar = document.getElementById("sidebar");
//     const menuBtn = document.getElementById("menuBtn");
//     const closeSidebar = document.getElementById("closeSidebar");
//     const loginOverlay = document.getElementById("loginOverlay");
//     const timeText = document.getElementById("loginTimeText");
//     const alert = document.getElementById("alertError");

//     if (alert) {
//         // wait 5 seconds
//         setTimeout(() => {
//             alert.classList.add("fade-out");

//             // remove completely after animation
//             setTimeout(() => {
//                 alert.remove();
//             }, 600);
//         }, 5000);
//     }
//     /* ================= SIDEBAR TOGGLE (MOBILE) ================= */
//     if (menuBtn && sidebar) {
//         menuBtn.onclick = () => sidebar.classList.toggle("show");
//     }

//     if (closeSidebar && sidebar) {
//         closeSidebar.onclick = () => sidebar.classList.remove("show");
//     }

//     /* ================= LOGIN ANIMATION ================= */
//     /*
//       Lalabas lang:
//       - kapag bagong login
//       Hindi lalabas:
//       - kapag refresh
//     */
//     if (loginOverlay) {
//         if (localStorage.getItem("hasLoggedIn")) {
//             loginOverlay.style.display = "none";
//         } else {
//             // show overlay first
//             loginOverlay.style.display = "flex";

//             // start fade after delay
//             setTimeout(() => {
//                 loginOverlay.classList.add("fade-out");
//             }, 2000);

//             // hide completely after fade
//             setTimeout(() => {
//                 loginOverlay.style.display = "none";
//                 localStorage.setItem("hasLoggedIn", "true");
//             }, 2800);
//         }
//     }

//     /* ================= LOGIN TIME TRACKER ================= */

//     // save login time ONCE per login
//     if (!localStorage.getItem("loginTime")) {
//         localStorage.setItem("loginTime", Date.now());
//     }

//     function updateLoginTime() {
//         const loginTime = parseInt(localStorage.getItem("loginTime"));
//         if (!loginTime || !timeText) return;

//         const now = Date.now();
//         const diff = Math.floor((now - loginTime) / 1000);

//         if (diff < 60) {
//             timeText.textContent = "Just now";
//         } else if (diff < 3600) {
//             const mins = Math.floor(diff / 60);
//             timeText.textContent = `${mins} min${mins > 1 ? "s" : ""} ago`;
//         } else if (diff < 86400) {
//             const hrs = Math.floor(diff / 3600);
//             timeText.textContent = `${hrs} hr${hrs > 1 ? "s" : ""} ago`;
//         } else {
//             const days = Math.floor(diff / 86400);
//             timeText.textContent = `${days} day${days > 1 ? "s" : ""} ago`;
//         }
//     }

//     // run immediately & every minute
//     updateLoginTime();
//     setInterval(updateLoginTime, 60000);

// });

// /* ================= LOGOUT HANDLER (ONLY ONE) ================= */
// function handleLogout(event) {
//     event.preventDefault();

//     const form = event.target;
//     const logoutItem = form.closest(".logout-item");

//     // optional fade on logout button
//     if (logoutItem) {
//         logoutItem.classList.add("fading");
//     }

//     // 🔥 CLEAR ALL LOGIN FLAGS
//     localStorage.removeItem("hasLoggedIn");
//     localStorage.removeItem("loginTime");

//     // submit after small delay
//     setTimeout(() => {
//         form.submit();
//     }, 300);
// }