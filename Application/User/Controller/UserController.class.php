<?php
namespace User\Controller;
use Think\Controller;
class UserController extends Controller{
	
	//会员注册
	public function register(){
        $users = M('users');
        $user_name= $_SESSION['user_name'];
	    if(!$user_name){
            $this->error('请重新登录','../../User/Center/index',3);
            exit;
        }

	    if(!$_SESSION['two_Verify']){
            $this->display('Verify');
            exit;
        }


        $area = $_GET['area'];
        session('register_area_default', $area); //创建默认 会员市场

        $ruser_name = $_GET['rootid']?$_GET['rootid']:$_SESSION['user_name']; // 查询顶级用户的user_name 或 需要查询的user_name

        $code = $users->field("max(user_name) as newno")->find();
        $Newcode = 'M'.str_pad(substr($code['newno'],1,6)+1,6,"0",STR_PAD_LEFT);
        $info= $users->where(" user_name = '$ruser_name'")->find();
        $recmid= $info['pid'];
        $centerid= $info['daili'];
        if($recmid){
            $recm_name = $info['user_name'];
            $parent_name = $info['user_name'];
        }else{
            $recm_name = $ruser_name;
            $parent_name = $ruser_name;
        }
        if($centerid){
            $center_name = $user_name;
        }else{
            $center_name = 'M000001';
        }
        $this->assign('user_code',$Newcode);
        $this->assign('recmid',$recm_name);
        $this->assign('centerid',$center_name);
        $this->assign('parentid',$parent_name);
        $this->display();
	}



	public function api_register_submit(){

        //为该用户创建身份信息
        $users = M('users');
		$add_data = array();
		$user_name = urldecode($_POST['id']);
        $user_infousername= $users->where(" user_name = '$user_name'")->find();
        if($user_infousername){
            $msg['Error'] = '-101';
            $msg['Data'] = '会员编号已存在';
            echo json_encode($msg);
            exit;
        }
        $add_data['user_name'] = $user_name;
        $centerid = urldecode($_POST['centerid']);
        $user_infocenterid= $users->where(" user_name = '$centerid'")->find();
        if(!$user_infocenterid){
            $msg['Error'] = '-102';
            $msg['Data'] = '代理中心编号不存在';
            echo json_encode($msg);
            exit;
        }
        if($user_infocenterid['daili'] == 0){
            $msg['Error'] = '-103';
            $msg['Data'] = '该代理中心编号未正式成为代理中心';
            echo json_encode($msg);
            exit;
        }
        $add_data['centerid'] = $user_infocenterid['user_id'];
        $add_data['centername'] = $centerid;

        $level = $_POST['level'];
        $single = $_POST['single']?$_POST['single']:1;
		$add_data['level'] = $level;
		$add_data['single'] = $single;
		$level_money = $this->getlevel($level);
		$add_data['lsk'] = $level_money;
		$add_data['password'] = md5(urldecode($_POST['password']));
		$add_data['second_password'] = md5(urldecode($_POST['safeword']));
		$add_data['truename'] = urldecode($_POST['username']);
		$add_data['idcard'] = urldecode($_POST['idcard']);
		$add_data['bankid'] = urldecode($_POST['bankid']);
		$add_data['bankno'] = urldecode($_POST['bankno']);
		$add_data['bankuser'] = urldecode($_POST['bankuser']);
		$add_data['bankname'] = urldecode($_POST['bankname']);
        $moblie = urldecode($_POST['moblie']);
        $user_mobile= $users->where(" moblie = '$moblie'")->find();
        if($user_mobile){
            $msg['Error'] = '-107';
            $msg['Data'] = '该手机号已注册';
            echo json_encode($msg);
            exit;
        }
		$add_data['moblie'] = $moblie;
		$add_data['email'] = urldecode($_POST['email']);
		$add_data['zipcode'] = urldecode($_POST['zipcode']);
		$add_data['address'] =  urldecode($_POST['address']);
		$add_data['place'] = $_POST['place'];
		$add_data['reg_time'] = time();
		$add_data['after_time'] = time();


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
            if($prow['chl']){
                $msg['Error'] = '-1061';
                $msg['Data'] = '安置位置A区已存在';
                echo json_encode($msg);
                exit;
            }
        }else if($area == '2'){
            if($prow['chr']){
                $msg['Error'] = '-1062';
                $msg['Data'] = '安置位置B区已存在';
                echo json_encode($msg);
                exit;
            }
        }else{
            $msg['Error'] = '-1060';
            $msg['Data'] = '安置位置不正确';
            echo json_encode($msg);
            exit;
        }

