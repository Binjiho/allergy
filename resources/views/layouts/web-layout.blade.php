<!DOCTYPE html>
<html lang="ko">
<head>
    @include('layouts.components.baseHead')
</head>
<body>

<div id="wrap" class="wrap {{ ($main_menu ?? '') == 'main' ? "main" : "sub" }}">

    @include('layouts.include.header')

    <section id="container" class="{{ ($main_menu ?? '') == 'main' ? "main" : "sub" }}">

        @yield('contents')

    </section>

    @include('layouts.include.footer')

</div>

@include('layouts.components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
