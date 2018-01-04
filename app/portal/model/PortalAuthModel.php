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
namespace app\portal\model;

use think\Model;

class PortalAuthModel extends Model
{
    public function checkAuth($user_id, $auth){
        $roleSql = "select role_id from cmf_role_user where user_id = $user_id";
        $roleId  = $this->query($roleSql);
        if(empty($roleId)){
            return false;
        }
        $roleId  = $roleId[0]['role_id'];
        if($roleId == 1){
            return true;
        }
        $sql = "select count(1) as num from cmf_auth_access where rule_name = '$auth' and  role_id = $roleId";
        $rs  = $this->query($sql);
        return $rs[0]['num']>0 ? true : false;
    }


}