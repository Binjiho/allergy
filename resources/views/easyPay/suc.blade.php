<!doctype html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="/assets/image/favicon.ico">

    <!-- 사이트 script -->
    <script type="text/javascript" src="/assets/js/jquery-1.12.4.min.js"></script>

    @switch($payType)
        @case('FEE')
            <script>
                $(function () {
                    alert('회비가 결제 되었습니다.');

                    if (window.opener && !window.opener.closed) {
                        window.opener.close();
                    }

                    if (window.opener.opener && !window.opener.opener.closed) {
                        window.opener.opener.location.reload();
                    }

                    window.close();
                })
            </script>
            @break

        @case('REG')
            <script>
                $(function () {
                    alert('사전등록이 결제 되었습니다.');
                        window.opener.location.replace('{{ $replaceUrl }}');

                    window.close();
                })
            </script>
            @break

        @default
            <script>
                $(function () {
                    alert('잘못된 접근입니다.');

                    if (window.opener && !window.opener.closed) {
                        window.opener.location.reload();
                    }

                    window.close();
                })
            </script>
            @break

    @endswitch
</head>
<body>

</body>
</html>