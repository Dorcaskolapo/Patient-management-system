
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from tabib-v2.inaikas.com/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Mar 2024 14:56:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon-32x32.png')}}">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="{{asset('assets/main/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/main/css/style.css')}}">
</head>

<body class="auth">
    <div id="main-wrapper" class="show">

        @yield('content')

    </div>

    <!-- JQuery v3.5.1 -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

    <!-- popper js -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Moment -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>

    <!-- Date Range Picker -->
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.min.js')}}"></script>

    <!-- Main Custom JQuery -->
    <script src="{{asset('assets/js/toggleFullScreen.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/option-themes.js')}}"></script>

</body>

</html>