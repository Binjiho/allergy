<?php

return [
    // ================= admin menu =================
    'main' => [
        'M1' => [
            'name' => '회원 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'dev' => false,
            'continue' => false,
        ],

        'M2' => [
            'name' => '회비 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'dev' => false,
            'continue' => false,
        ],

        'M3' => [
            'name' => '국외학술대회지원 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'dev' => false,
            'continue' => false,
        ],

        'M4' => [
            'name' => '학술대회 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'dev' => false,
            'continue' => false,
        ],
        
        'mail' => [
            'name' => '메일 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'dev' => false,
            'continue' => false,
        ],

//       'stat' => [
//           'name' => '접속 통계',
//           'route' => null,
//           'param' => [],
//           'url' => 'javascript:void(0);',
//           'dev' => false,
//           'continue' => false,
//       ],
    ],

    'sub' => [
        'M1' => [
            'S1' => [
                'name' => '회원관리',
                'route' => 'member',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'S2' => [
                'name' => '오프라인회원',
                'route' => 'memberoff',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'S3' => [
                'name' => '임원관리',
                'route' => null,
                'param' => [],
                'url' => 'javascript:;',
                'dev' => false,
                'continue' => false,
            ],
            'S4' => [
                'name' => '위원회관리',
                'route' => null,
                'param' => [],
                'url' => 'javascript:;',
                'dev' => false,
                'continue' => false,
            ],

        ],

        'M2' => [
            'S1' => [
                'name' => '회비관리',
                'route' => 'fee',
                'param' => ['case'=>'full'],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
        ],

        'M3' => [
            'S1' => [
                'name' => '국외학술대회지원 관리',
                'route' => 'overseas',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],

        ],

        'M4' => [
            'S1' => [
                'name' => '학술대회관리',
                'route' => 'workshop',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],

            'S2' => [
                'name' => '교육강좌관리',
                'route' => 'education',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
        ],

        'mail' => [
            'S1' => [
                'name' => '이전메일내역',
                'route' => 'mail',
                'param' => [],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],

        ],

//        'stat' => [
//            'S1' => [
//                'name' => '접속 통계',
//                'route' => 'stat',
//                'param' => [],
//                'url' => null,
//                'dev' => false,
//                'continue' => false,
//            ],
//
//            'S2' => [
//                'name' => '접속 경로',
//                'route' => 'stat.referer',
//                'param' => [],
//                'url' => null,
//                'dev' => false,
//                'continue' => false,
//            ],
//        ],
    ]
];
