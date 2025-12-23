<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#4dff29ff">
        <meta name="robots" content="noindex,follow">
        <meta name="google" content="notranslate">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/css/styles.css">

        <title>
        @hasSection ('title')
             @yield('title')&nbsp;-&nbsp;
        @endif
        {{config('app.name')}}
        </title>        

        @yield('head')
    <body>
        @yield('header')
        <div id="content" class="container">
            @yield('content')
        </div>
        @yield('footer')

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>
    </body>
</html>