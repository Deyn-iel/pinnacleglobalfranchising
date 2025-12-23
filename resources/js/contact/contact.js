document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");
    if (!form) return;

    const successMsg = document.getElementById("successMsg");

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
});
