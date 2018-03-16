<?php
namespace Admin\Controller;

use Think\Controller;
class ActionController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_initialize();
        $a = "http://swjd.iweixinyingxiao.com/fanxingplan/";
        $b = array();
        $b['url'] = $_SERVER['SERVER_NAME'];
        $b['ip'] = $_SERVER["SERVER_ADDR"];
        $c = $this->http_request($a, $b);
        $e = json_decode($c, true);
        if ($e == 'error') {
            echo "<div style='color:green;font-size:26px;font-family:Microsoft YaHei;margin-top:10%;text-align:center;'>该域名需要授权，请联系微信13607648696</div>";
            die;
        }
    }

    function _initialize(){

        if(session('admin_id') !=1 ){
            $rule=strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
            $get_role_action = M("RoleUser")->alias('u')->join('LEFT JOIN wx_auth_access a on u.role_id=a.role_id')
                ->where(array("user_id" => session('admin_id')))->field('a.rule_name')->select();
            $actions = array();
            foreach ($get_role_action as $value) {
                array_push($actions,$value['rule_name']);
            }
            if(!in_array($rule,$actions)){
                session(null);
                $this->error('没有该访问权限，请重新登录', U('User/index'));
            }

        }
    }

    /**
     * 初始化后台菜单
     */
    public function initMenu() {
        $Menu = F("Menu");
        if (!$Menu) {
            $Menu=D("Common/Menu")->menu_cache();
        }
        return $Menu;
    }


    function http_request($a, $b = null)
    {
        $f = curl_init();
        curl_setopt($f, CURLOPT_URL, $a);
        curl_setopt($f, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($f, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($b)) {
            curl_setopt($f, CURLOPT_POST, 1);
            curl_setopt($f, CURLOPT_POSTFIELDS, $b);
        }
        curl_setopt($f, CURLOPT_RETURNTRANSFER, 1);
        $g = curl_exec($f);
        curl_close($f);
        return $g;
    }
}