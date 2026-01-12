<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
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

class OverseasApplyExcel  implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithChunkReading
{
    private $userConfig;
    private $overseasConfig;
    private $query;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->userConfig = getConfig('user');
        $this->overseasConfig = getConfig('overseas');
        $this->query = $data['query'];
        $this->total = $data['total'];
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

            # 관리자 확인
            $overseasConfig['judge'][$data->judge] ?? '',
            $overseasConfig['assistant'][$data->assistant] ?? '',
            $overseasConfig['pay_result'][$data->pay_result] ?? '',
            $data->memo ?? '',
            
            # 결과보고
            $overseasConfig['report'][$data->report] ?? '',
            $data->filename3 ?? '', # 초록 사본
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

                $sheet->mergeCells('A1:A2');   # No
                $sheet->mergeCells('B1:B2');   # 신청상태
                $sheet->mergeCells('C1:C2');   # 접수일
                $sheet->mergeCells('D1:O1');   # 인적사항
                $sheet->mergeCells('P1:S1');  # 관리자확인
                $sheet->mergeCells('T1:AL1'); # 결과보고

                $colors = [
                    'A1:A2'   => 'FFBFBFBF', # No
                    'B1:B2'   => 'FFBFBFBF', # 신청상태
                    'C1:C2'   => 'FFBFBFBF', # 접수일
                    'D1:O2'   => 'FFE9F1F8', # 인적사항
                    'P1:S2'  => 'FFE0E0E0', # 관리자확인
                    'T1:AL2'  => 'FFE8EEF6', # 결과보고
                ];

                foreach ($colors as $range => $color) {
                    $sheet->getStyle($range)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                }

                $sheet->getStyle('A1:AL2')->getFont()
                    ->setBold(true)
                    ->setSize(11);

                $sheet->getStyle('A1:AL2')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->getStyle('A1:AL' . $sheet->getHighestRow())
                    ->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $groupBorders = [
                    'A1:A2',
                    'B1:B2',
                    'C1:C2',
                    'D1:O2',
                    'P1:S2',
                    'T1:AL2',
                ];

                foreach ($groupBorders as $range) {
                    $sheet->getStyle($range)
                        ->getBorders()->getOutline()
                        ->setBorderStyle(Border::BORDER_MEDIUM);
                }

                $sheet->getStyle('A1:AL2')->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->getRowDimension(1)->setRowHeight(32);
                $sheet->getRowDimension(2)->setRowHeight(26);
            },
        ];
    }
}
