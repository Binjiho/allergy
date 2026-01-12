<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GranteesExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $overseasConfig;
    private $collection;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->userConfig = getConfig('user');
        $this->overseasConfig = getConfig('overseas');
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
            'No',
            '연도',
            '학회명',
            '개최일자',
            '개최장소',
            '이름',

            '면허번호',
            '메모',
            '최초등록일',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $overseasConfig = $this->overseasConfig;

        return [
            $this->total - ($this->row++),
            $data->year ?? '',
            $data->title ?? '',
            $data->event_date ?? '',
            $data->place ?? '',
            $data->name_kr ?? '',

            $data->license_number ?? '',
            $data->memo ?? '',
            $data->created_at ?? '',
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
