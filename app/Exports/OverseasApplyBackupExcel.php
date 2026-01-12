<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class OverseasApplyExcel implements FromQuery, WithHeadings, ShouldAutoSize, WithChunkReading, WithEvents, WithMapping
{
    private $overseasConfig;
    private $collection;
    private $query;
    private $total;
    private $row = 0;

    public function __construct($data)
    {
        $this->overseasConfig = config("site.overseas") ?? [];
        $this->userConfig = config("site.user") ?? [];
        $this->total = $data['total'];
        $this->query = $data['query'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    /*
    public function collection()
    {
        return $this->collection;
    }
    */

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        $excelHeaderDatas = [
            [
                'No',
                '신청상태',
                '접수일',

                '인적사항', '인적사항', '인적사항', '인적사항', '인적사항',
                '인적사항', '인적사항', '인적사항', '인적사항', '인적사항',
                '인적사항', '인적사항',

                '지원자격', '지원자격', '지원자격', '지원자격', '지원자격',
                '지원자격', '지원자격',

                '관리자확인', '관리자확인', '관리자확인', '관리자확인',

                '결과보고', '결과보고', '결과보고', '결과보고', '결과보고',
                '결과보고', '결과보고', '결과보고', '결과보고', '결과보고',
                '결과보고', '결과보고', '결과보고', '결과보고', '결과보고',
                '결과보고', '결과보고', '결과보고', '결과보고',
            ],
            [
                'No',
                '신청상태',
                '접수일',

                '학회 아이디',
                '성명 (한글)',
                '성명 (영문)',
                '의사면허번호',
                '생년월일',
                '전공분야',
                '근무처 정보(국문)',
                '휴대전화번호',
                'E-mail',
                '계좌정보 - 은행명',
                '계좌정보 - 계좌번호',
                '계좌정보 - 예금주',

                '참가역할 - 초록 발표자',
                '참가역할 - 강의',
                '참가역할 - 참석 형태',
                '발표 초록 Title - 국문',
                '발표 초록 Title - 영문',
                '발표 초록 File',
                '초록채택메일 or 초청 메일 여부',
                '초록채택메일 or 초청 메일 File',
                '초록채택메일 or 초청 메일 동의여부',

                '심사상태',
                '지원협회',
                '지급여부',
                '메모',

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

        return $excelHeaderDatas;
    }

    public function map($data): array
    {
        $overseasConfig = $this->overseasConfig;
        $userConfig = $this->userConfig;

        $excelListDatas = [
            $this->total - ($this->row++),
            $overseasConfig['complete'][$data->complete],
            $data->created_at,
        ];

        ####인적사항
        $major = $userConfig['major'][$data->user->major] ?? '';
        if($major == 'Z') {
            $major .= '-';
            $major .= $data->user->major_etc ?? '';
        }
        $excelListDatas_add = [
            $data->user->id ?? '',
            $data->user->name_kr ?? '',
            ($data->user->first_name ?? '').' '.($data->user->last_name ?? ''),
            $data->user->license_number ?? '',
            $data->user->birth_date ?? '',
            $data->user->license_number ?? '',
            $major,
            $data->phone ?? '',
            $data->email ?? '',
            $data->bank_name ?? '',
            $data->account_num ?? '',
            $data->account_name ?? '',
        ];
        $excelListDatas = array_merge($excelListDatas, $excelListDatas_add);
        ####인적사항

        ####지원자격
        $excelListDatas_add = [
            $overseasConfig['presenter'][$data->presenter] ?? '',
            $overseasConfig['lecture'][$data->lecture] ?? '',
            $overseasConfig['attend'][$data->attend] ?? '',
            $data->title_kr ?? '',
            $data->title_en ?? '',
            $data->filename1 ?? '',
            $overseasConfig['submit_type'][$data->submit_type] ?? '',
            $data->filename2 ?? '',
            $overseasConfig['agree2'][$data->agree2] ?? '',
        ];
        $excelListDatas = array_merge($excelListDatas, $excelListDatas_add);
        ####지원자격

        ####관리자 확인
        $excelListDatas_add = [
            $overseasConfig['judge'][$data->judge] ?? '',
            $overseasConfig['assistant'][$data->assistant] ?? '',
            '',
            $data->memo ?? '',
        ];
        $excelListDatas = array_merge($excelListDatas, $excelListDatas_add);
        ####관리자 확인

        ####결과보고
        $excelListDatas_add = [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ];
        $excelListDatas = array_merge($excelListDatas, $excelListDatas_add);
        ####결과보고

        return $excelListDatas;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    function excelWidthToPixels(float $width): int {
        // Excel 기본 폰트 기준 근사치
        return (int) floor($width * 7 + 5);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $lastCol = $sheet->getHighestColumn();
                $lastIndex = Coordinate::columnIndexFromString($lastCol);
                $lastRow = $sheet->getHighestRow();

                $headerLast = 2;#헤더 줄 설정
                $dataStart = $headerLast + 1;

                ##################헤더 설정####################
                $event->sheet->getDelegate()->getStyle("A1:".$lastCol.$headerLast)->getFont()->setBold(true);#헤더 폰트 굵게

                if($headerLast > 1){
                    #헤더 두줄 이상일때
                    $sheet->mergeCells('A1:A'.$headerLast);#셀합치기 rowspan
                    $sheet->getStyle('A1:A'.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');

                    $sheet->mergeCells('B1:B'.$headerLast);#셀합치기 rowspan
                    $sheet->getStyle('B1:B'.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');

                    $sheet->mergeCells('C1:C'.$headerLast);#셀합치기 rowspan
                    $sheet->getStyle('C1:C'.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');

                    $sheet->mergeCells('D1:X1');#셀합치기 colspan
                    $sheet->getStyle('D1:X'.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E2EFDA');

                    $sheet->mergeCells('Y1:AB1');#셀합치기 colspan
                    $sheet->getStyle('Y1:AB'.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FBE08C');

                    $sheet->mergeCells('AC1:'.$lastCol.'1');#셀합치기 colspan
                    $sheet->getStyle('AC1:'.$lastCol.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E8D0F7');
                }else{

                    #헤더 한줄일때
                    $sheet->getStyle("A1:".$lastCol.$headerLast)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');

                }

                #헤더높이 고정
                for ($row = 1; $row <= $headerLast; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(20);
                }
                ##################헤더 설정####################

                ##################너비 강제 설정 (A~마지막 열까지)####################
                for ($col = 1; $col <= $lastIndex; $col++) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);

                    if ($colLetter === 'A') {
                        continue; //A열은 보통 넘버링이라 continue;
                    }

                    //$sheet->getStyle($colLetter."1:".$colLetter.$lastRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
                    $sheet->getColumnDimension($colLetter)->setWidth(30);
                    $sheet->getColumnDimension($colLetter)->setAutoSize(false);
                }
                ##################너비 강제 설정 (A~마지막 열까지)####################

                ##################데이터행 높이 및 다운로드링크####################
                $rows = $this->query()->get();

                foreach ($rows as $index => $row) {
                    $excelRow = $dataStart + $index;

                    $sheet->getRowDimension($excelRow)->setRowHeight(20);

                    if($excelRow > 1){#헤더보다 클 경우

                        $fileLinks = [
                            'U' => '1',
                            'W' => '2',
                        ];

                        if(count($fileLinks) > 0){
                            foreach ($fileLinks as $column => $field) {
                                $cellValue = $sheet->getCell($column.$excelRow)->getValue();

                                if (!empty($cellValue)) {
                                    $downloadUrl = $row->downloadUrl($field);
                                    $sheet->getCell($column.$excelRow)->getHyperlink()->setUrl($downloadUrl);
                                }
                            }
                        }

                        $imageLinks = [
                            //'R' => 'sub_realfile1',
                            //'U' => 'sub_realfile2',
                            //'Y' => 'sub_realfile3',
                        ];

                        if(count($imageLinks) > 0){
                            $fixedColWidth = 30; // 컬럼 폭 고정
                            $padX = 4;           // 좌우 여백(px)
                            $padY = 4;           // 상하 여백(px)
                            $colWidthPx = self::excelWidthToPixels($fixedColWidth);
                            $maxRowPx = 0; // 이 행에서 필요한 최대 높이(px)

                            foreach ($imageLinks as $column => $field) {
                                $coord = $column.$excelRow;
                                $cell  = $sheet->getCell($coord);

                                if (empty($cell->getValue())) continue;

                                // 절대경로 확보 + 존재 검증
                                $path = public_path(ltrim((string) $row->$field, '/'));
                                $real = realpath($path);
                                if ($real === false || !is_file($real)) continue;

                                // 이미지 정보 검증 (0×0 방지, 미지원 포맷 제외)
                                $info = @getimagesize($real);
                                if ($info === false) continue;
                                [$iw, $ih] = [$info[0] ?? 0, $info[1] ?? 0];
                                if ($iw <= 0 || $ih <= 0) continue;

                                $mime = $info['mime'] ?? '';

                                // webp 또는 환경상 PNG 문제가 있으면 JPEG로 변환(임시 파일)
                                $usePath = $real;
                                if ($mime === 'image/webp' || ($mime === 'image/png' && !function_exists('imagecreatefrompng'))) {
                                    $bin = @file_get_contents($real);
                                    if ($bin !== false) {
                                        $gd = @imagecreatefromstring($bin);
                                        if ($gd) {
                                            $tmpJpg = tempnam(sys_get_temp_dir(), 'img_').'.jpg';
                                            imagejpeg($gd, $tmpJpg, 90);
                                            imagedestroy($gd);
                                            $usePath = $tmpJpg;
                                            $mime = 'image/jpeg';
                                            // 크기도 다시 구함
                                            $i2 = @getimagesize($usePath);
                                            if ($i2 && $i2[0] > 0 && $i2[1] > 0) {
                                                $iw = $i2[0]; $ih = $i2[1];
                                            }
                                        } else {
                                            continue; // 읽기 실패 시 건너뜀
                                        }
                                    } else {
                                        continue;
                                    }
                                }

                                // 컬럼 너비 고정
                                $sheet->getColumnDimension($column)->setWidth($fixedColWidth);

                                // 셀 가로(px) 및 축소 비율 계산 (최소 1 보장)
                                $cellWpx = max(1, $colWidthPx - $padX);
                                $scale   = min(1.0, $cellWpx / max(1, $iw));
                                $nw      = max(1, (int) floor($iw * $scale));
                                $nh      = max(1, (int) floor($ih * $scale));

                                // 셀 값/링크 제거
                                $cell->setValue('');
                                //$cell->setHyperlink(new Hyperlink(''));

                                // 가운데 배치 오프셋
                                $offsetX = max(0, (int) floor(($cellWpx - $nw) / 2));

                                // 이미지 삽입 (여기서 잘못된 값이 있으면 Writer 예외가 납니다)
                                $d = new Drawing();
                                $d->setName('thumb');
                                $d->setDescription('thumb');
                                $d->setPath($usePath);   // PNG/JPG/GIF/BMP
                                $d->setWidth($nw);       // 폭만 지정(비율 유지)
                                $d->setCoordinates($coord);
                                $d->setOffsetX($offsetX);
                                $d->setOffsetY(2);
                                $d->setWorksheet($sheet);

                                // 행 높이를 이미지 높이에 맞춤 (px→pt)
                                $neededPx = $nh + $padY;
                                if ($neededPx > $maxRowPx) $maxRowPx = $neededPx;
                            }

                            // 이 행의 최종 높이 적용
                            if ($maxRowPx > 0) {
                                $sheet->getRowDimension($excelRow)
                                    ->setRowHeight(DrawingShared::pixelsToPoints($maxRowPx));
                            }
                        }
                    }
                }
                ##################데이터행 높이 및 다운로드링크####################

                ##################기타 설정####################
                $lastRow = $sheet->getHighestRow();
                $range = "A1:".$lastCol.$lastRow;

                $sheet->getStyle($range)->getAlignment()->setWrapText(true);#셀 내 텍스트 줄바꿈 설정 (내용이 셀을 넘어가더라도 셀 안에서 줄바꿈됨)
                $sheet->getStyle($range)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);#셀 내용 가로 정렬: 가운데 정렬
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);#셀 내용 세로 정렬: 가운데 정렬
                $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);#셀 테두리 설정: 모든 셀에 얇은(border thin) 선 적용
                $sheet->getStyle($range)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);#셀 서식을 일반으로 설정 - 숫자 길경우 생기는 문제 해결
                ##################기타 설정####################
            },
        ];
    }
}
