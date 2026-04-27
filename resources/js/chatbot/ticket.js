history.scrollRestoration = "manual";
document.addEventListener("DOMContentLoaded", () => {
    const msg = localStorage.getItem("success");
    if (msg) {
        showSuccess(msg);
        localStorage.removeItem("success");

        window.scrollTo(0, 0);
    }

    // Tabs
    document.querySelectorAll(".tab").forEach((t) => {
        t.addEventListener("click", () => {
            document
                .querySelectorAll(".tab")
                .forEach((x) => x.classList.remove("active"));
            t.classList.add("active");
            applyFilters();
        });
    });

    // Inputs
    document
        .getElementById("searchInput")
        ?.addEventListener("input", applyFilters);

    // Desktop filters
    document
        .getElementById("departmentFilter")
        ?.addEventListener("change", applyFilters);
    document
        .getElementById("priorityFilter")
        ?.addEventListener("change", applyFilters);

    // Mobile filters mirror (departmentFilter_m / priorityFilter_m)
    document
        .getElementById("departmentFilter_m")
        ?.addEventListener("change", () => {
            syncMobileToDesktop();
            applyFilters();
        });
    document
        .getElementById("priorityFilter_m")
        ?.addEventListener("change", () => {
            syncMobileToDesktop();
            applyFilters();
        });

    // Success alert fade out
    const alert = document.getElementById("successAlert");
    if (alert) {
        setTimeout(() => alert.classList.remove("show"), 6500);
        setTimeout(() => alert.remove(), 7200);
    }

    applyFilters();
    setInterval(refreshTickets, 3000);
});

function syncMobileToDesktop() {
    const depM = document.getElementById("departmentFilter_m");
    const priM = document.getElementById("priorityFilter_m");
    const depD = document.getElementById("departmentFilter");
    const priD = document.getElementById("priorityFilter");

    // If desktop elements exist, keep value aligned
    if (depM && depD) depD.value = depM.value;
    if (priM && priD) priD.value = priM.value;
}

function activeStatus() {
    const tab = document.querySelector(".tab.active");
    return tab ? tab.getAttribute("data-status") || "" : "";
}

function applyFilters() {
    const q = (document.getElementById("searchInput")?.value || "")
        .trim()
        .toLowerCase();

    // Prefer desktop filters; if not available (or empty) use mobile ones
    const depD = (document.getElementById("departmentFilter")?.value || "")
        .trim()
        .toLowerCase();
    const priD = (document.getElementById("priorityFilter")?.value || "")
        .trim()
        .toLowerCase();
    const depM = (document.getElementById("departmentFilter_m")?.value || "")
        .trim()
        .toLowerCase();
    const priM = (document.getElementById("priorityFilter_m")?.value || "")
        .trim()
        .toLowerCase();

    const dep = depD || depM || "";
    const pri = priD || priM || "";

    const st = activeStatus();

    const items = document.querySelectorAll("#ticketList .ticket-item");
    let visible = 0;

    items.forEach((item) => {
        const tNo = item.dataset.ticketNo || "";
        const subj = (item.dataset.subject || "").toLowerCase();
        const desc = (item.dataset.description || "").toLowerCase();
        const tDep = item.dataset.department || "";
        const tPri = item.dataset.priority || "";
        const tSt = item.dataset.status || "";

        const matchesQuery =
            !q || tNo.includes(q) || subj.includes(q) || desc.includes(q);
        const matchesDep = !dep || tDep === dep;
        const matchesPri = !pri || tPri === pri;
        const matchesSt = !st || tSt === st;

        const show = matchesQuery && matchesDep && matchesPri && matchesSt;
        item.style.display = show ? "" : "none";
        if (show) visible++;
    });

    document.getElementById("visibleCount").textContent = visible;
}

