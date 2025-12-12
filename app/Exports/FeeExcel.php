<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class FeeExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $feeConfig;
    private $collection;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->userConfig = getConfig('user');
        $this->feeConfig = getConfig('fee');
        $this->collection = $data['collection'];
        $this->total = $data['total'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return [
            '번호',
            '회비셋팅연도',
            '회비구분',
            '회비금액',
            '이름',

            '아이디',
            '면허번호',
            '근무처',
            '납부방법',
            '납부상태',

            '납부일자',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $feeConfig = $this->feeConfig;
        $user = $data->user;

        return [
            $this->total - ($this->row++),
            $data->year,
            $feeConfig['category'][$data->category ?? ''] ?? '',
            number_format($data->price ?? 0),
            $user->name_kr ?? '',

            $user->id ?? '',
            $user->license_number ?? '',
            $user->company_kr ?? '',
            $feeConfig['payment_method'][$data->payment_method ?? ''] ?? '',
            $feeConfig['payment_status'][$data->payment_status ?? ''] ?? '',

            !empty($data->payment_date) && isValidTimestamp($data->payment_date) ? $data->payment_date : '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // HTML을 허용할 셀 범위를 지정
                $event->sheet->getStyle("A:ZZ")->getAlignment()->setWrapText(true);

                // 텍스트 높이 가운데로 정렬
                $event->sheet->getStyle('A:ZZ')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // 텍스트 가운데로 정렬
                $event->sheet->getStyle('A:ZZ')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // 폰트 bold & size
                $event->sheet->getDelegate()->getStyle('A1:ZZ1')->getFont()->setBold(true)->setSize(10);
            },
        ];
    }
}
