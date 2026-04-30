<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Livret de fête | Concours FVSP 2026</title>
    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook/dflip/css/dflip.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook/dflip/css/themify-icons.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; overflow: hidden; background: #1a1a2e; }

        #viewer-bar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 9999;
            height: 52px;
            background: #111827;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        #viewer-bar a, #viewer-bar button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.75);
            font-family: system-ui, sans-serif;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            background: rgba(255,255,255,0.08);
            border: none;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }

        #viewer-bar a:hover, #viewer-bar button:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        #viewer-bar .bar-title {
            font-family: system-ui, sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
            flex: 1;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #flipbook-wrapper {
            position: fixed;
            top: 52px; left: 0; right: 0; bottom: 0;
        }

        #flipbook {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <div id="viewer-bar">
        <a href="{{ route('pages.livret') }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Retour
        </a>

        <span class="bar-title">Livret de fête — Concours FVSP 2026</span>

        <a href="{{ asset('Concours FVSP 2026 - Livret complet - 20260430.pdf') }}" download>
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Télécharger
        </a>
    </div>

    <div id="flipbook-wrapper">
        <div id="flipbook"
             class="_df_book"
             source="{{ asset('Concours FVSP 2026 - Livret complet - 20260430.pdf') }}">
        </div>
    </div>

    <script>
        var option_flipbook = {
            webgl: true,
            height: '100%',
            duration: 800,
            paddingTop: 10,
            paddingBottom: 10,
            paddingLeft: 10,
            paddingRight: 10,
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook/dflip/js/dflip.min.js"></script>

</body>

</html>
