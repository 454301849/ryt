<?php
namespace Admin\Controller;

use Think\Controller;
class UserController extends ActionController
{
    protected $users_model,$role_model;

    public function _initialize() {
        $this->users_model = M('admin');
        $this->role_model = D("Common/Role");
    }

    //登录前执行的方法
    public function index()
	{
		if ($_POST) {
			$arr = array();
			$username = $_POST['username'];
			$password = $_POST['password'];

			$info = M('admin')->where(" username = '{$username}' ")->select();
			if ($info[0]['password'] == md5($password)) {
				session(null);
				session('admin_id', $info[0]['id']);
				session('admin',$info[0]['username']);
				$admin_id = $info[0]['id'];
//                $result['ip']=get_client_ip(0,true);
                $result['ip']=$_SERVER['REMOTE_ADDR'];
                $result['last_time']=date("Y-m-d H:i:s");

				$info = M('admin')->where(" id = '{$admin_id}' ")->save($result);
				$arr['success'] = 1;
			} else {
				$arr['success'] = 0;
			}
			echo json_encode($arr);
		} else {
			$this->display();
		}
	}

    /*
     * 会员退出
     */
    public function  api_cancel(){
        session(null);
        redirect(U('Admin/User/index'));
    }



    /*
     * 会员注册
     */
    public function register(){
        $ruser_name = $_GET['user_name']?$_GET['user_name']:'M000001';
        $area = $_GET['area'];
        session('register_area_default', $area); //创建默认 会员市场

        $users = M('users');
        $code = $users->field("max(user_name) as newno")->find();
        
        
        
        //M后6位数改为8位
        $Newcode = 'M'.str_pad(substr($code['newno'],1,8)+1,8,"0",STR_PAD_LEFT);


        $info= $users->where(" user_name = '$ruser_name'")->find();
        $recmid= $info['pid'];
        $centerid= $info['daili'];
        if($recmid){
            $recm_name = $info['user_name'];
            $parent_name = $info['user_name'];
        }else{
            $recm_name = 'M000001';
            $parent_name = 'M000001';
        }
        if($centerid){
            $center_name = $ruser_name;
        }else{
            $center_name = 'M000001';
        }
        $this->assign('user_code',$Newcode);
        $this->assign('recmid',$recm_name);
        $this->assign('centerid',$center_name);
        $this->assign('parentid',$parent_name);

	    $this->display();
    }


    /*
     * 我的会员网络图
     */
    public function memberlists(){

        $duser_name = $_GET['user_name']?$_GET['user_name']:'M000001'; // 查询顶级用户的user_name 或 需要查询的user_name
        $info = $this->getinfo($duser_name);

        $ainfo = $this->getreginfo($info['chl']);
        $alinfo = $this->getreginfo($ainfo['chl']);
        $arinfo = $this->getreginfo($ainfo['chr']);
        $binfo = $this->getreginfo($info['chr']);
        $blinfo = $this->getreginfo($binfo['chl']);
        $brinfo = $this->getreginfo($binfo['chr']);

        $this->assign("info", $info);
        $this->assign("ainfo", $ainfo);
        $this->assign("binfo", $binfo);
        $this->assign("alinfo", $alinfo);
        $this->assign("arinfo", $arinfo);
        $this->assign("blinfo", $blinfo);
        $this->assign("brinfo", $brinfo);
        $this->display();
    }

