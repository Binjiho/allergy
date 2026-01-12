<?php

$year = [];

for($i = (int)date('Y'); $i >= 2016; $i--) {
    array_push($year, $i);
}

return [

    'year' => $year,

    'hide' => [
        'Y'=>'설정중', 'N'=>'공개',
    ],

    'date_type' => [
        'D' => '하루행사', 'L' => '장기행사'
    ],

    'member_gubun' => [
        'Y'=>'회원',
        'N'=>'비회원',
    ],

    'gubun' => [
        '1'=>'전문의',
        '2'=>'일반의',
        '3'=>'전공의',
        '4'=>'공중보건의',
        '5'=>'기타(간호사, 연구원 등)',
    ],

    'pay_method' => [
        'B'=>'무통장입금',
        'F'=>'무료',
        'C'=>'카드결제'
    ],
    'pay_status' => [
        'Y'=>'입금완료',
        'N'=>'미입금',
        'F'=>'무료',
        'W'=>'면제',
        'R'=>'환불',
    ],

    'region' => [
        "Seoul"=>"서울",
        "Busan"=>"부산",
        "Daegu"=>"대구",
        "Incheon"=>"인천",
        "Gwangju"=>"광주",
        "Daejeon"=>"대전",
        "Ulsan"=>"울산",
        "Gyeonggi-do"=>"경기도",
        "Gangwon-do"=>"강원도",
        "Chungcheongbuk-do"=>"충청북도",
        "Chungcheongnam-do"=>"충청남도",
        "Jeollabuk-do"=>"전라북도",
        "Jeollanam-do"=>"전라남도",
        "Gyeongsangbuk-do"=>"경상북도",
        "Gyeongsangnam-do"=>"경상남도",
        "Jeju-do"=>"제주도",
    ],
    
];
