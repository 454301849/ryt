<?php
namespace User\Controller;
use Think\Controller;

class DealController extends Controller{
	
	function transfer(){

		if(!$_SESSION['two_Verify']){
			$this->display('User_Verify');
			exit;
		}
		$users = M('users');
		$user_name= $_SESSION['user_name'];
		$user_info= $users->where(" user_name = '$user_name'")->find();
		$this->assign('user_info',$user_info);
		$this->display();
	}
	
	function  api_transfer_submit(){
		
		$users = M('users');
		$user_name_post = urldecode($_POST['suserid']);
		$user_infousername= $users->where(" user_name = '$user_name_post'")->find();
		if(!$user_infousername){
			$msg['Error'] = '-10003';
			$msg['Data'] = '收款人不存在';
			echo json_encode($msg);
			exit;
		}
		if($user_name_post == $_SESSION['user_name']){
			$msg['Error'] = '-10006';
			$msg['Data'] = '不能和自己转账';
			echo json_encode($msg);
			exit;
		}
		$user_name_session = $_SESSION['user_name'];
		$user_infonickname= $users->where(" user_name = '$user_name_session'")->find();
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
	
	function withdraw(){
		
		if(!$_SESSION['two_Verify']){
			$this->display('User_Verify');
			exit;
		}
		$users = M('users');
		$user_name = $_SESSION['user_name'];
		$user_info = $users->where(" user_name = '$user_name'")->find();
		$this->assign('info',$user_info);
		$this->display();
	}
	
	function api_withdraw_submit(){
		
		$users = M('users');
		$user_name_session = $_SESSION['user_name'];
		$user_infonickname = $users->where(" user_name = '$user_name_session'")->find();
		if (($user_infonickname['single'] == 3) && ($user_infonickname['jjb'] - $user_infonickname['lsk'] <= 0)) {
			$msg['Error'] = '-10006';
			$msg['Data'] = '您现在还处于回填状态';
			echo json_encode($msg);
			exit;
		}
		
		$yue = $user_infonickname['jjb'] - $user_infonickname['lsk'];
		
		if ($user_infonickname['single'] == 3) {
			
			$edit_data = array();
			$edit_data['jjb'] = $yue;
			$edit_data['single'] = 1;
			$users->where(" user_name = '$user_name_session'")->save($edit_data);
		}
		
	 	if (($user_infonickname['single'] == 3) && ($_POST['money'] >$yue)) {
			$msg['Error'] = '-10004';
			$msg['Data'] = '奖金币金额不足';
			echo json_encode($msg);
			exit;
		}
		
		if (($user_infonickname['single'] != 3) && ($_POST['money'] > $user_infonickname['jjb'])) {
			$msg['Error'] = '-10004';
			$msg['Data'] = '奖金币金额不足';
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
		
		$withdraw = M('withdraw');
		$money =  $_POST['money'];
		$poundage = M('bonus_info')->getField('tx_sxf');
		$add_data = array();
		$add_data['bankid'] = $_POST['bankid'];
		$add_data['bankno'] = $_POST['bankno'];
		$add_data['bankuser'] = urldecode($_POST['bankuser']);
		$add_data['bankname'] = urldecode($_POST['bankname']);
		$add_data['user_name'] = $_SESSION['user_name'];
		$add_data['money'] = $money;
		$add_data['poundage'] = $poundage/100;
		$add_data['arrival'] = $money - ($money * ($poundage/100));
		$add_data['remarks'] = urldecode($_POST['remarks']);
		$add_data['createtime'] = time();
		$add_withdraw_id = $withdraw -> add($add_data);
		
		$edit_datas = array();
		$edit_datas['jjb'] = $user_infonickname['jjb'] - $money;
		$users_res = $users -> where(" user_name = '$user_name_session' ") -> save($edit_datas);
		
		if($add_withdraw_id && $users_res){
			$msg['Error'] = '0';
			$msg['Data'] = '提现申请提交成功';
			echo json_encode($msg);
			exit;
		}else{
			$msg['Success'] =false;
			$msg['Error'] = '-10002';
			$msg['Data'] = "提现申请提交失败";
			echo json_encode($msg);
			exit;
		}
		exit;
	}
	
	function convert(){
		
		$this->display();
	}
	
	function convertinside(){
		
		$users = M('users');
		$user_name= $_SESSION['user_name'];
		$user_info= $users->where(" user_name = '$user_name'")->find();
		$this->assign('user_info',$user_info);
		$this->display();
	}
	
	function api_convertinside_submit(){
		
		$users = M('users');
		$edit_data = array();
		$user_name_session = $_SESSION['user_name'];
		$user_infonickname= $users->where(" user_name = '$user_name_session'")->find();
		if ($_POST['number'] > $user_infonickname['jjb']) {
			$msg['Error'] = '-10004';
			$msg['Data'] = '奖金币金额不足';
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
		$transform = M('transform');
		$add_data = array();
		$add_data['user_id'] = $user_infonickname['user_id'];
		$add_data['user_name'] = $user_infonickname['user_name'];
		$add_data['truename'] = $user_infonickname['truename'];
		$add_data['jine'] = $_POST['number'];
		$add_data['shouxu'] = 0;
		$add_data['zdate'] = time();
		$add_data['lx'] = 0;
		$add_transform_id = $transform -> add($add_data);
		
		$edit_data['jjb'] = $user_infonickname['jjb'] - $_POST['number'];
		$edit_data['gwb'] = $user_infonickname['gwb'] + $_POST['number'];
		$edit_id = $user_infonickname['user_id'];
		$edit = $users->where(" user_id = '$edit_id' ")->save($edit_data);
		if($add_transform_id && $edit){
			$msg['Error'] = '0';
			$msg['Data'] = '转换成功';
			echo json_encode($msg);
			exit;
		}else{
			$msg['Success'] =false;
			$msg['Error'] = '-10002';
			$msg['Data'] = "转换失败";
			echo json_encode($msg);
			exit;
		}
		exit;
	}
	
	function convertcredit(){
		
		$this->display();
	}
	
	function lists(){

         $type = $_GET['type']?$_GET['type']:'0';
        $user_name = $_SESSION['user_name'];
        $broke_record = M('broke_record');
        $pagecount = 10;

	    if($type == '-1' || $type =='' || $type == 0){
            $count = $broke_record->where("user_name = '{$user_name}'")->count();
            $Page = new \Think\Page($count, $pagecount);
            $info = $broke_record->where("user_name = '{$user_name}'")->
            order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        }else{
            $count = $broke_record->where("user_name = '{$user_name}' and user_name = '{$user_name}'")->count();
            $Page = new \Think\Page($count, $pagecount);
            $info = $broke_record->where("type = '{$type}' and user_name = '{$user_name}'")
                ->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        }

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');



        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->wap_show();
        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
		$this->display();
	}
	
	function detail($dealid){
		
		$broke_record = M('broke_record');
		$info = $broke_record->where("id = '{$dealid}'")->find();
		 $this->assign('info',$info);
		$this->display();
	}
	
	function classify(){
		
		$this->display();
	}
	
	function recordlists(){
		
		$bonus = M('bonus');
		$user_name = $_SESSION['user_name'];
		$pagecount = 10;
		$count = $bonus->where("user_name = '$user_name' ")->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = $bonus->where("user_name = '$user_name' ")->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->wap_show();
        
        $users = M('users');
//        foreach ($info as $key => $value){
//        	$user_name = $value['user_name'];
//        	$user_info= $users->where(" user_name = '$user_name'")->find();
//        	$info[$key]['area'] = $user_info['area1'] + $user_info['area2'];
//        }
		$this->assign('info',$info);
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function recorddetail($id){
		
		$bonus = M('bonus');
		$bonus_info = $bonus->where("id = '$id'")->find();
		$this->assign('info',$bonus_info);
		$this->display();
	}

	function withdrawlists(){
        $withdraw = M('withdraw');
        $users = M("users");
        $bank = M("bank");
        $user_name = $_SESSION['user_name'];
        $pagecount = 10;
        $count = $withdraw->where("user_name = '$user_name' ")->count();
        $Page = new \Think\Page($count, $pagecount);
        $info = $withdraw->where("user_name = '$user_name' ")->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->wap_show();
        foreach ($info as $key=>$value){
            $info[$key]['bank'] = $bank->where("id = '{$value['bankid']}'")->getField('name');
          //  $info[$key]['moblie']= $users->where("user_name = '{$value['user_name']}'")->getField('moblie');
        }
        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display();
    }
	
}

