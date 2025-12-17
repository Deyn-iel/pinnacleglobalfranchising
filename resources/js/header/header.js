document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const sections = document.querySelectorAll(".nav-section");
    const links = document.querySelectorAll(".nav-menu a");

    if (!toggle || !navMenu) return;

    /* ===============================
       TOGGLE NAV (MOBILE + TABLET)
    =============================== */
    toggle.addEventListener("click", (e) => {
        e.stopPropagation();

        navMenu.classList.toggle("show");   // existing behavior
        navMenu.classList.toggle("open");   // animation class
        toggle.classList.toggle("active");

        document.documentElement.classList.toggle("nav-open");
        document.body.classList.toggle("nav-open");
    });

    /* ===============================
       DROPDOWN SECTIONS
    =============================== */
    sections.forEach(section => {
        const title = section.querySelector(".nav-section-title");
        if (!title) return;

        title.addEventListener("click", (e) => {
            e.stopPropagation();

            sections.forEach(s => {
                if (s !== section) s.classList.remove("open");
            });

            section.classList.toggle("open");
        });
    });

    /* ===============================
       AUTO CLOSE ON LINK CLICK
    =============================== */
    links.forEach(link => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 1024) {
                navMenu.classList.remove("show", "open");
                toggle.classList.remove("active");

                document.documentElement.classList.remove("nav-open");
                document.body.classList.remove("nav-open");

                sections.forEach(section => section.classList.remove("open"));
            }
        });
    });

    /* ===============================
       CLOSE WHEN CLICKING OUTSIDE
    =============================== */
    document.addEventListener("click", () => {
        sections.forEach(section => section.classList.remove("open"));
    });

});
