<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ url('css/frontend.css') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')

    @include('includes.partials.ga')
</head>
<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')

    <div id="app">
        @include('frontend.includes.nav')
        @include('includes.partials.messages')

        <main>
            @yield('content')
        </main>
    </div><!--app-->

    @stack('before-scripts')
    <script src="{{ url('js/manifest.js') }}"></script>
    <script src="{{ url('js/vendor.js') }}"></script>
    <script src="{{ url('js/frontend.js') }}"></script>
    <livewire:scripts />
    @stack('after-scripts')
</body>
</html>
