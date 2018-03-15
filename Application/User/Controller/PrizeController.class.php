<?php
namespace User\Controller;
use Think\Controller;
use Think\Log;

class PrizeController extends Controller{

    /*
     * 激活会员    1  2  3 领导奖 4 5 分享奖 6 见点奖 7 区域管理奖 8 推荐奖
     */

    public function activateuser($user_id){


        $users = M('users');
        $info =$this->getUserbyID($user_id);
        $us_update['register']=1;
        $us_update['activate_time']=time();
        $reman=$this->getUserbyID($info['pid']);

		$plsk = $reman['lsk'];

        $reman_update['recount']=$reman['recount']+1;

        $users->where(" user_id = '{$info['user_id']}'")->save($us_update);
        $users->where(" user_id = '{$reman['user_id']}'")->save($reman_update);

        //是否回填单
        if($info['single'] == 1)
        {
            $this->addArea($info['user_id'],$info['lsk']);
			$this->tuijian($info,$plsk,$reman['level']);

			// $this->jdj($info['user_id'],$info['user_name'],$info['ppath'],$info['plevel']);//见点奖
			 $this->ldjxn($info['user_id'],$info['user_name'],$info['ppath'],$info['plevel']);
			 $this->yejitongji(1,1,$info['lsk'],0,0,0,0,0);
        }else{
            $this->yejitongji(1,0,0,0,0,0,0,0);
        }

        return '1';

    }
	/*
	* 见点奖金 b6
	*/
	
	public function jdj($user_id,$user_name,$rep,$rel){
		$users = M('users');
		$rep1 = rtrim($rep,',');
		$getlevelmaxceng = M('memberlevel')->max('jd_layer');
        $user_info = $users->where("user_id in ({$rep1})")->order("user_id desc")->limit(0,$getlevelmaxceng)->select();
		$bonusinfo = $this->getBonusinfo();
		$b6 = $bonusinfo['first_jd'];
        $ids = explode(',',$rep);

        $reuser = $this->getUserbyID ($user_id);
      //  $reuserinfo = $this->getUserbyID ($reuser['pid']);

		if ($user_info) {

			foreach ($user_info as $uinfo) {

				$us = $uinfo['plevel'];
				$cha = $rel - $us;
				$getgaveceng = $this->getlevelceng($uinfo['level']);
				
			//	echo '用户'.$uinfo['user_name']."层数差".$cha."接受层数".$getgaveceng."<br/>";

				//  层数差 二次消费 二次消费金额满600
				
				if($cha <= $getgaveceng && $uinfo['buynum'] >1 && $uinfo['buymoney'] >= 600 && $uinfo['grant'] ==1 ){
 $users->where(" user_id = '{$uinfo['user_id']}' ")->setInc('b6', $b6);
	$this->bonus_laiyuan($uinfo['user_id'], $uinfo['user_name'], $user_id, $user_name, 6, $b6, "见点奖");

				}

			}
        }
			
       $this->bonus();
	}
	/*
	 * 推荐奖 b5
	 */

	public function tuijian($info,$plsk,$plevel){
		$min_lsk = ($plsk >= $info['lsk'])?$info['lsk']: $plsk;
		$users = M('users');
        $centerinfo = M('bonus_info')->where("id = 1")->find();
        $b5 = $min_lsk*$centerinfo['recommend']/100;

        if($info['grant'] == 1){

             $pdsx_a = $this->tjdateCap($info['pid'],$b5,$plevel);

            $dateCap1=$pdsx_a[0];
            $dateCap2=$pdsx_a[1];

            if($dateCap1>0){
                $users -> where(" user_id = '{$info['pid']}' ") -> setInc('b5',$dateCap1);
                if($dateCap2){
                    $beizhu=$dateCap1."元分享奖(封顶)";
                }else{
                    $beizhu=$dateCap1."元分享奖";
                }

                 $this->bonus_laiyuan($info['pid'],$info['rusername'],$info['user_id'],$info['user_name'],5,$dateCap1,"分享奖");
            }else{
                  $this->bonus_laiyuan($info['pid'],$info['rusername'],$info['user_id'],$info['user_name'],5,0,"分享奖已封顶");
            }

        }
        $this->bonus();
	}

