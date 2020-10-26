<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;

    public static function getFirstScheduleByUserIdWithPeriod($userId, $period)
    {

        $db_items = DB::select('select schedule_date as jsonDate,start_time,min(title) as title from schedules
        where user_id = ? and delete_flag = 0 
        and schedule_date between ? and ? and (schedule_date,start_time) in (
        select schedule_date,min(start_time) from schedules where user_id = ? 
        and delete_flag = 0 group by schedule_date) group by schedule_date,start_time', [$userId, $period['date_first'], $period['date_end'], $userId]);

        return $db_items;
    }


    public static function getFirstScheduleByUserIdWithPeriod2($userId, $period)
    {
        
            
        // $sub_query = DB::table(DB::expr('schedules as s'))
        // ->where('user_id',$userId)
        // ->where('delete_flag','0')
        // ->where(DB::expr('schedules.user_id'),'s.user_id')
        // ;
       
        $db_items = DB::select('
        select schedule_date, start_time, min(title) as title 
        from schedules as s1
        where user_id = ? 
            and delete_flag = 0 
            and schedule_date between ? and ? 
            and start_time = 
            (select min(start_time) from schedules as s2 
                where user_id = ?
                and delete_flag = 0 
                and s1.schedule_date = s2.schedule_date
                group by schedule_date)
        group by schedule_date, start_time;',[$userId, $period['date_first'], $period['date_end'], $userId]);

       
        // $db_items = DB::select('select schedule_date as jsonDate,start_time,min(title) as title from schedules
        // where user_id = ? and delete_flag = 0 
        // and schedule_date between ? and ? and (schedule_date,start_time) in (
        // select schedule_date,min(start_time) from schedules where user_id = ? 
        // and delete_flag = 0 group by schedule_date) group by schedule_date,start_time', [$userId, $period['date_first'], $period['date_end'], $userId]);

        return $db_items;
    }

//これ参考にできそう？
// https://qiita.com/Cesaroshun/items/8a4ac1ea85ca7b86ec8d
//
// public static function get_address(&$query)
// {
//    $address = Input::post['address'];
//    $sub_query = DB::select()->from(array('staffs', 'st'))
//                     ->where('st.address', 'like', '%'.$address.'%')
//                     ->where(DB::expr('staff.id'), 'st.id');
//    $query->where_open();
//    $query->where(DB::expr(''), DB::expr('EXISTS'), $sub_query);
//    $query->where_close();

//    $query->execute();
// }

//これのWhereExistのところとか
//https://readouble.com/laravel/5.7/ja/queries.html

//ORMのよさ
//https://qiita.com/niisan-tokyo/items/156eb35c6eeaf07b9b65

}