    /*
     * 我的推荐
     */
    public function recmlists(){

      //  $weixin = A("User/Prize");
//         //----------- 量奖
      //  $add_data = $weixin -> liangjiang(5);
//            //        exit;
//
//        //------------ 层奖
//// $this->ldjxn($info['user_id'],$info['user_name'],$info['ppath'],$info['plevel']);
 //$add_data = $weixin -> ldjxn(12,'M000012','1,3,7,',3);  /// 002
//     //   dump($_SESSION);
//
//   // $add_data = $weixin -> cengjiang(6); /// 003
//    /// $add_data = $weixin -> cengjiang(362);  //004
// //  $add_data = $weixin -> cengjiang(363);  //005
////   $add_data = $weixin -> cengjiang(365);  //007
//   // $add_data = $weixin -> cengjiang(3);  //006
//////        $add_data = $weixin -> cengjiang(375);  //017
//////        $add_data = $weixin -> cengjiang(376);  //018
//////        $add_data = $weixin -> huzhu();
//
    	


        $users = M('users');
        $user_id= $_SESSION['admin_id'];

        $pagecount = 10;
        $count = $users->where(" pid = '$user_id'")->count();
        $Page = new \Think\Page($count, $pagecount);

        $info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')
            ->where("wx_users.pid = '$user_id'")
            ->order("wx_users.user_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->pc_show();

        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display();
    }

    /*
     *我的推荐 详情
     */
    public  function recmlist_detail(){
        $user_name = $_GET['user_name'];
        $info = M('users')->where(" user_name = '{$user_name}' ")->find();
        $info['area_name'] = $info['area']> 1?($info['area']> 2?'C区':'B区'):'A区';
        $level =M('memberlevel')->where(" id = '{$info['level']}' ")->find();
        $info['level'] = $level['name'];
        $this->assign('info',$info);
        $this->display();
    }

    /*
    * 会员列表
    */
    public function sortlists(){

        $users = M('users');

        $pagecount = 10;
        $count = $users->count();
        $Page = new \Think\Page($count, $pagecount);
        $info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->pc_show();
        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display();
    }
    
    public function sortlists_ajax(){
    
    
    
    	$users = M('users');
    	$where = array();
    
    	if ($_GET['user_name'] != null) {
    
    		$user_name = $_GET['user_name'];
    
    		$where['user_name'] = array('like',"%$user_name%");
    
    	}
    
    	if ($_GET['truename'] != null) {
    
    		$truename = $_GET['truename'];
    
    		$where['truename'] = array('like',"%$truename%");
    
    	}
    
    	 
    
    	if ($_GET['start'] > 0) {
    
    		$where[]['reg_time'] = array('egt', $_GET['start']);
    
    		$where[]['reg_time'] = array('elt', $_GET['end']);
    
    	}
    
    
    
    	$pagecount = 10;
    
    	$count = $users->where($where)->count();
    
    	$Page = new \Think\Pageajax($count, $pagecount);
    
    
    
    	$info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')->where($where)
    
    	->limit($Page->firstRow . ',' . $Page->listRows)->select();
    
    	// 实例化分页类 传入总记录数和每页显示的记录数(25)
    
    	$show = $Page->pc_show();
    
    
    
    	$this->assign('info',$info);
    
    	$this->assign('count', $count);
    
    	$this->assign('page', $show);
    
    	$this->display();
    
    }


    /*
     *会员列表 详情
     */
    public  function sortlist_detail(){
        $user_name = $_GET['user_name'];
        $info = M('users')->where(" user_name = '{$user_name}' ")->find();
        $user_id= $_SESSION['admin_id'];
        if($user_id == 1){
            $info['area_name'] = '顶级';
        }else{
            $info['area_name'] = $info['area']> 1?($info['area']> 2?'C区':'B区'):'A区';
        }
        $level =M('memberlevel')->select();
        $this->assign('info',$info);
        $this->assign('levelinfo',$level);
        $this->display();
    }

    /*
     *会员升级
     */
    public  function api_sortlist_upgrade(){
        $weixin = A("User/Prize");
        $users = M('users');
        $upgrade = M('upgrade');
        $user_id = $_POST['user_id'];
        $level = $_POST['level'];
        $newlevel = $_POST['newlevel'];

        $userinfo = $this->getparentinfo($user_id);

        $data['upgradetime'] = time();
        $data['user_name'] = $userinfo['user_name'];
        $data['user_id'] = $user_id;
        $data['truename'] = $userinfo['truename'];
        $data['level'] = $level;
        $data['newlevel'] = $newlevel;

        // new 会员信息
        $userdata['level'] = $newlevel;
        $newuserlevel= $this->getlevel($newlevel);

        $userdata['lsk'] = $newuserlevel['money'];
        $userdata['huiben'] = 0; // 重置 回本

        // 原会员等级
        $userlevel= $this->getlevel($level);

        $upgrade->add($data);

        if ($userinfo['reregister'] ==1 ){
            $addArea = $newuserlevel['money']-$userlevel['money'];

            $weixin -> addArea($user_id,$addArea);
        }


        $res = $users->where(" user_id = '{$user_id}' ")->save($userdata);
        if($res){
            $msg['Error'] = '0';
            $msg['Data'] ='升级成功!';
            echo json_encode($msg);
            exit;
        }else{
            $msg['Error'] = '-10000';
            $msg['Data'] ='升级失败';
            echo json_encode($msg);
            exit;
        }
    }
    
    public function api_update_submit(){
    	
    	$users = M('users');
    	$id= $_POST['id'];
    	$single = $_POST['single'];
    	$add_data = array();
    	$user = $users->where(" user_id = '$id'")->find();
    	// repath 推荐人
    	$recmid = $_POST['recmid'];
    	$rrow = $users->where(" user_name = '$recmid'")->find();
    	if(!$rrow){
    		$msg['Error'] = '-104';
    		$msg['Data'] = '推荐人编号不存在';
    		echo json_encode($msg);
    		exit;
    	}
    	$add_data['pid'] = $rrow['user_id'];
    	$add_data['rusername'] = $rrow['user_name'];
    	$add_data['repath']=$rrow['repath'].$rrow['user_id'].",";
    	$add_data['rlevel']=$rrow['rlevel']+1;
    	
    	
    	// ppath 安置人
    	$parentid = $_POST['parentid'];
    	$prow = $users->where(" user_name = '$parentid'")->find();
    	if(!$prow){
    		$msg['Error'] = '-105';
    		$msg['Data'] = '安置人编号不存在';
    		echo json_encode($msg);
    		exit;
    	}
    	$area = $_POST['area'];
    	if($area == '1'){
    		if($prow['chl'] && ($user['pusername'] != $parentid) && ($user['rusername'] != $recmid)){
    			$msg['Error'] = '-1061';
    			$msg['Data'] = '安置位置A区已存在';
    			echo json_encode($msg);
    			exit;
    		}
    	}else if($area == '2'){
    		if($prow['chr'] && ($user['pusername'] != $parentid) && ($user['rusername'] != $recmid)){
    			$msg['Error'] = '-1062';
    			$msg['Data'] = '安置位置B区已存在';
    			echo json_encode($msg);
    			exit;
    		}
    	}
    	$add_data['area'] = $area;
    	$add_data['grant'] = $single;
    	$add_data['parentid'] = $prow['user_id'];
    	$add_data['pusername'] = $prow['user_name'];
    	$add_data['ppath']=$prow['ppath'].$prow['user_id'].",";
    	$add_data['plevel']=$prow['plevel']+1;
    	$res = $users->where(" user_id = '$id'") -> save($add_data);
    	if(!$res){
    		$msg['Success'] =false;
    		$msg['Error'] = '-10002';
    		$msg['Data'] = "修改失败";
    		echo json_encode($msg);
    		exit;
    	}else{
    		$msg['Error'] = '0';
    		$msg['Data'] = '修改成功';
    		echo json_encode($msg);
    		exit;
    	}
    	exit;
    }

    public function api_update_grant_submit(){

        $users = M('users');
        $id= $_POST['id'];
        $single = $_POST['single'];

        $add_data['grant'] = $single;

        $res = $users->where(" user_id = '$id'") -> save($add_data);
        if(!$res){
            $msg['Success'] =false;
            $msg['Error'] = '-10002';
            $msg['Data'] = "修改失败";
            echo json_encode($msg);
            exit;
        }else{
            $msg['Error'] = '0';
            $msg['Data'] = '修改成功';
            echo json_encode($msg);
            exit;
        }
        exit;
    }
    /*
     *会员列表 详情
     */
    public  function sortlist_upgrade_detail(){
        $user_name = $_GET['user_name'];
        $info = $this->getupgradeinfo($user_name);
        $this->assign('info',$info);
        $this->assign('user_name',$user_name);
        $this->display();
    }


    /*
     * 会员网络
     */

    public function netchart(){

        $duser_name = $_GET['rootid']?$_GET['rootid']:'M000001'; // 查询顶级用户的user_name 或 需要查询的user_name
        $info_user = $this->getinfo($duser_name);

        if($info_user['name'] == NULL){
            $duser_name = 'M000001';
            $info_user = $this->getinfo($duser_name);
        }
        $info_lname = $this->getparentinfo($info_user['chl']); // A区
        $info_llame = $this->getparentinfo($info_lname['chl']); // A区A区
        $info_lrame = $this->getparentinfo($info_lname['chr']); // A区B区

        $info_rname = $this->getparentinfo($info_user['chr']); // B区
        $info_rlname = $this->getparentinfo($info_rname['chl']);// B区A区
        $info_rrname = $this->getparentinfo($info_rname['chr']);// B区B区


        $this->assign('user_name',$duser_name);
        $this->assign('info_user',$info_user);
        $this->assign('info_luser',$info_lname);
        $this->assign('info_lluser',$info_llame);
        $this->assign('info_lruser',$info_lrame);
        $this->assign('info_ruser',$info_rname);
        $this->assign('info_rluser',$info_rlname);
        $this->assign('info_rruser',$info_rrname);
        $this->display();
    }

    /*
     * 提交申请
     */
    function apply(){
        $this->display();
    }


    /*
     * 提交申请
     */
    function applylists(){
        $this->display();
    }
    
    /*
     * 提交申请
    */
    function reset_password(){
    	
    	 $users = M('users');
    	 $user_id = $_POST['user_id'];
    	 $edit_data = array();
    	 $edit_data['password'] = md5(123456);
    	 $edit_data['second_password'] = md5(123456);
    	 $res = $users->where("user_id = '$user_id' ")->save($edit_data);
    	 if(!$res){
    	 	$msg['Success'] =false;
    	 	$msg['Error'] = '-10002';
    	 	$msg['Data'] = "重置密码失败";
    	 	echo json_encode($msg);
    	 	exit;
    	 }else{
    	 	$msg['Error'] = '0';
    	 	$msg['Data'] = '重置密码成功';
    	 	echo json_encode($msg);
    	 	exit;
    	 }
    	 exit;
    }    
    
    function recharge(){
    
    	$this->display();
    }
    
    function api_recharge_submit(){
    	
    	$users = M('users');
    	$user_name = $_SESSION['admin'];
    	$edit_data = array();
    	$user_info= $users->where(" nickname = '$user_name'")->find();
    	$edit_data['jjb'] = $_POST['money']+ $user_info['jjb'];
    	$res = $users->where(" nickname = '$user_name'")->save($edit_data);
    	if(!$res){
    		$msg['Success'] =false;
    		$msg['Error'] = '-10000';
    		$msg['Data'] = "充值失败";
    		echo json_encode($msg);
    		exit;
    	}else{

            $Prize = A("User/Prize");
            $res = $Prize->yejitongji(0,0,0,0,0,$_POST['money'],0);


            $msg['Error'] = '0';
    		$msg['Data'] = '充值成功';
    		echo json_encode($msg);
    		exit;
    	}
    	exit;
    }

    /*
     * $user_id
     * 查询推荐人详细信息
     * return $info
     */

    protected function getreginfo($user_id)
    {
        $info =  M('users')->where(" user_id = '{$user_id}' ")->find();
        $levelinfo = $this->getlevel($info['level']);
        $info['name'] = $levelinfo['name'];
        $info['levelid'] = $levelinfo['id'];
        return $info;
    }


    /*
     * $user_id
     * 查询安置人详细信息
     * return $info
     */

    protected function getparentinfo($user_id)
    {
       $info =  M('users')->where(" user_id = '{$user_id}' ")->find();
       $levelinfo = $this->getlevel($info['level']);
       $info['name'] = $levelinfo['name'];
       $info['levelid'] = $levelinfo['id'];
       return $info;
    }

    /*
     * $user_name
     * 查询会员详细信息
     * return $info
     */

    protected function getinfo($user_name)
    {
        $info =  M('users')->where(" user_name = '{$user_name}' ")->find();
        $levelinfo = $this->getlevel($info['level']);
        $info['name'] = $levelinfo['name'];
        $info['levelid'] = $levelinfo['id'];
        return $info;
    }

    /*
     * $user_name
     * 查询会员详细信息
     * return $info
     */

    protected function getcenterinfo($center)
    {
        $info =  M('users')->where(" daili != '{$center}' ")->select();
        $infos = array();
        foreach($info as $i=>$in){
            $infos[$i] = $in;
            $levelinfo = $this->getlevel($in['level']);
            $infos[$i]['name'] = $levelinfo['name'];
            $infos[$i]['levelid'] = $levelinfo['id'];
            $infos[$i]['type'] =  $in['daili']> 1?($in['daili']> 2?'审核失败':'审核通过'):'待审核';
        }
        return $infos;
    }

    /*
     * $user_name
     * 查询会员升级详细信息
     * return $info
     */

    protected function getupgradeinfo($user_name)
    {
        $upgrade = M('upgrade');
        $info =  $upgrade->where(" user_name = '{$user_name}' ")->order("id desc")->select();
        $infos = array();
        foreach($info as $i=>$in){
            $infos[$i] = $in;
            $levelinfo = $this->getlevel($in['level']);
            $levelnewinfo = $this->getlevel($in['newlevel']);
            $infos[$i]['name'] = $levelinfo['name'];
            $infos[$i]['newname'] = $levelnewinfo['name'];
        }
        return $infos;
    }

    /*
     * $level
     * 查询会员级别
     * return $levelinfo['name']
     */
    protected  function getlevel($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo;
    }

    //  管理设置

    public function manage()
    {

        $users = M('admin')->select();
        $this->assign("users",$users);
        $this->display();
    }

    // 管理员添加
    public function add(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $this->display();
    }

    // 管理员添加提交
    public function add_post(){
        if(IS_POST){

            $data['username'] = urldecode($_POST['username']);
            $data['password'] = md5(urldecode($_POST['password']));
			$data['register_time'] = date("Y-m-d H:i:s");
            $data['email'] = urldecode($_POST['email']);
            $role_id = $_POST['role_id'];
            $role_ids = explode(",", $role_id);

            $result=$this->users_model->add($data);
            if ($result!==false) {
                $role_user_model=M("RoleUser");
                $role_user_model->where(array("user_id"=>$result))->delete();

                foreach ($role_ids as $role_id){
                    if(session('admin_id') != 1 && $role_id == 1){
                        $msg['Success'] =false;
                        $msg['Error'] = '-10000';
                        $msg['Data'] = "为了网站的安全，非网站创建者不可创建超级管理员！";
                        echo json_encode($msg);
                        exit;
                    }
                    $role_user_model->add(array("role_id"=>$role_id,"user_id"=>$result));
                }
                $msg['Success'] =false;
                $msg['Error'] = 0;
                $msg['Data'] = "保存成功";
                echo json_encode($msg);
                exit;
            } else {
                $msg['Success'] =false;
                $msg['Error'] = '-10000';
                $msg['Data'] = "保存失败";
                echo json_encode($msg);
                exit;
            }

        }
    }

    // 管理员编辑
    public function edit(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign("user",$user);
        $this->display();
    }

    // 管理员编辑提交
    public function edit_post(){
        if (IS_POST) {

            $data['username'] = urldecode($_POST['username']);
            if(urldecode($_POST['password'])){
                $data['password'] = md5(urldecode($_POST['password']));
            }
            $id = $_POST['id'];
            $data['email'] = urldecode($_POST['email']);
            $role_id = $_POST['role_id'];
            $role_ids = explode(",", $role_id);

            $result=$this->users_model->where('id = '.$id)->save($data);
            if ($result!==false) {
                $role_user_model=M("RoleUser");
                $role_user_model->where(array("user_id"=>$id))->delete();

                foreach ($role_ids as $role_id){
                    if(session('admin_id') != 1 && $role_id == 1){
                        $msg['Success'] =false;
                        $msg['Error'] = '-10000';
                        $msg['Data'] = "为了网站的安全，非网站创建者不可创建超级管理员！";
                        echo json_encode($msg);
                        exit;
                    }
                    $role_user_model->add(array("role_id"=>$role_id,"user_id"=>$id));
                }
                $msg['Success'] =false;
                $msg['Error'] = 0;
                $msg['Data'] = "保存成功";
                echo json_encode($msg);
                exit;
            } else {
                $msg['Success'] =false;
                $msg['Error'] = '-10000';
                $msg['Data'] = "保存失败";
                echo json_encode($msg);
                exit;
            }



        }
    }

    // 管理员删除
    public function delete(){
        $id = I('get.id',0,'intval');
        if($id==1){
            $this->error("最高管理员不能删除！");
        }

        if ($this->users_model->delete($id)!==false) {
            M("RoleUser")->where(array("user_id"=>$id))->delete();
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}