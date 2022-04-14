<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS files -->

    <link href="{{asset('assets_back_end/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets_back_end/css/app.min.css')}}" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap');

        .header_new_text {
            font-family: 'Quicksand', sans-serif;
        }

        .seldisable {
            pointer-events: none;
            background-color: #DAE0EC;
        }

        .dataTables_paginate a {
            padding: 6px 12px !important;
            /* border: 2px solid #eeeeee; */
            border-radius: 3px;
            background: white !important;
            border-color: white !important;
        }

        .dataTables_paginate a:hover {
            background: #eeeeee !important;
            /* color: #ffffff */
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid lightgrey;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            padding: 4px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid lightgrey;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            margin-left: 3px;
        }

        .btnround {
            display: block;
            height: 30px;
            width: 30px;
            border-radius: 50%;
        }

        #gradient {
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body class="antialiased" id="gradient">
    <div>

        <main class="py-5">
            @yield('content')
        </main>
    </div>

    <footer class="text-center">
        <div class="inner">
            <p class="text-dark-100"> {{ Carbon\Carbon::now()->format('Y') }} © Powered by <a class="text-white"
                    style="text-decoration: none" href="https://aries.lk/">Aries Software Solutions</a></p>
        </div>
    </footer>

    <script src="{{asset('assets/js/vendor.min.js')}}" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="{{asset('assets/js/app.min.js')}}" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="{{asset('assets/js/demo/dashboard.demo.js')}}" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>

    <script>
        var colors = new Array(
  [0,200,83],
  // [52,52,52],
  // [196,42,42],
  [33,33,33],
  // [32,32,32],
  // [196,42,42],
  [51,105,30],
  [38,50,56]);

var step = 0;
//color table indices for:
// current color left
// next color left
// current color right
// next color right
var colorIndices = [0,1,2,3,4];

//transition speed
var gradientSpeed = 0.005;

function updateGradient()
{

  if ( $===undefined ) return;

var c0_0 = colors[colorIndices[0]];
var c0_1 = colors[colorIndices[1]];
var c1_0 = colors[colorIndices[2]];
var c1_1 = colors[colorIndices[3]];

var istep = 1 - step;
var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
var color1 = "rgb("+r1+","+g1+","+b1+")";

var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
var color2 = "rgb("+r2+","+g2+","+b2+")";

 $('#gradient').css({
   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

  step += gradientSpeed;
  if ( step >= 1 )
  {
    step %= 1;
    colorIndices[0] = colorIndices[1];
    colorIndices[2] = colorIndices[3];

    //pick two new target color indices
    //do not pick the same as the current one
    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

  }
}

setInterval(updateGradient,10);
    </script>

</body>

</html>
