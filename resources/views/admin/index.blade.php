@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <section id="container" class="inner-layer">
        <div class="main-contents">
            <h3 class="main-tit">
                {{ env('APP_NAME') }}
                <span>관리자 페이지 입니다.</span>
            </h3>
        </div>
    </section>

    @if(isDev())
        <button onclick="mailLogin();">m2 mail</button>
    @endif
@endsection

@section('addScript')

    @if(isDev())
        <script>
            const mailLogin = () => {
                $.ajax({
                    type: "POST",
                    url: '{{ url('api/mail/data') }}',
                    data: {'case': 'auth-login'},
                    success: function (data) {
                        if (!data.url) {
                            alert('요청 실패');
                            console.log(data);
                            location.reload();
                            return false;
                        }

                        window.open(data.url);
                    },
                    error: function (error) {
                        alert('ERROR');
                        console.log(error);
                        location.reload();
                    }
                });
            }
        </script>
    @endif
@endsection
