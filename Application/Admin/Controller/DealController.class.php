<?php
namespace Admin\Controller;

use Think\Controller;
class DealController extends ActionController
{
	function __construct()
	{
		parent::__construct();
		//echo session('admin_id');
		if (!session('admin_id')) {
			$this->error('登录已超时，请重新登录', U('User/index'));
		}
	}
	
	/*
	 * 资金明细
	 */
	function main(){

		$broke_record = M('broke_record');
        $user_name = $_GET['user_name'];
		$pagecount = 10;
		$count = $broke_record->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = $broke_record->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		 // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->pc_show();
        $this->assign('info',$info);
        $this->assign('user_name', $user_name);
        $this->assign('page', $show);
		$this->display();
	}


    function main_ajax()
    {

        $broke_record = M('broke_record');
        $where = array();
        if ($_GET['user_name'] != null) {
            $where['user_name'] = $_GET['user_name'];
        }
        if ($_GET['type'] != null) {
            $where['type'] =$_GET['type'];
        }
        if ($_GET['truename'] != null) {
            $where ['truename'] = $_GET['truename'];
        }

        if ($_GET['start'] > 0) {
            $where[]['UNIX_TIMESTAMP(bdate)'] = array('egt', $_GET['start']);
            $where[]['UNIX_TIMESTAMP(bdate)'] = array('elt', $_GET['end']);
        }

        $pagecount = 13;
        $count = $broke_record->where($where)->count();
        $Page = new \Think\Pageajax($count, $pagecount);
        $info = $broke_record->where($where)->order("bdate desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->pc_show();

        $this->assign('page', $show);
        $this->assign('info',$info);
        $this->display();
    }

	/*
	 * 资金来源
	 */

	function main_detail($record){
        $broke_record = M('broke_record');
        $broke_record_info = $broke_record->where(" id = '$record'")->find();
        $this -> assign('record_info',$broke_record_info);
	    $this->display();
    }

	/*
	 * 奖金明细
	*/
	function recordlists(){

		$bonus = M('bonus');
		$pagecount = 10;
		$subQuery = $bonus->field("DATE_FORMAT(bdate,'%Y-%m-%d') days,count(*) counts")->group('days')->buildSql();
        $count = $bonus->table($subQuery.' b')->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = $bonus->
        field("DATE_FORMAT(bdate,'%Y-%m-%d') days,sum(b0) as b0 ,
        sum(b1) as b1,sum(b2) as b2,sum(b3) as b3,
        sum(b4) as b4,sum(b5) as b5,sum(b6) as b6,sum(b7) as b7,sum(b8) as b8,sum(ax) as ax
        ,sum(jf) as jf,sum(tx) as tx,sum(sh) as sh")
            ->group('days')->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->pc_show();
		$this->assign('info',$info);
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function recorddetail(){
		
		$date = $_GET['date'];
		$this->assign('date', $date);
		$this->display();
	}

	function huibenj(){
	    if ($_POST){
            $money = $_POST['money'];
            if ($money){

                $Prize = A("User/Prize");
                $res = $Prize->huiben($money);
                if($res){
                    $msg['Error'] = '0';
                    $msg['Data'] ='发放成功!';
                    echo json_encode($msg);
                    exit;
                }else{
                    $msg['Error'] = '-10000';
                    $msg['Data'] ='发放失败';
                    echo json_encode($msg);
                    exit;
                }
            }
        }else{
            $this->display();
        }

    }

	function recorddetail_ajax(){
	
		$bonus = M('bonus');		
		$where = array();
	//	$date = $_GET['date'];
	//	$where['bdate']=array('like',"%$date%");
		if ($_GET['user_name'] != null) {
			$user_name = $_GET['user_name'];
			$where['user_name'] = array('like',"%$user_name%");
		}
		if ($_GET['start'] > 0) {
			$where[]['UNIX_TIMESTAMP(bdate)'] = array('egt', $_GET['start']);
			$where[]['UNIX_TIMESTAMP(bdate)'] = array('elt', $_GET['end']);
		}
		$pagecount = 10;
		$count = $bonus->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$record = $bonus->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$show = $Page->pc_show();

		$this->assign('record', $record);
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function deposit(){
		
		$this->display();
	}
	
	/*
	 * 提现
	 */
	function withdraw(){
		$withdraw = M('withdraw');
		$user_name = $_GET['user_name'];
		$pagecount = 5;
		$count = $withdraw->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = $withdraw->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->pc_show();
		$this->assign('info',$info);
		$this->assign('user_name',$user_name);
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function withdraw_ajax()
	{
	
		$withdraw = M('withdraw');
		$users = M("users");
		$bank = M("bank");
		$where = array();
		if ($_GET['user_name'] != null) {
            $user_name = $_GET['user_name'];
			$where['user_name'] = array('like',"%$user_name%");
		}
		if ($_GET['truename'] != null) {
			$bankuser = $_GET['truename'];
			$where['bankuser'] = array('like',"%$bankuser%");
		}
	
		if ($_GET['start'] > 0) {
			$where[]['createtime'] = array('egt', $_GET['start']);
			$where[]['createtime'] = array('elt', $_GET['end']);
		}
	
		$pagecount = 10;
		$count = $withdraw->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = $withdraw->where($where)->order("createtime desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		foreach ($info as $key=>$value){
			$info[$key]['bank'] = $bank->where("id = '{$value['bankid']}'")->getField('name');
		    $info[$key]['moblie']= $users->where("user_name = '{$value['user_name']}'")->getField('moblie');
		}
		$show = $Page->pc_show();
	    
		$this->assign('page', $show);
		$this->assign('info',$info);
		$this->display();
	}
	
	function transfer(){
		$this->display();
	}
	
	function api_transfer_submit(){
		
		$users = M('users');
		$user_name_post = urldecode($_POST['memberid']);
		$user_infousername= $users->where(" user_name = '$user_name_post'")->find();
		if(!$user_infousername){
			$msg['Error'] = '-10003';
			$msg['Data'] = '收款人不存在';
			echo json_encode($msg);
			exit;
		}

		$user_name_session = $_SESSION['admin'];
		$user_infonickname= $users->where(" nickname = '$user_name_session'")->find();
		if ($_POST['type'] == 1 && $_POST['money'] > $user_infonickname['jjb']) {
			$msg['Error'] = '-10004';
			$msg['Data'] = '奖金币金额不足';
			echo json_encode($msg);
			exit;
		}
		if ($_POST['type'] == 2 && $_POST['money'] > $user_infonickname['gwb']) {
			$msg['Error'] = '-10007';
			$msg['Data'] = '购物币金额不足';
			echo json_encode($msg);
			exit;
		}
		$password = $_POST['safeword'];
		if ($user_infonickname['second_password'] != md5($password)) {
			$msg['Error'] = '-10005';
			$msg['Data'] = '二级密码错误';
			echo json_encode($msg);
			exit;
		}
		
		$transfer = M('transfer');
		$add_data = array();
		$suser_data = array();
		$zuser_data = array();
		$add_data['suserid'] = $user_infousername['user_id'];
		$add_data['susername'] = $user_infousername['user_name'];
		$add_data['struename'] = $user_infousername['truename'];
		$add_data['zuserid'] = $user_infonickname['user_id'];
		$add_data['zusername'] = $user_infonickname['user_name'];
		$add_data['ztruename'] = $user_infonickname['truename'];
		$add_data['type'] = $_POST['type'];
		$add_data['money'] = $_POST['money'];
		$add_data['remarks'] = urldecode($_POST['remarks']);
		$add_data['createtime'] = time();
		$add_transfer_id = $transfer -> add($add_data);
		
		if ($_POST['type'] == 1) {
			$suser_data['jjb'] = $user_infousername['jjb'] + $_POST['money'];
			$zuser_data['jjb'] = $user_infonickname['jjb'] - $_POST['money'];
		}
		if ($_POST['type'] == 2) {
			$suser_data['gwb'] = $user_infousername['gwb'] + $_POST['money'];
			$zuser_data['gwb'] = $user_infonickname['gwb'] - $_POST['money'];
		}
		$suser_id = $user_infousername['user_id'];
		$suser = $users->where(" user_id = '$suser_id' ")->save($suser_data);
		
		$zuser_id = $user_infonickname['user_id'];
		$zuser = $users->where(" user_id = '$zuser_id' ")->save($zuser_data);
		if($add_transfer_id && $suser && $zuser){
			$msg['Error'] = '0';
			$msg['Data'] = '转账成功';
			echo json_encode($msg);
			exit;
		}else{
			$msg['Success'] =false;
			$msg['Error'] = '-10002';
			$msg['Data'] = "转账失败";
			echo json_encode($msg);
			exit;
		}
		exit;
	}
	
	function detaillists(){
		$transfer = M('transfer');
		$user_name = $_GET['user_name'];
		$pagecount = 10;
		$count = $transfer->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = $transfer->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->pc_show();
		$this->assign('info',$info);
		$this->assign('user_name', $user_name);
		$this->assign('page', $show);
		$this->display();
	}
	
	function detaillists_ajax()
	{
	
		$transfer = M('transfer');
		$where = array();
		if ($_GET['user_name'] != null) {
			$user_name = $_GET['user_name'];
			$where['zusername|susername'] = array('like',"%$user_name%");
// 			$where['zusername|susername'] = $_GET['user_name'];
		}
		if ($_GET['truename'] != null) {
			$truename = $_GET['truename'];
			$where ['ztruename|struename'] = array('like',"%$truename%");
// 			$where ['ztruename|struename'] = $_GET['truename'];
		}
	
		if ($_GET['start'] > 0) {
			$where[]['createtime'] = array('egt', $_GET['start']);
			$where[]['createtime'] = array('elt', $_GET['end']);
		}
	
		$pagecount = 10;
		$count = $transfer->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = $transfer->where($where)->order("createtime desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
// 		echo $transfer->getLastSql();
// 		exit();
		$show = $Page->pc_show();
	
		$this->assign('page', $show);
		$this->assign('info',$info);
		$this->display();
	}
	
// 	function convert(){
		
// 		$this->display();
// 	}
	
// 	function convertinside(){
		
// 		$this->display();
// 	}
	
// 	function convertcredit(){
		
// 		$this->display();
// 	}
	
	function detail($dealid){
		
		$transfer = M('transfer');
		$transfer_info_dealid = $transfer->where(" id = '$dealid'")->find();
		$this -> assign('transfer_info',$transfer_info_dealid);
		$this -> assign('dealid',$dealid);
		$this->display();
	}
	
	function check($checkid){
		$withdraw = M('withdraw');
		$withdraw_info_checkid = $withdraw->where(" id = '$checkid'")->find();
		$bank = M("bank")->where("id = '{$withdraw_info_checkid['bankid']}'")->find();
		$user = M("users")->where("user_name = '{$withdraw_info_checkid['user_name']}'")->find();
		$this -> assign('withdraw_info',$withdraw_info_checkid);
		$this-> assign('bank',$bank);
		$this-> assign('user',$user);
		$this->display();
	}
	
//	function api_check_submit(){
//
//		$withdraw = M('withdraw');
//		$id = $_POST['id'];
//		$withdraw_data = array();
//		$withdraw_info = $withdraw->where(" id = '$id'")->find();
//		$money = $withdraw_info['money'];
//		$user_name = $withdraw_info['user_name'];
//		$withdraw_data['status'] = $_POST['status'];
//		$this->display();
//	}
	
	function api_check_submit(){
		
		$withdraw = M('withdraw');
		$id = $_POST['id'];
		$withdraw_data = array();
		$withdraw_info = $withdraw->where(" id = '$id'")->find();
		$money = $withdraw_info['money'];
		$user_name = $withdraw_info['user_name'];
		$withdraw_data['status'] = $_POST['status'];
		$withdraw_data['handletime'] = time();
		$withdraw_res = $withdraw -> where(" id = '$id'") -> save($withdraw_data);
		
		if($_POST['status'] == 0){
			$users = M('users');
			$edit_data = array();
			$user_info = $users->where(" user_name = '$user_name'")->find();
			$edit_data['jjb'] = $user_info['jjb'] + $money;
			$users_res = $users -> where(" user_name = '$user_name' ") -> save($edit_data);
			if($withdraw_res && $users_res){
				$msg['Error'] = '0';
				$msg['Data'] = '审核成功';
				echo json_encode($msg);
				exit;
			}else{
				$msg['Success'] =false;
				$msg['Error'] = '-10002';
				$msg['Data'] = "审核失败";
				echo json_encode($msg);
				exit;
			}
		}else{
			if($withdraw_res){

                $Prize = A("User/Prize");
                $res = $Prize->yejitongji(0,0,0,0,$money,0,0);

				$msg['Error'] = '0';
				$msg['Data'] = '审核成功';
				echo json_encode($msg);
				exit;
			}else{
				$msg['Success'] =false;
				$msg['Error'] = '-10002';
				$msg['Data'] = "审核失败";
				echo json_encode($msg);
				exit;
			}
		}
		
		exit;
	}
	
}