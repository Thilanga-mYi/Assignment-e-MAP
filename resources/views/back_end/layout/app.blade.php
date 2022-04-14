<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS files -->
    <link href="{{ asset('assets_back_end/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/css/app.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets_back_end/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets_back_end/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ asset('assets_back_end/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/select-picker/dist/picker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_back_end/plugins/blueimp-file-upload/css/jquery.fileupload.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('assets_back_end/css/notiflix.css') }}" rel="stylesheet" />



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');

        .header_new_text {
            font-family: 'Ubuntu', sans-serif;
        }

        .seldisable {
            pointer-events: none;
            background-color: #DAE0EC;
        }

        .custom-file input[type='file'] {
            display: none;
        }

        .coverimg {
            /* background-image: url('{{ asset('assets_back_end/img/bg/bg.svg') }}'); */
            background-repeat: no-repeat, no-repeat;
            background-size: cover;
        }

    </style>

</head>

<body class="coverimg">
    <div>
        <main>
            <div id="app" class="app">

                <div id="header" class="app-header bg-dark">

                    <div class="mobile-toggler">
                        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </div>

                    <div class="brand">
                        <div class="desktop-toggler">
                            <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </button>
                        </div>
                        <a href="/" class="brand-logo">
                            <h5 class="text-white pt-2">ADMIN PANEL</h5>
                        </a>
                    </div>

                    <div class="menu justify-content-end">

                        <div class="menu-item dropdown">

                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                                <div class="menu-img online">
                                    <img src="{{ asset('assets_back_end/img/user.png') }}" alt=""
                                        class="mw-100 mh-100 rounded-circle" />
                                </div>
                                <div class="menu-text">
                                    <span class="text-white" data-cfemail="">{{ Auth::user()->name }}</span>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end me-lg-3">
                                <a class="dropdown-item d-flex align-items-center" href="/logout">Log Out
                                    <i class="fa fa-toggle-off fa-fw ms-auto text-gray-400 fs-16px"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="sidebar" class="app-sidebar bg-white">

                    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

                        <div class="menu">

                            <div class="menu-header">Authorization Details</div>

                            <div class="menu-item">
                                <a class="menu-link">
                                    @if (Auth::user()->user_type_id == 1)
                                        <span>Admin</span>
                                    @endif
                                    @if (Auth::user()->user_type_id == 2)
                                        <span>LAB Operator</span>
                                    @endif
                                    @if (Auth::user()->user_type_id == 3)
                                        <span>XRAY Operator</span>
                                    @endif
                                    @if (Auth::user()->user_type_id == 4)
                                        <span>Doctor</span>
                                    @endif
                                    @if (Auth::user()->user_type_id == 5)
                                        <span>-</span>
                                    @endif
                                </a>

                                <a class="menu-link">
                                    <span>{{ Auth::user()->email }}</span>
                                </a>
                            </div>

                            <br>

                            <div class="menu-header">Dashboard</div>

                            <div class="menu-item">
                                <a href="/home" class="menu-link">
                                    <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
                </div>

                @yield('content')
                <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

            </div>
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets_back_end/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/js/app.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script src="{{ asset('assets_back_end/js/jquery.maskedinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets_back_end/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets_back_end/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets_back_end/plugins/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets_back_end/plugins/tag-it/js/tag-it.min.js') }}"></script>

    <script src="{{ asset('assets_back_end/js/notiflix.js') }}"></script>
    <script src="{{ asset('assets_back_end/js/process/print.js') }}"></script>
    <script src="{{ asset('assets_back_end/js/process/back_end_js.js') }}"></script>

    <script src="{{ asset('assets_back_end/js/rocket-loader.min.js') }}" data-cf-settings="0485eeef8cf3263d1a7b2548-|49"
        defer="">
    </script>


</body>

</html>
