
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
        <td style="padding: 50px 50px 50px;font-size: 16px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <th scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 22px;font-weight: 400;color: #083388;line-height: 1.3;letter-spacing: -0.03em;word-break: keep-all;">
                        <strong style="font-weight: 700;">{{ $overseas->overseasSetting->title ?? '' }} <br>지원 신청이 완료되었습니다.</strong>
                    </th>
                </tr>
                <tr>
                    <td scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        {{ $overseas->user->name_kr ?? '' }}회원님께서 신청하신 해외학회 참가지원 신청 내역입니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;color: #444444;line-height: 1.5">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    성명 (한글)
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->user->name_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    성명 (영문)
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->user->first_name ?? '' }} {{ $overseas->user->last_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    의사면허번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->user->license_number ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    생년월일
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->user->birth_date ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    전공분야
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $userConfig['major'][$overseas->user->major] ?? '' }} {{ $overseas->user->major == 'Z' ? $overseas->user->major_etc : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    * 근무처 정보(국문)
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->sosok_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    * 휴대전화번호
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->phone ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    * E-mail
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $overseas->email ?? '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td scope="col" style="padding-top: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        자세한 내용은 대한천식알레르기학회 국외학술대회 지원 신청에서 확인하시기 바라며 심사 결과는 추후 개별 통지 됩니다. <br><br>
                        자세한 문의는 학회 사무국으로 연락 주시기 바랍니다.<br><br>
                        감사합니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 60px;text-align: center;">
                        <a href="{{ env('APP_URL') }}/" target="_blank"><img src="{{ env('APP_URL') }}/assets/image/mail/btn_mail_home.jpg" alt="홈페이지 바로가기"></a>
                    </td>
                </tr>
                <tr>
                    <td scope="col" style="color:red; padding-top: 60px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;letter-spacing: -0.03em;word-break: keep-all;">
                        * 본 메일은 발송전용 메일이므로 답장을 받을 수 없습니다.
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