	/*
	* 推荐奖 每日封顶
	*/
    function tjdateCap($user_id,$newmey,$level) {

        $getcap = $this->getlevelCap($level);

        $bonus = $this->getdaybonus($user_id);

        $mey = $getcap - $bonus ['b5'];

        if($mey>0){
            if($mey>$newmey){
                return array($newmey,0);
            }elseif($mey==$newmey){
                return array($newmey,1);
            }else{
                return array($mey,1);
            }
        }else{
            return array(0,1);
        }
    }


    /*
     * 领导奖 量奖下拿三代 B3
     */

    function ldjxn($user_id,$user_name,$rep,$rel){
        $users = M('users');
		$rep1 = rtrim($rep,',');
        $user_info = $users->where("user_id in ({$rep1}) and register =1 and plevel between ".(abs($rel)-3)." and ".(abs($rel)-1))->select();
		 $bonusinfo = $this->getBonusinfo();
        $ids = explode(',',$rep);

        $reuser = $this->getUserbyID ($user_id);
       // $reuserinfo = $this->getUserbyID ($reuser['pid']);

		if ($user_info) {

			foreach ($user_info as $uinfo) {
                if($uinfo['grant'] == 1) {
                    $us = $uinfo['plevel'];
                    $cha = $rel - $us;
                    $uinfoid = $uinfo['user_id'] == 1 ? '' : $uinfo['user_id'];
                    // 一层内满足条件的最低注册金额
                    $getlevelminlsk = $users->where("ppath LIKE '%{$uinfoid}%'  and plevel = " . ($rel))->min('lsk');
                    $minlsk = $getlevelminlsk >= $uinfo['lsk'] ? $uinfo['lsk'] : $getlevelminlsk;
                    $getnum = $users->where("ppath LIKE '%{$uinfoid}%' and register =1 and plevel = " . ($rel))->count();

                    $lingdaojiang = $this->getlevelinfo($uinfo['level']);
                    //	echo '用户'.$uinfo['user_name']."层数差".$cha."最低金额".$minlsk."已有人数".$getnum."<br/>";

                    if ($cha == 1 && $getnum > 1) {
                        $b3 = $minlsk * $lingdaojiang['yi_glj'] / 100;
                    } else if ($cha == 2 && $getnum > 3) {
                        $b3 = $minlsk * $lingdaojiang['er_glj'] / 100;
                    } else if ($cha == 3 && $getnum > 7) {
                        $b3 = $minlsk * $lingdaojiang['san_glj'] / 100;
                    } else {

                    }


                    if ($b3) {
                        //echo $b3;
                        //return false;
                        $users->where(" user_id = '{$uinfo['user_id']}' ")->setInc('b3', $b3);
                        $this->bonus_laiyuan($uinfo['user_id'], $uinfo['user_name'], $user_id, $user_name, 3, $b3, "领导奖");
                    }
                }
			}
            }
//        }
       $this->bonus();
    }

/*
	 * 购物推荐奖 b8
	 */

	public function buytuijian($user_id,$lsk){
		$users = M('users');
		$user = $this->getUserbyID( $user_id );
		if($user['buynum'] > 1){
			$member_update['buymoney'] = $lsk;
		   $users->where("user_id = '{$user_id}'")->save($member_update);
		}
        $centerinfo = M('bonus_info')->where("id = 1")->find();
        $b8 = $lsk*$centerinfo['buytj']/100;
        if($user['grant'] == 1) {
            if ($user['pid']) {
                $userpid = $this->getUserbyID($user['pid']);
                if ($userpid['shoptype'] == '2' && $user['shoptype'] == '1') {
                    $b7 = $lsk * $centerinfo['buygl'] / 100;
                    $this->bonus_laiyuan($user['pid'], $user['rusername'], $user['user_id'], $user['user_name'], 7, $b7, "区域管理奖");
                }
                $this->bonus_laiyuan($user['pid'], $user['rusername'], $user['user_id'], $user['user_name'], 8, $b8, "购物推荐奖");
                $this->bonus();
            }
        }
	}


