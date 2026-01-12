<?php

namespace App\Services;

use App\Models\Board;
use App\Models\BoardFile;
use App\Models\Counter;
use App\Models\MailAddress;
use App\Models\MailAddressDetail;
use App\Models\MailList;
use App\Models\MailOldList;
use App\Models\MailFile;
use App\Models\MailSend;
use App\Models\Referer;
use App\Models\User;
use App\Models\UserOff;
use App\Models\Fee;
use App\Models\Education;
use App\Models\Workshop;
use App\Models\Lecture;
use App\Models\Hospital;
use App\Models\Registration;
use App\Models\Abs;
use App\Models\Affiliations;
use App\Models\Authors;
use App\Models\Journal;
use App\Models\Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DateTime;

/**
 * Class DBTransferServices
 * @package App\Services
 */
class DBTransferServices extends AppServices
{
    public function transferService()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        var_dump('################# start Transfer ################# <br> <br> <br> <br>');

        if (isDev()) {
            /* 관리자 영역 */
//            $this->userLevelUpdate(); // 회원 등급 업데이트
//            $this->userPasswordUpdate(); // 회원 비밀번호 일괄 업데이트
//            $this->userMajorUpdate(); // 회원 가입날짜 업데이트
//            $this->userMetaUpdate(); // 회원 가입날짜 업데이트

//            $this->userTransfer(); // 회원 정보
//            $this->offUserTransfer();

//            $this->feeTransfer(); // 회비 정보

//            $this->mailAddressTransfer(); // 메일 주소록
//            $this->mailAddressDetailTransfer(); // 메일 주소록 상세
//
//            $this->mailTransfer(); // 메일목록
//            $this->mailSendTransfer(); // 메일발송 리스트
            /* END 관리자 영역 */

//            $this->boardNotice(); // 공지사항 게시판
//            $this->boardBranch(); // 지회 게시판
//            $this->boardTreatment(); // 진료지침게시판
//            $this->boardPhoto(); // 포토갤러리 게시판
//            $this->boardJournal(); // 권호수 게시판
//            $this->boardWorkshop(); // 학술대회 게시판
//            $this->hospitalTransfer();

            /* 학술대회 영역 */
//            $this->pastWorkshopTransfer(); // 학술대회
//            $this->workshopTransfer(); // 학술대회
//            $this->workshopRegistrationTransfer(); // 사전등록
//            $this->absTransfer(); // 초록등록
//            $this->affiTransfer(); // affi
//            $this->authorTransfer(); // author
//            $this->supportTransfer(); // 후원신청
            /* //학술대회 영역 */
        }

