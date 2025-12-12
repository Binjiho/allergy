<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MemberExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping
{
    private $userConfig;
    private $collection;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->userConfig = getConfig('user');
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
            '회원상태',
            '회원등급',
            '이름',
            '아이디',

            '이메일',
            '면허번호',
            '근무처',
            '근무처번호',
            '휴대폰번호',

            '가입일',
            '최종수정일',
            '최종로그인',
            '관라자지정',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;

        return [
            $this->total - ($this->row++),
            $userConfig['confirm'][$data->confirm] ?? '',
            $userConfig['level'][$data->level] ?? '',
            $data->name_kr ?? '',
            $data->id ?? '',

            $data->email ?? '',
            $data->license_number ?? '',
            !empty($data->company_kr) ? $data->company_kr : $data->company_en ?? '',
            $data->companyTel ?? '',
            $data->phone ?? '',

            !empty($data->created_at) ? $data->created_at->format('Y-m-d') : '',
            !empty($data->updated_at) ? $data->updated_at->format('Y-m-d') : '',
            !empty($data->login_at) ? $data->login_at->format('Y-m-d') : '',
            $data->is_admin ?? '',
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
