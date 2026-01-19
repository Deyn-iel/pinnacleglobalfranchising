document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector("form");
    const previewBtn = document.getElementById("previewBtn");
    const previewContent = document.getElementById("previewContent");

    const previewModal = new bootstrap.Modal(
        document.getElementById("previewModal")
    );

    // ============================
    // PREVIEW BUTTON
    // ============================
    previewBtn.addEventListener("click", () => {

        // 1️⃣ CHECK REQUIRED FIELDS
        const invalidField = checkRequiredFields(form);
        if (invalidField) {
            alert("⚠ Please complete all required fields before previewing.");
            invalidField.focus();
            invalidField.scrollIntoView({ behavior: "smooth", block: "center" });
            return;
        }

        // 2️⃣ COLLECT DATA
        const data = collectFormData(form);

        // 3️⃣ BUILD PREVIEW HTML (SECTIONED)
        let html = "";

        Object.entries(data).forEach(([section, fields]) => {
            html += `
                <div style="margin-bottom:24px;">
                    <h5 style="border-bottom:2px solid #0d3553; padding-bottom:6px;">
                        ${escapeHtml(section)}
                    </h5>
            `;

            fields.forEach(item => {
                if (Array.isArray(item.value)) {
                    html += `
                        <div style="margin:10px 0;">
                            <strong>${escapeHtml(item.label)}</strong>
                            <ul>
                                ${item.value.map(v => `<li>${escapeHtml(v)}</li>`).join("")}
                            </ul>
                        </div>
                    `;
                } else {
                    html += `
                        <div style="margin:8px 0;">
                            <strong>${escapeHtml(item.label)}:</strong><br>
                            <span>${escapeHtml(item.value)}</span>
                        </div>
                    `;
                }
            });

            html += `</div>`;
        });

        previewContent.innerHTML = html;

        // 4️⃣ SHOW MODAL
        previewModal.show();
    });

    // ============================
    // CHECK REQUIRED FIELDS
    // ============================
    function checkRequiredFields(form) {
        const requiredFields = form.querySelectorAll("[required]");

        for (const field of requiredFields) {
            if (field.type === "checkbox" && !field.checked) return field;
            if (field.type === "file" && field.files.length === 0) return field;
            if (
                field.type !== "checkbox" &&
                field.type !== "file" &&
                field.value.trim() === ""
            ) return field;
        }
        return null;
    }

    // ============================
    // COLLECT FORM DATA (GROUPED)
    // ============================
    function collectFormData(form) {

        const elements = Array.from(form.elements);
        const previewData = {};

        for (const el of elements) {

            if (
                !el.name ||
                el.type === "submit" ||
                el.type === "button" ||
                el.type === "hidden"
            ) continue;

            const section =
                el.closest(".card")?.querySelector(".section-title")?.innerText ||
                "General Information";

            if (!previewData[section]) {
                previewData[section] = [];
            }

            let value = "";

            // CHECKBOX
            if (el.type === "checkbox") {
                value = el.checked ? "Yes" : "No";
            }

            // FILE INPUT
            else if (el.type === "file") {
                value = Array.from(el.files).map(f => f.name);
            }

            // NORMAL INPUT
            else if (el.value.trim() !== "") {
                value = el.value.trim();
            } else {
                continue;
            }

            previewData[section].push({
                label: formatLabel(el.name),
                value
            });
        }

        return previewData;
    }

    // ============================
    // HELPERS
    // ============================
    function formatLabel(name) {
        return name
            .replace(/_/g, " ")
            .replace(/\b\w/g, c => c.toUpperCase());
    }

    function escapeHtml(str) {
        return String(str || "").replace(/[&<>"']/g, m => ({
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;"
        }[m]));
    }

});

setTimeout(() => {
    const alert = document.querySelector('.alert.auto-hide');
    if (!alert) return;

    // smooth hide (CSS-based)
    alert.classList.add('hide');

    // remove element completely after animation
    setTimeout(() => {
        alert.remove();
    }, 650); // match CSS transition
}, 4000);