        var_dump('<br> <br> <br> <br> ################# finish Transfer #################');
    }

    private function userLevelUpdate()
    {
        $this->oldDBConnection();
        $old_user = DB::select(DB::raw("select * from member"));
        $custom_old_user = [];

        foreach ($old_user as $key => $row) {
            $user_id = $row->USERID;

            switch ($row->rank_no){
                case '종신회원':
                    $rank = '종신회원';
                    $gubun = 'N';
                    $grade = 'B';
                    $level = 'NB';
                    $is_admin = 'N';
                    break;
                case '관리자':
                    $rank = '관리자';
                    $gubun = 'N';
                    $grade = 'A';
                    $level = 'NA';
                    $is_admin = 'Y';
                    break;
                default:
                    $rank = '정회원';
                    $gubun = 'N';
                    $grade = 'A';
                    $level = 'NA';
                    $is_admin = 'N';
                    break;
            }

            $custom_old_user[] = [
                'user_id' => $user_id,
                'gubun' => $gubun,
                'grade' => $grade,
                'level' => $level,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totUser = number_format(count($custom_old_user));
            var_dump("INSERT users START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($custom_old_user as $key => $row) {
                $user = User::withTrashed()->where(['id'=> $row['user_id'],'gubun'=>'N'])->first();
                $user->gubun = $row['gubun'];
                $user->grade = $row['grade'];
                $user->level = $row['level'];
                $user->update();

                $cnt = ($key + 1);
                var_dump("INSERT users {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT users FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function userMajorUpdate()
    {
        $this->oldDBConnection();
        $old_user = DB::select(DB::raw("select * from if_users "));
        $custom_old_user = [];

        foreach ($old_user as $key => $row) {
            $user_id = $row->user_login;

            switch ($row->major_field){
                case '1010':
                    $user_major = 'A';
                    break;
                case '1020':
                    $user_major = 'B';
                    break;
                case '1030':
                    $user_major = 'C';
                    break;
                case '1040':
                    $user_major = 'D';
                    break;
                case '1050':
                    $user_major = 'E';
                    break;
                default:
                    $user_major = 'Z';
                    break;
            }

            $custom_old_user[] = [
                'user_id' => $user_id,
                'major' => $user_major ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totUser = number_format(count($custom_old_user));
            var_dump("INSERT users START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($custom_old_user as $key => $row) {
                $user = User::withTrashed()->where(['id'=> $row['user_id']])->first();
                if($user){
                    $user->major = !empty($row['major']) ? $row['major'] : null;

                    $user->update();

                }

                $cnt = ($key + 1);
                var_dump("INSERT users {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT users FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
    private function userMetaUpdate()
    {
        $this->oldDBConnection();
        $old_user = DB::select(DB::raw("select * from if_users "));
        $custom_old_user = [];

        foreach ($old_user as $key => $row) {
            $user_id = $row->user_login;

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

//            $home_zipcode = null;
//            $home_address1 = null;
//            $home_address2 = null;
//            $org_zipcode = null;
//            $org_address1 = null;
//            $org_address2 = null;
//            $of_tel = null;
//            $of_fax = null;
//            $major_field_etc = null;
//            $special_no = null;
            $dtl_sp_no = null;
            $org_name_en = null;
//            $join_dt = null;
//            $graduated_dt = null;
//            $org_position = null;
//            $last_login_dt = null;
//            $admin_memo = null;

            if (!empty($meta_data['home_zipcode']) ) {
                $home_zipcode = $meta_data['home_zipcode'];
            }
            if (!empty($meta_data['home_address1']) ) {
                $home_address1 = $meta_data['home_address1'];
            }
            if (!empty($meta_data['home_address2']) ) {
                $home_address2 = $meta_data['home_address2'];
            }
            if (!empty($meta_data['org_zipcode']) ) {
                $org_zipcode = $meta_data['org_zipcode'];
            }
            if (!empty($meta_data['org_address1']) ) {
                $org_address1 = $meta_data['org_address1'];
            }
            if (!empty($meta_data['org_address2']) ) {
                $org_address2 = $meta_data['org_address2'];
            }
            if (!empty($meta_data['of_tel']) ) {
                $of_tel = $meta_data['of_tel'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['major_field_etc']) ) {
                $major_field_etc = $meta_data['major_field_etc'];
            }
            if (!empty($meta_data['special_no']) ) {
                $special_no = $meta_data['special_no'];
            }
            if (!empty($meta_data['dtl_sp_no']) ) {
                $dtl_sp_no = $meta_data['dtl_sp_no'];
            }
            if (!empty($meta_data['org_name_en']) ) {
                $org_name_en = $meta_data['org_name_en'];
            }
            if (!empty($meta_data['join_dt']) ) {
                $join_dt = $meta_data['join_dt']; //입회일
            }
            if (!empty($meta_data['graduated_dt']) ) {
                $graduated_dt = $meta_data['graduated_dt'];
            }
            if (!empty($meta_data['org_position']) ) {
                $org_position = $meta_data['org_position'];
            }
            if (!empty($meta_data['last_login_dt']) ) {
                $last_login_dt = $meta_data['last_login_dt'];
            }
            if (!empty($meta_data['admin_memo']) ) {
                $admin_memo = $meta_data['admin_memo'];
            }

            $custom_old_user[] = [
                'user_id' => $user_id,
                'home_zipcode' => $home_zipcode ?? null,
                'home_address' => $home_address1 ?? null,
                'home_address2' => $home_address2 ?? null,

                'major_etc' => $major_field_etc ?? null,
                'special_number' => $special_no ?? null,
                'bun_number' => $dtl_sp_no ?? null,
                'org_name_en' => $org_name_en ?? null,
                'join_date' => $join_dt ?? null,
                'graduate_date' => $graduated_dt ?? null,

                'position' => $org_position ?? null,
                'company_zipcode' => $org_zipcode ?? null,
                'company_address' => $org_address1 ?? null,
                'company_address2' => $org_address2 ?? null,
                'companyTel' => $of_tel ?? null,
                'companyFax' => $of_fax ?? null,

                'memo' => $admin_memo ?? null,
                'login_at' => $last_login_dt ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totUser = number_format(count($custom_old_user));
            var_dump("INSERT users START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($custom_old_user as $key => $row) {
                $user = User::withTrashed()->where(['id'=> $row['user_id']])->first();
                if($user){
//                    $user->home_zipcode = !empty($row['home_zipcode']) ? $row['home_zipcode'] : null;
//                    $user->home_address = !empty($row['home_address']) ? $row['home_address'] : null;
//                    $user->home_address2 = !empty($row['home_address2']) ? $row['home_address2'] : null;
//
//                    $user->major_etc = !empty($row['major_etc']) ? $row['major_etc'] : null;
//                    $user->special_number = !empty($row['special_number']) ? $row['special_number'] : null;
                    $user->bun_number = !empty($row['bun_number']) ? $row['bun_number'] : null;
                    $user->company_en = !empty($row['org_name_en']) ? $row['org_name_en'] : null;
//                    $user->join_date = !empty($row['join_date']) ? $row['join_date'] : null;
//                    $user->graduate_date = !empty($row['graduate_date']) ? $row['graduate_date'] : null;
//
//                    $user->position = !empty($row['position']) ? $row['position'] : null;
//                    $user->company_zipcode = !empty($row['company_zipcode']) ? $row['company_zipcode'] : null;
//                    $user->company_address = !empty($row['company_address']) ? $row['company_address'] : null;
//                    $user->company_address2 = !empty($row['company_address2']) ? $row['company_address2'] : null;
//                    $user->companyTel = !empty($row['companyTel']) ? $row['companyTel'] : null;
//
//                    $user->companyFax = !empty($row['companyFax']) ? $row['companyFax'] : null;
//                    $user->memo = !empty($row['memo']) ? $row['memo'] : null;

                    $user->update();

                }

                $cnt = ($key + 1);
                var_dump("INSERT users {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT users FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function userPasswordUpdate()
    {
        $users = User::withTrashed()->whereNotNull('birth')->get();
//        $users = User::withTrashed()->get();

        $this->transaction();

        try {
            $totUser = number_format($users->count());
            var_dump("Update password START: {{$totUser}} 개 데이터 <br><br>");

            foreach ($users as $key => $user) {
                $password = empty($user->birth) ? 'kosenv1234' : str_replace('-', '', $user->birth);

                $user->password = \Illuminate\Support\Facades\Hash::make($password);
                $user->update();

                $cnt = ($key + 1);
                var_dump("Update password {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> Update password FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function userTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_users ORDER BY seq_id"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $del = $row->show_hide == 'show' ? 'N' : 'Y';
            $created_at = $row->create_dt ?? null;
            $updated_at = $row->update_dt ?? null;

            switch ($row->user_class){
                case '2':
                    $user_level = 'B';
                    break;
                case '3':
                    $user_level = 'A';
                    break;
                case '4':
                    $user_level = 'C';
                    break;
                case '5':
                    $user_level = 'D';
                    break;
                default:
                    $user_level = 'N';
                    break;
            }

            switch ($row->user_state){
                case '30':
                    $user_confirm = 'Y';
                    break;
                default:
                    $user_confirm = 'N';
                    break;
            }

            switch ($row->major_field){
                case '1010':
                    $user_major = 'A';
                    break;
                case '1020':
                    $user_major = 'B';
                    break;
                case '1030':
                    $user_major = 'C';
                    break;
                case '1040':
                    $user_major = 'D';
                    break;
                case '1050':
                    $user_major = 'E';
                    break;
                default:
                    $user_major = 'Z';
                    break;
            }

            if(!empty($row->name_en)){
                $eng_name = $row->name_en;

                $lastSpacePosition = strrpos($eng_name, ' ');

                if ($lastSpacePosition === false) {
                    $firstname = "";
                    $lastname = $eng_name;
                } else {
                    $lastname = substr($eng_name, $lastSpacePosition + 1);
                    $firstname = trim(substr($eng_name, 0, $lastSpacePosition));
                }
            }

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

            if (!empty($meta_data['gender']) ) {
                $gender = $meta_data['gender'];
            }
            if (!empty($meta_data['home_zipcode']) ) {
                $home_zipcode = $meta_data['home_zipcode'];
            }
            if (!empty($meta_data['home_address1']) ) {
                $home_address1 = $meta_data['home_address1'];
            }
            if (!empty($meta_data['home_address2']) ) {
                $home_address2 = $meta_data['home_address2'];
            }
            if (!empty($meta_data['org_zipcode']) ) {
                $org_zipcode = $meta_data['org_zipcode'];
            }
            if (!empty($meta_data['org_address1']) ) {
                $org_address1 = $meta_data['org_address1'];
            }
            if (!empty($meta_data['org_address2']) ) {
                $org_address2 = $meta_data['org_address2'];
            }
            if (!empty($meta_data['of_tel']) ) {
                $of_tel = $meta_data['of_tel'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['major_field_etc']) ) {
                $major_field_etc = $meta_data['major_field_etc'];
            }
            if (!empty($meta_data['special_no']) ) {
                $special_no = $meta_data['special_no'];
            }
            if (!empty($meta_data['dtl_sp_no']) ) {
                $dtl_sp_no = $meta_data['dtl_sp_no'];
            }
            if (!empty($meta_data['join_dt']) ) {
                $join_dt = $meta_data['join_dt']; //입회일
            }
            if (!empty($meta_data['graduated_dt']) ) {
                $graduated_dt = $meta_data['graduated_dt'];
            }
            if (!empty($meta_data['org_position']) ) {
                $org_position = $meta_data['org_position'];
            }
            if (!empty($meta_data['last_login_dt']) ) {
                $last_login_dt = $meta_data['last_login_dt'];
            }
            if (!empty($meta_data['admin_memo']) ) {
                $admin_memo = $meta_data['admin_memo'];
            }

            $custom_old_notice[] = [
                'del' => $del ?? 'N',
                'level' => $user_level ?? 'N',
                'gender' => $gender ?? null,
                'confirm' => $user_confirm ?? 'N',
                'sid' => $row->seq_id ?? null,


                'id' => $row->user_login ?? null,
                'name_kr' => $row->name_ko ?? null,
                'first_name' => $firstname ?? null,
                'last_name' => $lastname ?? null,
                'name_han' => $row->name_zh ?? null,

                'is_national' => ($row->is_foreign_member == 'NO') ? 'N' : 'Y',
                'birth_date' => $row->user_birth ?? null,
                'phone' => $row->user_mobile ?? null,
                'smsReception' => ($row->sms_service == 'Y') ? 'Y' : 'N',
                'email' => $row->user_email ?? null,

                'emailReception' => ($row->mailing_service == 'Y') ? 'Y' : 'N',
                'home_zipcode' => $home_zipcode ?? null,
                'home_address' => $home_address1 ?? null,
                'home_address2' => $home_address2 ?? null,
                'license_number' => $row->license_no ?? null,

                'major' => $user_major ?? 'Z',
                'major_etc' => $major_field_etc ?? null,
                'special_number' => $special_no ?? null,
                'bun_number' => $dtl_sp_no ?? null,
                'join_date' => $join_dt ?? null,

                'graduate_date' => $graduated_dt ?? null,
                'school' => $row->graduated_univ ?? null,
                'position' => $org_position ?? null,
                'company_kr' => $row->org_name ?? null,
                'company_en' => $row->org_name ?? null,

                'company_zipcode' => $org_zipcode ?? null,
                'company_address' => $org_address1 ?? null,
                'company_address2' => $org_address2 ?? null,
                'companyTel' => $of_tel ?? null,
                'companyFax' => $of_fax ?? null,
                'memo' => $admin_memo ?? null,

                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
                'login_at' => $last_login_dt ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT users (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {

                $board = new User();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];
                $board->login_at = $row['login_at'];

                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT users (회원db) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function offUserTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_users_offline ORDER BY seq_id"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $del = $row->show_hide == 'show' ? 'N' : 'Y';
            $created_at = $row->create_dt ?? null;
            $updated_at = $row->update_dt ?? null;

            switch ($row->user_class){
                case '2':
                    $user_level = 'B';
                    break;
                case '3':
                    $user_level = 'A';
                    break;
                case '4':
                    $user_level = 'C';
                    break;
                case '5':
                    $user_level = 'D';
                    break;
                default:
                    $user_level = 'N';
                    break;
            }

            switch ($row->user_state){
                case '30':
                    $user_confirm = 'Y';
                    break;
                default:
                    $user_confirm = 'N';
                    break;
            }

            switch ($row->major_field){
                case '1010':
                    $user_major = 'A';
                    break;
                case '1020':
                    $user_major = 'B';
                    break;
                case '1030':
                    $user_major = 'C';
                    break;
                case '1040':
                    $user_major = 'D';
                case '1050':
                    $user_major = 'E';
                    break;
                default:
                    $user_major = 'Z';
                    break;
            }

            if(!empty($row->name_en)){
                $eng_name = $row->name_en;

                $lastSpacePosition = strrpos($eng_name, ' ');

                if ($lastSpacePosition === false) {
                    $firstname = "";
                    $lastname = $eng_name;
                } else {
                    $lastname = substr($eng_name, $lastSpacePosition + 1);
                    $firstname = trim(substr($eng_name, 0, $lastSpacePosition));
                }
            }

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

            if (!empty($meta_data['gender']) ) {
                $gender = $meta_data['gender'];
            }
            if (!empty($meta_data['home_zipcode']) ) {
                $home_zipcode = $meta_data['home_zipcode'];
            }
            if (!empty($meta_data['home_address1']) ) {
                $home_address1 = $meta_data['home_address1'];
            }
            if (!empty($meta_data['home_address2']) ) {
                $home_address2 = $meta_data['home_address2'];
            }
            if (!empty($meta_data['org_zipcode']) ) {
                $org_zipcode = $meta_data['org_zipcode'];
            }
            if (!empty($meta_data['org_address1']) ) {
                $org_address1 = $meta_data['org_address1'];
            }
            if (!empty($meta_data['org_address2']) ) {
                $org_address2 = $meta_data['org_address2'];
            }
            if (!empty($meta_data['of_tel']) ) {
                $of_tel = $meta_data['of_tel'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['of_fax']) ) {
                $of_fax = $meta_data['of_fax'];
            }
            if (!empty($meta_data['major_field_etc']) ) {
                $major_field_etc = $meta_data['major_field_etc'];
            }
            if (!empty($meta_data['special_no']) ) {
                $special_no = $meta_data['special_no'];
            }
            if (!empty($meta_data['dtl_sp_no']) ) {
                $dtl_sp_no = $meta_data['dtl_sp_no'];
            }
            if (!empty($meta_data['join_dt']) ) {
                $join_dt = $meta_data['join_dt']; //입회일
            }
            if (!empty($meta_data['graduated_dt']) ) {
                $graduated_dt = $meta_data['graduated_dt'];
            }
            if (!empty($meta_data['org_position']) ) {
                $org_position = $meta_data['org_position'];
            }
            if (!empty($meta_data['last_login_dt']) ) {
                $last_login_dt = $meta_data['last_login_dt'];
            }
            if (!empty($meta_data['admin_memo']) ) {
                $admin_memo = $meta_data['admin_memo'];
            }

            $custom_old_notice[] = [
                'del' => $del ?? 'N',
                'level' => $user_level ?? 'N',
                'gender' => $gender ?? null,
                'confirm' => $user_confirm ?? 'N',


                'id' => $row->user_login ?? null,
                'name_kr' => $row->name_ko ?? null,
                'first_name' => $firstname ?? null,
                'last_name' => $lastname ?? null,
                'name_han' => $row->name_zh ?? null,

                'is_national' => ($row->is_foreign_member == 'NO') ? 'N' : 'Y',
                'birth_date' => $row->user_birth ?? null,
                'phone' => $row->user_mobile ?? null,
                'smsReception' => ($row->sms_service == 'Y') ? 'Y' : 'N',
                'email' => $row->user_email ?? null,

                'emailReception' => ($row->mailing_service == 'Y') ? 'Y' : 'N',
                'home_zipcode' => $home_zipcode ?? null,
                'home_address' => $home_address1 ?? null,
                'home_address2' => $home_address2 ?? null,
                'license_number' => $row->license_no ?? null,

                'major' => $user_major ?? 'Z',
                'major_etc' => $major_field_etc ?? null,
                'special_number' => $special_no ?? null,
                'bun_number' => $dtl_sp_no ?? null,
                'join_date' => $join_dt ?? null,

                'graduate_date' => $graduated_dt ?? null,
                'school' => $row->graduated_univ ?? null,
                'position' => $org_position ?? null,
                'company_kr' => $row->org_name ?? null,
                'company_en' => $row->org_name ?? null,

                'company_zipcode' => $org_zipcode ?? null,
                'company_address' => $org_address1 ?? null,
                'company_address2' => $org_address2 ?? null,
                'companyTel' => $of_tel ?? null,
                'companyFax' => $of_fax ?? null,
                'memo' => $admin_memo ?? null,

                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
                'login_at' => $last_login_dt ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT users_off (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {

                $board = new UserOff();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];
                $board->login_at = $row['login_at'];

                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT users_off (회원db) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT users_off FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function feeTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_user_payment WHERE item_type IN ('ANN', 'PER', 'ENT') ORDER BY pay_id"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {

            $product_id = $row->product_id;
            if($product_id > 0){
                $old_item = DB::table('if_item_product')
                    ->where('product_id', $product_id)
                    ->first();
                $user_class_id = $old_item->user_class_id;
            }

            $created_at = $row->create_dt ?? null;

            switch ($row->item_type){
                case 'ANN':
                    $category = 'B';
                    break;
                case 'PER':
                    $category = 'C';
                    break;
                case 'ENT':
                    $category = 'A';
                    break;
                default:
                    $category = 'B';
                    break;
            }

            switch ($row->pay_state){
                case '1000':
                    $payment_status = 'N';
                    break;
                case '9000':
                    $payment_status = 'Y';
                    break;
                default:
                    $payment_status = 'N';
                    break;
            }

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

            if (!empty($meta_data['admin_memo']) ) {
                $admin_memo = $meta_data['admin_memo'];
            }
            if (!empty($meta_data['order_code']) ) {
                $order_code = $meta_data['order_code'];
            }

            $custom_old_notice[] = [
                'category' => $category ?? null,
                'user_sid' => $row->user_id ?? null,
                'memo' => $admin_memo ?? null,
                'payment_status' => $payment_status ?? 'N',
                'payment_method' => ($row->pay_method == 'BANK_TR') ? 'B' : 'C',

                'year' => $row->item_year ?? null,
                'payment_date' => $row->pay_date ?? null,
                'price' => $row->pay_amount ?? null,
                'sDate' => $row->pay_date ?? null,
                'eDate' => $row->expiry_date ?? null,

                'resultCode' => $order_code ?? null,
                'level' => ($user_class_id == '2') ? 'B' : 'A',

                'created_at' => $created_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT fee (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {

                $board = new Fee();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];

                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT fee (회원db) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT fee FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function mailAddressTransfer()
    {
        $this->oldDBConnection();
        $old_mailAddress = DB::select(DB::raw("select * from mailgroup WHERE IDX is not null order by IDX"));
        $custom_old_mailAddress = [];

        foreach ($old_mailAddress as $row) {
            $custom_old_mailAddress[] = [
                'sid' => $row->IDX,
                'title' => $row->GROUPNAME,
                'c_index' => null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totMailAddress = number_format(count($custom_old_mailAddress));
            var_dump("INSERT mail_addresses START: {{$totMailAddress}} 개 데이터 <br><br>");

            foreach ($custom_old_mailAddress as $key => $row) {

                $mailAddress = new MailAddress();
                $mailAddress->setByData($row);

                // 추가 or 변경 데이터
                $mailAddress->c_index = $row['c_index']; // 이전 메일주소록 인덱스값
                $mailAddress->save();

                $cnt = ($key + 1);
                var_dump("INSERT mail_addresses {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT mail_addresses FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function mailAddressDetailTransfer()
    {
        $this->oldDBConnection();
        $old_mailAddressDetail = DB::select(DB::raw("select * from mailgroup_list where GROUP_IDX is not null "));
        $custom_old_mailAddressDetail = [];

        foreach ($old_mailAddressDetail as $row) {

            $created_at = \DateTime::createFromFormat('y/m/d', $row->WORK_DATE);

            $custom_old_mailAddressDetail[] = [
                'ma_sid' => $row->GROUP_IDX,
                'name' => $row->USERNAME,
                'email' => $row->EMAIL,
                'mobile' => null,
                'office' => null,
                'created_at' => $created_at,
                'updated_at' => null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totMailAddressDetail = number_format(count($custom_old_mailAddressDetail));
            var_dump("INSERT mail_addresses_details START: {{$totMailAddressDetail}} 개 데이터 <br><br>");

            foreach ($custom_old_mailAddressDetail as $key => $row) {
                $mailAddressDetail = new MailAddressDetail();
                $mailAddressDetail->setByData((object)$row);

                // 추가 or 변경 데이터
                $mailAddressDetail->created_at = $row['created_at'];
                $mailAddressDetail->updated_at = $row['updated_at'];
                $mailAddressDetail->save();

                $cnt = ($key + 1);
                var_dump("INSERT mail_addresses_details {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT mail_addresses_details FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
    
    private function mailTransfer()
    {
        $this->oldDBConnection();
        $old_mail = DB::select(DB::raw("select * from if_mail_content ORDER BY create_dt"));
        $custom_old_mail = [];

        foreach ($old_mail as $key => $row) {

            $del = $row->show_hide == 'show' ? 'N' : 'Y';
            $created_at = $row->create_dt ?? null;

            $custom_old_mail[] = [
                'template' => 'none',
                'subject' => $row->mail_subject,
                'contents' => $row->mail_content,
                'thread' => $row->send_count ?? 0,
                'send_date' => empty($row->senddate) ? null : date('Y-m-d H:i:s', $row->senddate),
                'created_at' => $created_at,
                'del' => $del,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totMail = number_format(count($custom_old_mail));
            var_dump("INSERT mail_lists START: {{$totMail}} 개 데이터 <br><br>");

            foreach ($custom_old_mail as $key => $row) {
                $mail = new MailList();
                $mail->setByData($row);

                // 추가 or 변경 데이터
                $mail->created_at = $row['created_at'];

                $mail->save();


                $cnt = ($key + 1);
                var_dump("INSERT mail_lists {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT mail_lists FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function mailSendTransfer()
    {
        ini_set('memory_limit', '-1');

        $this->oldDBConnection();
        $custom_old_mailSend = [];

        DB::table('mail_list_tbl')
            ->whereIn('mail_sid', function ($query) {
                $query->select('sid')
                    ->from('send_email')
                    ->orderBy('signdate');
            })
            ->whereNotNull('seq')
            ->orderBy('sid')
            ->chunk(1000, function ($old_mailSend) use(&$custom_old_mailSend) {
                foreach ($old_mailSend as $send) {
                    if (empty($send->code)) {
                        $status = 'S';
                        $send->code = '250';
                    } else {
                        $status = in_array($send->code, ['000', '250']) ? 'S' : 'F'; // 성공 : 실패
                    }

                    $custom_old_mailSend[] = [
                        'old_ml_sid' => $send->mail_sid,
                        'wiseu_seq' => $send->seq,
                        'receiver_name' => $send->name,
                        'receiver_email' => $send->email,
                        'subject' => $send->subject,
                        'contents' => $send->mail_body,
                        'status' => $status,
                        'status_msg' => ($status == 'R') ? '발송대기' : (getConfig('mail')['code'][$send->code] ?? ''),
                        'created_at' => date('Y-m-d H:i:s', $send->senddate),
                    ];
                }
            });

        $this->activationDBConnection();

        $totMailSend = number_format(count($custom_old_mailSend));
        var_dump("INSERT mail_sends START: {{$totMailSend}} 개 데이터 <br><br>");

        foreach ($custom_old_mailSend as $key => $row) {
            $mail = MailList::where('old_sid', $row['old_ml_sid'])->first();

            if (empty($mail->sid)) {
                continue; // 메일목록에 없는 데이터 건너뛰기
            }

            MailSend::insert([
                'ml_sid' => $mail->sid,
                'wiseu_seq' => $row['wiseu_seq'],
                'receiver_name' => $row['receiver_name'],
                'receiver_email' => $row['receiver_email'],
                'subject' => $row['subject'],
                'contents' => $row['contents'],
                'status' => $row['status'],
                'status_msg' => $row['status_msg'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['created_at'],
            ]);

            $cnt = ($key + 1);
            var_dump("INSERT mail_sends {$cnt} 번째 <br>");
        }

        $allMail = MailList::all();

        foreach ($allMail as $mail) {
            $mail->update([
                'readyCnt' => $mail->readyMail()->count(),
                'failCnt' => $mail->failMail()->count(),
                'sucCnt' => $mail->sucMail()->count(),
            ]);
        }
    }

    private function statCounter()
    {
        $this->oldDBConnection();
        $old_counter = DB::select(DB::raw("select * from counter"));
        $custom_old_counter = [];

        foreach ($old_counter as $row) {
            $created_at = Carbon::createFromFormat('Ymd', $row->d_regis)->format('Y-m-d H:i:s');

            $custom_old_counter[] = [
                'hit' => $row->hit,
                'page' => $row->page,
                'week' => $row->week,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totCounter = number_format(count($custom_old_counter));
            var_dump("INSERT counters START: {{$totCounter}} 개 데이터 <br><br>");

            foreach ($custom_old_counter as $key => $row) {
                Counter::insert([
                    'lang' => 'ko',
                    'hit' => $row['hit'],
                    'page' => $row['page'],
                    'week' => $row['week'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                ]);

                $cnt = ($key + 1);
                var_dump("INSERT counters {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT counters FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function statReferer()
    {
        $this->oldDBConnection();
        $old_referer = DB::select(DB::raw("select * from referer"));
        $custom_old_referer = [];

        foreach ($old_referer as $row) {
            $created_at = Carbon::createFromFormat('YmdHis', $row->d_regis)->format('Y-m-d H:i:s');

            $custom_old_referer[] = [
                'ip' => $row->ip,
                'id' => empty($row->id) ? null : $row->id,
                'referer' => $row->referer ?? '',
                'browser' => '',
                'platform' => '',
                'keyword' => '',
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totReferer = number_format(count($custom_old_referer));
            var_dump("INSERT referers START: {{$totReferer}} 개 데이터 <br><br>");

            foreach ($custom_old_referer as $key => $row) {
                Referer::insert([
                    'lang' => 'ko',
                    'ip' => $row['ip'],
                    'u_sid' => empty($row->id) ? null : (User::where('uid', $row->id)->first()->u_sid ?? null),
                    'referer' => $row['referer'],
                    'browser' => $row['browser'],
                    'platform' => $row['platform'],
                    'keyword' => $row['keyword'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                ]);

                $cnt = ($key + 1);
                var_dump("INSERT referers {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT referers FINISH");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function boardTreatment()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_posts where template_id = '29' ORDER BY seq_id")); //공지사항
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $hide = $row->post_state == 'open' ? 'N' : 'Y';
            $created_at = $row->post_date ?? null;
            $updated_at = $row->post_modified ?? null;

            $category_map = [
                1 => 'A',
                2 => 'B',
                3 => 'C',
                4 => 'D',
                5 => 'E',
                6 => 'F',
                7 => 'G',
                8 => 'H',
                9 => 'I',
                10 => 'Z',
            ];

            $field_arr = [];
            if(!empty($row->post_category) && $row->post_category > 0){
                $mapped_code = $category_map[$row->post_category] ?? null;
                $field_arr[] = $mapped_code;
            }
            if(!empty($row->post_category2) && $row->post_category2 > 0){
                $mapped_code2 = $category_map[$row->post_category2] ?? null;
                $field_arr[] = $mapped_code2;
            }
            if(!empty($row->post_category3) && $row->post_category3 > 0){
                $mapped_code3 = $category_map[$row->post_category3] ?? null;
                $field_arr[] = $mapped_code3;
            }
            $field = implode(',',$field_arr);

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);
            $uploadFile = [];

            $realfile1 = null;
            $filename1 = null;
            $realFilePath = null; // $realFilePath도 초기화

            if (!empty($meta_data['file_attachment']) && is_array($meta_data['file_attachment'])) {

                // file_attachment 배열의 데이터를 순회합니다.
                foreach ($meta_data['file_attachment'] as $fileData) {

                    $fileName = $fileData['file_name'] ?? null;
                    $originalFilePath = $fileData['file_path'] ?? '';

                    // 1. 파일 이름 추출 (경로의 마지막 슬래시 / 이후 문자열)
                    $baseName = basename($originalFilePath);

                    $realFilePath = '/storage/uploads/board/notice/' . $baseName;

                    $realfile1 = $realFilePath;
                    $filename1 = $fileName;
                }
            }

            if (!empty($meta_data['post_year']) ) {
                $post_year = $meta_data['post_year'];
            }
            if (!empty($meta_data['post_author']) ) {
                $post_author = $meta_data['post_author'];
            }
            if (!empty($meta_data['post_link']) ) {
                $post_link = $meta_data['post_link'];
                $post_link_type = 1;
            } else if (!empty($meta_data['post_link2']) ) {
                $post_link = $meta_data['post_link2'];
                $post_link_type = 2;
            }
            if (!empty($meta_data['post_citation']) ) {
                $post_etc = $meta_data['post_citation'];
            }

            $custom_old_notice[] = [
                'code' => 'treatment',
                'field' => $field,
                'gubun' => '2',
                'year' => $post_year ?? null,
                'guideline' => $row->post_title_eng ?? null,
                'author' => $post_author ?? null,
                'etc' => $post_etc ?? null,
                'realfile1' => $realfile1 ?? null,
                'filename1' => $filename1 ?? null,


                'user_sid' => $row->post_user_id ?? null,
                'name' => $row->post_name ?? null,
                'email' => $row->post_email ?? null,
                'subject' => $row->post_title ?? null,
                'contents' => $row->post_content ?? null,
                'link_type' => $post_link_type ?? null,
                'link_url' => $post_link ?? null,
                'notice' => 'N',
                'popup' => 'N',
                'main' => 'N',
                'hide' => $hide,
                'ref' => $row->post_view_count ?? null,
                'uploadFile' => $uploadFile,
                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT bords (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
//                $row['user_sid'] = '17905'; // 작성자 sid 추가

                $board = new Board();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->ref = $row['ref'];
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];

                $board->save();

                if (!empty($row['uploadFile'])) {
                    foreach ($row['uploadFile'] as $data) {
                        $data['user_sid'] = $row['user_sid'];

                        $boardFile = new BoardFile();
                        $boardFile->setByData($data, $board->sid);

                        // 추가 or 변경 데이터
                        $boardFile->code = 'treatment';
                        $boardFile->download = $row['download'] ?? 0;
                        $boardFile->created_at = $data['created_at'];
                        $boardFile->updated_at = $data['updated_at'];

                        $boardFile->save();
                    }
                }

                $cnt = ($key + 1);
                var_dump("INSERT boards (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function boardNotice()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_posts where template_id = '7' ORDER BY seq_id")); //공지사항
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $hide = $row->post_state == 'open' ? 'N' : 'Y';
            $created_at = $row->post_date ?? null;
            $updated_at = $row->post_modified ?? null;

            $uploadFile = [];

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);
            // 1. meta_data에서 파일 첨부 배열이 존재하는지 확인합니다.
//            if (isset($meta_data['file_attachment']) && is_array($meta_data['file_attachment'])) {
//
//                // file_attachment 배열의 데이터를 순회합니다.
//                foreach ($meta_data['file_attachment'] as $fileData) {
//                    $fileName = $fileData['file_name'] ?? null;
//                    $originalFilePath = $fileData['file_path'] ?? '';
//
//                    // 1. 파일 이름 추출 (경로의 마지막 슬래시 / 이후 문자열)
//                    $baseName = basename($originalFilePath);
//
//                    $realFilePath = '/storage/uploads/board/notice/' . $baseName;
//
//                    $uploadFile[] = [
//                        // DB에 저장할 때 필요한 필드명으로 매핑합니다.
//                        'filename' => $fileName,
//                        'realfile' => $realFilePath, // 실제 파일 경로 (DB에 저장될 값)
//                        'download' => 0, // JSON에 없으므로 기본값 0 사용
//                        'created_at' => null,
//                        'updated_at' => null,
//                    ];
//                }
//            }

            $custom_old_notice[] = [
                'code' => 'abs-news',
                'user_sid' => $row->post_user_id ?? null,
                'name' => $row->post_name ?? null,
                'email' => $row->post_email ?? null,
                'subject' => $row->post_title ?? null,
                'contents' => $row->post_content ?? null,
//                'link_url' => empty($row->LINK_URL) ? null : $row->LINK_URL,
                'notice' => 'N',
                'popup' => 'N',
                'main' => 'N',
                'hide' => $hide,
                'ref' => $row->post_view_count ?? null,
                'uploadFile' => $uploadFile,
                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT bords (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
//                $row['user_sid'] = '17905'; // 작성자 sid 추가

                $board = new Board();
                $board->setByData($row);

                // 추가 or 변경 데이터
//                $board->category = '4';
                $board->ref = $row['ref'];
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];

                $board->save();

                if (!empty($row['uploadFile'])) {
                    foreach ($row['uploadFile'] as $data) {
                        $data['user_sid'] = $row['user_sid'];

                        $boardFile = new BoardFile();
                        $boardFile->setByData($data, $board->sid);

                        // 추가 or 변경 데이터
                        $boardFile->download = $row['download'] ?? 0;
                        $boardFile->created_at = $data['created_at'];
                        $boardFile->updated_at = $data['updated_at'];

                        $boardFile->save();
                    }
                }

                $cnt = ($key + 1);
                var_dump("INSERT boards (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function boardBranch()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_posts where template_id = '24' ORDER BY seq_id")); //서울지회
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $hide = $row->post_state == 'open' ? 'N' : 'Y';
            $created_at = $row->post_date ?? null;
            $updated_at = $row->post_modified ?? null;

            $uploadFile = [];

            $custom_old_notice[] = [
                'code' => 'branch',
                'user_sid' => $row->post_user_id ?? null,
                'name' => $row->post_name ?? null,
                'email' => $row->post_email ?? null,
                'subject' => $row->post_title ?? null,
                'contents' => $row->post_content ?? null,
//                'link_url' => empty($row->LINK_URL) ? null : $row->LINK_URL,
                'notice' => 'N',
                'popup' => 'N',
                'main' => 'N',
                'hide' => $hide,
                'ref' => $row->post_view_count ?? null,
                'uploadFile' => $uploadFile,
                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT bords (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
//                $row['user_sid'] = '17905'; // 작성자 sid 추가

                $board = new Board();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->category = '7'; //서울 1
                $board->ref = $row['ref'];
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];

                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT boards (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function boardPhoto()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_posts where template_id = '5' ORDER BY seq_id")); //공지사항
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $hide = $row->post_state == 'open' ? 'N' : 'Y';
            $created_at = $row->post_date ?? null;
            $updated_at = $row->post_modified ?? null;

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);
            $uploadFile = [];

            $thumbrealfile = null;
            $thumbfilename = null;
            $realFilePath = null; // $realFilePath도 초기화

            if (!empty($meta_data['file_attachment']) && is_array($meta_data['file_attachment'])) {

                // file_attachment 배열의 데이터를 순회합니다.
                foreach ($meta_data['file_attachment'] as $fileData) {
                    $fileName = $fileData['file_name'] ?? null;
                    $originalFilePath = $fileData['file_path'] ?? '';

                    // 1. 파일 이름 추출 (경로의 마지막 슬래시 / 이후 문자열)
                    $baseName = basename($originalFilePath);

                    $realFilePath = '/storage/uploads/board/photo/' . $baseName;

                    $uploadFile[] = [
                        // DB에 저장할 때 필요한 필드명으로 매핑합니다.
                        'filename' => $fileName,
                        'realfile' => $realFilePath, // 실제 파일 경로 (DB에 저장될 값)
                        'download' => 0, // JSON에 없으므로 기본값 0 사용
                        'created_at' => null,
                        'updated_at' => null,
                    ];
                }
            }

            if (!empty($meta_data['thumb_attachment']) && is_array($meta_data['thumb_attachment'])) {

                // file_attachment 배열의 데이터를 순회합니다.
                foreach ($meta_data['thumb_attachment'] as $fileData) {

                    $fileName = $fileData['file_name'] ?? null;
                    $originalFilePath = $fileData['file_path'] ?? '';

                    // 1. 파일 이름 추출 (경로의 마지막 슬래시 / 이후 문자열)
                    $baseName = basename($originalFilePath);

                    $realFilePath = '/storage/uploads/board/photo/thumbnail/' . $baseName;

                    $thumbrealfile = $realFilePath;
                    $thumbfilename = $fileName;
                }
            }

            if (!empty($meta_data['post_year']) ) {
                $post_year = $meta_data['post_year'];
            }
            if (!empty($meta_data['post_author']) ) {
                $post_author = $meta_data['post_author'];
            }
            if (!empty($meta_data['post_link']) ) {
                $post_link = $meta_data['post_link'];
                $post_link_type = 1;
            } else if (!empty($meta_data['post_link2']) ) {
                $post_link = $meta_data['post_link2'];
                $post_link_type = 2;
            }
            if (!empty($meta_data['post_citation']) ) {
                $post_etc = $meta_data['post_citation'];
            }

            $custom_old_notice[] = [
                'code' => 'photo',
                'year' => $post_year ?? null,
                'guideline' => $row->post_title_eng ?? null,
                'author' => $post_author ?? null,
                'etc' => $post_etc ?? null,
                'event_sDate' => $created_at ?? null,
                'thumbnail_realfile' => $thumbrealfile ?? null,
                'thumbnail_filename' => $thumbfilename ?? null,


                'user_sid' => $row->post_user_id ?? null,
                'name' => $row->post_name ?? null,
                'email' => $row->post_email ?? null,
                'subject' => $row->post_title ?? null,
                'contents' => $row->post_content ?? null,
                'link_type' => $post_link_type ?? null,
                'link_url' => $post_link ?? null,
                'notice' => 'N',
                'popup' => 'N',
                'main' => 'N',
                'hide' => $hide,
                'ref' => $row->post_view_count ?? null,
                'uploadFile' => $uploadFile,
                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT bords (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
//                $row['user_sid'] = '17905'; // 작성자 sid 추가

                $board = new Board();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->ref = $row['ref'];
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];

                $board->save();

                if (!empty($row['uploadFile'])) {
                    foreach ($row['uploadFile'] as $data) {
                        $data['user_sid'] = $row['user_sid'];

                        $boardFile = new BoardFile();
                        $boardFile->setByData($data, $board->sid);

                        // 추가 or 변경 데이터
                        $boardFile->code = 'photo';
                        $boardFile->download = $row['download'] ?? 0;
                        $boardFile->created_at = $data['created_at'];
                        $boardFile->updated_at = $data['updated_at'];

                        $boardFile->save();
                    }
                }

                $cnt = ($key + 1);
                var_dump("INSERT boards (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function boardJournal()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_aaci_journal ORDER BY uid")); //권호수게시판
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $created_at = $row->reg_dt ?? null;


            $custom_old_notice[] = [
                'code' => $row->code ?? null,
                'book' => $row->Book ?? null,
                'category' => $row->Cat ?? null,
                'no' => $row->No ?? null,
                'issue_number' => $row->Issn ?? null,

                'vol' => $row->Vol ?? null,
                'num' => $row->Num ?? null,
                'regnum' => $row->Regnum ?? null,
                'start_page' => $row->StartPage ?? null,
                'last_page' => $row->LastPage ?? null,

                'tot_page' => $row->TotPage ?? null,
                'subject_kr' => $row->HSubject ?? null,
                'subject_en' => $row->ESubject ?? null,
                'author_kr' => $row->HAuthor ?? null,
                'author_en' => $row->EAuthor ?? null,

                'main_author_kr' => $row->HmainAuthor ?? null,
                'main_author_en' => $row->EmainAuthor ?? null,
                'place_kr' => $row->HPlace ?? null,
                'place_en' => $row->EPlace ?? null,
                'publisher_kr' => $row->HPublisher ?? null,

                'publisher_en' => $row->EPublisher ?? null,
                'published_at' => $row->Publisher_date ?? null,
                'abstract_kr' => $row->HAbstract ?? null,
                'abstract_en' => $row->EAbstract ?? null,
                'keywords' => $row->EKeywords ?? null,

                'filename' => $row->File_name ?? null,

                'created_at' => $created_at ?? null,
            ];
            
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT journal (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {

                $board = new Journal();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];

                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT journal (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT journal FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }


    private function boardWorkshop()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_conference  ORDER BY seq_id"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $hide = $row->show_hide == 'show' ? 'N' : 'Y';
            $created_at = $row->created_dt ?? null;

            switch ($row->event_type){
                case 'ACD':
                    $event_category = '1';
                    break;
                case 'OVS':
                    $event_category = '2';
                    break;
                case 'EDU':
                    $event_category = '3';
                    break;
                case 'MET':
                    $event_category = '5';
                    break;
                case 'LEC':
                    $event_category = '6';
                    break;
                case 'SEM':
                    $event_category = '8';
                    break;
                default:
                    $event_category = '7';
                    break;
            }

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

            if (!empty($meta_data['event_content']) ) {
                $event_content = $meta_data['event_content'];
            }

            $custom_old_notice[] = [
                'code' => 'event-schedule',
                'year' => $row->event_year ?? null,
                'gubun' => $event_category ?? null,
                'place' => $row->event_place ?? null,

                'date_type' => ($row->event_period_from == $row->event_period_to) ? 'D' : 'L',
                'event_sDate' => $row->event_period_from ?? null,
                'event_eDate' => $row->event_period_to ?? null,


                'user_sid' => null,
                'name' => null,
                'email' => null,
                'subject' => $row->event_name ?? null,
                'contents' => $event_content ?? null,

                'link_type' => $post_link_type ?? null,
                'link_url' => $post_link ?? null,
                'notice' => 'N',
                'popup' => 'N',
                'main' => 'N',
                'hide' => $hide,
                'ref' => 0,

                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT bords (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
//                $row['user_sid'] = '17905'; // 작성자 sid 추가

                $board = new Board();
                $board->setByData($row);

                // 추가 or 변경 데이터
                $board->ref = $row['ref'];
                $board->created_at = $row['created_at'];
                $board->updated_at = $row['updated_at'];

                $board->save();

                if (!empty($row['uploadFile'])) {
                    foreach ($row['uploadFile'] as $data) {
                        $data['user_sid'] = $row['user_sid'];

                        $boardFile = new BoardFile();
                        $boardFile->setByData($data, $board->sid);

                        // 추가 or 변경 데이터
                        $boardFile->code = 'photo';
                        $boardFile->download = $row['download'] ?? 0;
                        $boardFile->created_at = $data['created_at'];
                        $boardFile->updated_at = $data['updated_at'];

                        $boardFile->save();
                    }
                }

                $cnt = ($key + 1);
                var_dump("INSERT boards (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
    private function pastWorkshopTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_study ORDER BY num"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $created_at = $row->create_dt ?? null;

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
//            $meta_data = json_decode($row->meta_data, true);
//
//            if (!empty($meta_data['event_content']) ) {
//                $event_content = $meta_data['event_content'];
//            }

            $custom_old_notice[] = [
                'code' => $row->num ?? null,
                'title' => $row->times ? '제'.$row->times.'차 교육강좌' : null,
                'date_type' => 'D',
                'event_sdate' => $row->dt ?? null,

                'created_at' => $created_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT past_workshop (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
                $board = new Education();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT past_workshop (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT past_workshop FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function workshopTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_conference where event_type = 'EDU' ORDER BY seq_id"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $created_at = $row->create_dt ?? null;

            // meta_data 필드에 JSON 문자열이 있다고 가정합니다.
            $meta_data = json_decode($row->meta_data, true);

            if (!empty($meta_data['event_content']) ) {
                $event_content = $meta_data['event_content'];
            }
            if (!empty($meta_data['program_table']) ) {
                $program_table = $meta_data['program_table'];
            }
            if (!empty($meta_data['pre_reg_content']) ) {
                $pre_reg_content = $meta_data['pre_reg_content'];
            }

            $custom_old_notice[] = [
                'code' => $row->seq_id ?? null,
                'title' => $row->event_name ?? null,
                'date_type' => ($row->event_period_from == $row->event_period_to) ? 'D' : 'L',
                'event_sdate' => $row->event_period_from ?? null,
                'created_at' => $created_at ?? null,
                'regist_use' => 'Y',

                'event_edate' => $row->event_period_to ?? null,
                'hide' => 'N',
                'place' => $row->event_place ?? null,
                'total_info' => $event_content ?? null,
                'fee_info' => $program_table ?? null,
                'pay_info' => $pre_reg_content ?? null,
//                'notice_info' => $row->event_place ?? null,
//                'inquire_info' => $row->event_place ?? null,

                'regist_sdate' => $row->pre_reg_from ?? null,
                'regist_edate' => $row->pre_reg_to ?? null,

            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT past_workshop (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
                $board = new Education();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT past_workshop (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT past_workshop FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function workshopRegistrationTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_conference_register where show_hide = 'show' AND conference_id = '525' ORDER BY cr_id"));
        $custom_old_notice = [];

        foreach ($old_notice as $row) {
            $created_at = $row->create_dt ?? null;
            $updated_at = $row->update_dt ?? null;

            switch ($row->user_type){
                case '11':
                    $gubun = '1';
                    break;
                case '22':
                    $gubun = '2';
                    break;
                case '33':
                    $gubun = '3';
                    break;
                case '44':
                    $gubun = '4';
                    break;
                case '99':
                    $gubun = '5';
                    break;
                default:
                    $gubun = '5';
                    break;
            }



            $custom_old_notice[] = [
                'wsid' => '123',
                'member_gubun' => $row->user_class == '99' ? 'N' : 'Y',
                'license_number' => $row->license_no ?? null,
                'name_kr' => $row->name_ko ?? null,
                'gubun' => $gubun ?? null,

                'email' => $row->user_email ?? null,
                'region' => $row->region ?? null,
                'sigu' => $row->local_med_org2 ?? null,
                'office_name' => $row->org_name ?? null,
                'phone' => $row->user_mobile ?? null,
                'department' => $row->org_dept ?? null,

                'zipcode' => $row->org_zipcode ?? null,
                'addr' => $row->org_address1 ?? null,
                'addr_etc' => $row->org_address2 ?? null,
                'office_tel' => $row->org_tel2 ?? null,
                'office_tel_first' => $row->org_tel1 ?? null,



                'amount' => $row->total_amount ?? null,
                'pay_method' => ($row->pay_method == 'CARD_LC') ? 'C' : 'B',
                'pay_status' => ($row->pay_state == '9000') ? 'Y' : 'N',


                'user_memo' => $row->user_memo ?? null,
                'memo' => $row->admin_memo ?? null,
                'created_at' => $created_at ?? null,
                'updated_at' => $updated_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT past_workshop (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
                $board = new Registration();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT past_workshop (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT past_workshop FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
private function pastLectureTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_study_detail ORDER BY num"));
        $custom_old_notice = [];

        foreach ($old_notice as $row) {
            $created_at = $row->reg_dt ?? null;

            $custom_old_notice[] = [
                'wsid' => $row->uid ?? null,
                'title' => $row->title ?? null,
                'office' => $row->office ?? null,
                'name' => $row->name ?? null,


                'created_at' => $created_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT past_workshop (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
                $board = new Lecture();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT past_workshop (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT past_workshop FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function hospitalTransfer()
    {
        $this->oldDBConnection();
        $old_notice = DB::select(DB::raw("select * from if_hospital ORDER BY num"));
        $custom_old_notice = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_notice as $row) {
            $created_at = $row->reg_dt ?? null;

            switch ($row->position){
                case '내과':
                    $major='A';
                    break;
                case '소아청소년과':
                    $major='B';
                    break;
                case '피부과':
                    $major='C';
                    break;
                case '이비인후과':
                    $major='D';
                    break;
                default:
                    $major='A';
                    break;
            }

            switch ($row->sido) {
                case '서울특별시':
                    $si = '1';
                    break;
                case '부산광역시':
                    $si = '2';
                    break;
                case '대구광역시':
                    $si = '3';
                    break;
                case '인천광역시':
                    $si = '4';
                    break;
                case '광주광역시':
                    $si = '5';
                    break;
                case '대전광역시':
                    $si = '6';
                    break;
                case '울산광역시':
                    $si = '7';
                    break;
                case '세종특별자치시':
                    $si = '17';
                    break;
                case '경기도':
                    $si = '9';
                    break;
                case '강원도':
                    $si = '8';
                    break;
                case '충청북도':
                    $si = '16';
                    break;
                case '충청남도':
                    $si = '15';
                    break;
                case '전라북도':
                    $si = '13';
                    break;
                case '전라남도':
                    $si = '12';
                    break;
                case '경상북도':
                    $si = '11';
                    break;
                case '경상남도':
                    $si = '10';
                    break;
                case '제주특별자치도':
                    $si = '14';
                    break;
                default:
                    $si = '1';
                    break;
            }

            $custom_old_notice[] = [
                'major' => $major ?? null,
                'name_kr' => $row->hosp_name ?? null,
                'chief_name' => $row->chief_name ?? null,
                'chief_email' => $row->chief_mail ?? null,
                'address' => $row->addr ?? null,
                'tel' => $row->tel ?? null,

                'si' => $si ?? null,
                'jext_yn' => $row->jext ?? 'N',

                'created_at' => $created_at ?? null,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totNotice = number_format(count($custom_old_notice));
            var_dump("INSERT past_workshop (공지사항) START: {{$totNotice}} 개 데이터 <br><br>");

            foreach ($custom_old_notice as $key => $row) {
                $board = new Hospital();
                $board->setByTransfer($row);

                // 추가 or 변경 데이터
                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT past_workshop (공지사항) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT past_workshop FINISH (공지사항)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function affiTransfer()
    {
        $this->oldDBConnection();
        $old_schedule = DB::select(DB::raw("SELECT * FROM workshop_abstract "));
        $custom_old_schedule = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_schedule as $row) {

            $affi_arr = [];
            $affi_arr = explode('||',$row->AFFILIATION_KOR);
            $affi_en_arr = explode('||',$row->AFFILIATION_ENG);

            $signdate = $row->WORK_DATE ?? null;
            $cdate = DateTime::createFromFormat('y/m/d', $signdate);
            $created_at = $cdate ? $cdate->format('Y-m-d H:i:s') : null;

            foreach ($affi_arr as $key => $aff){
                $custom_old_schedule[] = [
                    'prereg_idx' => $row->PREREG_IDX,
                    'affi_kr' => $affi_arr[$key],
                    'affi_en' => $affi_en_arr[$key],

                    'created_at' => $created_at,
                ];
            }
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totSchedule = number_format(count($custom_old_schedule));
            var_dump("INSERT affi (mems) START: {{$totSchedule}} 개 데이터 <br><br>");

            foreach ($custom_old_schedule as $key => $row) {

                $abs = Abs::withTrashed()->where('prereg_idx', $row['prereg_idx'])->first();
                $row['abs_sid'] = $abs->sid ?? 0;

                $board = new Affiliations();
                $board->setByData($row);

                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT abs (학술대회 일정) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT abs FINISH (학술대회 일정)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }

    private function authorTransfer()
    {
        $this->oldDBConnection();
        $old_schedule = DB::select(DB::raw("SELECT * FROM workshop_abstract "));
        $custom_old_schedule = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_schedule as $row) {

            $aut_arr = [];
            $aut_arr = explode('||',$row->AUTHOR_KOR);
            $aut_en_arr = explode('||',$row->AUTHOR_ENG);
            $aut_affi_arr = explode('||',$row->AUTHOR_AFFILIATION);
            $aut_check_arr = explode('||',$row->COAUTHOR_CHECK);

            $signdate = $row->WORK_DATE ?? null;
            $cdate = DateTime::createFromFormat('y/m/d', $signdate);
            $created_at = $cdate ? $cdate->format('Y-m-d H:i:s') : null;

            foreach ($aut_arr as $key => $aut){

                $kor_name = $aut_arr[$key];
                $kor_arr = explode(',',$kor_name);
                $name_kr = $kor_arr[1].$kor_arr[0];

                $eng_name = $aut_en_arr[$key];
                $eng_arr = explode(',',$eng_name);
                $first_name = $eng_arr[0];
                $last_name = $eng_arr[1];


                $custom_old_schedule[] = [
                    'prereg_idx' => $row->PREREG_IDX,
                    'c_author_yn' => $aut_check_arr[$key] == 'T' ? 'Y':'N',
                    'name_kr' => $name_kr,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'affiliation' => $aut_affi_arr[$key],

                    'created_at' => $created_at,
                ];
            }
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totSchedule = number_format(count($custom_old_schedule));
            var_dump("INSERT affi (mems) START: {{$totSchedule}} 개 데이터 <br><br>");

            foreach ($custom_old_schedule as $key => $row) {

                $abs = Abs::withTrashed()->where('prereg_idx', $row['prereg_idx'])->first();
                $row['abs_sid'] = $abs->sid ?? 0;

                $board = new Authors();
                $board->setByData($row);

                $board->created_at = $row['created_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT abs (학술대회 일정) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT abs FINISH (학술대회 일정)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
    private function supportTransfer()
    {
        $this->oldDBConnection();
        $old_schedule = DB::select(DB::raw("SELECT * FROM workshop_donation "));
        $custom_old_schedule = [];

        // 팝업 사용 게시판 없어서 팝업은 안옮김
        foreach ($old_schedule as $row) {

            $signdate = $row->WORK_DATE ?? null;
            $cdate = DateTime::createFromFormat('y/m/d', $signdate);
            $created_at = $cdate ? $cdate->format('Y-m-d H:i:s') : null;

            switch ($row->GRADE){
                case 'DIAMOND':
                    $grade='D';
                    break;
                case 'GOLD':
                    $grade='G';
                    break;
                case 'SILVER':
                    $grade='S';
                    break;
                case 'BRONZE':
                    $grade='B';
                    break;
                default:
                    $grade='B';
                    break;
            }

            if($row->STATUS == '3'){
                $spayment_status = 'Y';
            }else{
                $spayment_status = 'N';
            }

            $custom_old_schedule[] = [
                'work_code' => $row->WORKSHOP_IDX,
                'grade' => $grade,
                'spayment_status' => $spayment_status,

                'price' => $row->AMT ?? 0,
                'company' => $row->COMP_NAME,
                'ceo' => $row->COMP_CEO,
                'company_zipcode' => $row->COMP_ZIPCODE,
                'company_address' => $row->COMP_ADDR1,
                'company_address2' => $row->COMP_ADDR2,

                'manager' => $row->STAFF_NAME,
                'position' => $row->STAFF_POSITION,
                'department' => $row->PAY_AMT ?? 0,
                'tel' => $row->TEL,
                'phone' => $row->MOBILE,
                'fax' => $row->FAX,

                'email' => $row->EMAIL,
                'manager_zipcode' => $row->ZIPCODE,
                'manager_address' => $row->ADDR1,
                'manager_address2' => $row->ADDR2,

                'created_at' => $created_at,
//                'updated_at' => $updated_at,
            ];
        }

        $this->activationDBConnection();
        $this->transaction();

        try {
            $totSchedule = number_format(count($custom_old_schedule));
            var_dump("INSERT workshop (mems) START: {{$totSchedule}} 개 데이터 <br><br>");

            foreach ($custom_old_schedule as $key => $row) {

                $board = new Support();
                $board->setByData($row);

                $board->created_at = $row['created_at'];
//                $board->updated_at = $row['updated_at'];
                $board->save();

                $cnt = ($key + 1);
                var_dump("INSERT boards (학술대회 일정) {$cnt} 번째 <br>");
            }

            DB::commit();
            var_dump("<br><br> INSERT boards FINISH (학술대회 일정)");
        } catch (\Exception $e) {
            $this->dbRollback($e);
        }
    }
    private function oldDBConnection()
    {
        config()->set('database.connections.mysql.host', env('DB_HOST'));
        config()->set('database.connections.mysql.password', env('DB_PASSWORD'));
        config()->set('database.connections.mysql.database', "test"); // 이 줄을 추가

        // 현재 연결된 MySQL 연결을 해제(purge)
        \Illuminate\Support\Facades\DB::purge('mysql');

        // 변경된 설정으로 다시 연결(reconnect)
        \Illuminate\Support\Facades\DB::reconnect('mysql');
    }

    private function activationDBConnection()
    {
        config()->set('database.connections.mysql.host', env('DB_HOST'));
        config()->set('database.connections.mysql.password', env('DB_PASSWORD'));
        config()->set('database.connections.mysql.database', "allergy");

        // 현재 연결된 MySQL 연결을 해제(purge)
        \Illuminate\Support\Facades\DB::purge('mysql');

        // 변경된 설정으로 다시 연결(reconnect)
        \Illuminate\Support\Facades\DB::reconnect('mysql');
    }
}