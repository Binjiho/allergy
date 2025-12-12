<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RegistrationExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $defaultConfig;
    private $collection;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->userConfig = getConfig('user');
        $this->defaultConfig = getConfig('default-workshop');
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
            '접수번호',
            '회원구분',
            '등록구분',
            '이름',
            '근무처(소속)',

            '면허번호',
            '이메일',
            '휴대폰번호',
            '등록비',
            '결제방법',

            '결제상태',
            '최초등록일',
            '최종등록일',
            '메모',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;
        $defaultConfig = $this->defaultConfig;
        if( $data['office_use'] == 'Y' ){
            $sosok ="(".$data->zipcode ?? ''.") ".$data->addr ?? ''." ".$data->addr_etc ?? '';
        }else{
            $sosok = $data->office_name ?? '';
        }

        return [
            $this->total - ($this->row++),
            $data->reg_num,
            $defaultConfig['member_gubun'][$data->member_gubun] ?? '',
            $defaultConfig['gubun'][$data->gubun] ?? '',
            $data->name_kr ?? '',
            $sosok,

            $data->license_number,
            $data->email,
            $data->phone,
            !empty($data->amount) ? number_format($data->amount ?? 0) : '',
            $defaultConfig['pay_method'][$data->pay_method] ?? '',

            $defaultConfig['pay_status'][$data->pay_status] ?? '',
            $data->created_at ?? '',
            $data->updated_at ?? '',
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
