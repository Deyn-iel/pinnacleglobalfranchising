
document.addEventListener("DOMContentLoaded", () => {

    const refsContainer = document.getElementById('refs');
    const addRefBtn = document.getElementById('addRef');
    const previewBtn = document.getElementById('previewBtn');
    const previewContent = document.getElementById('previewContent');
    const form = document.getElementById('franchiseForm');

    // Bootstrap modal instance
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));

    function addRefRow(name = '', contact = '') {
        const row = document.createElement('div');
        row.className = 'ref-row';
        row.innerHTML = `
            <input placeholder="Reference name" class="ref-name" value="${escapeHtml(name)}" />
            <input placeholder="Contact info" class="ref-contact" value="${escapeHtml(contact)}" />
            <button type="button" class="btn ghost removeRef">Remove</button>
        `;
        row.querySelector('.removeRef').addEventListener('click', () => row.remove());
        refsContainer.appendChild(row);
    }

    addRefBtn?.addEventListener('click', () => addRefRow());

    previewBtn?.addEventListener('click', () => {
        const data = collectForm();
        if (!data) return;

        previewContent.innerHTML =
            `<strong style='font-size:18px;'>${escapeHtml(data.company)}</strong><br>` +
            `<div class="small text-muted mt-1">Contact: ${escapeHtml(data.contactName)} • ${escapeHtml(data.phone)} • ${escapeHtml(data.email)}</div><hr>` +
            `<div><b>Location:</b> ${escapeHtml(data.location)}</div>` +
            `<div><b>Model:</b> ${escapeHtml(data.model)}</div>` +
            `<div><b>Investment:</b> ${escapeHtml(data.investment)}</div><hr>` +
            `<div><strong>Description</strong><p>${escapeHtml(data.description)}</p></div>` +
            `<div><strong>References</strong><ul>${data.references.map(r =>
                `<li>${escapeHtml(r.name)} — ${escapeHtml(r.contact)}</li>`
            ).join('')}</ul></div>` +
            `<div class="small text-muted"><b>Files uploaded:</b> ${data.files.length}</div>`;

        previewModal.show();
    });

    form?.addEventListener('submit', e => {
        e.preventDefault();
        const data = collectForm();
        if (!data) return;

        alert("Application submitted! (Mock)");
        console.log("SUBMITTED DATA:", data);

        form.reset();
        refsContainer.innerHTML = '';
        addRefRow();
        previewModal.hide();
    });

    function collectForm() {
        const company = document.getElementById('company')?.value.trim();
        const contactName = document.getElementById('contactName')?.value.trim();
        const phone = document.getElementById('phone')?.value.trim();
        const email = document.getElementById('email')?.value.trim();
        const location = document.getElementById('location')?.value.trim();
        const model = document.getElementById('model')?.value;
        const investment = document.getElementById('investment')?.value;
        const description = document.getElementById('description')?.value.trim();
        const agree = document.getElementById('agree')?.checked;

        if (!company || !contactName || !phone || !email || !location || !model || !investment || !description) {
            alert("Please complete all required fields.");
            return null;
        }
        if (!agree) {
            alert("Please confirm agreement to terms.");
            return null;
        }

        const files = Array.from(document.getElementById('docs')?.files || [])
            .map(f => ({ name: f.name, size: f.size, type: f.type }));

        const references = Array.from(refsContainer.querySelectorAll('.ref-row')).map(r => ({
            name: r.querySelector('.ref-name')?.value.trim(),
            contact: r.querySelector('.ref-contact')?.value.trim()
        })).filter(r => r.name || r.contact);

        return { company, contactName, phone, email, location, model, investment, description, files, references };
    }

    function escapeHtml(str) {
        return String(str || '').replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        }[m]));
    }

    refsContainer.innerHTML = "";
    addRefRow();

});

