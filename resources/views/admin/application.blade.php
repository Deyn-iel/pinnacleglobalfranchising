<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Franchise Application · Dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/admin/app.css'])

    <style>
        :root {
            --sidebar-w: 260px;

            --bg: #f5f6fa;
            --text: #0f172a;
            --muted: #64748b;
            --border: rgba(15, 23, 42, .10);
            --card: rgba(255, 255, 255, .92);

            --shadow: 0 18px 45px rgba(15, 23, 42, .08);
            --shadow-hover: 0 28px 80px rgba(15, 23, 42, .16);

            --radius: 18px;
            --primary: #0d6efd;
            --primary-soft: rgba(13, 110, 253, .12);

            --admin-top-safe: 76px;
        }

        /* =========================
   GLOBAL RESET
========================= */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            max-width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            background: var(--bg);
            color: var(--text);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        img,
        svg,
        iframe,
        video {
            max-width: 100%;
        }

        button,
        input,
        select,
        textarea {
            min-width: 0;
        }

        /* =========================
   LAYOUT
========================= */

        aside {
            width: var(--sidebar-w);
            z-index: 999;
        }

        main {
            width: calc(100% - var(--sidebar-w));
            max-width: calc(100vw - var(--sidebar-w));
            min-width: 0;
            margin-left: var(--sidebar-w);
            padding: clamp(16px, 2.2vw, 34px);
        }

        @media (min-width: 1400px) {
            main {
                padding-left: 34px;
                padding-right: 34px;
            }
        }

        @media (max-width: 991.98px) {
            main {
                width: 100%;
                max-width: 100%;
                margin-left: 0;
                padding: 16px;
            }
        }

        @media (max-width: 575.98px) {
            main {
                padding: 10px;
            }
        }

        /* =========================
   PAGE HEADER
========================= */

        .page-header {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: clamp(16px, 2vw, 24px);
            box-shadow: var(--shadow);
            margin-bottom: 18px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .page-header::after {
            content: "";
            position: absolute;
            right: -90px;
            top: -90px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(13, 110, 253, .18), transparent 60%);
            pointer-events: none;
        }

        .page-header h3 {
            position: relative;
            z-index: 1;
            font-size: clamp(19px, 3vw, 28px);
            line-height: 1.25;
            letter-spacing: -.02em;
            overflow-wrap: anywhere;
        }

        .page-header p {
            position: relative;
            z-index: 1;
            font-size: clamp(13px, 2vw, 15px);
        }

        @media (max-width: 575.98px) {
            .page-header {
                padding: 14px;
                border-radius: 14px;
                margin-bottom: 14px;
            }

            .page-header h3 i {
                display: none;
            }
        }

        /* =========================
   STAT CARDS
========================= */

        .stat-card {
            height: 100%;
            min-width: 0;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--shadow);
            transition: transform .18s ease, box-shadow .22s ease, border-color .22s ease;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            inset: -25% -35% auto -35%;
            height: 120%;
            background: radial-gradient(circle at top, rgba(13, 110, 253, .10), transparent 55%);
            pointer-events: none;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-hover);
            border-color: rgba(13, 110, 253, .22);
        }

        .stat-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }

        .stat-top>div:first-child {
            min-width: 0;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: var(--primary-soft);
            color: var(--text);
            flex: 0 0 auto;
            box-shadow: 0 14px 28px rgba(13, 110, 253, .10);
        }

        .stat-icon i {
            font-size: 18px;
        }

        .stat-title {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 2px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .stat-value {
            font-size: clamp(26px, 2.6vw, 34px);
            font-weight: 900;
            color: var(--text);
            letter-spacing: -.02em;
            line-height: 1.05;
        }

        .stat-sub {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }

        .stat-card .fw-semibold,
        .stat-title,
        .stat-value,
        .stat-sub {
            overflow-wrap: anywhere;
        }

        @media (max-width: 575.98px) {
            .stat-card {
                padding: 14px;
                border-radius: 16px;
            }

            .stat-top {
                gap: 10px;
            }

            .stat-icon {
                width: 42px;
                height: 42px;
                border-radius: 14px;
            }

            .stat-value {
                font-size: 28px;
            }
        }

        /* =========================
   ALERTS
========================= */

        .alert {
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
            border: 1px solid rgba(34, 197, 94, .25);
            transition: opacity .6s ease, transform .6s ease;
            overflow-wrap: anywhere;
        }

        .alert.fade:not(.show) {
            opacity: 0;
            transform: translateY(-10px);
        }

        /* =========================
   DISCOVERY UPLOAD CARD
========================= */

        .discovery-upload-card {
            min-width: 0;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            box-shadow: var(--shadow);
            margin-bottom: 18px;
        }

        .discovery-upload-title {
            font-weight: 900;
            margin: 0;
            color: var(--text);
            overflow-wrap: anywhere;
        }

        .discovery-upload-meta {
            color: var(--muted);
            font-size: 13px;
            margin: 2px 0 0;
            overflow-wrap: anywhere;
        }

        .discovery-upload-form {
            width: auto;
        }

        .discovery-file-input {
            width: min(360px, 100%);
        }

        @media (max-width: 767.98px) {
            .discovery-upload-card {
                padding: 14px;
                border-radius: 14px;
            }

            .discovery-upload-card>.d-flex {
                display: block !important;
            }

            .discovery-upload-form {
                width: 100%;
                margin-top: 12px;
                display: grid !important;
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .discovery-file-input,
            .discovery-upload-form .btn {
                width: 100%;
                max-width: 100% !important;
            }
        }

        /* =========================
   FORMS / FILTERS
========================= */

        form .form-control,
        form .form-select {
            height: 45px;
            border-radius: 10px;
        }

        .responsive-filter {
            align-items: stretch;
        }

        .responsive-filter .form-control,
        .responsive-filter .form-select,
        .responsive-filter .btn {
            width: 100%;
        }

        @media (max-width: 767.98px) {
            .responsive-filter>[class*="col-"] {
                width: 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .responsive-filter {
                margin-bottom: 14px !important;
            }

            .responsive-filter .form-control,
            .responsive-filter .form-select,
            .responsive-filter .btn {
                height: 44px;
                font-size: 14px;
            }
        }

        /* =========================
   TABLE DESKTOP
========================= */

        .table-wrapper {
            min-width: 0;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px;
            box-shadow: var(--shadow);
            overflow: visible;
            backdrop-filter: blur(10px);
        }

        .table-scroll {
            width: 100%;
            overflow-x: auto;
            overflow-y: visible;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            margin-bottom: 0;
            font-size: 14px;
            min-width: 840px;
        }

        th {
            white-space: nowrap;
        }

        td {
            vertical-align: middle;
        }

        .table td,
        .table th {
            max-width: 280px;
            overflow-wrap: anywhere;
        }

        .table thead th {
            border-bottom: 0;
        }

        .table-hover tbody tr {
            transition: background .15s ease;
        }

        /* =========================
   TABLE MOBILE CARD VIEW
========================= */

        @media (max-width: 767.98px) {
            .table-wrapper {
                padding: 0;
                background: transparent;
                border: 0;
                box-shadow: none;
                overflow: visible;
            }

            .table-scroll {
                overflow: visible;
            }

            .table-scroll table,
            .table-scroll thead,
            .table-scroll tbody,
            .table-scroll th,
            .table-scroll td,
            .table-scroll tr {
                display: block;
                width: 100%;
                min-width: 0;
            }

            .table-scroll table {
                min-width: 0 !important;
                border-collapse: separate;
                border-spacing: 0;
                font-size: 13px;
            }

            .table-scroll thead {
                display: none;
            }

            .table-scroll tbody tr {
                background: var(--card);
                border: 1px solid var(--border);
                border-radius: 16px;
                box-shadow: var(--shadow);
                margin-bottom: 12px;
                padding: 10px 12px;
                overflow: visible;
            }

            .table-scroll tbody td {
                width: 100%;
                max-width: 100%;
                border: 0;
                border-bottom: 1px solid rgba(15, 23, 42, .08);
                padding: 10px 0;
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 14px;
                text-align: right;
                white-space: normal;
                overflow-wrap: anywhere;
            }

            .table-scroll tbody td:last-child {
                border-bottom: 0;
            }

            .table-scroll tbody td::before {
                flex: 0 0 42%;
                max-width: 42%;
                text-align: left;
                color: var(--muted);
                font-weight: 800;
                line-height: 1.35;
            }

            .table-scroll tbody td:nth-child(1)::before {
                content: "Applicant";
            }

            .table-scroll tbody td:nth-child(2)::before {
                content: "Brand";
            }

            .table-scroll tbody td:nth-child(3)::before {
                content: "Email";
            }

            .table-scroll tbody td:nth-child(4)::before {
                content: "Contact";
            }

            .table-scroll tbody td:nth-child(5)::before {
                content: "Proposed Location";
            }

            .table-scroll tbody td:nth-child(6)::before {
                content: "Date Applied";
            }

            .table-scroll tbody td:nth-child(7)::before {
                content: "Meeting Schedule";
            }

            .table-scroll tbody td:nth-child(8)::before {
                content: "Status";
            }

            .table-scroll tbody td:nth-child(9)::before {
                content: "Actions";
            }

            .table-scroll tbody td[colspan] {
                display: block;
                text-align: center;
                padding: 24px 12px;
            }

            .table-scroll tbody td[colspan]::before {
                display: none;
                content: "";
            }

            .table-scroll .badge {
                white-space: normal;
                line-height: 1.3;
                text-align: right;
            }
        }

        /* =========================
   BUTTONS
========================= */

        .btn {
            min-width: 0;
            white-space: normal;
        }

        .btn-primary {
            background: #0f172a;
            border: none;
            font-weight: 700;
            border-radius: 999px;
            padding: 6px 14px;
        }

        .btn-primary:hover {
            background: #111827;
        }

        .btn-danger {
            font-weight: 700;
            border-radius: 999px;
            padding: 6px 14px;
        }

        .loading-btn {
            opacity: 1;
        }

        .loading-btn.loading {
            pointer-events: none;
            opacity: .85;
        }

        .loading-btn .btn-text {
            display: none;
        }

        .loading-btn.loading .btn-text {
            display: inline;
        }

        .loading-btn .btn-loader {
            display: none;
        }

        .loading-btn.loading .btn-loader {
            display: inline;
        }

        /* =========================
   ACTION DROPDOWN
========================= */

        .actions-cell {
            white-space: nowrap;
            overflow: visible;
        }

        .action-group {
            position: relative;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .action-toggle {
            width: 38px;
            height: 38px;
            border: 1px solid rgba(15, 23, 42, .12);
            border-radius: 12px;
            background: #fff;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .08);
            transition: all .18s ease;
        }

        .action-toggle:hover,
        .action-toggle.show {
            background: #0f172a;
            color: #fff;
            border-color: #0f172a;
        }

        .action-menu {
            min-width: 205px;
            max-width: calc(100vw - 24px);
            padding: 8px;
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: 14px;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .16);
        }

        .action-menu.show {
            margin-top: 8px !important;
        }

        .action-menu form {
            margin: 0;
        }

        .action-btn {
            width: 100%;
            min-height: 38px;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 9px;
            padding: 9px 12px;
            font-size: 13px;
            font-weight: 800;
            color: #fff;
            transition: all .18s ease;
            box-shadow: none;
            text-decoration: none;
            margin-bottom: 6px;
            white-space: normal;
        }

        .action-menu .action-btn:last-child,
        .action-menu form:last-child .action-btn {
            margin-bottom: 0;
        }

        .action-btn:hover {
            color: #fff;
            filter: brightness(.96);
        }

        .action-btn i {
            pointer-events: none;
        }

        .action-view {
            background: #0f172a;
        }

        .action-schedule {
            background: #06b6d4;
        }

        .action-start {
            background: #2563eb;
        }

        .action-reschedule {
            background: #f59e0b;
        }

        .action-done {
            background: #16a34a;
        }

        .action-close {
            background: #111827;
        }

        .action-workflow {
            background: #0f766e;
        }

        .action-decline {
            background: #dc2626;
        }

        .action-delete {
            background: #e11d48;
        }

        @media (max-width: 767.98px) {
            .actions-cell {
                justify-content: space-between !important;
                text-align: right !important;
                overflow: visible;
            }

            .actions-cell .action-group {
                margin-left: auto;
            }

            .action-toggle {
                width: 40px;
                height: 40px;
            }

            .action-menu,
            .action-menu.show {
                width: min(230px, calc(100vw - 34px));
                max-width: calc(100vw - 34px);
            }
        }

        /* =========================
   WORKFLOW
========================= */

        .workflow-steps {
            margin: 0 0 16px;
            padding-left: 18px;
            color: #475569;
            font-size: 13px;
            line-height: 1.55;
        }

        .workflow-panel {
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: 12px;
            padding: 14px;
            background: #f8fafc;
            margin-bottom: 12px;
            overflow-wrap: anywhere;
        }

        .workflow-panel-title {
            font-weight: 900;
            margin-bottom: 10px;
            color: #0f172a;
        }

        .reservation-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .reservation-grid .full {
            grid-column: 1 / -1;
        }

        @media (max-width: 767.98px) {
            .workflow-steps {
                padding-left: 18px;
                font-size: 12px;
            }

            .workflow-panel {
                padding: 12px;
                border-radius: 12px;
            }

            .reservation-grid {
                grid-template-columns: 1fr !important;
            }

            .reservation-grid .full {
                grid-column: auto;
            }

            .reservation-grid>.full>.d-flex {
                flex-wrap: wrap;
                align-items: flex-start !important;
            }

            .reservation-grid>.full>.d-flex input[type="number"] {
                width: 100%;
                max-width: 100% !important;
                margin-left: 24px;
            }

            .workflow-panel .text-end {
                text-align: left !important;
            }

            .workflow-panel .btn,
            .workflow-panel a.btn {
                width: 100%;
            }
        }

        /* =========================
   MODALS
========================= */

        .modal {
            z-index: 1060 !important;
        }

        .modal-backdrop.show {
            z-index: 1055 !important;
        }

        .app-details-modal {
            z-index: 1070 !important;
        }

        .modal-dialog {
            max-width: min(var(--bs-modal-width, 500px), calc(100vw - 24px));
            margin-left: auto;
            margin-right: auto;
        }

        .modal-content {
            max-width: 100%;
            max-height: calc(100dvh - 24px);
        }

        .modal-dialog-scrollable .modal-content {
            max-height: calc(100dvh - 24px);
        }

        .modal-body {
            min-width: 0;
            overflow-x: auto;
        }

        .modal-footer {
            flex-wrap: wrap;
            gap: 8px;
        }

        [id^="scheduleModal"] .modal-dialog,
        [id^="rescheduleModal"] .modal-dialog {
            width: min(650px, calc(100vw - 24px));
            max-width: 650px;
            margin: 80px auto !important;
            pointer-events: auto;
        }

        #scheduleModal1 .modal-content,
        [id^="scheduleModal"] .modal-content,
        [id^="rescheduleModal"] .modal-content {
            border-radius: 16px;
        }

        #scheduleModal1 .modal-body,
        [id^="scheduleModal"] .modal-body,
        [id^="rescheduleModal"] .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        [id^="postDiscoveryModal"] .modal-dialog,
        .discovery-modal .modal-dialog {
            width: min(1120px, calc(100vw - 24px));
            max-width: min(1120px, calc(100vw - 24px));
        }

        #appDetailsModal {
            padding: 16px !important;
        }

        #appDetailsModal.show {
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding-top: var(--admin-top-safe) !important;
            padding-bottom: 24px !important;
        }

        #appDetailsModal .modal-dialog {
            margin: 0 auto !important;
            width: min(1100px, calc(100vw - 32px));
            max-width: 1100px;
        }

        #appDetailsModal .modal-content {
            border-radius: 18px;
            overflow: hidden;
            border: 0;
            box-shadow: 0 24px 80px rgba(15, 23, 42, .25);
            max-height: calc(100vh - var(--admin-top-safe) - 40px);
            background: #fff;
        }

        #appDetailsModal .modal-header,
        #appDetailsModal .modal-footer {
            background: #fff;
            position: relative;
            z-index: 2;
            flex: 0 0 auto;
        }

        #appDetailsModal .modal-header {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(15, 23, 42, .08);
        }

        #appDetailsModal .modal-body {
            padding: 18px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        #appDetailsModal .modal-footer {
            padding: 12px 18px;
            border-top: 1px solid rgba(15, 23, 42, .08);
        }

        @media (max-width: 991.98px) {
            :root {
                --admin-top-safe: 58px;
            }

            #appDetailsModal .modal-dialog {
                width: min(100%, calc(100vw - 24px));
            }
        }

        @media (max-width: 767.98px) {
            :root {
                --admin-top-safe: 48px;
            }

            .modal,
            #appDetailsModal {
                padding: 8px !important;
            }

            #appDetailsModal.show {
                padding: 8px !important;
            }

            .modal-dialog,
            #appDetailsModal .modal-dialog,
            [id^="scheduleModal"] .modal-dialog,
            [id^="rescheduleModal"] .modal-dialog,
            [id^="postDiscoveryModal"] .modal-dialog,
            .discovery-modal .modal-dialog {
                width: calc(100vw - 16px) !important;
                max-width: calc(100vw - 16px) !important;
                margin: 8px auto !important;
            }

            .modal-content,
            #appDetailsModal .modal-content,
            [id^="scheduleModal"] .modal-content,
            [id^="rescheduleModal"] .modal-content,
            [id^="postDiscoveryModal"] .modal-content,
            .discovery-modal .modal-content {
                max-height: calc(100dvh - 16px) !important;
                border-radius: 14px;
            }

            .modal-header,
            .modal-body,
            .modal-footer,
            #appDetailsModal .modal-header,
            #appDetailsModal .modal-body,
            #appDetailsModal .modal-footer,
            [id^="postDiscoveryModal"] .modal-header,
            [id^="postDiscoveryModal"] .modal-body,
            [id^="postDiscoveryModal"] .modal-footer,
            [id^="scheduleModal"] .modal-header,
            [id^="scheduleModal"] .modal-body,
            [id^="scheduleModal"] .modal-footer,
            [id^="rescheduleModal"] .modal-header,
            [id^="rescheduleModal"] .modal-body,
            [id^="rescheduleModal"] .modal-footer {
                padding: 12px !important;
            }

            .modal-title,
            #appDetailsModal .modal-title,
            [id^="postDiscoveryModal"] .modal-title,
            [id^="scheduleModal"] .modal-title,
            [id^="rescheduleModal"] .modal-title {
                font-size: 16px;
                line-height: 1.25;
            }

            .modal-body,
            #appDetailsModal .modal-body,
            [id^="scheduleModal"] .modal-body,
            [id^="rescheduleModal"] .modal-body,
            [id^="postDiscoveryModal"] .modal-body,
            .discovery-modal .modal-body {
                overflow-y: auto;
                overflow-x: hidden;
            }

            .modal-footer {
                display: grid;
                grid-template-columns: 1fr;
            }

            .modal-footer .btn,
            .modal-footer .btn-custom,
            .modal-footer .slide-btn {
                width: 100%;
                min-width: 0;
            }

            #appDetailsModal .btn {
                font-size: 14px;
            }
        }

        /* =========================
   DISCOVERY PRESENTATION MODAL
========================= */

        .discovery-modal {
            --bs-modal-width: min(1120px, calc(100vw - 32px));
        }

        .discovery-modal .modal-dialog {
            min-height: calc(100vh - 3rem);
            display: flex;
            align-items: center;
            margin: 1.5rem auto;
        }

        .discovery-content {
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(15, 23, 42, .18);
        }

        .discovery-stage {
            background: #fff;
            color: var(--text);
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        .discovery-topbar,
        .discovery-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 18px;
            border-color: rgba(15, 23, 42, .10);
        }

        .discovery-topbar {
            border-bottom: 1px solid rgba(15, 23, 42, .10);
            background: #fff;
        }

        .discovery-controls {
            border-top: 1px solid rgba(15, 23, 42, .10);
            background: #f8fafc;
        }

        .discovery-kicker {
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .discovery-applicant {
            color: var(--muted);
            font-size: 13px;
        }

        .discovery-ppt-frame {
            min-width: 0;
            min-height: 0;
            padding: clamp(12px, 2vw, 20px);
            background: #f1f5f9;
        }

        .discovery-ppt-viewer {
            width: 100%;
            height: min(520px, calc(100vh - 260px));
            min-height: 320px;
            border: 1px solid rgba(15, 23, 42, .12);
            border-radius: 8px;
            background: #fff;
        }

        .discovery-ppt-placeholder {
            min-height: 320px;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 34px 18px;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: 8px;
        }

        .discovery-ppt-placeholder i {
            font-size: 42px;
            color: #d97706;
            margin-bottom: 14px;
        }

        .discovery-ppt-placeholder h3 {
            margin: 0 0 6px;
            font-size: clamp(20px, 2vw, 26px);
            font-weight: 900;
            color: var(--text);
        }

        .discovery-ppt-placeholder p {
            margin: 0;
            max-width: 560px;
            color: var(--muted);
            font-weight: 600;
            line-height: 1.55;
        }

        .discovery-empty-state {
            text-align: center;
            color: var(--muted);
            font-weight: 700;
            padding: 52px 18px;
            background: #fff;
            border: 1px dashed rgba(15, 23, 42, .18);
            border-radius: 8px;
        }

        .slide-progress {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .slide-btn {
            min-height: 42px;
            border: 1px solid rgba(15, 23, 42, .14);
            border-radius: 10px;
            padding: 0 16px;
            background: #fff;
            color: var(--text);
            font-weight: 800;
            white-space: normal;
        }

        .slide-btn.primary {
            border-color: #60a5fa;
            background: #2563eb;
            color: #fff;
        }

        .slide-btn:disabled,
        .slide-btn.disabled {
            opacity: .55;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 767.98px) {
            .discovery-modal .modal-dialog {
                min-height: calc(100dvh - 16px);
                margin: 8px auto !important;
            }

            .discovery-stage {
                min-height: calc(100dvh - 16px);
            }

            .discovery-topbar,
            .discovery-controls {
                padding: 12px;
                align-items: stretch;
                flex-direction: column;
            }

            .discovery-ppt-frame {
                padding: 10px;
            }

            .discovery-ppt-viewer,
            .discovery-ppt-placeholder,
            .discovery-empty-state {
                min-height: 280px;
                height: min(420px, calc(100dvh - 250px));
            }

            .discovery-controls .d-flex {
                width: 100%;
                display: grid !important;
                grid-template-columns: 1fr;
            }

            .slide-btn {
                width: 100%;
                justify-content: center;
                flex: 1;
            }
        }

        /* =========================
   DOWNLOAD BUTTON
========================= */

        .download-pdf-btn {
            position: relative;
            overflow: hidden;
            min-width: 145px;
        }

        .download-spinner {
            display: none;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spinDownload .75s linear infinite;
        }

        .download-pdf-btn.is-downloading {
            pointer-events: none;
            opacity: .85;
        }

        .download-pdf-btn.is-downloading .download-spinner {
            display: inline-block;
        }

        .download-pdf-btn.is-downloading .fa-file-pdf {
            display: none;
        }

        @keyframes spinDownload {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* =========================
   PAGINATION
========================= */

        .pagination {
            justify-content: center;
            flex-wrap: wrap;
            gap: 4px;
        }

        @media (max-width: 575.98px) {
            .pagination {
                font-size: 13px;
            }

            .page-link {
                padding: 6px 10px;
            }
        }

        /* =========================
   EXTRA SMALL DEVICE FIXES
========================= */

        @media (max-width: 575.98px) {
            h4 {
                font-size: 18px;
            }

            .row {
                --bs-gutter-x: .75rem;
            }

            .btn {
                font-size: 14px;
            }

            .form-control,
            .form-select {
                font-size: 14px;
            }
        }

        /* =========================================================
   FINAL MODAL + RESPONSIVE OVERRIDE FIX
   Put this at the VERY BOTTOM of your style tag
========================================================= */

        /* Make Bootstrap modal/backdrop higher than your admin sidebar/navbar */
        .modal-backdrop {
            z-index: 2147483000 !important;
        }

        .modal {
            z-index: 2147483001 !important;
        }

        /* When modal is open, force sidebar/navbar behind the modal */
        body.modal-open aside,
        body.modal-open nav,
        body.modal-open header,
        body.modal-open .navbar,
        body.modal-open .sidebar,
        body.modal-open .admin-sidebar,
        body.modal-open .topbar,
        body.modal-open .main-header {
            z-index: 1000 !important;
        }

        /* Remove unwanted body shifting */
        body.modal-open {
            padding-right: 0 !important;
            overflow: hidden !important;
        }

        /* Center all modals properly */
        .modal.show {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 16px !important;
        }

        /* General modal sizing */
        .modal-dialog {
            width: min(720px, calc(100vw - 32px)) !important;
            max-width: min(720px, calc(100vw - 32px)) !important;
            margin: 0 auto !important;
            height: auto !important;
            min-height: 0 !important;
        }

        /* Large modals */
        #appDetailsModal .modal-dialog,
        [id^="postDiscoveryModal"] .modal-dialog,
        .post-discovery-dialog,
        .discovery-modal .modal-dialog {
            width: min(900px, calc(100vw - 32px)) !important;
            max-width: min(900px, calc(100vw - 32px)) !important;
            margin: 0 auto !important;
        }

        /* Modal content should never exceed screen height */
        .modal-content {
            width: 100% !important;
            max-width: 100% !important;
            max-height: calc(100dvh - 32px) !important;
            overflow: hidden !important;
            border-radius: 14px !important;
            display: flex !important;
            flex-direction: column !important;
        }

        /* Header/footer fixed, body scrolls */
        .modal-header,
        .modal-footer {
            flex: 0 0 auto !important;
        }

        .modal-body {
            flex: 1 1 auto !important;
            min-height: 0 !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        /* Fix post-discovery workflow content */
        [id^="postDiscoveryModal"] .modal-content {
            max-height: calc(100dvh - 32px) !important;
        }

        [id^="postDiscoveryModal"] .modal-header {
            padding: 14px 16px !important;
        }

        [id^="postDiscoveryModal"] .modal-body {
            padding: 16px !important;
        }

        [id^="postDiscoveryModal"] .modal-footer {
            padding: 12px 16px !important;
        }

        /* Prevent text from going outside */
        [id^="postDiscoveryModal"] *,
        #appDetailsModal *,
        .discovery-modal * {
            overflow-wrap: anywhere;
        }

        /* Workflow panel responsive */
        .workflow-panel {
            width: 100% !important;
            max-width: 100% !important;
        }

        .workflow-panel .btn,
        .workflow-panel a.btn {
            max-width: 100%;
            white-space: normal;
        }

        /* Reservation form grid */
        .reservation-grid {
            width: 100%;
            max-width: 100%;
        }

        /* Package rows */
        .reservation-grid .full .d-flex {
            min-width: 0;
        }

        .reservation-grid .full label {
            min-width: 0;
            overflow-wrap: anywhere;
        }

        /* Desktop with sidebar: keep modal away from being visually too wide */
        @media (min-width: 992px) {

            [id^="postDiscoveryModal"] .modal-dialog,
            .post-discovery-dialog {
                width: min(820px, calc(100vw - 340px)) !important;
                max-width: min(820px, calc(100vw - 340px)) !important;
            }

            #appDetailsModal .modal-dialog {
                width: min(900px, calc(100vw - 340px)) !important;
                max-width: min(900px, calc(100vw - 340px)) !important;
            }
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .modal.show {
                padding: 12px !important;
            }

            .modal-dialog,
            #appDetailsModal .modal-dialog,
            [id^="postDiscoveryModal"] .modal-dialog,
            .post-discovery-dialog,
            .discovery-modal .modal-dialog {
                width: calc(100vw - 24px) !important;
                max-width: calc(100vw - 24px) !important;
                margin: 0 auto !important;
            }

            .modal-content {
                max-height: calc(100dvh - 24px) !important;
            }
        }

        /* Mobile */
        @media (max-width: 767.98px) {
            .modal.show {
                align-items: flex-start !important;
                justify-content: center !important;
                padding: 8px !important;
            }

            .modal-dialog,
            #appDetailsModal .modal-dialog,
            [id^="scheduleModal"] .modal-dialog,
            [id^="rescheduleModal"] .modal-dialog,
            [id^="postDiscoveryModal"] .modal-dialog,
            .post-discovery-dialog,
            .discovery-modal .modal-dialog {
                width: calc(100vw - 16px) !important;
                max-width: calc(100vw - 16px) !important;
                margin: 0 auto !important;
            }

            .modal-content,
            #appDetailsModal .modal-content,
            [id^="scheduleModal"] .modal-content,
            [id^="rescheduleModal"] .modal-content,
            [id^="postDiscoveryModal"] .modal-content,
            .discovery-modal .modal-content {
                max-height: calc(100dvh - 16px) !important;
                border-radius: 14px !important;
            }

            .modal-header,
            .modal-body,
            .modal-footer,
            #appDetailsModal .modal-header,
            #appDetailsModal .modal-body,
            #appDetailsModal .modal-footer,
            [id^="scheduleModal"] .modal-header,
            [id^="scheduleModal"] .modal-body,
            [id^="scheduleModal"] .modal-footer,
            [id^="rescheduleModal"] .modal-header,
            [id^="rescheduleModal"] .modal-body,
            [id^="rescheduleModal"] .modal-footer,
            [id^="postDiscoveryModal"] .modal-header,
            [id^="postDiscoveryModal"] .modal-body,
            [id^="postDiscoveryModal"] .modal-footer {
                padding: 12px !important;
            }

            .modal-title {
                font-size: 16px !important;
                line-height: 1.25 !important;
            }

            .modal-footer {
                display: grid !important;
                grid-template-columns: 1fr !important;
                gap: 8px !important;
            }

            .modal-footer .btn {
                width: 100% !important;
            }

            .workflow-steps {
                font-size: 12px !important;
                padding-left: 16px !important;
                margin-bottom: 12px !important;
            }

            .workflow-panel {
                padding: 12px !important;
                border-radius: 12px !important;
            }

            .reservation-grid {
                grid-template-columns: 1fr !important;
            }

            .reservation-grid .full {
                grid-column: auto !important;
            }

            .workflow-panel .text-end {
                text-align: left !important;
            }

            .workflow-panel .btn,
            .workflow-panel a.btn {
                width: 100% !important;
            }

            .reservation-grid .full .d-flex {
                flex-wrap: wrap !important;
                align-items: flex-start !important;
            }

            .reservation-grid .full input[type="number"] {
                width: 100% !important;
                max-width: 100% !important;
                margin-left: 24px !important;
            }
        }

        /* Small phones */
        @media (max-width: 420px) {
            .modal.show {
                padding: 6px !important;
            }

            .modal-dialog,
            #appDetailsModal .modal-dialog,
            [id^="postDiscoveryModal"] .modal-dialog,
            .post-discovery-dialog {
                width: calc(100vw - 12px) !important;
                max-width: calc(100vw - 12px) !important;
            }

            .modal-content {
                max-height: calc(100dvh - 12px) !important;
            }

            [id^="postDiscoveryModal"] .modal-header,
            [id^="postDiscoveryModal"] .modal-body,
            [id^="postDiscoveryModal"] .modal-footer {
                padding: 10px !important;
            }
        }

        /* =====================================================
   FORCE ALL MODALS TO CENTER ON ALL DEVICES
   Put this at the VERY BOTTOM of <style>
===================================================== */

        .modal.show {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 12px !important;
            overflow: hidden !important;
        }

        .modal-dialog,
        .modal-dialog-centered,
        .post-discovery-dialog,
        #appDetailsModal .modal-dialog,
        [id^="scheduleModal"] .modal-dialog,
        [id^="rescheduleModal"] .modal-dialog,
        [id^="postDiscoveryModal"] .modal-dialog,
        .discovery-modal .modal-dialog {
            margin: auto !important;
            transform: none !important;
        }

        .modal-dialog-centered {
            min-height: 0 !important;
        }

        .modal-dialog-centered::before {
            display: none !important;
        }

        .modal-content {
            margin: auto !important;
        }

        /* Center modal header/footer layout */
        .modal-header {
            align-items: center !important;
        }

        .modal-footer {
            justify-content: center !important;
        }

        /* Mobile center fix */
        @media (max-width: 767.98px) {
            .modal.show {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 8px !important;
                overflow: hidden !important;
            }

            .modal-dialog,
            .modal-dialog-centered,
            .post-discovery-dialog,
            #appDetailsModal .modal-dialog,
            [id^="scheduleModal"] .modal-dialog,
            [id^="rescheduleModal"] .modal-dialog,
            [id^="postDiscoveryModal"] .modal-dialog,
            .discovery-modal .modal-dialog {
                width: calc(100vw - 20px) !important;
                max-width: calc(100vw - 20px) !important;
                margin: auto !important;
                transform: none !important;
            }

            .modal-content,
            #appDetailsModal .modal-content,
            [id^="scheduleModal"] .modal-content,
            [id^="rescheduleModal"] .modal-content,
            [id^="postDiscoveryModal"] .modal-content,
            .discovery-modal .modal-content {
                max-height: calc(100dvh - 24px) !important;
                margin: auto !important;
            }
        }

        /* Center only Schedule / Reschedule modal footer buttons */
        [id^="scheduleModal"] .modal-footer,
        [id^="rescheduleModal"] .modal-footer {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 16px !important;
            text-align: center !important;
        }

        /* Do not let the buttons stretch or move right */
        [id^="scheduleModal"] .modal-footer .btn,
        [id^="rescheduleModal"] .modal-footer .btn {
            width: auto !important;
            min-width: 120px !important;
            flex: 0 0 auto !important;
            margin: 0 !important;
        }

        /* On small phones, keep them centered but stacked */
        @media (max-width: 575.98px) {

            [id^="scheduleModal"] .modal-footer,
            [id^="rescheduleModal"] .modal-footer {
                display: grid !important;
                grid-template-columns: 1fr !important;
                justify-items: center !important;
            }

            [id^="scheduleModal"] .modal-footer .btn,
            [id^="rescheduleModal"] .modal-footer .btn {
                width: min(220px, 100%) !important;
            }
        }
    </style>
</head>

<body>

    @include('admin-sidebar.navbar')
    @include('admin-sidebar.sidebar')

    <main>

        <div class="page-header">
            <h3 class="fw-bold mb-1">
                <i class="fas fa-chart-line me-2"></i>Franchise Application Dashboard
            </h3>
            <p class="text-muted mb-0">
                Overview of franchise applications and recent activity.
            </p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="stat-card">
                    <div class="stat-top">
                        <div>
                            <div class="stat-title">Total Applications</div>
                            <div class="stat-value">{{ \App\Models\FranchiseApplication::count() }}</div>
                            <p class="stat-sub">All-time submitted forms</p>
                        </div>
                        <div class="stat-icon"><i class="fas fa-folder-open"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="stat-card">
                    <div class="stat-top">
                        <div>
                            <div class="stat-title">Submitted Today</div>
                            <div class="stat-value">
                                {{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</div>
                            <p class="stat-sub">New entries today</p>
                        </div>
                        <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="stat-card">
                    <div class="stat-top">
                        <div>
                            <div class="stat-title">Latest Applicant</div>
                            <div class="fw-semibold fs-5">
                                {{ optional(\App\Models\FranchiseApplication::latest()->first())->personal_full_name ?? 'No Data' }}
                            </div>
                            <p class="stat-sub">Most recent submission</p>
                        </div>
                        <div class="stat-icon"><i class="fas fa-user"></i></div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div id="uploadSuccessAlert"
                class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
                role="alert">
                <i class="fas fa-check-circle fs-5"></i>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2" role="alert">
                <i class="fas fa-circle-exclamation fs-5 mt-1"></i>
                <div>
                    <strong>{{ $errors->first() }}</strong>
                </div>
            </div>
        @endif

        <div class="discovery-upload-card">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="discovery-upload-title">
                        <i class="fas fa-file-powerpoint me-2"></i>Discovery Slides
                    </h4>
                    <p class="discovery-upload-meta">
                        {{ $discoveryPresentation['name'] ?? 'No PowerPoint uploaded yet' }}
                    </p>
                </div>

                <form action="{{ route('admin.application.discoverySlides.upload') }}" method="POST"
                    enctype="multipart/form-data"
                    class="discovery-upload-form d-flex align-items-center flex-wrap gap-2">
                    @csrf
                    <input type="file" name="presentation" class="form-control discovery-file-input"
                        accept=".ppt,.pptx" required>
                    <button type="submit" class="btn btn-dark loading-btn">
                        <i class="fas fa-upload me-2"></i>
                        <span class="btn-label">Upload PPTX</span>
                        <span class="btn-loader">
                            <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
                        </span>
                        <span class="btn-text ms-2">Uploading...</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
            <h4 class="fw-bold mb-0">Recent Applications</h4>
            <div class="text-muted small">Showing latest submissions</div>
        </div>

        <form method="GET" class="row g-2 mb-3 responsive-filter">

            <div class="col-12 col-sm-6 col-xl-2">
                <input type="text" name="search" class="form-control" placeholder="Search applicant..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-12 col-lg-4 col-xl-3">
                <select name="brand" class="form-select">
                    <option value="All">All Brands</option>
                    <option value="Kape-Ilokano" {{ request('brand') == 'Kape-Ilokano' ? 'selected' : '' }}>
                        Kape-Ilokano
                    </option>
                    <option value="Patatas Project" {{ request('brand') == 'Patatas Project' ? 'selected' : '' }}>
                        Patatas Project
                    </option>
                </select>
            </div>

            <div class="col-12 col-sm-6 col-lg-2">
                <select name="status" class="form-select">
                    <option value="All">All Status</option>
                    <option value="Review in Progress"
                        {{ request('status') == 'Review in Progress' ? 'selected' : '' }}>
                        Review in Progress</option>
                    <option value="Appointment Scheduled"
                        {{ request('status') == 'Appointment Scheduled' ? 'selected' : '' }}>Appointment Scheduled
                    </option>
                    <option value="Discovery Meeting"
                        {{ request('status') == 'Discovery Meeting' ? 'selected' : '' }}>
                        Discovery Meeting</option>
                    <option value="Discovery Session Completed"
                        {{ request('status') == 'Discovery Session Completed' ? 'selected' : '' }}>Discovery Session
                        Completed
                    </option>
                    <option value="Voucher/Coupon Option"
                        {{ request('status') == 'Voucher/Coupon Option' ? 'selected' : '' }}>Voucher/Coupon Option
                    </option>
                    <option value="Franchisee Registration"
                        {{ request('status') == 'Franchisee Registration' ? 'selected' : '' }}>Franchisee Registration
                    </option>
                    <option value="Franchisee Registered"
                        {{ request('status') == 'Franchisee Registered' ? 'selected' : '' }}>Franchisee Registered
                    </option>
                    <option value="Franchise Reservation Registration"
                        {{ request('status') == 'Franchise Reservation Registration' ? 'selected' : '' }}>
                        Franchise Reservation Registration
                    </option>
                    <option value="Pending Payment" {{ request('status') == 'Pending Payment' ? 'selected' : '' }}>
                        Pending Payment
                    </option>
                    <option value="Printed" {{ request('status') == 'Printed' ? 'selected' : '' }}>Printed</option>
                    <option value="Paid (Confirmed)" {{ request('status') == 'Paid (Confirmed)' ? 'selected' : '' }}>
                        Paid (Confirmed)
                    </option>
                    <option value="Franchise Reservation Registered"
                        {{ request('status') == 'Franchise Reservation Registered' ? 'selected' : '' }}>
                        Franchise Reservation Registered
                    </option>
                    <option value="Declined" {{ request('status') == 'Declined' ? 'selected' : '' }}>Declined</option>
                </select>
            </div>

            <div class="col-12 col-sm-6 col-lg-2 d-grid">
                <select name="sort" class="form-select">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>

            <div class="col-12 col-sm-6 col-lg-2 d-grid">
                <button type="submit" class="btn btn-dark loading-btn">
                    <span class="btn-label">Apply</span>
                    <span class="btn-loader">
                        <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
                    </span>
                    <span class="btn-text ms-2">Loading...</span>
                </button>
            </div>

        </form>
        <div class="table-wrapper">
            <div class="table-scroll">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Applicant</th>
                            <th>Brand</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Proposed Location</th>
                            <th>Date Applied</th>
                            <th>Meeting Schedule</th>
                            <th>Status</th>
                            <th class="text-center" style="width:230px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($applications as $app)
                            <tr>
                                <td class="fw-semibold" data-label="Applicant">
                                    {{ $app->personal_full_name }}
                                </td>

                                <td data-label="Brand">
                                    {{ $app->brand ?? 'Kape-Ilokano' }}
                                </td>

                                <td data-label="Email">
                                    {{ $app->email }}
                                </td>

                                <td data-label="Contact">
                                    {{ $app->personal_contact }}
                                </td>

                                <td data-label="Proposed Location">
                                    {{ $app->address_city }} {{ $app->proposal_location }}
                                </td>

                                <td data-label="Date Applied">
                                    {{ $app->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    @if ($app->appointment_date)
                                        <div class="fw-semibold">
                                            {{ \Carbon\Carbon::parse($app->appointment_date)->format('M d, Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($app->appointment_time)->format('h:i A') }}
                                        </small>
                                    @else
                                        <span class="text-muted">Not Scheduled</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $status = $app->status ?? 'Review in Progress';
                                        $badgeClass = 'bg-warning text-dark';

                                        switch (strtolower(trim($status))) {
                                            // MODULE 3 - APPLICATION STATUS TRACKING
                                            case 'review in progress':
                                                $status = 'Review in Progress';
                                                $badgeClass = 'bg-warning text-dark';
                                                break;

                                            // MODULE 4 - APPOINTMENT SCHEDULING
                                            case 'appointment scheduled':
                                                $status = 'Appointment Scheduled';
                                                $badgeClass = 'bg-info text-dark';
                                                break;

                                            // Optional next stages
                                            case 'discovery meeting':
                                                $status = 'Discovery Meeting';
                                                $badgeClass = 'bg-primary';
                                                break;

                                            case 'discovery session done':
                                            case 'discovery session completed':
                                                $status = 'Discovery Session Completed';
                                                $badgeClass = 'bg-success';
                                                break;

                                            case 'voucher/coupon option':
                                                $status = 'Voucher/Coupon Option';
                                                $badgeClass = 'bg-secondary';
                                                break;

                                            case 'franchisee registration':
                                                $status = 'Franchisee Registration';
                                                $badgeClass = 'bg-info text-dark';
                                                break;

                                            case 'franchisee registered':
                                                $status = 'Franchisee Registered';
                                                $badgeClass = 'bg-primary';
                                                break;

                                            case 'franchise reservation registration':
                                                $status = 'Franchise Reservation Registration';
                                                $badgeClass = 'bg-info text-dark';
                                                break;

                                            case 'pending payment':
                                                $status = 'Pending Payment';
                                                $badgeClass = 'bg-warning text-dark';
                                                break;

                                            case 'printed':
                                                $status = 'Printed';
                                                $badgeClass = 'bg-secondary';
                                                break;

                                            case 'paid (confirmed)':
                                                $status = 'Paid (Confirmed)';
                                                $badgeClass = 'bg-success';
                                                break;

                                            case 'franchise reservation registered':
                                                $status = 'Franchise Reservation Registered';
                                                $badgeClass = 'bg-dark';
                                                break;

                                            case 'declined':
                                                $status = 'Declined';
                                                $badgeClass = 'bg-danger';
                                                break;

                                            default:
                                                $status = 'Review in Progress';
                                                $badgeClass = 'bg-warning text-dark';
                                                break;
                                        }
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                </td>

                                <td class="text-center actions-cell" data-label="Actions">
                                    <div class="action-group dropdown">
                                        <button class="action-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" aria-label="Open actions">
                                            <i class="fas fa-ellipsis"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end action-menu">
                                            <button type="button" class="action-btn action-view js-view-app"
                                                title="View Details" data-bs-toggle="modal"
                                                data-bs-target="#appDetailsModal"
                                                data-url="{{ route('admin.applications.modal', $app->id) }}">
                                                <i class="fas fa-eye"></i>
                                                <span>View Details</span>
                                            </button>

                                            {{-- REVIEW --}}
                                            @if ($app->status == 'Review in Progress' || $app->status == 'Submitted')
                                                <button type="button" class="action-btn action-schedule"
                                                    title="Schedule Meeting" data-bs-toggle="modal"
                                                    data-bs-target="#scheduleModal{{ $app->id }}">
                                                    <i class="fas fa-calendar-plus"></i>
                                                    <span>Schedule Meeting</span>
                                                </button>
                                            @endif

                                            {{-- APPOINTMENT --}}
                                            @if ($app->status == 'Appointment Scheduled')
                                                <button type="button"
                                                    class="action-btn action-start js-start-discovery-slides"
                                                    title="Let's Begin"
                                                    data-app-name="{{ $app->personal_full_name }}"
                                                    data-app-id="{{ $app->id }}"
                                                    data-slides-url="{{ route('admin.application.discoverySlides.json') }}"
                                                    data-start-url="{{ route('admin.application.startDiscovery', $app->id) }}"
                                                    data-done-url="{{ route('admin.application.doneDiscovery', $app->id) }}">
                                                    <i class="fas fa-play"></i>
                                                    <span>Let's Begin</span>
                                                </button>

                                                <button type="button" class="action-btn action-reschedule"
                                                    title="Reschedule" data-bs-toggle="modal"
                                                    data-bs-target="#rescheduleModal{{ $app->id }}">
                                                    <i class="fas fa-clock"></i>
                                                    <span>Reschedule</span>
                                                </button>
                                            @endif

                                            {{-- DISCOVERY --}}
                                            @if ($app->status == 'Discovery Meeting')
                                                <form
                                                    action="{{ route('admin.application.doneDiscovery', $app->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="action-btn action-done loading-btn"
                                                        title="Mark Done">
                                                        <i class="fas fa-check"></i>
                                                        <span>Mark Done</span>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- DONE --}}
                                            @if (in_array($app->status, [
                                                    'Discovery Session Done',
                                                    'Discovery Session Completed',
                                                    'Voucher/Coupon Option',
                                                    'Franchisee Registration',
                                                    'Franchisee Registered',
                                                    'Franchise Reservation Registration',
                                                    'Printed',
                                                    'Pending Payment',
                                                    'Paid (Confirmed)',
                                                    'Franchise Reservation Registered',
                                                ]))
                                                <button type="button" class="action-btn action-workflow"
                                                    title="Continue Workflow" data-bs-toggle="modal"
                                                    data-bs-target="#postDiscoveryModal{{ $app->id }}">
                                                    <i class="fas fa-list-check"></i>
                                                    <span>Continue Workflow</span>
                                                </button>

                                                <form action="{{ route('admin.application.decline', $app->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="action-btn action-decline loading-btn" title="Decline">
                                                        <i class="fas fa-xmark"></i>
                                                        <span>Decline</span>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.applications.destroy', $app->id) }}"
                                                method="POST" onsubmit="return confirm('Delete application?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn action-delete loading-btn"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>

                                            </form>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No applications submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>



    </main>


    @foreach ($applications as $app)
        <div class="modal fade" id="rescheduleModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Reschedule Appointment</h5>
                    </div>

                    <form action="{{ route('admin.application.reschedule', $app->id) }}" method="POST">
                        @csrf

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="appointment_date" class="form-control" required
                                    value="{{ $app->appointment_date }}">
                            </div>

                            <div class="mb-3">
                                <label>Time</label>
                                <input type="time" name="appointment_time" class="form-control" required
                                    value="{{ $app->appointment_time }}">
                            </div>

                            <div class="mb-3">
                                <label>Meeting Type</label>
                                <select name="meeting_type" class="form-select">
                                    <option {{ $app->meeting_type == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                                    <option {{ $app->meeting_type == 'Google Meet' ? 'selected' : '' }}>Google Meet
                                    </option>
                                    <option {{ $app->meeting_type == 'Face to Face' ? 'selected' : '' }}>Face to Face
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Meeting Link</label>
                                <input type="url" name="meeting_link" class="form-control"
                                    value="{{ $app->meeting_link }}" placeholder="Paste Zoom / Google Meet link">
                            </div>

                        </div>

                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning loading-btn">
                                <span class="btn-label">Save Changes</span>
                                <span class="btn-loader">
                                    <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
                                </span>
                                <span class="btn-text ms-2">Updating...</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach
    @foreach ($applications as $app)
        <div class="modal fade" id="scheduleModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Schedule Appointment</h5>
                    </div>

                    <form action="{{ route('admin.application.schedule', $app->id) }}" method="POST">
                        @csrf

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="appointment_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Time</label>
                                <input type="time" name="appointment_time" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Meeting Type</label>
                                <select name="meeting_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option>Zoom</option>
                                    <option>Google Meet</option>
                                    <option>Face to Face</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Meeting Link</label>
                                <input type="url" name="meeting_link" class="form-control"
                                    placeholder="Paste Zoom / Google Meet link">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info loading-btn">
                                <span class="btn-label">Save Schedule</span>
                                <span class="btn-loader">
                                    <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
                                </span>
                                <span class="btn-text ms-2">Sending...</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @foreach ($applications as $app)
        <div class="modal fade" id="postDiscoveryModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable post-discovery-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title fw-bold mb-0">Post-Discovery Workflow</h5>
                            <div class="text-muted small">{{ $app->personal_full_name }} ·
                                {{ $app->brand ?? 'Franchise' }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <ol class="workflow-steps">
                            <li><strong>Discovery Session Completed</strong> - applicant is offered a voucher/coupon.
                            </li>
                            <li><strong>Voucher/Coupon Option</strong> - Yes goes to coupon registration; No goes
                                directly to franchise reservation registration.</li>
                            <li><strong>Coupon Registration</strong> - if applicable, select/register a coupon. Payment
                                reference is removed.</li>
                            <li><strong>Franchise Reservation Registration</strong> - admin fills out the reservation
                                form, like the OD reservation form.</li>
                            <li><strong>Submitted Forms</strong> - saved reservations appear in the admin submitted
                                forms list with print access.</li>
                        </ol>

                        @if (in_array($app->status, ['Discovery Session Done', 'Discovery Session Completed']))
                            <div class="workflow-panel">
                                <div class="workflow-panel-title">Voucher/Coupon Option</div>
                                <div class="d-flex flex-wrap gap-2">
                                    <form action="{{ route('admin.application.voucherOption', $app->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="voucher_option" value="yes">
                                        <button type="submit" class="btn btn-success loading-btn">
                                            <span class="btn-label">Yes, Register Coupon</span>
                                            <span class="btn-loader"><i
                                                    class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                            <span class="btn-text ms-2">Saving...</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.application.voucherOption', $app->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="voucher_option" value="no">
                                        <button type="submit" class="btn btn-dark loading-btn">
                                            <span class="btn-label">No, Proceed to Reservation Registration</span>
                                            <span class="btn-loader"><i
                                                    class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                            <span class="btn-text ms-2">Saving...</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if ($app->status === 'Voucher/Coupon Option')
                            <form action="{{ route('admin.application.registerCoupon', $app->id) }}" method="POST"
                                class="workflow-panel">
                                @csrf
                                <div class="workflow-panel-title">Coupon Registration</div>
                                <div class="reservation-grid">
                                    <div>
                                        <label class="form-label">Coupon</label>
                                        <select name="coupon_id" class="form-select" required>
                                            <option value="">Select coupon</option>
                                            @foreach ($availableCoupons as $coupon)
                                                <option value="{{ $coupon->id }}">
                                                    {{ $coupon->unique_code }} - {{ $coupon->claimable_item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Paid Amount</label>
                                        <input type="number" name="amount" class="form-control" min="0"
                                            step="0.01">
                                    </div>
                                    <div>
                                        <label class="form-label">Buyer Name</label>
                                        <input type="text" name="buyer_name" class="form-control"
                                            value="{{ $app->personal_full_name }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Buyer Email</label>
                                        <input type="email" name="buyer_email" class="form-control"
                                            value="{{ $app->email }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Buyer Contact</label>
                                        <input type="text" name="buyer_contact" class="form-control"
                                            value="{{ $app->personal_contact }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Mode of Payment</label>
                                        <select name="mode_of_payment" class="form-select">
                                            <option value="">Select Payment</option>
                                            <option value="Cash">Cash</option>
                                            <option value="GCash">GCash</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Card">Card</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="full">
                                        <label class="form-label">Buyer Address</label>
                                        <input type="text" name="buyer_address" class="form-control"
                                            value="{{ $app->personal_address }}" required>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-success loading-btn">
                                        <span class="btn-label">Proceed to Reservation Registration</span>
                                        <span class="btn-loader"><i
                                                class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                        <span class="btn-text ms-2">Saving...</span>
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if ($app->status === 'Franchisee Registration')
                            <form action="{{ route('admin.application.registerFranchisee', $app->id) }}"
                                method="POST" class="workflow-panel">
                                @csrf
                                <div class="workflow-panel-title">Franchisee Registration</div>
                                <div class="reservation-grid">
                                    <div>
                                        <label class="form-label">Franchisee Name</label>
                                        <input type="text" name="franchisee_name" class="form-control"
                                            value="{{ $app->personal_full_name }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Email</label>
                                        <input type="email" name="franchisee_email" class="form-control"
                                            value="{{ $app->email }}">
                                    </div>
                                    <div>
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" name="franchisee_contact" class="form-control"
                                            value="{{ $app->personal_contact }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Address</label>
                                        <input type="text" name="franchisee_address" class="form-control"
                                            value="{{ $app->personal_address }}" required>
                                    </div>
                                </div>
                                @if ($app->coupon)
                                    <div class="alert alert-info mt-3 mb-0">
                                        Coupon registered: <strong>{{ $app->coupon->unique_code }}</strong> -
                                        {{ $app->coupon->claimable_item }}
                                    </div>
                                @endif
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-dark loading-btn">
                                        <span class="btn-label">Submit Franchisee Details</span>
                                        <span class="btn-loader"><i
                                                class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                        <span class="btn-text ms-2">Saving...</span>
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if ($app->status === 'Franchisee Registered')
                            <div class="workflow-panel">
                                <div class="workflow-panel-title">Auto-Generated Agreement</div>
                                <p class="text-muted mb-3">Generate and print the Client Acknowledgement Agreement.
                                    Opening the document will move the application to Printed.</p>
                                <a href="{{ route('admin.application.acknowledgement.print', $app->id) }}"
                                    target="_blank" class="btn btn-dark js-workflow-print"
                                    data-open-workflow="{{ $app->id }}">
                                    <i class="fas fa-print me-2"></i>Print Client Acknowledgement Agreement
                                </a>
                            </div>
                        @endif

                        @if ($app->status === 'Printed')
                            <form action="{{ route('admin.application.proceedToPayment', $app->id) }}" method="POST"
                                class="workflow-panel">
                                @csrf
                                <div class="workflow-panel-title">Payment Status: Pending</div>
                                <p class="text-muted mb-3">The acknowledgement agreement has been printed. Continue
                                    when the application is ready for payment recording.</p>
                                <button type="submit" class="btn btn-warning loading-btn">
                                    <span class="btn-label">Proceed to Payment</span>
                                    <span class="btn-loader"><i
                                            class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                    <span class="btn-text ms-2">Saving...</span>
                                </button>
                            </form>
                        @endif

                        @if ($app->status === 'Pending Payment')
                            <form action="{{ route('admin.application.recordPayment', $app->id) }}" method="POST"
                                class="workflow-panel">
                                @csrf
                                <div class="workflow-panel-title">Record Payment</div>
                                <div class="reservation-grid">
                                    <div>
                                        <label class="form-label">Reference Number</label>
                                        <input type="text" name="payment_reference_no" class="form-control"
                                            value="{{ $app->payment_reference_no }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Sales Invoice Number</label>
                                        <input type="text" name="sales_invoice_no" class="form-control"
                                            value="{{ $app->sales_invoice_no }}" required>
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-success loading-btn">
                                        <span class="btn-label">Confirm Payment</span>
                                        <span class="btn-loader"><i
                                                class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                        <span class="btn-text ms-2">Saving...</span>
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if (in_array($app->status, ['Franchise Reservation Registration', 'Paid (Confirmed)']))
                            <form action="{{ route('admin.application.reservation.store', $app->id) }}"
                                method="POST" class="workflow-panel">
                                @csrf
                                <div class="workflow-panel-title">Franchise Reservation Registration</div>
                                <div class="reservation-grid">
                                    <div>
                                        <label class="form-label">Reservation Date</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ now()->toDateString() }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $app->personal_full_name }}" required>
                                    </div>
                                    <div class="full">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $app->personal_address }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Contact</label>
                                        <input type="text" name="contact" class="form-control"
                                            value="{{ $app->personal_contact }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $app->email }}">
                                    </div>
                                    <div class="full">
                                        <label class="form-label">Packages</label>
                                        @php
                                            $reservationPackages = [
                                                'kiosk' => 'Kiosk - 150k',
                                                'inline_cafe' => 'In-Line Cafe',
                                                'small' => 'Small - 45sqm to 74sqm - 350k',
                                                'medium' => 'Medium - 75sqm to 100sqm - 500k',
                                                'large' => 'Large - 100sqm and up - 750k',
                                                'sitdown' => 'Sit-Down Cafe - 150k',
                                                'foodtruck' => 'Food Truck - 150k',
                                                'flexible' => 'Flexible Package - Coupon / Flat Rate 350k',
                                            ];
                                        @endphp
                                        @foreach ($reservationPackages as $key => $label)
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <input type="checkbox" name="package[]" value="{{ $key }}"
                                                    id="pkg{{ $app->id }}{{ $key }}">
                                                <label for="pkg{{ $app->id }}{{ $key }}"
                                                    class="flex-grow-1">{{ $label }}</label>
                                                <input type="number" name="package_count[{{ $key }}]"
                                                    class="form-control" min="0" placeholder="Qty"
                                                    style="max-width:100px;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control"
                                            value="{{ $app->proposal_location }}">
                                    </div>
                                    <div class="d-flex align-items-end">
                                        <label class="form-check mb-2">
                                            <input type="checkbox" name="location_tba" value="1"
                                                class="form-check-input">
                                            Location TBA
                                        </label>
                                    </div>
                                    <div>
                                        <label class="form-label">Payment Mode</label>
                                        <select name="payment_mode" class="form-select" required>
                                            <option value="">Select</option>
                                            <option>Cash</option>
                                            <option>GCash</option>
                                            <option>Bank Deposit</option>
                                            <option>Bank Transfer</option>
                                            <option>Check</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Check No.</label>
                                        <input type="text" name="check_no" class="form-control">
                                    </div>
                                    <div>
                                        <label class="form-label">Signature</label>
                                        <input type="text" name="signature" class="form-control"
                                            value="{{ $app->personal_full_name }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Signature Date</label>
                                        <input type="date" name="signature_date" class="form-control"
                                            value="{{ now()->toDateString() }}" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Official Receipt No.</label>
                                        <input type="text" name="official_receipt_no" class="form-control"
                                            value="{{ $app->sales_invoice_no }}">
                                    </div>
                                    <div>
                                        <label class="form-label">Receipt Issued By</label>
                                        <input type="text" name="receipt_issued_by" class="form-control">
                                    </div>
                                    <div>
                                        <label class="form-label">Receipt Issued Date</label>
                                        <input type="date" name="receipt_issued_date" class="form-control"
                                            value="{{ now()->toDateString() }}">
                                    </div>
                                    <div>
                                        <label class="form-label">Reviewed By</label>
                                        <input type="text" name="reviewed_by" class="form-control">
                                    </div>
                                    <div>
                                        <label class="form-label">Reviewed Date</label>
                                        <input type="date" name="reviewed_date" class="form-control">
                                    </div>
                                    <div>
                                        <label class="form-label">Endorsed By</label>
                                        <input type="text" name="endorsed_by" class="form-control">
                                    </div>
                                    <div>
                                        <label class="form-label">Endorsed Date</label>
                                        <input type="date" name="endorsed_date" class="form-control">
                                    </div>
                                </div>
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-success loading-btn">
                                        <span class="btn-label">Submit Reservation</span>
                                        <span class="btn-loader"><i
                                                class="fa-solid fa-arrows-rotate fa-spin me-2"></i></span>
                                        <span class="btn-text ms-2">Saving...</span>
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if ($app->status === 'Franchise Reservation Registered')
                            <div class="workflow-panel mb-0">
                                <div class="workflow-panel-title">Franchise Reservation Registered</div>
                                <p class="mb-2">Reservation #{{ $app->franchise_reservation_id }} has been
                                    created.
                                </p>
                                @if ($app->franchise_reservation_id)
                                    <a href="{{ route('admin.portals.od.register-franchise.print', $app->franchise_reservation_id) }}"
                                        target="_blank" class="btn btn-dark">
                                        <i class="fas fa-print me-2"></i>Print Reservation
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade app-details-modal" id="appDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold mb-0">Application Details</h5>
                </div>

                <div class="modal-body" id="appModalBody">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border" role="status" aria-hidden="true"></div>
                        <div class="mt-2">Loading...</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade discovery-modal" id="discoverySlidesModal" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content discovery-content">
                <div class="discovery-stage">
                    <div class="discovery-topbar">
                        <div>
                            <div class="discovery-kicker">Franchise Discovery Presentation</div>
                            <div class="discovery-applicant" id="discoveryApplicantName">Applicant</div>
                        </div>
                        <div class="slide-progress" id="discoverySlideProgress">PowerPoint</div>
                    </div>

                    <div class="discovery-ppt-frame">
                        <iframe src="" title="Discovery presentation" class="discovery-ppt-viewer d-none"
                            id="discoveryPptViewer"></iframe>
                        <div class="discovery-ppt-placeholder d-none" id="discoveryPptPlaceholder">
                            <div>
                                <i class="fas fa-file-powerpoint"></i>
                                <h3 id="discoveryPptName">PowerPoint presentation ready</h3>
                                <p>
                                    The PowerPoint file is uploaded. Open it in a new tab to present it, then return
                                    here
                                    and click Finish.
                                </p>
                            </div>
                        </div>
                        <div class="discovery-empty-state d-none" id="discoveryEmptyState">
                            Upload a PPTX discovery presentation first, then start again.
                        </div>
                    </div>

                    <div class="discovery-controls">
                        <div class="slide-progress" id="discoveryStatusText">Discovery deck is ready.</div>
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="#" target="_blank"
                                class="slide-btn text-decoration-none d-inline-flex align-items-center"
                                id="discoveryOpenBtn">Open PPTX</a>
                            <button type="button" class="slide-btn primary" id="discoveryNextBtn">Finish</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            document.addEventListener("click", function(event) {
                const downloadBtn = event.target.closest(".download-pdf-btn");

                if (!downloadBtn) return;

                const label = downloadBtn.querySelector(".download-label");

                downloadBtn.classList.add("is-downloading");

                if (label) {
                    label.textContent = "Preparing PDF...";
                }

                setTimeout(function() {
                    downloadBtn.classList.remove("is-downloading");

                    if (label) {
                        label.textContent = "Download PDF";
                    }
                }, 3000);
            });

            document.querySelectorAll("form").forEach(form => {
                form.addEventListener("submit", function() {

                    const btn = form.querySelector('button[type="submit"], button:not([type])');

                    if (!btn) return;

                    btn.disabled = true;
                    btn.classList.add("loading");

                    const label = btn.querySelector(".btn-label");
                    if (label) label.style.display = "none";
                });
            });

            const alertBox = document.getElementById("uploadSuccessAlert");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.remove("show");
                    alertBox.classList.add("fade");
                    setTimeout(() => alertBox.remove(), 600);
                }, 2500);
            }

            const openWorkflowId = new URLSearchParams(window.location.search).get("open_workflow");
            if (openWorkflowId) {
                const workflowModalEl = document.getElementById(`postDiscoveryModal${openWorkflowId}`);
                if (workflowModalEl) {
                    new bootstrap.Modal(workflowModalEl).show();
                }
            }

            document.querySelectorAll(".js-workflow-print").forEach(link => {
                link.addEventListener("click", function() {
                    const workflowId = this.dataset.openWorkflow;

                    if (!workflowId) return;

                    setTimeout(() => {
                        const url = new URL(window.location.href);
                        url.searchParams.set("open_workflow", workflowId);
                        window.location.href = url.toString();
                    }, 900);
                });
            });

            const modalBody = document.getElementById("appModalBody");

            document.querySelectorAll(".js-view-app").forEach(btn => {
                btn.addEventListener("click", async function() {
                    const url = this.dataset.url;

                    modalBody.innerHTML = `
        <div class="text-center py-5 text-muted">
          <div class="spinner-border" role="status" aria-hidden="true"></div>
          <div class="mt-2">Loading...</div>
        </div>
      `;

                    try {
                        const res = await fetch(url, {
                            method: "GET",
                            headers: {
                                "X-Requested-With": "XMLHttpRequest",
                                "Accept": "text/html"
                            },
                            credentials: "same-origin"
                        });

                        const html = await res.text();

                        if (!res.ok) {
                            console.error("Modal load failed:", res.status, html);
                            throw new Error(`HTTP ${res.status}`);
                        }

                        modalBody.innerHTML = html;

                    } catch (error) {
                        console.error("Error loading modal:", error);
                        modalBody.innerHTML = `
          <div class="alert alert-danger mb-0">
            Failed to load application details.<br>
            <small>${error.message}</small>
          </div>
        `;
                    }
                });
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || "";
            const discoveryModalEl = document.getElementById("discoverySlidesModal");
            const discoveryModal = discoveryModalEl ? new bootstrap.Modal(discoveryModalEl) : null;
            const pptViewer = document.getElementById("discoveryPptViewer");
            const pptPlaceholder = document.getElementById("discoveryPptPlaceholder");
            const pptName = document.getElementById("discoveryPptName");
            const emptyState = document.getElementById("discoveryEmptyState");
            const openBtn = document.getElementById("discoveryOpenBtn");
            const nextBtn = document.getElementById("discoveryNextBtn");
            const progressText = document.getElementById("discoverySlideProgress");
            const statusText = document.getElementById("discoveryStatusText");
            const applicantName = document.getElementById("discoveryApplicantName");
            const discoveryStorageKey = "activeFranchiseDiscoveryDeck";

            let activePresentation = null;
            let activeDoneUrl = "";
            let activePresentationUrl = "";
            let activeWorkflowId = "";
            let finishingDiscovery = false;
            const localPresentationHostnames = ["localhost", "127.0.0.1", "::1"];
            const canUseOfficeViewer = !localPresentationHostnames.includes(window.location.hostname);

            const saveDiscoveryState = () => {
                if (!activeDoneUrl) return;

                localStorage.setItem(discoveryStorageKey, JSON.stringify({
                    applicantName: applicantName?.textContent || "Applicant",
                    doneUrl: activeDoneUrl,
                    presentationUrl: activePresentationUrl,
                    workflowId: activeWorkflowId,
                }));
            };

            const clearDiscoveryState = () => {
                localStorage.removeItem(discoveryStorageKey);
            };

            const loadDiscoveryPresentation = async (url) => {
                const response = await fetch(url, {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json"
                    },
                    credentials: "same-origin"
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const payload = await response.json();
                return payload.presentation || null;
            };

            const restoreDiscoveryState = async () => {
                if (!discoveryModal) return;

                const rawState = localStorage.getItem(discoveryStorageKey);
                if (!rawState) return;

                try {
                    const state = JSON.parse(rawState);

                    if (!state?.doneUrl || !state?.presentationUrl) {
                        clearDiscoveryState();
                        return;
                    }

                    activeDoneUrl = state.doneUrl;
                    activePresentationUrl = state.presentationUrl;
                    activeWorkflowId = state.workflowId || "";
                    activePresentation = await loadDiscoveryPresentation(activePresentationUrl);

                    if (!activePresentation) {
                        clearDiscoveryState();
                        return;
                    }

                    finishingDiscovery = false;

                    if (applicantName) {
                        applicantName.textContent = state.applicantName || "Applicant";
                    }

                    if (statusText) {
                        statusText.textContent = "Discovery meeting resumed.";
                    }

                    renderDiscoveryPresentation();
                    discoveryModal.show();
                } catch (error) {
                    console.error("Unable to restore discovery deck:", error);
                    clearDiscoveryState();
                }
            };

            const postApplicationStatus = async (url) => {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json"
                    },
                    credentials: "same-origin"
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                return response.json();
            };

            const renderDiscoveryPresentation = () => {
                const shouldShowViewer = !!activePresentation?.viewer_url && canUseOfficeViewer;

                if (pptViewer) {
                    if (shouldShowViewer) {
                        pptViewer.src = activePresentation.viewer_url;
                        pptViewer.classList.remove("d-none");
                    } else {
                        pptViewer.removeAttribute("src");
                        pptViewer.classList.add("d-none");
                    }
                }

                pptPlaceholder?.classList.toggle("d-none", !activePresentation || shouldShowViewer);

                if (pptName) {
                    pptName.textContent = activePresentation?.name || "PowerPoint presentation ready";
                }

                if (openBtn) {
                    openBtn.href = activePresentation?.url || "#";
                    openBtn.classList.toggle("disabled", !activePresentation?.url);
                }

                emptyState?.classList.toggle("d-none", !!activePresentation);

                if (progressText) {
                    progressText.textContent = activePresentation?.name || "PowerPoint";
                }

                if (nextBtn) {
                    nextBtn.textContent = "Finish";
                    nextBtn.disabled = !activePresentation || finishingDiscovery;
                }
            };

            document.querySelectorAll(".js-start-discovery-slides").forEach(button => {
                button.addEventListener("click", async () => {
                    if (!discoveryModal) return;

                    activeDoneUrl = button.dataset.doneUrl;
                    activePresentationUrl = button.dataset.slidesUrl;
                    activeWorkflowId = button.dataset.appId || "";
                    activePresentation = null;
                    finishingDiscovery = false;

                    if (applicantName) {
                        applicantName.textContent = button.dataset.appName || "Applicant";
                    }

                    if (statusText) {
                        statusText.textContent = "Loading PowerPoint presentation...";
                    }

                    button.disabled = true;

                    try {
                        activePresentation = await loadDiscoveryPresentation(
                            activePresentationUrl);

                        if (!activePresentation) {
                            renderDiscoveryPresentation();
                            if (statusText) {
                                statusText.textContent =
                                    "No PowerPoint presentation uploaded yet.";
                            }
                            window.alert("Please upload a PPTX file first.");
                            return;
                        }

                        renderDiscoveryPresentation();
                        saveDiscoveryState();
                        discoveryModal.show();

                        if (statusText) {
                            statusText.textContent = "Starting discovery meeting...";
                        }

                        await postApplicationStatus(button.dataset.startUrl);
                        saveDiscoveryState();
                        if (statusText) {
                            statusText.textContent = canUseOfficeViewer ?
                                "Discovery meeting started. Use the presentation viewer, then click Finish." :
                                "Discovery meeting started. Open the PPTX, then click Finish when done.";
                        }
                    } catch (error) {
                        console.error("Unable to start discovery:", error);
                        if (statusText) {
                            statusText.textContent =
                                "Could not start discovery. Please close and try again.";
                        }
                        if (nextBtn) nextBtn.disabled = true;
                        clearDiscoveryState();
                    } finally {
                        button.disabled = false;
                    }
                });
            });

            nextBtn?.addEventListener("click", async () => {
                if (!activeDoneUrl || finishingDiscovery) return;

                finishingDiscovery = true;
                renderDiscoveryPresentation();

                if (statusText) {
                    statusText.textContent = "Finishing discovery and marking as done...";
                }

                try {
                    await postApplicationStatus(activeDoneUrl);
                    clearDiscoveryState();
                    if (statusText) {
                        statusText.textContent = "Discovery completed. Refreshing list...";
                    }
                    setTimeout(() => {
                        const url = new URL(window.location.href);
                        if (activeWorkflowId) {
                            url.searchParams.set("open_workflow", activeWorkflowId);
                        }
                        window.location.href = url.toString();
                    }, 900);
                } catch (error) {
                    console.error("Unable to finish discovery:", error);
                    finishingDiscovery = false;
                    if (statusText) {
                        statusText.textContent =
                            "Could not mark as done. Please try Finish Discovery again.";
                    }
                    renderDiscoveryPresentation();
                    saveDiscoveryState();
                }
            });

            restoreDiscoveryState();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
