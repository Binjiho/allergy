<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>대한천식알레르기학회</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin:0; padding:0;">
<table style="width:650px;max-width:650px;margin: 0 auto;padding:0;border:1px solid #ddd;border-collapse: collapse;border-spacing:0;box-sizing:border-box;letter-spacing: -0.03em;">
    <tbody>
    <tr>
        <td style="padding: 0;text-align: center;text-align: center; font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 26px;color: #050505;">
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_header.jpg" alt="대한천식알레르기학회" style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    <tr>
        <td style="padding: 50px 50px 20px;font-size: 16px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <th scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 26px;font-weight: 400;color: #083388;line-height: 1.3;letter-spacing: -0.03em;">
                        <strong style="font-weight: 700;">대한천식알레르기학회 회원가입을 축하합니다!</strong>
                    </th>
                </tr>
                <tr>
                    <td scope="col" style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        대한천식알레르기학회 홈페이지 회원가입이 정상적으로 처리 되었습니다. <br/>
                        앞으로도 대한천식알레르기학회 많은 관심과 참여를 부탁드립니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;color: #444444;line-height: 1.5">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    가입일
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ !empty($user->created_at) ? $user->created_at->format('Y년 m월 d일') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 195px;padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;line-height: 1.3;text-align: left;letter-spacing: -0.03em;">
                                    아이디
                                </th>
                                <td style="width: 355px;padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 14px;color: #444444;line-height: 1.3;letter-spacing: -0.03em;">
                                    {{ $user->id ? maskEvenStr($user->id) : '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td scope="col" style="padding-top: 30px;padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        대기자로 우선 가입되시며, 대한천식알레르기학회 가입 승인 후 등급이 조정됩니다. <br/>
                        <strong style="color: #1736d3;">가입 승인은 최대 10일 이상 소요</strong> 될 수 있는 점 양해 부탁 드리며, <br/>
                        <strong style="color: #1736d3;">승인 완료 후 회원가입 시 입력해 주셨던 아이디(이메일)로 승인 완료 메일이 자동 발송</strong> 됩니다. <br/>
                        궁금한 부분이 있으시면 사무국으로 연락을 주시기 바랍니다. 감사합니다.
                    </td>
                </tr>
                <tr>
                    <td scope="col" style="padding-top: 30px;padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 16px;font-weight: 400;text-align: left;line-height: 1.5;color: #4d4d4d;letter-spacing: -0.03em;word-break: keep-all;">
                        회원가입 관련 문의 : TEL : <a href="tel:{{ env('APP_TEL') }}" target="_blank" style="color: #4d4d4d;">{{ env('APP_TEL') }}</a>  E-MAIL : <a href="mailto:{{ env('APP_EMAIL') }}"  style="color: #4d4d4d;" target="_blank">{{ env('APP_EMAIL') }}</a>, <a href="mailto:kaaaci@naver.com"  style="color: #4d4d4d;" target="_blank">kaaaci@naver.com</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 60px;text-align: center;">
                        <a href="{{ env('APP_URL') }}" target="_blank"><img src="{{ env('APP_URL') }}/assets/image/mail/btn_mail_home.jpg" alt="홈페이지 바로가기"></a>
                    </td>
                </tr>
                <tr>
                    <th scope="col" style="padding-top: 60px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', 'Arial', sans-serif;font-size: 13px;font-weight: 400;text-align: left;line-height: 1.5;color: #ed1313;letter-spacing: -0.03em;">
                        ※ 정보 유출 방지를 위하여 메일을 확인 하신 후 삭제 하시기 바랍니다.
                    </th>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_footer.jpg" alt="{{ env('APP_ADDR') }} 전화 : {{ env('APP_TEL') }} | 팩스 : {{ env('APP_FAX') }} | E-mail : allergy@allergy.or.kr, kaaaci@naver.com. 사업자등록번호 : 208-82-05449 | 상호 : 대한천식알레르기학회. © 2020 THE KOREAN ACADEMY OF ASTHMA, ALLERGY AND CLINICAL IMMUNOLOGY. All Rights Reserved." style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>