    /*
     * 量奖 日封顶
     * 测  M000007 50元
     */

    function ljdateCap($user_id,$newmey) {

        $user = $this->getUserbyID ( $user_id );
        $bonus = $this->getdaybonus($user_id);

        $ulevel_jine = $user['lsk']; // 得到封顶

        $mey = $ulevel_jine - $bonus ['b2'];

        if($mey>0){
            if($mey>$newmey){
                return array($newmey,0);
            }elseif($mey==$newmey){
                return array($newmey,1);
            }else{
                return array($mey,1);
            }
        }else{
            return array(0,1);
        }
    }



    /*
     * 层奖 日封顶
     * 测  M000007 50元 
     * 返回2元素的一维数组，第一个元素表示 层奖金额，第二个元素为1时表示封顶，否则表示不封顶。
     */

    function cjdateCap($user_id,$newmey) {

        $user = $this->getUserbyID ( $user_id );
        $bonus = $this->getdaybonus($user_id);

        $ulevel_jine = $user['lsk']; // 得到封顶

        $mey = $ulevel_jine - $bonus ['b1'];

        if($mey>0){
            if($mey>$newmey){
                return array($newmey,0);
            }elseif($mey==$newmey){
                return array($newmey,1);
            }else{
                return array($mey,1);
            }
        }else{
            return array(0,1);
        }
    }


    /*
     * 保单奖 3%-5% B8
     */

    function baodan($user_id,$user_name,$yuser_id,$yuser_name,$lsk){
        $users = M('users');
        $centerinfo = M('centerlists')->where("user_id = '{$yuser_id}'")->find();
        $b8 = $lsk*$centerinfo['reward']/100;
        $users -> where(" user_id = '{$yuser_id}' ") -> setInc('b8',$b8);
        $this->bonus_laiyuan($yuser_id,$yuser_name,$user_id,$user_name,8,$b8,"报单激活会员");
        $this->bonus();
    }

    /*
     * 获取该用户当前时间内 所获取的总收入
     */
    function getdaybonus($user_id){
        $where['year(bdate)'] = date("Y");
        $where['month(bdate)'] = date("m");
        $where['day(bdate)'] = date("d");
        $where['user_id'] = $user_id;
        $info =  M('bonus')->where($where)->find();
        return $info;
    }

