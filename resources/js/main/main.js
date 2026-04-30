AOS.init({
    once: false,
    offset: 100,
    easing: "ease-out-back",
});

document.addEventListener("DOMContentLoaded", () => {
    const animatedElements = document.querySelectorAll(
        ".image, .franchise-brands-section, .franchise-section, .circle-box, .franchise-now-container, .franchise-steps, .step, .franchise-now-button-wrapper, .brand-name, .brand-desc",
    );

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-show");
                    obs.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px",
        },
    );

    animatedElements.forEach((element) => observer.observe(element));

    /**
     * MOBILE CLICK EFFECT FOR CIRCLE BUTTONS
     * Button appears only after tapping the circle on mobile/tablet.
     */
    const isTouchDevice = window.matchMedia("(hover: none)").matches;

    if (isTouchDevice) {
        const circleBoxes = document.querySelectorAll(".circle-box");

        circleBoxes.forEach((box) => {
            box.addEventListener("click", function (event) {
                const clickedButton = event.target.closest(".circle-btn");

                if (clickedButton) {
                    return;
                }

                circleBoxes.forEach((otherBox) => {
                    if (otherBox !== box) {
                        otherBox.classList.remove("mobile-active");
                    }
                });

                box.classList.toggle("mobile-active");
            });
        });

        document.addEventListener("click", function (event) {
            const clickedInsideCircle = event.target.closest(".circle-box");

            if (!clickedInsideCircle) {
                circleBoxes.forEach((box) => {
                    box.classList.remove("mobile-active");
                });
            }
        });
    }
});
