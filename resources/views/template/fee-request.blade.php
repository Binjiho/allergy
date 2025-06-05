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
            <img src="{{ env('APP_URL') }}assets/image/mail/mail_header.jpg" alt="대한천식알레르기학회" style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    <tr>
        <td style="padding: 50px 50px 80px;font-size: 16px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <th scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 26px;font-weight: 400;color: #083388;line-height: 1.3;letter-spacing: -0.03em;word-break: keep-all;">
                        <strong style="font-weight: 700;">대한천식알레르기학회 회비 입금 요청 드립니다.</strong>
                    </th>
                </tr>
                <tr>
                    <td scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        {{ $fee->user->name_kr ?? '' }} 회원님. 안녕하십니까? <br/>
                        회원님의 회비 납부 신청이 정상적으로 접수되었음을 안내드립니다. <br/>
                        아래 계좌로 회비를 납부해 주시면, 확인 후 최종 납부 완료 처리가 진행될 예정입니다.
                        <br/>
                        <br/>
                        ※ 입금 계좌 정보 : 신한은행 / 100-012-958376 / 대한천식알레르기학회
                        <br/>
                        <br/>
                        입금 확인 후 납부 완료 안내를 별도로 드릴 예정이며, 기타 문의 사항이 있으실 경우 사무국으로 연락 주시기 바랍니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;color: #444444;line-height: 1.5">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    회원등급
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $userConfig['level'][$fee->user->level] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    이름
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $fee->user->name_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    아이디
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $fee->user->id ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    근무처정보
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $fee->user->company_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    납부 회비 항목
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $title_str ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    회비 금액
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ number_format($tot_price ?? 0) ?? 0 }}원
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    결제방법
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $feeConfig['payment_method'][$fee->payment_method ?? ''] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    학회 계좌 정보
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    신한은행 / 100-012-958376 / 대한천식알레르기학회
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    입금 예정일
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ !empty($fee->deposit_date) ? $fee->deposit_date->format('Y-m-d') : '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 60px;text-align: center;">
                        <a href="{{ env('APP_URL') }}" target="_blank"><img src="{{ env('APP_URL') }}assets/image/mail/btn_mail_home.jpg" alt="홈페이지 바로가기"></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ env('APP_URL') }}assets/image/mail/mail_footer.jpg" alt="[03186] 서울 종로구 새문안로 92 광화문오피시아빌딩 1329호. 전화 : +82-2-747-0528 | 팩스 : +82-2-3676-2847 | E-mail : allergy@allergy.or.kr, kaaaci@naver.com. 사업자등록번호 : 208-82-05449 | 상호 : 대한천식알레르기학회. © 2020 THE KOREAN ACADEMY OF ASTHMA, ALLERGY AND CLINICAL IMMUNOLOGY. All Rights Reserved." style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>