    /*
     * 奖金统计
     */
    public function bonus(){
        $users = M('users');
        $bonusinfo = $this->getBonusinfo();
        $lj=0;
        $user_info = $users->where('b1>0 or b2>0 or b3>0 or b4>0 or b5>0 or b6>0 or b7>0 or b8>0')->select();

        if($user_info){
                $txb=$bonusinfo['first_tx'];//奖金币(提现)
                $gwb=$bonusinfo['first_gw'];//购物币
                $axjj=$bonusinfo['first_axjj'];//爱心基金币
                $shuishou=$bonusinfo['shuishou'];//税收
                $sql=0;
                $lx=1; //产生数据条数,0产生N条,1每日产生1条
                $did=$this->bonustime_insert($lx);

                foreach ($user_info as $uinfo){


                    $member_update=NULL;
                    $b1=$uinfo['b1'];
                    $b2=$uinfo['b2'];
                    $b3=$uinfo['b3'];
                    $b4=$uinfo['b4'];
                    $b5=$uinfo['b5'];
                    $b6=$uinfo['b6'];
                    $b7=$uinfo['b7'];
                    $b8=$uinfo['b8'];


                    $b0=$b1+$b2+$b3+$b4+$b5+$b6+$b7+$b8;
                    $member_update['b0']=0;
                    $member_update['b1']=0;
                    $member_update['b2']=0;
                    $member_update['b3']=0;
                    $member_update['b4']=0;
                    $member_update['b5']=0;
                    $member_update['b6']=0;
                    $member_update['b7']=0;
                    $member_update['b8']=0;
                    $member_update['mey']=$uinfo['mey']+$b0;
                    $member_update['maxmey']=$uinfo['maxmey']+$b0;

                    $member_update['jjb']=$uinfo['jjb']+$b0*$txb/100;
                    $member_update['gwb']=$uinfo['gwb']+$b0*$gwb/100;
                    $member_update['axjj']=$uinfo['axjj']+$b0*$axjj/100;
                    $member_update['sh']=$uinfo['sh']+$b0*$shuishou/100;


                    $users->where("user_id = '{$uinfo['user_id']}'")->save($member_update);

                    $bonus_update['date_id']=$did;

                    $bonus_update ['user_id'] = $uinfo ['user_id'];
                    $bonus_update ['user_name'] = $uinfo ['user_name'];
                    $bonus_update['b0']=$b0;
                    $bonus_update['b1']=$b1;
                    $bonus_update['b2']=$b2;
                    $bonus_update['b3']=$b3;
                    $bonus_update['b4']=$b4;
                    $bonus_update['b5']=$b5;
                    $bonus_update['b6']=$b6;
                    $bonus_update['b7']=$b7;
                    $bonus_update['b8']=$b8;
                    $bonus_update['tx']=$member_update['jjb'];
                    $bonus_update['jf']=$member_update['gwb'];
                    $bonus_update['ax']=$member_update['axjj'];
                    $bonus_update['sh']=$member_update['sh'];


                    $lj=$lj+$b0;
                    if($b0>0){
                     $this->bonus_insert($lx,$bonus_update);
                    }
                }
        }
        $this->yejitongji(0,0,0,$lj,0,0,0,$member_update['jjb']);
    }


    /*
    * @lx 0产生多条数据，1每天产生1条
    */
    function bonustime_insert($lx) {
        $bonustime =M('bonustime');
        $where['year(jsdate)'] = date("Y");
        $where['month(jsdate)'] = date("m");
        $where['day(jsdate)'] = date("d");
        if ($lx == 1) {
            $bonusinfo = $bonustime->where($where)->find();
            if ($bonusinfo) {
                $did = $bonusinfo ['id'];
            } else {
                $bonustime_update['jsdate'] = date('Y-m-d H:i:s',time());
                $bonustime_update['jslx'] = '1';
                $did = $bonustime->add($bonustime_update);
            }
        } else if ($lx == 0) {
            $bonustime_update['jsdate'] = date('Y-m-d H:i:s',time());
            $bonustime_update['jslx'] = '1';
            $did = $bonustime->add($bonustime_update);
        }
        return $did;
    }


    /*
    * @lx 0产生多条数据，1每天产生1条,必须与bonustime的lx同步
    */

