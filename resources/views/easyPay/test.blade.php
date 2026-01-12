<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes,viewport-fit=cover">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="Author" content="대한천식알레르기학회">
    <meta name="Keywords" content="대한천식알레르기학회">
    <meta name="description" content="대한천식알레르기학회">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getAppName() }}@yield('addTitle')</title>
    <link rel="icon" href="/assets/image/favicon.ico">

    <!-- 사이트 script -->
    <script type="text/javascript" src="/assets/js/jquery-1.12.4.min.js"></script>

    <script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/crypto-js/crypto-js.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/js/flatpickr-ko.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('script/app/app.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

    <!-- 사이트 script -->
    <script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/js/slick.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.rwdImageMaps.js"></script>
    <script type="text/javascript" src="/assets/js/common.js"></script>
</head>
<body>
<button onclick="payCall()">결제창 호출</button>

<script>
    const payCall = () => {
        callbackAjax('{{ route('easyPay.data') }}', {
            'case': 'transaction-reg',
            'pay_type': 'FEE',
            'amount': 1000,
        }, function (data, error) {
            if (error) {
                // console.log(error);
                alert('ERROR');
                location.reload();
                return false;
            }

            const popupHeight = 700;
            const popupWidth = 600;
            const popName = 'easyPay';
            const popupY = (window.screen.height / 2) - (popupHeight / 2);
            const popupX = (window.screen.width / 2) - (popupWidth / 2);

            window.open(data.url, popName, 'status=no, height=' + popupHeight + ', width=' + popupWidth + ', left=' + popupX + ', top=' + popupY);
        });
    }
</script>
</body>
</html>