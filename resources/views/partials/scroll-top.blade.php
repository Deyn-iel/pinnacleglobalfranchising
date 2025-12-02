<button class="scroll-to-top" id="scrollToTopBtn">
    <span>&#8593;</span>
</button>


<script>
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    window.addEventListener("scroll", () => {
        scrollToTopBtn.classList.toggle(
            "show",
            window.scrollY > 200 // smoother threshold
        );
    });

    scrollToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>
