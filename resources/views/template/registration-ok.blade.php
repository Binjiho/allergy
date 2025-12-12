<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>대한천식알레르기학회</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0;padding: 0;">
<table style="width:650px;max-width:650px;margin: 0 auto;padding:0;border:1px solid #ddd;border-collapse: collapse;border-spacing:0;box-sizing:border-box;letter-spacing: -0.03em;">
    <tbody>
    <tr>
        <td style="padding: 0;text-align: center;text-align: center;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 26px;color: #050505;">
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_header.jpg" alt="대한천식알레르기학회" style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    <tr>
        <td style="padding: 50px 50px 80px;font-size: 16px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <th scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 22px;font-weight: 400;color: #083388;line-height: 1.3;letter-spacing: -0.03em;word-break: keep-all;">
                        <strong style="font-weight: 700;">{{ $reg->workshop->title ?? '' }} <br/>사전등록 완료 안내 드립니다.</strong>
                    </th>
                </tr>
                <tr>
                    <td scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        {{ $reg->name_kr ?? '' }} 회원님. 안녕하십니까? <br/>
                        {{ $reg->workshop->title ?? '' }} 사전등록 완료 안내 메일 드립니다. <br/>
                        영수증은 해당 행사의 사전등록 조회 후 출력 가능합니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;color: #444444;line-height: 1.5">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    접수번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->reg_num ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    회원등급 및 ID
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    @if( ($reg->member_gubun ?? '') == 'Y' )
                                        {{ $userConfig['level'][$reg->user->level ?? ''] }} / {{ $reg->user->id }}
                                    @else
                                        비회원
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    등록구분
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $defaultConfig['gubun'][$reg['gubun']] }} -
                                    {{ number_format($reg['amount']) ?? 0 }}원
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    성명
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->name_kr ?? '' }}
                                </td>
                            </tr>
                            @if( ($reg->gubun ?? '') != '5' )
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    의사면허번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->license_number ?? '' }}
                                </td>
                            </tr>
                            @endif
                            @if(!empty($reg->region))
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    소속의사회
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $defaultConfig['region'][$reg->region] ?? '' }} {{ $reg->sigu ?? '' }}
                                </td>
                            </tr>
                            @endif

                                <tr>
                                    <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                        근무처(소속)
                                    </th>
                                    <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                        {{ $reg->office_name ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                        근무처(소속) 주소
                                    </th>
                                    <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                        ({{ $reg->zipcode ?? '' }}) {{ $reg->addr ?? '' }} {{ $reg->addr_etc ?? '' }}
                                    </td>
                                </tr>

                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    소속과
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->department ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    근무처(소속) 전화번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->office_tel ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    휴대전화번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->phone ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    E-Mail
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $reg->email ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    총 등록비
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ number_format($reg->amount ?? 0) }}원
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    결제 방법
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $defaultConfig['pay_method'][$reg->pay_method] ?? '' }}
                                </td>
                            </tr>
                            @if(($reg->pay_method ?? '') == 'B')
                                <tr>
                                    <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                        입금자 명
                                    </th>
                                    <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                        {{ $reg->send_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                        입금 예정일
                                    </th>
                                    <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                        {{ $reg->send_date ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                        계좌정보
                                    </th>
                                    <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                        신한은행 / 100-012-958376 / 대한천식알레르기학회
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 60px;text-align: center;">
                        <a href="{{ env('APP_URL') }}/workshop/{{ $reg->workshop->sid }}/registration/search" target="_blank"><img src="{{ env('APP_URL') }}/assets/image/mail/btn_mail_regist.jpg" alt="사전등록 조회 및 영수증 출력"></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_footer.jpg" alt="[03186] 서울 종로구 새문안로 92 광화문오피시아빌딩 1329호. 전화 : +82-2-747-0528 | 팩스 : +82-2-3676-2847 | E-mail : allergy@allergy.or.kr, kaaaci@naver.com. 사업자등록번호 : 208-82-05449 | 상호 : 대한천식알레르기학회. © 2020 THE KOREAN ACADEMY OF ASTHMA, ALLERGY AND CLINICAL IMMUNOLOGY. All Rights Reserved." style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>