        $add_data['area'] = $area;
        $add_data['parentid'] = $prow['user_id'];
        $add_data['pusername'] = $prow['user_name'];
        $add_data['ppath']=$prow['ppath'].$prow['user_id'].",";
        $add_data['plevel']=$prow['plevel']+1;
        $add_user_id = $users -> add($add_data);

        if($area ==1){
            $chl =$add_user_id;
            $area_info['chl'] = $chl;
            $res = $users -> where(" user_name = '$parentid' ") -> save($area_info);
        }else{
            $chr =$add_user_id;
            $area_info['chr'] = $chr;
            $res = $users -> where(" user_name = '$parentid' ") -> save($area_info);
        }

//        $this->addArea($add_user_id,$level_money);

        if(!$add_user_id){
            $msg['Success'] =false;
            $msg['Error'] = '-10002';
            $msg['Data'] = "新增会员失败";
            echo json_encode($msg);
            exit;
        }else{
            $msg['Error'] = '0';
            $msg['Data'] = '新增会员成功';
            echo json_encode($msg);
            exit;
        }
        exit;
	}
	
	function basicinfo(){
		$users = M('users');
		$user_name= $_SESSION['user_name'];
		$user_info= $users->where(" user_name = '$user_name'")->find();
		$banks = M('bank');
		$bankid = $user_info['bankid'];
		$bank_info = $banks->where(" id = '$bankid'")->find();
		$levels = M('memberlevel');
		$levelid = $user_info['level'];
		$level_info = $levels->where(" id = '{$levelid}' ")->find();
		$this->assign('user_info',$user_info);
		$this->assign('bank_info',$bank_info);
		$this->assign('level_info',$level_info);
		$this->display();
	}

	/*
	 * 我的推荐
	 */

	public function recmlists(){

        $users = M('users');
        $user_id= $_SESSION['user_id'];
        if(!$user_id){
            $this->error('请重新登录','../../User/Center/index',3);
            exit;
        }

        $pagecount = 10;
        $count = $users->where(" pid = '$user_id'")->count();
        $Page = new \Think\Page($count, $pagecount);
//         $info= $users->where(" pid = '$user_id'")->order("user_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')
        ->where("wx_users.pid = '$user_id'")
        ->order("wx_users.user_id asc")
        ->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->wap_show();
        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
	    $this->display();
    }

    /*
     * 会员详情
     */

    public function detail(){
        $users = M('users');

        $user_id= $_SESSION['user_id'];
        if(!$user_id){
            $this->error('请重新登录','../../User/Center/index',3);
            exit;
        }

        $detail_id= $_GET['id'];
        $info= $users->where(" user_id = '$detail_id'")->find();
        $info['area_name'] = $info['area']> 1?($info['area']> 2?'C区':'B区'):'A区';
        $level = $info['level'];
        $info['name'] = M('memberlevel')->where(" id = '$level'")->getField('name');
        $this->assign('info',$info);
        $this->display();
    }


    function getMemberbyID($userid){
        $users = M('users');
        return $users->where(" user_id = '$userid'")->find();
    }


    /*
     * 获取银行信息
     */
    public function bank(){
        $bank = M('bank');
        $bank_list = $bank->select();
        $data=json_encode($bank_list,JSON_UNESCAPED_UNICODE);
        echo  $this->create_item($data);
    }

    /*
     * 获取会员市场
     */

    public function memberarea(){
        $default_area = $_SESSION['register_area_default'];
        if($default_area == '1'){
            $data="[{\"id\":1,\"name\":\"A区\",\"order\":1,\"usable\":true}]";
        }else if($default_area == '2'){
            $data="[{\"id\":2,\"name\":\"B区\",\"order\":2,\"usable\":true}]";
        }else if($default_area == '3'){
            $data="[{\"id\":3,\"name\":\"C区\",\"order\":2,\"usable\":true}]";
        }else{
            $data="[{\"id\":1,\"name\":\"A区\",\"order\":1,\"usable\":true},
        {\"id\":2,\"name\":\"B区\",\"order\":2,\"usable\":true}]";
        }
//        $data="[{\"id\":1,\"name\":\"A区\",\"order\":1,\"usable\":true},
//        {\"id\":2,\"name\":\"B区\",\"order\":2,\"usable\":true},
////        {\"id\":3,\"name\":\"C区\",\"order\":2,\"usable\":true}
//]";
        echo  $this->create_item($data);
    }


    /*
     *  获取会员等级
     */
    public function  memberlevel(){
        $member = M('memberlevel');
        $member_level = $member->select();
		// var_dump($menber_level);
        $data=json_encode($member_level,JSON_UNESCAPED_UNICODE);
        echo  $this->create_item($data);
    }

    /*
     *  获取会员等级
    */
    public function  membersingle(){
    	$data="[
        {\"id\":1,\"name\":\"实单\",\"order\":1,\"usable\":true},
        {\"id\":3,\"name\":\"回填单\",\"order\":3,\"usable\":true}]";
    	echo  $this->create_item($data);
    }

    /*
    *  获取会员奖金发放
    */
    public function  membergrant(){
        $data="[
        {\"id\":1,\"name\":\"是\",\"order\":1,\"usable\":true},
        {\"id\":2,\"name\":\"否\",\"order\":2,\"usable\":true}]";
        echo  $this->create_item($data);
    }

    /*
    *  获取会员等级
    */
    public function  express(){
        $data="[
        {\"id\":'ems',\"name\":\"邮政\",\"order\":1,\"usable\":true},
        {\"id\":'huitongkuaidi',\"name\":\"百世汇通\",\"order\":2,\"usable\":true},
        {\"id\":'youzhengguonei',\"name\":\"包裹/平邮/挂号信\",\"order\":3,\"usable\":true},
        {\"id\":'debangwuliu',\"name\":\"德邦物流\",\"order\":3,\"usable\":true},
        {\"id\":'guotongkuaidi',\"name\":\"国通快递\",\"order\":3,\"usable\":true},
        {\"id\":'jiajiwuliu',\"name\":\"佳吉物流\",\"order\":3,\"usable\":true},
        {\"id\":'shunfeng',\"name\":\"顺丰\",\"order\":3,\"usable\":true},
        {\"id\":'shenghuiwuliu',\"name\":\"盛辉物流\",\"order\":3,\"usable\":true},
        {\"id\":'tiantian',\"name\":\"天天快递\",\"order\":3,\"usable\":true},
        {\"id\":'yuantong',\"name\":\"圆通速递\",\"order\":3,\"usable\":true},
        {\"id\":'yunda',\"name\":\"韵达快运\",\"order\":3,\"usable\":true},
        {\"id\":'zhongtong',\"name\":\"中通速递\",\"order\":3,\"usable\":true},
        {\"id\":'zhaijisong',\"name\":\"宅急送\",\"order\":3,\"usable\":true}
        ]";
        echo  $this->create_item($data);
    }

    /*
     *  获取地区信息
     */
    public function  place(){
        $region = M('region');
        $root = $_POST['root'];
        $region_list = $region-> where(" PARENT_ID = '$root'")->select();
        $data=json_encode($region_list,JSON_UNESCAPED_UNICODE);
        echo  $this->create_item($data);
    }

    /*
     * 生成xml 文件
     */
    function create_item($json)
    {
        $this->encoding ="utf-8";
        $feed = "";
        $feed .= "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\n";
        $feed .="<HttpResult xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns=\"http://tempuri.org/\">\n";
        $feed .="<error>0</error>\n";
        $feed .="<time>".date('Y-m-d H:i:s',time()-86400)."</time>\n";
        $feed .=" <data xsi:type=\"xsd:string\">\n";
        $feed .=$json;
        $feed .="</data>\n";
        $feed .="</HttpResult>\n";
        return $feed;
    }
    
    function main(){
    	$bonus = M('bonus_info');
    	$bonus_info = $bonus->find();
    	$this->assign('bonus_info',$bonus_info);
    	
    	$broke =M('broke_record');
    	$bonus = M('bonus');
    	$user_name = $_SESSION['user_name'];
    	$where['user_name'] = $user_name;
    	$where['year(bdate)'] = date("Y");
    	$where['month(bdate)'] = date("m");
    	$where['day(bdate)'] = date("d");
    	$broke_count = $broke->where($where)->count();
    	$bonus_sum =  $bonus->where($where)->sum('b0');
    	$this->assign('broke_count',$broke_count);
    	$this->assign('bonus_sum',$bonus_sum);
   	
    	$this->display();
    }

    /*
     * $level
     * 查询会员级别
     * return $levelinfo['name']
     */
    protected  function getlevel($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo['money'];
    }
    
    function basicedit(){
    	$users = M('users');
    	$user_name= $_SESSION['user_name'];
    	$user_info= $users->where(" user_name = '$user_name'")->find();
    	$this->assign('user_info',$user_info);
    	$this->assign('bankid',$user_info['bankid']);
    	$this->assign('province',$user_info['province']);
    	$this->assign('city',$user_info['city']);
    	$this->assign('place',$user_info['place']);
    	$this->display();
    }
    
    function api_basicedit_submit(){
    	 
    	$users = M('users');
    	$user_name= $_SESSION['user_name'];
    	$edit_data = array();
    	$edit_data['truename'] = urldecode($_POST['username']);
    	$edit_data['idcard'] = urldecode($_POST['idcard']);
    	$edit_data['bankid'] = urldecode($_POST['bankid']);
    	$edit_data['bankno'] = urldecode($_POST['bankno']);
    	$edit_data['bankuser'] = urldecode($_POST['bankuser']);
    	$edit_data['bankname'] = urldecode($_POST['bankname']);
    	$edit_data['moblie'] = urldecode($_POST['moblie']);
    	$edit_data['email'] = urldecode($_POST['email']);
    	$edit_data['zipcode'] = urldecode($_POST['zipcode']);
    	$edit_data['address'] =  urldecode($_POST['address']);
    	$edit_data['province'] =  urldecode($_POST['province']);
    	$edit_data['city'] =  urldecode($_POST['city']);
    	$edit_data['place'] =  urldecode($_POST['place']);
    	$edit_data['headimgurl'] =  urldecode($_POST['headimgurl']);
    	$edit = $users->where(" user_name = '$user_name' ")->save($edit_data);
    	if(!$edit){
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
    
    function api_basicface_submit(){
    	 
    	if (IS_POST ) {
    		$upload = new \Think\Upload();
    		$upload->rootPath = './Uploads/';
    		$upload->maxSize = 3145728;
    		$upload->autoSub = false;
    		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
    		$upload->savePath = '';
    		$upload->autoSub = true;
    		$upload->subName = date("Ymd");
    		$imginfo = $upload->upload();
    		if (!$imginfo) {
    			$this->error($upload->getError());
    		} else {
    			foreach ($imginfo as $val) {
    				$pic_url = "Uploads/" . $val['savepath'] . $val['savename'];
    			}
    			//	$this->success("幻灯片图片上传成功");
    			//echo '<script>alert("'.$pic_url.'");</script>';
    			echo '<script>parent.document.getElementById("mypic").src="'.'/'.addslashes($pic_url).'";</script>';
    			echo '<script>parent.document.getElementById("headimgurl_").value="'.'/'.addslashes($pic_url).'";</script>';
    		}
    		die;
    	}
    }
    
    public function netchart(){

        if(!$_SESSION['two_Verify']){
            $this->display('Verify');
            exit;
        }


    	$duser_name = $_GET['rootid']?$_GET['rootid']:$_SESSION['user_name']; // 查询顶级用户的user_name 或 需要查询的user_name
    	$info_user = $this->getinfo($duser_name);
    	 
    	if($info_user['name'] == NULL){
    		$duser_name = $_SESSION['user_name'];
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
    
    
	function applylists(){
        $user_name = $_SESSION['user_name'];
		$centerlists = M('centerlists');
		$pagecount = 10;
		$count = $centerlists->where("user_name = '{$user_name}'")->count();
		$Page = new \Think\Page($count, $pagecount);
		$centerlists_info = $centerlists->where("user_name = '{$user_name}'")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show = $Page->wap_show();
		$this->assign('centerlists_info',$centerlists_info);
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function apply(){
		
		$this->display();
	}
	
	function api_apply_submit(){
		
		$users = M('users');
		$user_name = $_SESSION['user_name'];
		$user_infousername= $users->where(" user_name = '$user_name'")->find();
		$baodantype = urldecode($_POST['type']);

		// 查询推荐的人数 
		$tuijian_num = $user_infousername['recount'];
		if($baodantype == 1){
			if($tuijian_num < 10){
				$msg['Success'] =false;
				$msg['Error'] = '-10003';
				$msg['Data'] = "团队人数少于10 申请失败";
				echo json_encode($msg);
				exit;
			}
		}

		if($baodantype == 2){
			// 查询人数下有几个品鉴店

			$shopnum = $users->where("pid = {$user_infousername['user_id']}")->count;

			if($tuijian_num >99 || $shopnum >4 ){
				
			}else{
				$msg['Success'] =false;
				$msg['Error'] = '-10003';
				$msg['Data'] = "团队人数少于100 或品鉴店少于5 申请失败";
				echo json_encode($msg);
				exit;
			}
		}
		$centerlists = M('centerlists');
		$add_data = array();
		$add_data['user_id'] =  $user_infousername['user_id'];
		$add_data['user_name'] =  $user_infousername['user_name'];
		$add_data['truename'] =  $user_infousername['truename'];
		$add_data['type'] =  $baodantype;
		$add_data['title'] =  urldecode($_POST['title']);
		$add_data['content'] =  urldecode($_POST['content']);
		$add_data['tj_time'] =  time();
		$add_centerlists_id = $centerlists -> add($add_data);
		if(!$add_centerlists_id){
			$msg['Success'] =false;
			$msg['Error'] = '-10000';
			$msg['Data'] = "提交申请失败";
			echo json_encode($msg);
			exit;
		}else{
			$msg['Error'] = '0';
			$msg['Data'] = '提交申请成功';
			echo json_encode($msg);
			exit;
		}
		exit;
		
	}
	
	function safeinfo(){

		$this->display();
	}
	
	function api_safeinfo_submit(){
		
		$users = M('users');
		$user_name = $_SESSION['user_name'];
		$user_info= $users->where(" user_name = '$user_name'")->find();
		
		$password = $_POST['safeword'];
		if ($user_info['second_password'] != md5($password)) {
			$msg['Error'] = '-1';
			$msg['Data'] = '二级密码错误';
			echo json_encode($msg);
			exit;
		}
		$edit_data = array();
		$edit_data['password'] = md5($_POST['npassword']);
		$edit_data['second_password'] = md5($_POST['nsafeword']);
		$user_res = $users->where(" user_name = '$user_name'")->save($edit_data);
		if(!$user_res){
			$msg['Success'] =false;
			$msg['Error'] = '-10000';
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
    
}
?>