    public function bonus_insert($lx, $_bonus) {
        $bonus =M('bonus');
        $where['year(bdate)'] = date("Y");
        $where['month(bdate)'] = date("m");
        $where['day(bdate)'] = date("d");
        $where['user_id'] = $_bonus['user_id'];

        if ($lx == 1) {
            $bonusinfo = $bonus->where($where)->find();

            if ($bonusinfo['id']) {
                $bonus_update =array();

                $bonus_update['b0'] = $bonusinfo['b0'] + $_bonus['b0'];
                $bonus_update['b1'] = $bonusinfo['b1'] + $_bonus['b1'];
                $bonus_update['b2'] = $bonusinfo['b2'] + $_bonus['b2'];
                $bonus_update['b3'] = $bonusinfo['b3'] + $_bonus['b3'];
                $bonus_update['b4'] = $bonusinfo['b4'] + $_bonus['b4'];
                $bonus_update['b5'] = $bonusinfo['b5'] + $_bonus['b5'];
                $bonus_update['b6'] = $bonusinfo['b6'] + $_bonus['b6'];
                $bonus_update['b7'] = $bonusinfo['b7'] + $_bonus['b7'];
                $bonus_update['b8'] = $bonusinfo['b8'] + $_bonus['b8'];
                $bonus_update['tx'] =  $_bonus['tx'];
                $bonus_update['jf'] =  $_bonus['jf'];
                $bonus_update['ax'] =  $_bonus['ax'];
                $bonus_update['sh'] =  $_bonus['sh'];
                $bonus->where(" user_id = '{$bonusinfo['user_id']}'")->save($bonus_update);
            } else {

                $bonus_update ['bdate'] = date('Y-m-d H:i:s',time());
                $bonus_update ['date_id'] = $_bonus ['date_id'];
                $bonus_update ['user_id'] = $_bonus ['user_id'];
                $bonus_update ['user_name'] = $_bonus ['user_name'];
                $bonus_update ['b0'] = $_bonus['b0'];
                $bonus_update ['b1'] = $_bonus['b1'];
                $bonus_update ['b2'] = $_bonus['b2'];
                $bonus_update ['b3'] = $_bonus['b3'];
                $bonus_update ['b4'] = $_bonus['b4'];
                $bonus_update ['b5'] = $_bonus['b5'];
                $bonus_update ['b6'] = $_bonus['b6'];
                $bonus_update ['b7'] = $_bonus['b7'];
                $bonus_update ['b8'] = $_bonus['b8'];
                $bonus_update ['tx'] =  $_bonus['tx'];
                $bonus_update ['jf'] =  $_bonus['jf'];
                $bonus_update ['ax'] =  $_bonus['ax'];
                $bonus_update ['sh'] =  $_bonus['sh'];
                $bonus->add($bonus_update);
            }
        }else if($lx == 0) {

            $bonus_update = NULL;
            $bonus_update['bdate'] = date('Y-m-d H:i:s',time());
            $bonus_update['date_id'] = $_bonus['date_id'];
            $bonus_update['user_id'] = $_bonus['user_id'];
            $bonus_update['user_name'] = $_bonus['user_name'];
            $bonus_update['yuser_id'] = $_bonus['yuser_id'];
            $bonus_update['yuser_name'] = $_bonus['yuser_name'];
            $bonus_update['b0'] = $_bonus['b0'];
            $bonus_update['b1'] = $_bonus['b1'];
            $bonus_update['b2'] = $_bonus['b2'];
            $bonus_update['b3'] = $_bonus['b3'];
            $bonus_update['b4'] = $_bonus['b4'];
            $bonus_update['b5'] = $_bonus['b5'];
            $bonus_update['b6'] = $_bonus['b6'];
            $bonus_update['b7'] = $_bonus['b7'];
            $bonus_update['b8'] = $_bonus['b8'];
            $bonus_update['tx'] =  $_bonus['tx'];
            $bonus_update['jf'] =  $_bonus['jf'];
            $bonus_update['ax'] =  $_bonus['ax'];
            $bonus_update['sh'] =  $_bonus['sh'];
            $bonus->add($bonus_update);
        }
    }

    /*
     * 写入奖金来源
     * $user_id 发送的会员ID
	 * $user_name 发送的会员名
	 * $yuser_id 收到的会员ID
	 * $yuser_name 收到的会员名
	 * $type 类型
	 * $beizhu 备注
	 * $jine 金额
	*/

