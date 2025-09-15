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
  <body  class=" d-flex flex-column bg-white">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="row g-0 flex-fill bg-cover h-100 min-vh-100" style="background-image: url(/static/photos/trucks.jpg)">

        <div class="col-12 col-lg-6 col-xl-6 border-primary d-flex flex-column justify-content-center">
        <div class="container-tight">
            <h2 class="page-title" style="color: #010408; font-size:50px; white-space: nowrap;">
                Content Search Service
            </h2>
        </div>
        </div>

        <div class="col-lg col-xl-4 border-primary d-flex flex-column justify-content-center">
            <div class="container-tight">
              <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-4">
                    </div>

                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                        @endforeach
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2 class="h2 text-center mb-4">Login Page</h2>
                    <form action="{{ route('login.post') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Email" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input name="password" type="password" class="form-control"  placeholder="Password"  autocomplete="off">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

    </div>
    <!-- Libs JS -->

    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>
