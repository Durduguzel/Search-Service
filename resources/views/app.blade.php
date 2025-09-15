<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Content Search Service</title>
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('dashboard.index') }}">
                    Search Service
                    </a>
                </h1>

                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item @if (Request::segment(1) === 'dashboard') active @endif">
                            <a class="nav-link" href="{{ route('dashboard.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                            </span>
                            <span class="nav-link-title">
								Dashboard
                            </span>
                            </a>
                        </li>

                        <li class="nav-item @if (Request::segment(1) === 'providers') active @endif">
                            <a class="nav-link" href="{{ route('dashboard.providers') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-binary-tree" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 20a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M16 4a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M16 20a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M11 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M21 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" /><path d="M5.058 18.306l2.88 -4.606" /><path d="M10.061 10.303l2.877 -4.604" /><path d="M10.065 13.705l2.876 4.6" /><path d="M15.063 5.7l2.881 4.61" /></svg>
                            </span>
                            <span class="nav-link-title">
								Providers
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!--nav bar top-->
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(/static/avatars/user-icon.jpg)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <!-- page content -->
            @yield('content')
            <!-- /page content -->
            <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ \Carbon\Carbon::now()->year }}
                                All rights reserved.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </footer>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
    <script src="/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
    <script src="/dist/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
    <script src="/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/dist/js/demo.min.js?1692870487" defer></script>

	<script src="/dist/libs/litepicker/dist/litepicker.js?1692870487" defer></script>
	<script>
		// @formatter:off
		document.addEventListener("DOMContentLoaded", function () {
			window.Litepicker && (new Litepicker({
				element: document.getElementById('datepicker-1'),
				buttonText: {
					previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
					nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
				},
			}));
		});
		document.addEventListener("DOMContentLoaded", function () {
			window.Litepicker && (new Litepicker({
				element: document.getElementById('datepicker-2'),
				buttonText: {
					previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
					nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
				},
			}));
		});
		document.addEventListener("DOMContentLoaded", function () {
			window.Litepicker && (new Litepicker({
				element: document.getElementById('datepicker-3'),
				buttonText: {
					previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
					nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
				},
			}));
		});
		document.addEventListener("DOMContentLoaded", function () {
			window.Litepicker && (new Litepicker({
				element: document.getElementById('datepicker-4'),
				buttonText: {
					previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
					nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
		<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
				},
			}));
		});
		// @formatter:on
	</script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    @yield('footerJs')

  </body>
</html>
