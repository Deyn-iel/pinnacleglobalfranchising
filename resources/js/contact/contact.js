document.addEventListener("DOMContentLoaded", () => {

    /* ===== CONTACT FORM ===== */
    const form = document.getElementById("contactForm");
    const successMsg = document.getElementById("successMsg");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action || window.location.href, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    form.reset();
                    successMsg.textContent = "✔ " + data.message;
                    successMsg.style.display = "block";
                    successMsg.style.opacity = "1";

                    setTimeout(() => {
                        successMsg.style.opacity = "0";
                        setTimeout(() => {
                            successMsg.style.display = "none";
                        }, 600);
                    }, 3000);
                }
            })
            .catch(() => {
                alert("Something went wrong. Please try again.");
            });
        });
    }

    /* ===== OFFICE HOURS DROPDOWN (FIXED) ===== */
    const hoursBtn = document.querySelector(".hours-btn");
    const hoursMenu = document.querySelector(".hours-menu");
    const arrow = document.querySelector(".arrow");

    if (hoursBtn && hoursMenu && arrow) {
        hoursBtn.addEventListener("click", () => {
            hoursMenu.classList.toggle("show");
            arrow.classList.toggle("rotate");
        });
    }

});
