const checkbox = document.getElementById("confirmCheck");
const button = document.getElementById("proceedBtn");

checkbox.addEventListener("change", () => {
    const isChecked = checkbox.checked;

    button.classList.toggle("active", isChecked);
    button.classList.toggle("disabled", !isChecked);
});

button.addEventListener("click", (e) => {
    if (button.classList.contains("disabled")) {
        e.preventDefault();
    }
});