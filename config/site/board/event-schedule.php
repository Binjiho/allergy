<?php

$code = 'event-schedule';

return [
    'menu' => [ // 메뉴 키
        'main' => 'M5',
        'sub' => 'S1'
    ],

    'code' => "{$code}", // 게시판 코드
    'skin' => 'event-schedule', // 게시판 스킨
    'name' => '공지사항', // 게시판 명
    'subject' => '제목', // 게시판 Subject 명
    'directory' => "/board/{$code}", // 게시판 업로드 경로
    'paginate' => 10, // 페이지별 노출 리스트 수

    'options' => [
        'hide' => ['N' => '공개', 'Y' => '비공개'], // 노출여부
        'main' => ['Y' => '노출', 'N' => '미노출'], // 메인노출
        'notice' => ['Y' => '사용', 'N' => '미사용'], // 상단공지
        'secret' => ['Y' => '사용', 'N' => '미사용'], // 비밀글
        'date_type' => ['D' => '하루', 'L' => '장기'], // 기간 타입
        'popup_contents' => ['1' => '공지 내용과 동일', '2' => '팝업 내용 새로 작성'], // 팝업내용
        'popup_detail' => ['N' => '설정안함', 'Y' => '설정함'], // 팝업 상세보기 링크 사용여부
        'popup_skin' => ['none' => '없음', 'A' => 'TYPE A', 'B' => 'TYPE B', 'C' => 'TYPE C'], // 팝업 스킨
        'popup_yn' => ['N' => '미사용', 'Y' => '사용'], // 팝업 사용여부,

    ],

    'permission' => [ // 권한 빈값은 전체 접근, 값이있을경우 해당 level 만 접근가능
        'list' => [], // 리스트 권한
        'view' => [], // 상세보기 권한
        'write' => [], // 글쓰기 권한
    ],

    'use' => [ // 사용 유무
        'login' => false, // 로그인 필요
        'writer' => false, //작성자
        'main' => false, // 메인노출
        'notice' => false, // 공지
        'subject' => true, // 제목
        'link' => true, // 상세링크
        'hide' => true, // 공개옵션
        'popup' => false, // 팝업
        'secret' => false, // 비밀글
        'gubun' => true, // 구분
        'category' => false, // 카테고리
        'date' => true, // 기간설정
        'place' => true, // 장소
        'thumbnail' => false, // 썸네일파일
        'file' => false, // 파일업로드 (단일파일)
        'contents' => true, // 내용
        'plupload' => true, // 파일업로드 (plupload) 사용
        'heart' => true, // 파일업로드 (plupload) 사용
        'comment' => false, // 댓글
    ],

    'gubun' => [
        'name' => '구분', // 구분 명칭
        'type' => 'radio', // radio or select
        'item' => [ // 게시판 카테고리 ex) key => value
            '1' => '국내', //국내학술대회 ACD
            '2' => '국외', //해외학회일정 OVS
            '3' => '교육강좌', //EDU
            '4' => '심포지엄',
            '5' => '집담회', //MET
            '6' => '연수강좌', //LEC
            '7' => '기타', //ETC
            '8' => '세미나', //SEM
        ],
    ],

    'category' => [
        'name' => '카테고리', // 카테고리 명칭
        'type' => 'radio', // radio or select
        'item' => [ // 게시판 카테고리 ex) key => value

        ],
    ],

    'file' => [ // 기본 max 5개 까지 업로드가능 그이상은 DB 추가 필요
        1 => [
            'name' => '파일1',
        ],

//        2 => [
//            'name' => '파일2',
//        ],
//
//        3 => [
//            'name' => '파일3',
//        ],
//
//        4 => [
//            'name' => '파일4',
//        ],
//
//        5 => [
//            'name' => '파일5',
//        ],
    ],

    'thumbnail' => [
        'name' => '썸네일', // 썸네일 명칭
    ],

    'date' => [
        'name' => '행사일정' // 일정 사용시 일정명
    ],

    'search' => [ // 검색 정보
        'subject/contents' => '제목+내용',
        'name' => '작성자',
        'subject' => '제목',
        'contents' => '내용',
    ],
];
