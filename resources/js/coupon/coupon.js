document.addEventListener("DOMContentLoaded", () => {

    /* fade danger + success alerts */
    const alerts = document.querySelectorAll('.alert-danger-custom, .alert-success-custom');

    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('alert-hide');

            setTimeout(() => {
                alert.remove();
            }, 500);

        }, 3000);
    });

    /* loading animation on claim coupon submit */
    const claimForm = document.querySelector('form[action*="coupon/claim"]');

    if(claimForm){
        claimForm.addEventListener('submit', function(){

            const btn = claimForm.querySelector('button[type="submit"]');

            if(btn){
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Processing...';
            }

        });
    }

});


const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("sidebarOverlay");
const menuBtn = document.getElementById("menuToggleBtn");
const mainContent = document.getElementById("mainContent");
const closeBtn = document.getElementById("closeSidebarBtn");

if (closeBtn) {
    closeBtn.addEventListener("click", closeSidebar);
}

function openSidebar() {
    sidebar.classList.remove("mobile-closed");
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeSidebar() {
    sidebar.classList.add("mobile-closed");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
}

function toggleSidebar() {
    if (sidebar.classList.contains("mobile-closed")) {
        openSidebar();
    } else {
        closeSidebar();
    }
}

function handleResize() {
    if (window.innerWidth > 967) {
        sidebar.classList.remove("mobile-closed");
        overlay.classList.remove("active");
        document.body.style.overflow = "";
        mainContent.classList.remove("expanded");
    } else {
        sidebar.classList.add("mobile-closed");
        mainContent.classList.add("expanded");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    handleResize();

    if (menuBtn) {
        menuBtn.addEventListener("click", toggleSidebar);
    }

    if (overlay) {
        overlay.addEventListener("click", closeSidebar);
    }

    window.addEventListener("resize", handleResize);

    const codeInput = document.querySelector('input[name="unique_code"]');
    if (codeInput) {
        codeInput.addEventListener('input', function () {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 8);
        });
    }
});