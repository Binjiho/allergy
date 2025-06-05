@extends('layouts.popup-layout')

@section('addStyle')
    <style>
        * {
            -webkit-print-color-adjust:exact;
        }
        html, body{
            -webkit-print-color-adjust:exact;
        }
        .font-pre,
        .font-pre *{
            font-family: 'Pretendard Variable',sans-serif;
        }
        .font-serif,
        .font-serif *{
            font-family: 'Noto Serif', serif;
        }
        .print-wrap{
            padding: 20px;
            margin: 0 auto;
        }
        .print-wrap .btn{
            min-width: 115px;
            padding: 12px 30px;
            font-size: 1.8rem;
            font-weight: 500;
        }
        .print-contents{
            width: 100%;
            max-width: 550px;
            margin: 0 auto;
            padding: 60px 30px;
            border: 4px solid #cccccc;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('/assets/image/sub/bg_receipt.png');
        }
        .print-tit{
            font-size: 4.8rem;
            font-weight: 700;
            line-height: 1;
            word-spacing: 30px;
            text-align: center;
        }
        .price{
            margin-top: 40px;
            font-size: 2.4rem;
            line-height: 1.5;
            text-align: center;
        }
        .price + p{
            margin-top: 50px;
            font-size: 1.8rem;
            line-height: 1.6;
            text-align: center;
        }
        .date{
            margin-top: 70px;
            font-size: 1.6rem;
            text-align: center;
        }
        .sign{
            margin-top: 25px;
            font-size: 2.5rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-align: center;
        }

        @page{
            size: A4;
            margin: 0;
        }
        @media print{
            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            html, body{
                width: 210mm;
                height: 297mm;
            }
            .btn-wrap{
                display: none;
            }
        }
    </style>
@endsection

@section('contents')
    <div class="print-wrap">
        <div class="print-contents">
            <div class="print-conbox">
                <h1 class="print-tit">영 수 증</h1>
                <div class="price">
                    일금  <strong>{{ priceKo($target_price) ?? 0 }}원</strong>  정 <strong>(&#8361; {{ number_format($target_price) ?? 0 }})</strong>
                </div>
                <p>
                    상기 금액을 대한천식알레르기학회 <br>
                    {{ $fee_list[0]->year }}년 {{ $target_category ?? '' }}로 정히 영수합니다.
                </p>
                <div class="date">
                    {{ date('Y.m.d') }}
                </div>
                <div class="sign">
                    <img src="/assets/image/sub/img_print_logo.png" alt="대한천식알레르기학회. The Korean Academy of Asthma, Allergy and Clinical Immunology.">
                </div>
            </div>
        </div>
        <div class="btn-wrap text-center">
            <a href="#n" class="btn btn-type1 color-type4" onclick="self.close();">닫기</a>
            <button type="button" class="btn btn-type1 color-type1" onclick="goPrint();">인쇄</button>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        function goPrint() {
            window.print();
        }
    </script>
@endsection