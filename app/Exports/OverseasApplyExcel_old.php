<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OverseasApplyExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
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
            '신청상태',
            '학회ID',
            '성명(한글)',
            '소속',
            '면허번호',

            '이메일',
            '휴대폰번호',
            '지원자격',
            '발표제목',
            '심사상태',

            '지원협회',
            '결과보고제출상태',
            '접수일',
            '결과보고서제출일',
            '지급여부',

            '메모',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $overseasConfig = $this->overseasConfig;

        return [
            $this->total - ($this->row++),
            $overseasConfig['complete'][$data->complete] ?? '',
            $data->user->id ?? '',
            $data->user->name_kr ?? '',
            $data->sosok_kr ?? '',
            $data->user->license_number ?? '',


            $data->email ?? '',
            $data->phone ?? '',
            $overseasConfig['presenter'][$data->presenter] ?? '',
            $data->title_kr ?? '',

            $overseasConfig['judge'][$data->judge] ?? '',
            $overseasConfig['assistant'][$data->assistant] ?? '',
            $overseasConfig['report'][$data->report] ?? '',
            $data->created_at ?? '',
            $data->reported_at ?? '',
            $overseasConfig['pay_result'][$data->pay_result] ?? '',

            $data->memo ?? '',
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
