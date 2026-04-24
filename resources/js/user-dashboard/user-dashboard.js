document.addEventListener("DOMContentLoaded", () => {

    const sidebar      = document.getElementById("sidebar");
    const menuBtn      = document.getElementById("menuBtn");
    const closeSidebar = document.getElementById("closeSidebar");
    const loginOverlay = document.getElementById("loginOverlay");
    const timeText     = document.getElementById("loginTimeText");
    const alert = document.getElementById("alertError");

    if (alert) {
        setTimeout(() => {
            alert.classList.add("fade-out");

            setTimeout(() => {
                alert.remove();
            }, 600);
        }, 5000);
    }

    const isFirstLoad = sessionStorage.getItem("welcomeShown") !== "true";

    if (loginOverlay) {

        if (isFirstLoad) {
            sessionStorage.setItem("welcomeShown", "true");

            if (!localStorage.getItem("loginTime")) {
                localStorage.setItem("loginTime", Date.now());
            }

            loginOverlay.style.display = "flex";

            setTimeout(() => {
                loginOverlay.classList.add("fade-out");
            }, 1500);

            setTimeout(() => {
                loginOverlay.style.display = "none";
                loginOverlay.classList.remove("fade-out");
            }, 2300);

        } else {
            loginOverlay.style.display = "none";
        }
    }

    if (menuBtn && sidebar) {
        menuBtn.addEventListener("click", () => {
            sidebar.classList.toggle("show");
        });
    }

    if (closeSidebar && sidebar) {
        closeSidebar.addEventListener("click", () => {
            sidebar.classList.remove("show");
        });
    }

        function timeAgo(seconds) {
        if (seconds < 60) return "Just now";

        if (seconds < 3600) {
            const mins = Math.floor(seconds / 60);
            return `${mins} min${mins !== 1 ? "s" : ""} ago`;
        }

        if (seconds < 86400) {
            const hrs = Math.floor(seconds / 3600);
            return `${hrs} hr${hrs !== 1 ? "s" : ""} ago`;
        }

        const days = Math.floor(seconds / 86400);
        return `${days} day${days !== 1 ? "s" : ""} ago`;
    }


    function updateLoginTime() {
        if (!timeText) return;

        const loginTime = localStorage.getItem("loginTime");
        if (!loginTime) return;

        const diff = Math.floor((Date.now() - loginTime) / 1000);
        timeText.textContent = timeAgo(diff);
    }

    updateLoginTime();
    setInterval(updateLoginTime, 60000);
});

window.handleLogout = function () {
    sessionStorage.clear();
    localStorage.removeItem("loginTime");
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

//     localStorage.removeItem("hasLoggedIn");
//     localStorage.removeItem("loginTime");

//     // submit after small delay
//     setTimeout(() => {
//         form.submit();
//     }, 300);
// }