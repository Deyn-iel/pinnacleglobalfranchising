import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/**
 * Toggle password visibility
 */
window.togglePassword = function () {
    const pass = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');

    if (!pass || !eye) return; // safety check

    const isHidden = pass.type === 'password';
    pass.type = isHidden ? 'text' : 'password';

    eye.innerHTML = isHidden
        ? `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 0 1 1.562-3.033M6.1 6.1A9.99 9.99 0 0 1 12 4c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 0 1-4.245 5.318"/>
            <line x1="1" y1="1" x2="23" y2="23"></line>
          `
        : `
            <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          `;
};

/**
 * Auto-hide error alert
 */
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const alert = document.querySelector('.custom-alert-error');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }, 6000);
});