window.openTicketDetails = function openTicketDetails(el) {
    const noEl = el.querySelector(".ticket-no");

    const ticketId = el.dataset.id;
    const subject = el.dataset.subject || "";
    const dept = el.dataset.department || "";
    const pri = el.dataset.priority || "";
    const badge = el.querySelector(".badge-status");
    const st = badge
        ? badge.innerText.trim().replace(" ", "_").toLowerCase()
        : "pending";

    const approvalRequested = el.dataset.approvalRequested == "1";

    const normalWrap = document.getElementById("normalStatusWrap");
    const approvalWrap = document.getElementById("approvalActionsWrap");

    // reset
    normalWrap.classList.remove("d-none");
    approvalWrap.classList.add("d-none");

    // if may approval request at resolved
    if (approvalRequested) {
        normalWrap.classList.add("d-none"); // hide dropdown
        approvalWrap.classList.remove("d-none"); // show buttons
    }

    document.getElementById("d_ticketNo").innerText = noEl?.innerText || "—";
    document.getElementById("d_subject").innerText = subject || "—";

    const visibleDesc = el.querySelector(".ticket-desc")?.innerText || "";
    document.getElementById("d_description").innerText = visibleDesc || "—";

    document.getElementById("d_department").innerText = cap(dept);
    document.getElementById("d_priority").innerText = cap(pri);
    let statusText = (st || "").replace(/_/g, " ");

    if (st === "in_progress" && approvalRequested) {
        statusText = "for review";
    }

    document.getElementById("d_statusText").innerText = statusText;
    document.getElementById("d_time").innerText = el.dataset.time || "";

    const statusSelect = document.getElementById("d_statusSelect");
    const resolveWrap = document.getElementById("resolveJustificationWrap");

    if (statusSelect) {
        statusSelect.onchange = function () {
            if (this.value === "resolved") {
                document
                    .getElementById("normalStatusWrap")
                    .classList.add("d-none");

                document
                    .getElementById("approvalActionsWrap")
                    .classList.remove("d-none");
            } else {
                // balik normal
                document
                    .getElementById("normalStatusWrap")
                    .classList.remove("d-none");
                document
                    .getElementById("approvalActionsWrap")
                    .classList.add("d-none");
            }
        };
    }

    if (statusSelect) {
        statusSelect.innerHTML = "";

        if (st === "pending") {
            statusSelect.innerHTML = `
    <option value="pending" selected>Pending</option>
  `;
        } else if (st === "in_progress") {
            statusSelect.innerHTML = `
    <option value="in_progress" selected>In Progress</option>
  `;
        } else {
            statusSelect.innerHTML = `
    <option value="resolved" selected>Resolved</option>
  `;
        }
    }

    const form = document.getElementById("statusForm");
    form.onsubmit = function (e) {
        const status = document.getElementById("d_statusSelect")?.value;
        const justification = document
            .getElementById("resolveJustification")
            ?.value.trim();

        if (status === "resolved") {
            e.preventDefault();

            if (!justification) {
                alert(
                    "⚠️ Justification is required before resolving this ticket.",
                );
                return;
            }

            const action = form.action;
            const parts = action.split("/");
            const ticketId = parts[parts.length - 2];

            const baseUrl = document.querySelector(
                'meta[name="base-url"]',
            ).content;

            fetch(`${baseUrl}/tickets/${ticketId}/request-approval`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: JSON.stringify({
                    justification: justification,
                }),
            })
                .then((res) => res.json())
                .then(() => {
                    alert("⏳ Waiting for user approval...");

                    document
                        .getElementById("normalStatusWrap")
                        .classList.add("d-none");
                    document
                        .getElementById("approvalActionsWrap")
                        .classList.remove("d-none");

                    location.reload();
                });
        }
    };
    if (form && ticketId) {
        const baseUrl =
            document.querySelector('meta[name="base-url"]')?.content || "";
        form.action = baseUrl + "/tickets/" + ticketId + "/status";
    }

    new bootstrap.Modal(document.getElementById("ticketDetailsModal")).show();

    const saveBtn = document.getElementById("saveBtn");

    if (saveBtn) {
        if (approvalRequested) {
            saveBtn.style.display = "none";
        } else {
            saveBtn.style.display = "";
        }
    }

    const acceptBtn = document.getElementById("acceptTicket");

    if (acceptBtn) {
        acceptBtn.replaceWith(acceptBtn.cloneNode(true)); // remove old listeners

        const newBtn = document.getElementById("acceptTicket");
        newBtn.addEventListener("click", approveTicket);
    }
};

