<!doctype html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if(isset($title))
            {{ $title }} - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    @vite(['resources/scss/app.scss'])

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/9e115321b2.js" crossorigin="anonymous"></script>

  </head>

  <body id="app" class="bg-light">
    @include("_partials.navigation")

    <main class="py-4">
        <div class="container-fluid vstack gap-4">
            @include('_partials.flash-messages')
        
            <!-- Header -->
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="hstack gap-3">

                            @if(isset($showBackButton))
                            <a href="#" onclick="window.history.back()" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            @endif

                            @hasSection('heading')
                                @yield("heading")
                            @else
                                <h1 class="h2 m-0">{{ $title ?? "Stránka bez názvu" }}</h1>
                            @endif

                        </div>
                        <div class="hstack gap-2 text-nowrap">
                            @yield("buttons")
                        </div>
                    </div>
                </div>
            </div>

            @yield("main")
        </div>
    </main>

    @yield("bottom")
    @vite(['resources/js/app.js'])
    @yield("js-footer")
  </body>
</html>
