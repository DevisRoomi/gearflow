<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearFlow — Buku Log & Peminjaman Alat Studio</title>
    <meta name="description" content="Sistem logbook fisik dan sirkulasi peminjaman perangkat produksi multimedia & lab studio.">
    <meta name="theme-color" content="#F4EFE6">

    <!-- Custom Inlined SVG Favicon (Brutalist Black/Yellow Ticket Stamp) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='4' fill='%23FACC15' stroke='%23121214' stroke-width='3'/%3E%3Cpath d='M8 10h16M8 16h10M8 22h14' stroke='%23121214' stroke-width='2.5' stroke-linecap='round'/%3E%3Ccircle cx='23' cy='16' r='2' fill='%23E11D48' stroke='%23121214' stroke-width='1.5'/%3E%3C/svg%3E">

    <!-- Typography: Syne (Display Editorial), Plus Jakarta Sans (Readable UI), JetBrains Mono (Codes & Serials) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Syne:wght@700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CDN for utility primitives -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --ink: #121214;
            --paper: #F5EFEB;
            --card-bg: #FFFFFF;
            --border-thick: 2.5px solid var(--ink);
            --shadow-hard: 4px 4px 0px var(--ink);
            --shadow-hard-hover: 6px 6px 0px var(--ink);
            --shadow-hard-pressed: 1px 1px 0px var(--ink);
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--paper);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        .font-display {
            font-family: 'Syne', sans-serif;
            letter-spacing: -0.02em;
        }

        .font-mono-tag {
            font-family: 'JetBrains Mono', monospace;
        }

        .brutal-box {
            background-color: var(--card-bg);
            border: var(--border-thick);
            box-shadow: var(--shadow-hard);
            border-radius: 10px;
        }

        .brutal-interactive {
            background-color: var(--card-bg);
            border: var(--border-thick);
            box-shadow: var(--shadow-hard);
            border-radius: 10px;
            transition: transform 0.12s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.12s cubic-bezier(0.2, 0, 0, 1);
        }
        .brutal-interactive:hover {
            transform: translate(-2px, -2px);
            box-shadow: var(--shadow-hard-hover);
        }

        .brutal-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: var(--border-thick);
            box-shadow: var(--shadow-hard);
            border-radius: 8px;
            font-weight: 700;
            transition: transform 0.08s ease, box-shadow 0.08s ease;
            cursor: pointer;
            user-select: none;
        }
        .brutal-button:hover {
            transform: translate(-1.5px, -1.5px);
            box-shadow: var(--shadow-hard-hover);
        }
        .brutal-button:active {
            transform: translate(2px, 2px);
            box-shadow: var(--shadow-hard-pressed);
        }

        .brutal-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border: 2px solid var(--ink);
            box-shadow: 2px 2px 0px var(--ink);
            border-radius: 9999px;
            font-weight: 700;
        }

        .brutal-input {
            border: var(--border-thick);
            box-shadow: 3px 3px 0px var(--ink);
            border-radius: 8px;
            outline: none;
            transition: box-shadow 0.1s ease;
        }
        .brutal-input:focus-visible {
            box-shadow: 5px 5px 0px var(--ink);
            background-color: #FFFDF9;
        }

        /* Keyboard Accessibility Focus Rings */
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 3px solid #18181B;
            outline-offset: 2px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #EAE3D9;
        }
        ::-webkit-scrollbar-thumb {
            background: #121214;
            border-radius: 4px;
        }
    </style>
</head>
<body class="min-h-screen py-6 px-3 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto space-y-6">
        @include('partials.header')
        @include('partials.flash')
        @yield('content')
    </div>

    @include('partials.loan-modal')

    <footer class="max-w-7xl mx-auto pt-10 pb-6 text-center text-xs font-semibold text-zinc-600">
        <p class="font-mono-tag">GEARFLOW // STUDIO OPERATIONAL LEDGER & ASSET REGISTRY</p>
        <p class="mt-1 text-zinc-500">Peralatan inventaris milik studio. Rusak/hilang wajib dilaporkan maksimal 1x24 jam.</p>
    </footer>

    @stack('scripts')
</body>
</html>
