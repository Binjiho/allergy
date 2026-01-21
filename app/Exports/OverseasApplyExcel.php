<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class OverseasApplyExcel  implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithChunkReading
{
    private $collection;
    private $userConfig;
    private $overseasConfig;
    private $query;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->collection = $data['collection'];
        $this->userConfig = getConfig('user');
        $this->overseasConfig = getConfig('overseas');
        $this->query = $data['query'];
        $this->total = $data['total'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // 이제 registerEvents 뿐만 아니라 여기서도 $this->collection을 쓸 수 있습니다.
        return $this->collection;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // 미리보기용 데이터 반환 (컬렉션 형태)
    public function getPreviewData()
    {
        $previewQuery = clone $this->query;

        $mappedData = [];
        $this->row = 0; // 초기화

        foreach ($previewQuery->get() as $item) {
            $mappedData[] = $this->map($item);
        }

//        return [
//            'headings' => [
//                $this->headings(),
//            ],
//            'data' => collect($mappedData),
//            'total' => $this->total,
//        ];
        return [
            'headings' => $this->headings(),
            'data' => collect($mappedData),
            'total' => $this->total,
        ];
    }

    public function query()
    {
        return $this->query;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function headings(): array
    {
        return [
            # 첫번째
            [
                'No',
                '신청상태',
                '접수일',

                '인적사항', '', '', '', '', '', '', '', '', '', '', '',

                '신청정보', '', '', '', '', '', '', '',

                '관리자확인', '', '', '',

                '결과보고', '', '', '', '', '', '', '', '', '',
                '', '', '', '', '', '', '', '', '',
            ],

            # 두번째
            [
                'No',
                '신청상태',
                '접수일',

                # 인적사항
                '학회 아이디',
                '성명 (한글)',
                '성명 (영문)',
                '의사면허번호',
                '생년월일',
                '졸업년도',
                '소속',
                '휴대전화번호',
                'E-mail',
                '계좌번호-은행명',
                '계좌번호',
                '계좌번호-예금주',

                # 신청정보
                '참가역할-초록발표자',
                '참가역할-강의',
                '참가역할-참석 형태',
                '발표 초록 Title(국문)',
                '발표 초록 Title(영문)',
                '발표 초록 File',
                '초록채택메일 or 초청메일',
                '초록채택메일 or 초청메일 파일',

                # 관리자 확인
                '심사상태',
                '지원협회',
                '지급여부',
                '메모',

                # 결과 보고
                '결과보고 제출상태',
                '초록사본',
                '초록채택메일',
                '항공료',
                '항공료 파일',
                '숙박비',
                '숙박비 파일',
                '등록비',
                '등록비 파일',
                '식대',
                '식대 파일',
                '교통비',
                '교통비 파일',
                '기타 영수증 파일',
                '결과보고서 파일',
                '지출내역서 파일',
                '기타 파일',
                '금액 합계',
                '결과보고 제출일',
            ],
        ];
    }

    public function map($data): array
    {
        $overseasConfig = $this->overseasConfig;
        # 회원
        $user = $data->user;
        $name_eng = $user->first_name . $user->last_name;
        $submitFile = ($data->submit_type == 'A') ? ($data->filename2 ?? '-') : '-';
        return [
            $this->total - ($this->row++),
            $this->overseasConfig['complete'][$data->complete],
            $data->created_at ?? '',

            # 인적사항
            $user->id ?? '',
            $user->name_kr ?? '',
            $name_eng ?? '',
            $user->license_number ?? '',
            $user->birth_date ?? '',
            $user->graduate_date ?? '',
            $data->sosok_kr ?? '',
            $user->phone ?? '',
            $data->email ?? '',
            $data->bank_name ?? '',
            $data->account_num ?? '',
            $data->account_name ?? '',

            # 신청정보
            $overseasConfig['presenter'][$data->presenter] ?? '',
            $overseasConfig['lecture'][$data->lecture] ?? '',
            $overseasConfig['attend'][$data->attend] ?? '',
            $data->title_kr ?? '',
            $data->title_en ?? '',
            $data->filename1 ?? '',
            $overseasConfig['submit_type'][$data->submit_type] ?? '',
            $submitFile,

            # 관리자 확인
            $overseasConfig['judge'][$data->judge] ?? '',
            $overseasConfig['assistant'][$data->assistant] ?? '',
            $overseasConfig['pay_result'][$data->pay_result] ?? '',
            $data->memo ?? '',
            
            # 결과보고
            $overseasConfig['report'][$data->report] ?? '',
            $data->filename3 ?? '', # 초록 채택 메일
            $data->filename4 ?? '', # 초록 채택 메일
            number_format($data->pay1) ?? 0,
            $data->filename5 ?? '', # 항공료 파일
            number_format($data->pay2) ?? 0,
            $data->filename6 ?? '', # 숙박비 파일
            number_format($data->pay3) ?? 0,
            $data->filename7 ?? '', # 등록비 파일
            number_format($data->pay4) ?? 0,
            $data->filename8 ?? '', # 식대 파일
            number_format($data->pay5) ?? 0,
            $data->filename9 ?? '', # 교통비 파일
            $data->filename10 ?? '', # 기타 영수증 파일
            $data->filename11 ?? '', # 결과 보고서 파일
            $data->filename12 ?? '', # 지출 내역서 파일
            $data->filename13 ?? '', # 기타 파일
            number_format($data->tot_pay) ?? 0,
            $data->reported_at ?? '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /* =========================
                 * 하이퍼링크 처리
                 * ========================= */
                foreach ($this->collection as $idx => $row) {
                    $line = $idx + 3;

                    $map = [
                        // 신청정보
                        'U'  => 1, // 발표 초록 File
                        'W'  => 2, // 초록채택메일 or 초청메일 파일

                        // 결과보고
                        'AC' => 3,  // 초록사본
                        'AD' => 4,  // 초록채택메일
                        'AF' => 5,  // 항공료 파일
                        'AH' => 6,  // 숙박비 파일
                        'AJ' => 7,  // 등록비 파일
                        'AL' => 8,  // 식대 파일
                        'AN' => 9,  // 교통비 파일
                        'AO' => 10, // 기타 영수증 파일
                        'AP' => 11, // 결과보고서 파일
                        'AQ' => 12, // 지출내역서 파일
                        'AR' => 13, // 기타 파일
                    ];

                    foreach ($map as $col => $num) {
                        $realFileField = "realfile{$num}";

                        if (!empty($row->{$realFileField})) {
                            $sheet->getCell("{$col}{$line}")
                                ->getHyperlink()
                                ->setUrl($row->excelHyperLink($num));

                            $sheet->getStyle("{$col}{$line}")
                                ->getFont()
                                ->getColor()->setARGB('FF0000FF');

                            $sheet->getStyle("{$col}{$line}")
                                ->getFont()->setUnderline(true);
                        }
                    }
                }

                /* =========================
                 * 헤더 병합
                 * ========================= */
                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');

                $sheet->mergeCells('D1:O1');   // 인적사항
                $sheet->mergeCells('P1:W1');   // 신청정보
                $sheet->mergeCells('X1:AA1');  // 관리자확인
                $sheet->mergeCells('AB1:AT1'); // 결과보고

                /* =========================
                 * 색상
                 * ========================= */
                $colors = [
                    'A1:A2'   => 'FFBFBFBF',
                    'B1:B2'   => 'FFBFBFBF',
                    'C1:C2'   => 'FFBFBFBF',
                    'D1:O2'   => 'FFE9F1F8',
                    'P1:W2'   => 'FFEFF7EE',
                    'X1:AA2'  => 'FFE0E0E0',
                    'AB1:AT2' => 'FFE8EEF6',
                ];

                foreach ($colors as $range => $color) {
                    $sheet->getStyle($range)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                }

                /* =========================
                 * 스타일
                 * ========================= */
                $sheet->getStyle('A1:AT2')->getFont()->setBold(true)->setSize(11);
                $sheet->getStyle('A1:AT2')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->getStyle('A1:AT' . $sheet->getHighestRow())
                    ->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getRowDimension(1)->setRowHeight(32);
                $sheet->getRowDimension(2)->setRowHeight(26);
            },
        ];
    }
}
