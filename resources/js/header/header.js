document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const sections = document.querySelectorAll(".nav-section");
    const links = document.querySelectorAll(".nav-menu a");

    if (!toggle || !navMenu) return;

    toggle.addEventListener("click", (e) => {
        e.stopPropagation();

        navMenu.classList.toggle("show");   // existing behavior
        navMenu.classList.toggle("open");   // animation class
        toggle.classList.toggle("active");

        document.documentElement.classList.toggle("nav-open");
        document.body.classList.toggle("nav-open");
    });

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

    document.addEventListener("click", () => {
        sections.forEach(section => section.classList.remove("open"));
    });

});
