<!doctype html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="/assets/image/favicon.ico">

    <!-- 사이트 script -->
    <script type="text/javascript" src="/assets/js/jquery-1.12.4.min.js"></script>

    <script>
        $(function () {
            alert('{{ $code }}: {{ $msg }}');

            if (window.opener && !window.opener.closed) {
                window.opener.location.reload();
            }

            window.close();
        })
    </script>
</head>
<body>

</body>
</html>