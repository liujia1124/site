<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\count\model;


use think\Model;

class VistorLogModel extends Model
{
    protected $table = "post_vistor_log";
    private $blackList = [
        '45.77.0.16',
        '66.249.79.85',
        '127.0.0.1',
        '66.249.66.30',
        '66.249.66.29',
        '66.249.79.87'
        ];
    public function showVistorsBypage($startTime, $endTime, $pageNum=1, $pageSize=100)
    {
        $argArr = [];
        if($startTime){
            $argArr['start_time'] = $startTime;
        }
        if($endTime){
            $argArr['end_time'] = $endTime;
        }

        $startTime = empty($startTime)?date("Y-m-d"):$startTime;
        $endTime   = empty($endTime)?date("Y-m-d",strtotime("+1 day")):$endTime;

        $start  = $pageNum*$pageSize-$pageSize;
        $length = $pageSize;

        $joinUser = [
            ['__USER__ u', 'log.user_id = u.id']
        ];
        $joinPost = [
            ['__PORTAL_POST__ p', 'log.post_id = p.id']
        ];

        $voList = $this->alias('log')->join($joinUser)->join($joinPost)->field('log.*, u.user_nickname as username, p.post_title as title')->where(['log.create_time'=>['between', [$startTime,$endTime] ] ])->limit($start, $length)->order('log.id desc')->paginate([ 'list_rows'=>100, 'query'=>$argArr ] );

        return $voList;
    }

    public function showRealVistorsBypage($startTime, $endTime, $pageNum=1, $pageSize=100)
    {
        $argArr = [];
        if($startTime){
            $argArr['start_time'] = $startTime;
        }
        if($endTime){
            $argArr['end_time'] = $endTime;
        }

        $startTime = empty($startTime)?date("Y-m-d"):$startTime;
        $endTime   = empty($endTime)?date("Y-m-d",strtotime("+1 day")):$endTime;

        $start  = $pageNum*$pageSize-$pageSize;
        $length = $pageSize;

        $joinUser = [
            ['__USER__ u', 'log.user_id = u.id']
        ];
        $joinPost = [
            ['__PORTAL_POST__ p', 'log.post_id = p.id']
        ];

        $voList = $this->alias('log')->join($joinUser)->join($joinPost)->field('log.*, u.user_nickname as username, p.post_title as title')->where(['log.create_time'=>['between', [$startTime,$endTime] ], 'real_ip'=>['not in',$this->blackList] ])->limit($start, $length)->order('log.id desc')->paginate([ 'list_rows'=>100, 'query'=>$argArr ] );

        return $voList;
    }


}