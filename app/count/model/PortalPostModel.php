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

class PortalPostModel extends Model
{

    public function countArticle($startTime,$endTime)
    {
        $sql = "select u.`user_nickname` as user_name, rs.`name` as name, rs.num as num from( ";
        $sql .= "select user_id,path, name,count(*) as num from ( ";
        $sql .= "select a.user_id as user_id ,path, c.`name` as name from cmf_portal_post as a ";
        $sql .= "LEFT JOIN cmf_portal_category_post   as m on a.id = m.post_id  ";
        $sql .= "LEFT JOIN cmf_portal_category        as c on m.category_id = c.id where a.create_time>=$startTime and a.create_time<$endTime) ";
        $sql .= "as child group by user_id, path ) as rs left join cmf_user as u on u.id = rs.user_id order by user_name,name";
        $voList = $this->query($sql);
        return $voList;
    }




}