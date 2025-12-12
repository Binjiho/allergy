<!DOCTYPE html>
<html lang="ko">
<head>
    @include('eng.layouts.components.baseHead')
</head>
<body>

<div id="wrap" class="wrap {{ ($main_menu ?? '') == 'main' ? "main" : "sub" }}">

    @include('eng.layouts.include.header')

    <section id="container" class="{{ ($main_menu ?? '') == 'main' ? "main" : "sub" }}">

        @yield('contents')

    </section>

    @include('eng.layouts.include.footer')

</div>

@include('eng.layouts.components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
