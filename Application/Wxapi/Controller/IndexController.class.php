<?php
namespace Wxapi\Controller;

use Think\Controller;
class IndexController extends Controller
{
	function index()
	{
		define('TOKEN', 'weixin');
		if (!isset($_GET['echostr'])) {
			$this->responseMsg();
		} else {
			$this->valid();
		}
	}
	public function valid()
	{
		$echoStr = $_GET["echostr"];
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$tmpArr = array(TOKEN, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature) {
			echo $echoStr;
			die;
		}
	}
	public function responseMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$RX_TYPE = trim($postObj->MsgType);
			switch ($RX_TYPE) {
				case "event":
					$result = $this->receiveEvent($postObj);
					break;
				case 'text':
					$result = $this->receiveText($postObj);
					break;
				case 'image':
					echo "";
					die;
					break;
				case 'location':
					echo "";
					die;
					break;
				case 'voice':
					echo "";
					die;
					break;
				case 'video':
					echo "";
					die;
					break;
				case 'link':
					echo "";
					die;
					break;
				default:
					echo "";
					die;
					break;
			}
			echo $result;
		} else {
			echo "";
			die;
		}
	}
	private function get_user_id($object)
	{
		$openid = $object->FromUserName;
		$users = M('users');
		$userinfo = $users->where(" openid = '{$openid}' ")->select();
		if ($userinfo == null) {
			$weixin = A("Wxapi/Weixin");
			$data = $weixin->get_user_info($openid);
			$user_id = $users->add($data);
		} else {
			if ($userinfo[0]['subscribe'] == 0) {
				$users->where(" openid = '{$openid}' ")->save(array("subscribe" => 1));
			}
			$user_id = $userinfo[0]['user_id'];
		}
		return $user_id;
	}
	private function save_user_path($object, $scene_id)
	{
		$users = M('users');
		$res = $users->field("user_id")->where(" openid = '{$object->FromUserName}' ")->find();
		if (!$res['user_id']) {
			$weixin = A("Wxapi/Weixin");
			$openid = $object->FromUserName;
			$data = $weixin->get_user_info($openid);
			$data['pid'] = $scene_id;
			$path_info = $users->field("pid,gid,openid,nickname")->where(" user_id = '{$scene_id}' ")->find();
			$weixin->send_word($path_info['openid'], "系统通知：\n\n您的一级会员「" . $data['nickname'] . "」已成功关注");
			$gid_user_id = $path_info['pid'];
			if ($gid_user_id > 0) {
				$data['gid'] = $gid_user_id;
				$gid_info = $users->field("openid,nickname")->where(" user_id = '{$gid_user_id}' ")->find();
				$weixin->send_word($gid_info['openid'], "系统通知：\n\n您的二级会员「" . $data['nickname'] . "」已成功关注\n\n您与ta的关系：\n您--「" . $path_info['nickname'] . "」--「" . $data['nickname'] . "」");
			}
			$oid_user_id = $path_info['gid'];
			if ($oid_user_id > 0) {
				$data['oid'] = $oid_user_id;
				$oid_info = $users->field("openid")->where(" user_id = '{$oid_user_id}' ")->find();
				$weixin->send_word($oid_info['openid'], "系统通知：\n\n您的三级会员「" . $data['nickname'] . "」已成功关注\n\n您与ta的关系：\n您--「" . $gid_info['nickname'] . "」--「" . $path_info['nickname'] . "」--「" . $data['nickname'] . "」");
			}
			$return = $users->add($data);
		} else {
			$return = $res['user_id'];
			$users->where(" user_id = '{$return}' ")->setField("subscribe", '1');
		}
		return '感谢您成为' . $return . "号会员，平台全体家人将竭诚为您服务！";
	}
	private function receiveEvent($object)
	{
		$content = "";
		switch ($object->Event) {
			case "subscribe":
				$subscribe = M('subscribe')->find();
				$scene_id = str_replace("qrscene_", "", $object->EventKey);
				if (empty($scene_id)) {
					$content = "您不是通过海报关注的，无法成为会员，请取消关注后扫描推广员宣传海报进行关注";
				} else {
					$users = M('users');
					$res = $users->field("user_id")->where(" openid = '{$object->FromUserName}' ")->find();
					if ($res['user_id']) {
						$id = $res['user_id'];
						$users->where(" user_id = '{$id}' ")->setField("subscribe", '1');
						$content = "感谢您成为" . $res['user_id'] . "号会员，平台全体家人将竭诚为您服务！\n" . $subscribe['content'];
					} else {
						$wechat = A("User/Wechat");
						$openid = $object->FromUserName;
						$result = $wechat->add_user_id($scene_id, $openid);
						$content = "感谢您成为" . $result . "号会员，平台全体家人将竭诚为您服务！\n" . $subscribe['content'];
					}
				}
				break;
			case 'unsubscribe':
				$content = "取消关注";
				$users = M('users');
				$users->where(" openid = '{$object->FromUserName}' ")->save(array("subscribe" => 0));
				break;
			case 'SCAN':
				break;
			case 'CLICK':
				$result = $this->receiveText($object);
				echo $result;
				die;
				break;
			case 'LOCATION':
				break;
			case 'VIEW':
				break;
			case 'MASSSENDJOBFINISH':
				break;
			default:
				break;
		}
		if (is_array($content)) {
			if (isset($content[0])) {
				$result = $this->transmitNews($object, $content);
			} else {
				if (isset($content['MusicUrl'])) {
					$result = $this->transmitMusic($object, $content);
				}
			}
		} else {
			if (empty($content)) {
				echo "success";
				die;
			}
			$result = $this->transmitText($object, $content);
		}
		return $result;
	}
	private function receiveText($object)
	{
		if ($object->Content) {
			$keyword = trim($object->Content);
		} else {
			$keyword = trim($object->EventKey);
		}
		if (strstr($keyword, "qr")) {
			$user_info = M('users')->field("user_id,agent")->where(" openid = '{$object->FromUserName}' ")->select();
			$user_id = $user_info[0]['user_id'];
			if ($user_info[0]['agent'] == 0) {
				$content = "您还未成为代理，不能生成推广海报，前去购买代理吧！";
			} else {
				if (S($user_id . 'qr')) {
					echo '';
					die;
				}
				S($user_id . 'qr', 1, 5);
				$weixin = A('Wxapi/Weixin');
				$weixin->send_word($object->FromUserName, "入口已关闭，在个人中心生成");
				die;
				$weixin->send_word($object->FromUserName, "后台正在自动合成宣传二维码，请稍后几秒~");
				$qrcode_info = M('qrcode')->getByUser_id($user_id);
				if (file_exists('Public/qr_path/' . $user_id . '.jpg')) {
					$media_id = $qrcode_info['media_id'];
					$time1 = time() - $qrcode_info['created_at'];
					if ($time1 >= 259200) {
						$media = $weixin->media_pic('Public/qr_path/' . $user_id . '.jpg');
						$data['created_at'] = $media['created_at'];
						$data['media_id'] = $media_id = $media['media_id'];
						M('qrcode')->where(" scene_id = '{$qrcode_info['scene_id']}' ")->save($data);
					}
					$time2 = time() - $qrcode_info['update_time'];
					if ($time2 >= 2592000 || $qrcode_info['update_time'] == 0) {
						$media_id = $weixin->get_qr_path_new($user_id, $qrcode_info[scene_id]);
					}
				} else {
					$media_id = $weixin->get_qr_path_new($user_id, $qrcode_info[scene_id]);
				}
				$content['MediaId'] = $media_id;
				$result = $this->transmitImage($object, $content);
				return $result;
				die;
			}
		} elseif ($keyword == '31426789075443') {
			$users = M('users');
			$openid = $object->FromUserName;
			$res = $users->field("user_id")->where(" openid = '{$openid}' ")->select();
			if (!$res[0]['user_id']) {
				$weixin = A("Wxapi/Weixin");
				$data = $weixin->get_user_info($openid);
				$users->add($data);
				$content = "success";
			}
		} else {
			$content = "";
			$where = array('keyword' => $keyword);
			$newsinfo = M('news')->where($where)->order("code asc")->select();
			if ($newsinfo) {
				$content = $newsinfo;
				foreach ($content as $key => $value) {
					$id = $value['id'];
					$content[$key]['url'] = "http://" . $_SERVER['SERVER_NAME'] . U('/Home/Wap/index') . "?id=" . $id;
					$content[$key]['pic_url'] = "http://" . $_SERVER['SERVER_NAME'] . $value['pic_url'];
					$res = M('news')->where(" id = '{$id}' ")->setInc('click', 1);
				}
			} else {
				$text = M('text');
				$textinfo = $text->where($where)->select();
				if ($textinfo) {
					$temp = array_rand($textinfo, 1);
					$content = $textinfo[$temp]['content'];
					$id = $textinfo[$temp]['id'];
					$res = $text->where(" id = '{$id}' ")->setInc('click', 1);
				} else {
					$custominfo = M('custom')->getByToken($token);
					if ($custominfo['switch'] == 1) {
						if ($custominfo['keyword']) {
							$where = array('keyword' => $custominfo['keyword']);
							$newsinfo = M('news')->where($where)->order("code asc")->select();
							if ($newsinfo) {
								$content = $newsinfo;
								foreach ($content as $key => $value) {
									$id = $value['id'];
									$content[$key]['url'] = "http://" . $_SERVER['SERVER_NAME'] . U('/Home/Wap/index') . "?id=" . $id;
									$content[$key]['pic_url'] = "http://" . $_SERVER['SERVER_NAME'] . $value['pic_url'];
								}
							} else {
								$content = "平台未做关键词图文回复";
							}
						} else {
							$content = $custominfo['content'];
						}
					} elseif ($custominfo['switch'] == 2) {
						$result = $this->transmitService($object);
						return $result;
						die;
					}
				}
			}
		}
		if (is_array($content)) {
			$result = $this->transmitNews($object, $content);
		} elseif (empty($content)) {
			echo "";
			die;
		} else {
			$result = $this->transmitText($object, $content);
		}
		return $result;
	}
	private function receiveImage($object)
	{
		$content = array("MediaId" => $object->MediaId);
		$result = $this->transmitImage($object, $content);
		return $result;
	}
	private function receiveLocation($object)
	{
		$content = "你发送的是位置，纬度为：" . $object->Location_X . "；经度为：" . $object->Location_Y . "；缩放级别为：" . $object->Scale . "；位置为：" . $object->Label;
		$result = $this->transmitText($object, $content);
		return $result;
	}
	private function receiveVoice($object)
	{
		if (isset($object->Recognition) && !empty($object->Recognition)) {
			$content = "你刚才说的是：" . $object->Recognition;
			$result = $this->transmitText($object, $content);
		} else {
			$content = array("MediaId" => $object->MediaId);
			$result = $this->transmitVoice($object, $content);
		}
		return $result;
	}
	private function receiveVideo($object)
	{
		$content = array("MediaId" => $object->MediaId, "ThumbMediaId" => $object->ThumbMediaId, "Title" => "", "Description" => "");
		$result = $this->transmitVideo($object, $content);
		return $result;
	}
	private function receiveLink($object)
	{
		$content = "你发送的是链接，标题为：" . $object->Title . "；内容为：" . $object->Description . "；链接地址为：" . $object->Url;
		$result = $this->transmitText($object, $content);
		return $result;
	}
	private function transmitText($object, $content)
	{
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $result;
	}
	private function transmitImage($object, $imageArray)
	{
		$itemTpl = "<Image>
		    <MediaId><![CDATA[%s]]></MediaId>
		</Image>";
		$item_str = sprintf($itemTpl, $imageArray['MediaId']);
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[image]]></MsgType>
		{$item_str}
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
		return $result;
	}
	private function transmitVoice($object, $voiceArray)
	{
		$itemTpl = "<Voice>
		    <MediaId><![CDATA[%s]]></MediaId>
		</Voice>";
		$item_str = sprintf($itemTpl, $voiceArray['MediaId']);
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[voice]]></MsgType>
		{$item_str}
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
		return $result;
	}
	private function transmitVideo($object, $videoArray)
	{
		$itemTpl = "<Video>
		    <MediaId><![CDATA[%s]]></MediaId>
		    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
		    <Title><![CDATA[%s]]></Title>
		    <Description><![CDATA[%s]]></Description>
		</Video>";
		$item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[video]]></MsgType>
		{$item_str}
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
		return $result;
	}
	private function transmitNews($object, $newsArray)
	{
		if (!is_array($newsArray)) {
			return;
		}
		$itemTpl = "    <item>
		        <Title><![CDATA[%s]]></Title>
		        <Description><![CDATA[%s]]></Description>
		        <PicUrl><![CDATA[%s]]></PicUrl>
		        <Url><![CDATA[%s]]></Url>
		    </item>
		";
		$item_str = "";
		foreach ($newsArray as $item) {
			$item_str .= sprintf($itemTpl, $item['title'], $item['desc'], $item['pic_url'], $item['url']);
		}
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[news]]></MsgType>
		<ArticleCount>%s</ArticleCount>
		<Articles>
		{$item_str}</Articles>
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
		return $result;
	}
	private function transmitMusic($object, $musicArray)
	{
		$itemTpl = "<Music>
		    <Title><![CDATA[%s]]></Title>
		    <Description><![CDATA[%s]]></Description>
		    <MusicUrl><![CDATA[%s]]></MusicUrl>
		    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
		</Music>";
		$item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[music]]></MsgType>
		{$item_str}
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
		return $result;
	}
	private function transmitService($object)
	{
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[transfer_customer_service]]></MsgType>
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
		return $result;
	}
	private function logger($log_content)
	{
		if (isset($_SERVER['HTTP_APPNAME'])) {
			sae_set_display_errors(false);
			sae_debug($log_content);
			sae_set_display_errors(true);
		} else {
			if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
				$max_size = 10000;
				$log_filename = "log.xml";
				if (file_exists($log_filename) and abs(filesize($log_filename)) > $max_size) {
					unlink($log_filename);
				}
				file_put_contents($log_filename, date('H:i:s') . " " . $log_content . "\r\n", FILE_APPEND);
			}
		}
	}
}