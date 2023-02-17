<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="nepgov, news, voting">

    {{-- for facebook --}}
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="@yield('topicname')" />


    {{-- for twitter --}}
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:description" content="@yield('topicname')">
 
 

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>NepGov</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/transparent-style.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/skin-modes.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet" />


    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('backend') }}/assets/colors/color1.css" />

    


    @yield('links')

</head>
