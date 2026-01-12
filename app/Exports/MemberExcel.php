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
            '아이디',
            '이름(국문)',

            '이름(영문)',
            '이름(한자)',
            '외국 국적 회원 여부',
            '생년월일',
            '휴대폰번호',

            '이메일',
            '자택주소',
            '면허번호',
            '전공분야',

            '전문의번호',
            '분과전문의번호',
            '입회일',
            '출신학교',
            '졸업일',

            '근무처(국문)',
            '근무처(영문)',
            '직위',
            '근무처번호',
            '근무처주소',
            'Mailing 서비스',

            'SMS 수신',
            '가입일',
            '최종수정일',
            '최종로그인',
            '관라자지정',
        ];
    }

    public function map($data): array
    {
        $userConfig = $this->userConfig;

        $eng_name = $data->first_name ?? '';
        $eng_name .= ' ';
        $eng_name .= $data->last_name ?? '';

        $home_addr = '('.$data->home_zipcode.') ';
        $home_addr .= $data->home_address ?? '';
        $home_addr .= ' ';
        $home_addr .= $data->home_address2 ?? '';

        $major = $userConfig['major'][$data->major] ?? '';
        if($data->major == 'Z') {
            $major .= '-';
            $major .= $data->major_etc;
        }

        $company_addr = '('.$data->company_zipcode.') ';
        $company_addr .= $data->company_address ?? '';
        $company_addr .= ' ';
        $company_addr .= $data->company_address2 ?? '';

        return [
            $this->total - ($this->row++),
            $userConfig['confirm'][$data->confirm] ?? '',
            $userConfig['level'][$data->level] ?? '',
            $data->id ?? '',
            $data->name_kr ?? '',

            $eng_name ?? '',
            $data->name_han ?? '',
            $data->is_national ?? '',
            $data->birth_date ?? '',
            $data->phone ?? '',

            $data->email ?? '',
            $home_addr ?? '',
            $data->license_number ?? '',
            $major ?? '',

            $data->special_number ?? '',
            $data->bun_number ?? '',
            $data->join_date ?? '',
            $data->school ?? '',
            $data->graduate_date ?? '',

            $data->company_kr ?? '',
            $data->company_en ?? '',
            $data->position ?? '',
            $data->companyTel ?? '',
            $company_addr ?? '',
            $data->emailReception == 'Y' ? '수신' : '미수신',

            $data->smsReception == 'Y' ? '수신' : '미수신',
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