function cap(s) {
    if (!s) return "";
    return s.replace(/_/g, " ").replace(/\b\w/g, (c) => c.toUpperCase());
}

document.getElementById("cancelTicket")?.addEventListener("click", function () {
    const wrap = document.getElementById("cancelJustificationWrap");
    const textarea = document.getElementById("cancelJustification");

    wrap.classList.remove("d-none");
    textarea.focus();
});

document
    .getElementById("cancelJustification")
    ?.addEventListener("input", function () {
        const btn = document.getElementById("submitDeclineBtn");

        if (this.value.trim()) {
            btn.classList.remove("d-none");
        } else {
            btn.classList.add("d-none");
        }
    });

document
    .getElementById("cancelJustification")
    ?.addEventListener("keydown", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            submitDecline();
        }
    });

function submitDecline() {
    const textarea = document.getElementById("cancelJustification");
    const reason = textarea.value.trim();
    if (!reason) return;

    const btn = document.getElementById("submitDeclineBtn");

    if (btn) {
        btn.disabled = true;
        btn.innerHTML =
            '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Declining...';
    }

    const form = document.getElementById("statusForm");
    const action = form.action;
    const parts = action.split("/");
    const ticketId = parts[parts.length - 2];

    const baseUrl = document.querySelector('meta[name="base-url"]').content;

    fetch(`${baseUrl}/tickets/${ticketId}/decline`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            reason: reason,
        }),
    })
        .then((res) => res.json())
        .then(() => {
            localStorage.setItem("success", "Ticket declined successfully.");
            location.reload();
        })
        .catch(() => {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = "Save";
            }
        });
}

document
    .getElementById("submitDeclineBtn")
    ?.addEventListener("click", submitDecline);

function refreshTickets() {
    const baseUrl = document.querySelector('meta[name="base-url"]').content;

    const modal = document.getElementById("ticketDetailsModal");
    const isOpen = modal?.classList.contains("show");
    if (isOpen) return;

    fetch(`${baseUrl}/tickets/user`)
        .then((res) => res.json())
        .then((tickets) => {
            tickets.forEach((ticket) => {
                const el = document.querySelector(
                    `.ticket-item[data-id="${ticket.id}"]`,
                );
                if (!el) return;

                el.dataset.status = ticket.status;

                const badge = el.querySelector(".badge-status");
                if (badge) {
                    badge.classList.remove(
                        "st-pending",
                        "st-progress",
                        "st-resolved",
                        "st-review",
                    );

                    if (ticket.status === "pending") {
                        badge.classList.add("st-pending");
                    } else if (
                        ticket.status === "in_progress" &&
                        ticket.approval_requested
                    ) {
                        badge.classList.add("st-review");
                    } else if (ticket.status === "in_progress") {
                        badge.classList.add("st-progress");
                    } else if (ticket.status === "resolved") {
                        badge.classList.add("st-resolved");
                    }

                    let statusText = ticket.status.replace("_", " ");

                    if (
                        ticket.status === "in_progress" &&
                        ticket.approval_requested
                    ) {
                        statusText = "for review"; // or 'requesting approval'
                    }

                    badge.innerText = statusText;
                }
                el.dataset.approvalRequested = ticket.approval_requested
                    ? "1"
                    : "0";
            });

            applyFilters();
        });
}

let approving = false;

function approveTicket() {
    if (approving) return;
    approving = true;

    const confirmApprove = confirm(
        "Are you sure you want to approve this ticket?",
    );
    if (!confirmApprove) {
        approving = false;
        return;
    }

    const btn = document.getElementById("acceptTicket");
    if (btn) {
        btn.disabled = true;
        btn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2"></span> Processing...';
    }

    const form = document.getElementById("statusForm");
    const action = form.action;
    const parts = action.split("/");
    const ticketId = parts[parts.length - 2];

    const baseUrl = document.querySelector('meta[name="base-url"]').content;

    fetch(`${baseUrl}/tickets/${ticketId}/approve`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((res) => res.json())
        .then(() => {
            localStorage.setItem("success", "Ticket resolved successfully.");
            location.reload();
        })
        .catch(() => {
            approving = false;
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle"></i> Accept';
            }
        });
}