    public function bonus_laiyuan($user_id, $user_name, $yuser_id, $yuser_name, $type, $jine, $beizhu) {
        $bonusinfo = $this->getBonusinfo();
		$broke =M('broke_record');

        $txb=$bonusinfo['first_tx'];//奖金币(提现)
        $gwb=$bonusinfo['first_gw'];//购物币
        $axjj=$bonusinfo['first_axjj'];//爱心基金币
        $shuishou=$bonusinfo['shuishou'];//税收
        $bonuslaiyuan = NULL;
        $bonuslaiyuan['user_id'] = $user_id;
        $bonuslaiyuan['user_name'] = $user_name;
        $bonuslaiyuan['yuser_id'] = $yuser_id;
        $bonuslaiyuan['yuser_name'] = $yuser_name;
        $bonuslaiyuan['type'] = $type;
        $bonuslaiyuan['fee'] = $jine;
        $bonuslaiyuan['tx'] = $jine*$txb/100;
        $bonuslaiyuan['jf'] = $jine*$gwb/100;
        $bonuslaiyuan['ax'] = $jine*$axjj/100;
        $bonuslaiyuan['sh'] = $jine*$shuishou/100;
        $bonuslaiyuan['bdate'] = date('Y-m-d H:i:s',time());
        $bonuslaiyuan['desc'] = $beizhu;
		//return var_dump($bonuslaiyuan);
        $broke->add($bonuslaiyuan);
	//	return  $broke->getlastsql();
    }

    /*
     * 写入订单来源
     * $user_id 发送的会员ID
     * $user_name 发送的会员名
     * $yuser_id 收到的会员ID
     * $yuser_name 收到的会员名
     * $type 类型
     * $beizhu 备注
     * $jine 金额
    */

    public function bonus_xiaofei($user_id, $user_name, $yuser_id, $yuser_name, $jine, $beizhu) {

        $bonuslaiyuan = NULL;
        $bonuslaiyuan ['user_id'] = $user_id;
        $bonuslaiyuan ['user_name'] = $user_name;
        $bonuslaiyuan ['yuser_id'] = $yuser_id;
        $bonuslaiyuan ['yuser_name'] = $yuser_name;
        $bonuslaiyuan ['type'] = '7';
        $bonuslaiyuan ['fee'] = $jine;
        $bonuslaiyuan ['bdate'] = date('Y-m-d H:i:s',time());
        $bonuslaiyuan ['desc'] = $beizhu;
        M('broke_record')-> add($bonuslaiyuan);
        $this->yejitongji(0,0,0,0,0,0,$jine,0);
    }

    /*
	*xzhy 新增会员数量
	*xzyj 新增业绩
	*xzdan 新增会员单数
	*ff 积分发放
	*tx 提现
	*cz 充值
	*dd 订单
	*/
    public  function yejitongji($xzhy,$xzdan,$xzyj,$ff,$tx,$cz,$dd,$txjj){

        $systemyeji =M('systemyeji');
        $where['year(ydate)'] = date("Y");
        $where['month(ydate)'] = date("m");
        $where['day(ydate)'] = date("d");
        $bonusinfo = $systemyeji->where($where)->find();
        if ($bonusinfo){
            $systemyeji_update['xzhy']=$bonusinfo['xzhy']+$xzhy;
            $systemyeji_update['zhy']=$bonusinfo['zhy']+$xzhy;
            $systemyeji_update['xzdan']=$bonusinfo['xzdan']+$xzdan;
            $systemyeji_update['zdan']=$bonusinfo['zdan']+$xzdan;
            $systemyeji_update['xzyj']=$bonusinfo['xzyj']+$xzyj;
            $systemyeji_update['zyj']=$bonusinfo['zyj']+$xzyj;
            $systemyeji_update['ff']=$bonusinfo['ff']+$ff;
            $systemyeji_update['zff']=$bonusinfo['zff']+$ff;
			$systemyeji_update['txjj']=$bonusinfo['txjj']+$txjj;
            $systemyeji_update['ztxjj']=$bonusinfo['ztxjj']+$txjj;
            $systemyeji_update['tx']=$bonusinfo['tx']+$tx;
            $systemyeji_update['cz']=$bonusinfo['cz']+$cz;
            $systemyeji_update['dd']=$bonusinfo['dd']+$dd;
            $systemyeji->where(" id = '{$bonusinfo['id']}'")->save($systemyeji_update);

        }else{
            $systeminfo = $systemyeji->find();
            if($systeminfo){
                $zzz =$systemyeji->field('sum(xzhy),sum(xzdan),sum(xzyj),sum(ff),sum(txjj)')->find();
            }else{
                $zzz=array(0,0,0,0,0);
            }
            $_systemyeji['ydate']=date('Y-m-d H:i:s',time());
            $_systemyeji['xzhy']=$xzhy;
            $_systemyeji['zhy']=$xzhy+$zzz['sum(xzhy)'];
            $_systemyeji['xzdan']=$xzdan;
            $_systemyeji['zdan']=$xzdan+$zzz['sum(xzdan)'];
            $_systemyeji['xzyj']=$xzyj;
            $_systemyeji['zyj']=$xzyj+$zzz['sum(xzyj)'];
            $_systemyeji['ff']=$ff;
            $_systemyeji['zff']=$ff+$zzz['sum(ff)'];
			$_systemyeji['txjj']=$txjj;
            $_systemyeji['ztxjj']=$txjj+$zzz['sum(txjj)'];
            $_systemyeji['tx']=$tx;
            $_systemyeji['cz']=$cz;
            $_systemyeji['dd']=$dd;
            $systemyeji-> add($_systemyeji);
        }
    }

