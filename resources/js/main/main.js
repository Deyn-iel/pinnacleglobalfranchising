
        AOS.init({
            once: false,   // animation plays every scroll
            offset: 100,   // trigger earlier
            easing: 'ease-out-back',
        });
        document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(
        ".image, .franchise-section, .circle-box, .franchise-now-container, .franchise-steps, .step, .franchise-now-button-wrapper, .brand-name, .brand-desc"
    );

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-show");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        }
    );

    elements.forEach(el => observer.observe(el));
});
document.addEventListener("DOMContentLoaded", () => {

    const animatedElements = document.querySelectorAll(
        ".image, .franchise-section, .circle-box, .franchise-now-container, .franchise-steps, .step, .franchise-now-button-wrapper, .brand-name, .brand-desc"
    );

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-show");
                obs.unobserve(entry.target); // animate once only
            }
        });
    }, {
        threshold: 0.15,           // show when 15% visible
        rootMargin: "0px 0px -50px 0px"
    });

    animatedElements.forEach(el => observer.observe(el));
});