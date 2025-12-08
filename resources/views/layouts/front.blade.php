<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FVSP Terre Sainte 2026</title>

    @vite(['resources/css/app.css', 'resources/js/countdown.js'])

    @yield('top-scripts')

</head>

<body>

    <header class="header-shadow relative bg-white">
        <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between px-4 py-1">
            <div class="flex lg:hidden">
                <a href="/" class="-m-1.5 p-1.5">
                    <img src="{{ asset('images/logo.png') }}" width="50" height="50" alt="Logo FVSP Terre-Sainte 2026">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" popovertarget="desktop-menu-solutions" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-400">
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="font-display text-theme-blue hidden font-medium uppercase lg:flex lg:w-full lg:items-center lg:gap-x-12 xl:text-lg">
                <div class="flex flex-1 items-center justify-end gap-x-8 xl:gap-x-12">
                    {{-- <a href="/">Accueil</a> --}}
                    <a href="{{ route('pages.committee') }}">Organisation</a>
                    <a href="{{ route('sponsor.index') }}">Sponsoring</a>
                </div>
                <a href="/">
                <img src="{{ asset('images/logo.png') }}" width="100" height="100" class="xl:size-[150px]" alt="Logo FVSP Terre-Sainte 2026">
                </a>
                <div class="justify-left flex flex-1 items-center gap-x-8 xl:gap-x-12">
                    {{-- <a href="">Sponsors</a> --}}
                    <a href="{{ route('contact.index') }}" class="">Contact</a>
                    <a href="/admin">Login</a>
                </div>
            </div>
        </nav>
        <el-popover id="desktop-menu-solutions" popover
            class="transition-discrete data-closed:-translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in relative top-0 w-full overflow-visible bg-white transition backdrop:bg-transparent open:block">
            <div aria-hidden="true" class="popover-shadow absolute inset-0 top-1/2 bg-white ring-1 ring-gray-900/5"></div>
            <div class="font-display text-theme-blue relative grid justify-items-start gap-y-3 bg-white px-4 pb-5 pt-10 text-sm font-medium uppercase">
                <a href="/">Accueil</a>
                <a href="{{ route('pages.committee') }}">Organisation</a>
                {{-- <a href="programme.html">Programme</a> --}}
                <a href="{{ route('sponsor.index') }}">Sponsors</a>
                <a href="{{ route('contact.index') }}">Contact</a>
                <a href="/admin">Login</a>
            </div>
        </el-popover>
    </header>

    <main>

        @yield('content')

    </main>

    <footer class="bg-theme-light-blue pb-8 pt-10">
        <div class="container mx-auto px-4">
            <div class="mb-10 flex flex-col gap-x-8 gap-y-8 md:flex-row lg:gap-x-14">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" width="150" height="150" class="size-[80px] shrink-0 sm:size-[110px] lg:size-[150px]" alt="Logo FVSP Terre-Sainte 2026">
                </a>
                <nav class="font-display text-theme-blue grid justify-items-start gap-x-8 gap-y-2 font-medium uppercase *:hover:underline lg:grid-cols-[max-content_max-content]">
                    {{-- <a href="/">Accueil</a> --}}
                    <a href="{{ route('pages.committee') }}">Organisation</a>
                    {{-- <a href="programme.html">Programme</a> --}}
                    <a href="{{ route('sponsor.index') }}">Sponsors</a>
                    <a href="{{ route('contact.index') }}">Contact</a>
                    <a href="/admin">Login</a>
                </nav>
                <div class="w-max flex-1 shrink-0 space-y-5">
                    <div class="flex items-center gap-x-3 gap-y-0.5 max-lg:flex-wrap md:justify-end">
                        <span class="font-display text-theme-red font-medium uppercase">SDIS Terre-Sainte</span>
                        <div class="flex items-center gap-x-2">
                            <a href="https://sdis-ts.ch/" target="_blank" aria-title="Voir le site du SDIS Terre-Sainte">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path
                                        d="M11 19.0067C11.2849 19.0067 12.0393 18.7295 12.8323 17.1436C13.171 16.4623 13.4636 15.6347 13.6791 14.6955H8.32094C8.5365 15.6347 8.82904 16.4623 9.16778 17.1436C9.96073 18.7295 10.7152 19.0067 11 19.0067ZM8.01685 12.8478H13.9832C14.0448 12.2589 14.0795 11.6391 14.0795 11.0002C14.0795 10.3612 14.0448 9.74145 13.9832 9.15251H8.01685C7.95526 9.74145 7.92061 10.3612 7.92061 11.0002C7.92061 11.6391 7.95526 12.2589 8.01685 12.8478ZM8.32094 7.30485H13.6791C13.4636 6.36562 13.171 5.53803 12.8323 4.85671C12.0393 3.2708 11.2849 2.99365 11 2.99365C10.7152 2.99365 9.96073 3.2708 9.16778 4.85671C8.82904 5.53803 8.5365 6.36562 8.32094 7.30485ZM15.8386 9.15251C15.8963 9.74914 15.9233 10.3689 15.9233 11.0002C15.9233 11.6314 15.8925 12.2512 15.8386 12.8478H18.791C18.9296 12.255 19.0065 11.6353 19.0065 11.0002C19.0065 10.365 18.9334 9.7453 18.791 9.15251H15.8424H15.8386ZM18.102 7.30485C17.2782 5.72279 15.9425 4.45253 14.3143 3.70962C14.857 4.69504 15.2881 5.92296 15.5691 7.30485H18.1058H18.102ZM6.42709 7.30485C6.70809 5.92296 7.13921 4.69888 7.68196 3.70962C6.05371 4.45253 4.71801 5.72279 3.89426 7.30485H6.43094H6.42709ZM3.20909 9.15251C3.07052 9.7453 2.99353 10.365 2.99353 11.0002C2.99353 11.6353 3.06667 12.255 3.20909 12.8478H6.16149C6.10375 12.2512 6.07681 11.6314 6.07681 11.0002C6.07681 10.3689 6.1076 9.74914 6.16149 9.15251H3.20909ZM14.3143 18.2907C15.9425 17.5478 17.2782 16.2775 18.102 14.6955H15.5691C15.2881 16.0774 14.857 17.3014 14.3143 18.2907ZM7.68581 18.2907C7.14306 17.3053 6.71194 16.0774 6.43094 14.6955H3.89426C4.71801 16.2775 6.05371 17.5478 7.68196 18.2907H7.68581ZM11 20.8543C8.38655 20.8543 5.88011 19.8161 4.03209 17.9681C2.18408 16.1201 1.14587 13.6136 1.14587 11.0002C1.14587 8.38667 2.18408 5.88023 4.03209 4.03221C5.88011 2.1842 8.38655 1.146 11 1.146C13.6135 1.146 16.12 2.1842 17.968 4.03221C19.816 5.88023 20.8542 8.38667 20.8542 11.0002C20.8542 13.6136 19.816 16.1201 17.968 17.9681C16.12 19.8161 13.6135 20.8543 11 20.8543Z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/sdis_terre_sainte/" target="_blank" class="" aria-label="Voir la page instagram du SDIS Terre-Sainte">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path
                                        d="M11.0043 6.05879C8.27153 6.05879 6.06724 8.26308 6.06724 10.9959C6.06724 13.7287 8.27153 15.933 11.0043 15.933C13.7372 15.933 15.9415 13.7287 15.9415 10.9959C15.9415 8.26308 13.7372 6.05879 11.0043 6.05879ZM11.0043 14.2057C9.23833 14.2057 7.79458 12.7662 7.79458 10.9959C7.79458 9.22558 9.23403 7.78613 11.0043 7.78613C12.7747 7.78613 14.2141 9.22558 14.2141 10.9959C14.2141 12.7662 12.7704 14.2057 11.0043 14.2057ZM17.295 5.85683C17.295 6.49707 16.7793 7.0084 16.1434 7.0084C15.5032 7.0084 14.9918 6.49277 14.9918 5.85683C14.9918 5.2209 15.5075 4.70527 16.1434 4.70527C16.7793 4.70527 17.295 5.2209 17.295 5.85683ZM20.5649 7.02558C20.4918 5.48301 20.1395 4.1166 19.0094 2.99082C17.8836 1.86504 16.5172 1.5127 14.9747 1.43535C13.3848 1.34512 8.61958 1.34512 7.02974 1.43535C5.49146 1.5084 4.12505 1.86074 2.99497 2.98652C1.86489 4.1123 1.51685 5.47871 1.4395 7.02129C1.34927 8.61113 1.34927 13.3764 1.4395 14.9662C1.51255 16.5088 1.86489 17.8752 2.99497 19.001C4.12505 20.1268 5.48716 20.4791 7.02974 20.5564C8.61958 20.6467 13.3848 20.6467 14.9747 20.5564C16.5172 20.4834 17.8836 20.1311 19.0094 19.001C20.1352 17.8752 20.4875 16.5088 20.5649 14.9662C20.6551 13.3764 20.6551 8.61543 20.5649 7.02558ZM18.511 16.6721C18.1758 17.5143 17.527 18.1631 16.6805 18.5025C15.4129 19.0053 12.4051 18.8893 11.0043 18.8893C9.60356 18.8893 6.59145 19.001 5.32817 18.5025C4.48599 18.1674 3.83716 17.5186 3.49771 16.6721C2.99497 15.4045 3.11099 12.3967 3.11099 10.9959C3.11099 9.59511 2.99927 6.58301 3.49771 5.31973C3.83286 4.47754 4.48169 3.82871 5.32817 3.48926C6.59575 2.98652 9.60356 3.10254 11.0043 3.10254C12.4051 3.10254 15.4172 2.99082 16.6805 3.48926C17.5227 3.82441 18.1715 4.47324 18.511 5.31973C19.0137 6.5873 18.8977 9.59511 18.8977 10.9959C18.8977 12.3967 19.0137 15.4088 18.511 16.6721Z" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/sdisterresainte" target="_blank" aria-label="Voir la page facebook du SDIS Terre-Sainte">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path d="M16.1193 12.375L16.7303 8.39352H12.9099V5.8098C12.9099 4.72055 13.4436 3.65879 15.1546 3.65879H16.8914V0.268984C16.8914 0.268984 15.3153 0 13.8084 0C10.6622 0 8.60575 1.90695 8.60575 5.35906V8.39352H5.10852V12.375H8.60575V22H12.9099V12.375H16.1193Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-3 gap-y-0.5 max-lg:flex-wrap md:justify-end">
                        <span class="font-display text-theme-red font-medium uppercase">FVSP</span>
                        <div class="flex items-center gap-x-2">
                            <a href="https://fvsp.ch/" target="_blank" aria-title="voir le site">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path
                                        d="M11 19.0067C11.2849 19.0067 12.0393 18.7295 12.8323 17.1436C13.171 16.4623 13.4636 15.6347 13.6791 14.6955H8.32094C8.5365 15.6347 8.82904 16.4623 9.16778 17.1436C9.96073 18.7295 10.7152 19.0067 11 19.0067ZM8.01685 12.8478H13.9832C14.0448 12.2589 14.0795 11.6391 14.0795 11.0002C14.0795 10.3612 14.0448 9.74145 13.9832 9.15251H8.01685C7.95526 9.74145 7.92061 10.3612 7.92061 11.0002C7.92061 11.6391 7.95526 12.2589 8.01685 12.8478ZM8.32094 7.30485H13.6791C13.4636 6.36562 13.171 5.53803 12.8323 4.85671C12.0393 3.2708 11.2849 2.99365 11 2.99365C10.7152 2.99365 9.96073 3.2708 9.16778 4.85671C8.82904 5.53803 8.5365 6.36562 8.32094 7.30485ZM15.8386 9.15251C15.8963 9.74914 15.9233 10.3689 15.9233 11.0002C15.9233 11.6314 15.8925 12.2512 15.8386 12.8478H18.791C18.9296 12.255 19.0065 11.6353 19.0065 11.0002C19.0065 10.365 18.9334 9.7453 18.791 9.15251H15.8424H15.8386ZM18.102 7.30485C17.2782 5.72279 15.9425 4.45253 14.3143 3.70962C14.857 4.69504 15.2881 5.92296 15.5691 7.30485H18.1058H18.102ZM6.42709 7.30485C6.70809 5.92296 7.13921 4.69888 7.68196 3.70962C6.05371 4.45253 4.71801 5.72279 3.89426 7.30485H6.43094H6.42709ZM3.20909 9.15251C3.07052 9.7453 2.99353 10.365 2.99353 11.0002C2.99353 11.6353 3.06667 12.255 3.20909 12.8478H6.16149C6.10375 12.2512 6.07681 11.6314 6.07681 11.0002C6.07681 10.3689 6.1076 9.74914 6.16149 9.15251H3.20909ZM14.3143 18.2907C15.9425 17.5478 17.2782 16.2775 18.102 14.6955H15.5691C15.2881 16.0774 14.857 17.3014 14.3143 18.2907ZM7.68581 18.2907C7.14306 17.3053 6.71194 16.0774 6.43094 14.6955H3.89426C4.71801 16.2775 6.05371 17.5478 7.68196 18.2907H7.68581ZM11 20.8543C8.38655 20.8543 5.88011 19.8161 4.03209 17.9681C2.18408 16.1201 1.14587 13.6136 1.14587 11.0002C1.14587 8.38667 2.18408 5.88023 4.03209 4.03221C5.88011 2.1842 8.38655 1.146 11 1.146C13.6135 1.146 16.12 2.1842 17.968 4.03221C19.816 5.88023 20.8542 8.38667 20.8542 11.0002C20.8542 13.6136 19.816 16.1201 17.968 17.9681C16.12 19.8161 13.6135 20.8543 11 20.8543Z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/fvsp_sapeurspompiers_vaudois/" target="_blank" class="" aria-label="voir notre page instagram">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path
                                        d="M11.0043 6.05879C8.27153 6.05879 6.06724 8.26308 6.06724 10.9959C6.06724 13.7287 8.27153 15.933 11.0043 15.933C13.7372 15.933 15.9415 13.7287 15.9415 10.9959C15.9415 8.26308 13.7372 6.05879 11.0043 6.05879ZM11.0043 14.2057C9.23833 14.2057 7.79458 12.7662 7.79458 10.9959C7.79458 9.22558 9.23403 7.78613 11.0043 7.78613C12.7747 7.78613 14.2141 9.22558 14.2141 10.9959C14.2141 12.7662 12.7704 14.2057 11.0043 14.2057ZM17.295 5.85683C17.295 6.49707 16.7793 7.0084 16.1434 7.0084C15.5032 7.0084 14.9918 6.49277 14.9918 5.85683C14.9918 5.2209 15.5075 4.70527 16.1434 4.70527C16.7793 4.70527 17.295 5.2209 17.295 5.85683ZM20.5649 7.02558C20.4918 5.48301 20.1395 4.1166 19.0094 2.99082C17.8836 1.86504 16.5172 1.5127 14.9747 1.43535C13.3848 1.34512 8.61958 1.34512 7.02974 1.43535C5.49146 1.5084 4.12505 1.86074 2.99497 2.98652C1.86489 4.1123 1.51685 5.47871 1.4395 7.02129C1.34927 8.61113 1.34927 13.3764 1.4395 14.9662C1.51255 16.5088 1.86489 17.8752 2.99497 19.001C4.12505 20.1268 5.48716 20.4791 7.02974 20.5564C8.61958 20.6467 13.3848 20.6467 14.9747 20.5564C16.5172 20.4834 17.8836 20.1311 19.0094 19.001C20.1352 17.8752 20.4875 16.5088 20.5649 14.9662C20.6551 13.3764 20.6551 8.61543 20.5649 7.02558ZM18.511 16.6721C18.1758 17.5143 17.527 18.1631 16.6805 18.5025C15.4129 19.0053 12.4051 18.8893 11.0043 18.8893C9.60356 18.8893 6.59145 19.001 5.32817 18.5025C4.48599 18.1674 3.83716 17.5186 3.49771 16.6721C2.99497 15.4045 3.11099 12.3967 3.11099 10.9959C3.11099 9.59511 2.99927 6.58301 3.49771 5.31973C3.83286 4.47754 4.48169 3.82871 5.32817 3.48926C6.59575 2.98652 9.60356 3.10254 11.0043 3.10254C12.4051 3.10254 15.4172 2.99082 16.6805 3.48926C17.5227 3.82441 18.1715 4.47324 18.511 5.31973C19.0137 6.5873 18.8977 9.59511 18.8977 10.9959C18.8977 12.3967 19.0137 15.4088 18.511 16.6721Z" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/FVSP.pompiers.vaudoise/" target="_blank" aria-label="voir notre page facebook">
                                <svg width="22" height="22" fill="#1246A1">
                                    <path d="M16.1193 12.375L16.7303 8.39352H12.9099V5.8098C12.9099 4.72055 13.4436 3.65879 15.1546 3.65879H16.8914V0.268984C16.8914 0.268984 15.3153 0 13.8084 0C10.6622 0 8.60575 1.90695 8.60575 5.35906V8.39352H5.10852V12.375H8.60575V22H12.9099V12.375H16.1193Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-300 pt-6">
                <div class="flex flex-wrap justify-between gap-1 text-gray-600">
                    <div>© 2025 SDIS Terre-Sainte.</div>
                    {{-- <a href="">Politique de confidentialité</a> --}}
                </div>
            </div>
        </div>
    </footer>

    @yield('bottom-scripts')

</body>

</html>