    /*
    * 业绩计算
    */

    function addArea($userid,$money){
        $users = M('users');
        $row = $users->where(" user_id = '$userid'")->find();
        if ($row){
            if ($fman=$this->getUserbyID($row['parentid'])){
                switch($row['area']){
                    case 1:
                        $fman_update['area1']=$fman['area1']+$money; #总业绩
                        $fman_update['yarea1']=$fman['yarea1']+$money; #结余业绩
                        break;
                    case 2:
                        $fman_update['area2']=$fman['area2']+$money; #总业绩
                        $fman_update['yarea2']=$fman['yarea2']+$money; #结余业绩

                        break;
                    case 3:
                        $fman_update['area2']=$fman['area2']+$money; #总业绩
                        $fman_update['yarea2']=$fman['yarea2']+$money; #结余业绩
                        break;
                    default:
                        break;
                }
                $fid = $fman['user_id'];
                $res = $users -> where(" user_id = '$fid' ") -> save($fman_update);
                $this->addArea($fman['user_id'],$money);
            }
        }
    }



    /*
     * $user_id
     * 查询会员详细信息
     * return $info
     */

    public function getUserbyID($user_id){
        $info =  M('users')->where(" user_id = '{$user_id}' ")->find();
        return $info;
    }

    /*
     *
     * 查询奖金基础配置
     * return $info
     */

    public function getBonusinfo(){
        $info =  M('bonus_info')->where(" id = 1 ")->find();
        return $info;
    }

    /*
     * $level
     * 查询会员级别
     * return $levelinfo['reward']
    */

    protected  function getlevel($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo['reward'];
    }

    protected  function getlevelinfo($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo;
    }
    /*
     * $level
     * 查询会员 日封顶金额
     * return $levelinfo['reward']
    */

    protected  function getlevelCap($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo['capdaymoney'];
    }

    /*
     * $level
     * 查询会员 见点层
     * return $levelinfo['jd_layer']
    */

    protected  function getlevelceng($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo['jd_layer'];
    }
    /*
     * $user_id
     * 得到安置关系链
     * return $info
    */

    function ppath($user_id){
        $us=$this->getUserbyID($user_id);
        $ppath=$us['ppath'];
        $len=strlen($ppath);
        $str=substr($ppath,0,$len-1);//$len-16
        $arr=explode(",",$str);
        return $arr;
    }

}

