<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('partials.navbar')

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            @yield('content')

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>
        @include('partials.scripts')
</body>

</html>
