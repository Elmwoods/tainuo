<?php
if(!defined("ni8")) exit("Access Denied");
class WtsAction extends PublicAction {
//初始化
public function _initialize(){ 
     $this->webset=$this->finds('Web','id=1','id desc',true);
	 $this->wxset=$this->finds('Weixin','id=1','id desc');
}	
//首页
public function index(){	
	$this->token=$this->wxset['token'];
	$this->appid=$this->wxset['appid'];
	$this->appsecret=$this->wxset['appsecret'];
	$this->access_token=$this->wxset['access_token'];
	$this->gxtime=$this->wxset['gxtime'];
	$this->kfz=$this->wxset['kfz'];
	
	$action=$_GET['action'];
	if (!empty($action)) {
		$wechatObj = $this->$action();
	}else {			
		if ($this->kfz == 0) {
			$this->valid();// 成为开发者
		}else{				
			$this->responseMsg();// 获取用户发送自动回复信息
		}
	}
}
// 获取用户发送自动回复信息开始
public function responseMsg() {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];		
		$this->log_resultall($postStr);//获取信息
		if (!empty($postStr)) {
			// 处理开始
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
			// 公共
			$this->fromUsername = $postObj->FromUserName; //发送者
			$this->toUsername = $postObj->ToUserName; //接受者               
			$this->msgtime = $postObj->CreateTime; //时间
			$this->msgtype = $postObj->MsgType; //类型
			$this->msgid = $postObj->MsgId; //消息id
			$this->hqcontent = $postObj->Content;
			$this->times = time();
			$this->addtime = date("Y-m-d H:i:s");
			
			// 更新活跃时间
			//$nr = array();
			//$sj = (array)$this->msgtime;
			//$nr['gxtime'] = $sj[0];
			//$this->save('user',$nr,"username='".$this->fromUsername."'");
			// 判断类型
			if ($this->msgtype == 'text') {
				$keyword = trim($postObj->Content); //内容
				if (!empty($keyword)) {
					// 关键字回复开始
					$keylist = $this->lb('weixinkey', "passed=1 and userid=1", 'id desc');
					$pp = 0;
					foreach($keylist as $key => $value) {
						$keys = str_replace('\\', '', $value['keys']);
						$keys = (json_decode($keys, true));
						foreach($keys as $k => $v) {
							if ($v['matchMode'] == 1) {
								if ($v['keyword'] == $keyword) $pp = 1;
							}else {
								if (stripos($v['keyword'], $keyword) > -1) $pp = 1;
							}
							$this->log_resultall('pp='.$v['keyword']);
							if ($pp == 1) {
								if ($value['style'] == '0') {
									$this->content = $value['content'];
									$resultStr = $this->text();
								}else {
									$con = str_replace('\\', '', $value['content']);
									$con = (json_decode($con, true));
									$t1 = "";
									$sl = count($con);
									foreach($con as $k1 => $v1) {
										$t1 .= "
									<item>
									<Title><![CDATA[" . $v1["title"] . "]]></Title> 
									<Description><![CDATA[" . $v1["title"] . "]]></Description>
									<PicUrl><![CDATA[".C("pic_url") . str_replace("../", "", $v1["imgUrl"]) . "]]></PicUrl>
									<Url><![CDATA[" . $v1["urlTitle"] . "]]></Url>
									</item>
									";
									}
									$this->content = $t1;
									$resultStr = $this->news($sl);
								}
								$this->log_resultall($resultStr);
								echo $resultStr;
								exit;
							}
						}
					}
					if ($pp == 0) {
					    $this->getkf();
						// 没有找到发送消息
						$value = $this->finds('weixink', ' userid=1 and qy=1 ', 'id asc'); //1
						if ($value['style'] == '0') {
							$this->content = $value['content'];
							$resultStr = $this->text();
						}else {
							$con = str_replace('\\', '', $value['content']);
							$con = (json_decode($con, true));
							$t1 = "";
							$sl = count($con);
							foreach($con as $k1 => $v1) {
								$t1 .= "
										<item>
										<Title><![CDATA[" . $v1["title"] . "]]></Title> 
										<Description><![CDATA[" . $v1["title"] . "]]></Description>
										<PicUrl><![CDATA[".C("pic_url") . str_replace("../", "", $v1["imgUrl"]) . "]]></PicUrl>
										<Url><![CDATA[" . $v1["urlTitle"] . "]]></Url>
										</item>
										";
							}
							$this->content = $t1;
							$resultStr = $this->news($sl);
						}
						$this->log_resultall($resultStr);
						echo $resultStr;
						exit;
					} 
					// end
				}else {
					echo "Input something...";
				}
			}elseif ($this->msgtype == 'image') {
				// 图片
				// $picurl =$postObj->PicUrl;//图片链接
				// $mediaid =$postObj->MediaId;//图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
			}elseif ($this->msgtype == 'voice') {
				// 语音
				// $mediaid =$postObj->MediaId;//语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
				// $format =$postObj->Format;//语音格式，如amr，speex等
				// $recognition =$postObj->Recognition;//语音识别结果，UTF8编码接收语音识别结果
			}elseif ($this->msgtype == 'video') {
				// 视频
				// $mediaid =$postObj->MediaId;//视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
				// $thumbmediatd =$postObj->ThumbMediaId;//视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
			}elseif ($this->msgtype == 'location') {
				// 地理位置
				// $l_x =$postObj->Location_X;//地理位置维度
				// $l_y =$postObj->Location_Y;//地理位置经度
				// $scale =$postObj->Scale;//地图缩放大小
				// $label =$postObj->Label;//地理位置信息
			}elseif ($this->msgtype == 'link') {
				// 链接消息
				// $title =$postObj->Title;//消息标题
				// $description =$postObj->Description;//消息描述
				// $url =$postObj->Url;//消息链接
			}elseif ($this->msgtype == 'event') {
			
				// 接收事件
				$event = $postObj->Event; //事件类型，subscribe(订阅)、unsubscribe(取消订阅) 
				$eventkey = $postObj->EventKey; //1事件KEY值，qrscene_为前缀，后面为二维码的参数值 2 SCAN事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id
				$ticket = $postObj->Ticket; //1二维码的ticket，可用来换取二维码图片
				if ($event == "subscribe") {
				
					// 首次关注
					$value = $this->finds('weixink', ' userid=1 and qy=0 ', 'id asc'); //1
					if ($value['style'] == '0') {
						$this->content = $value['content'];
						$resultStr = $this->text();
					}else {
						$con = str_replace('\\', '', $value['content']);
						$con = (json_decode($con, true));
						$t1 = "";
						$sl = count($con);
						foreach($con as $k1 => $v1) {
							$t1 .= "<item>
							        <Title><![CDATA[" . $v1["title"] . "]]></Title> 
                                    <Description><![CDATA[" . $v1["title"] . "]]></Description>
                                    <PicUrl><![CDATA[".C("pic_url"). str_replace("../", "", $v1["imgUrl"]) . "]]></PicUrl>
                                    <Url><![CDATA[" . $v1["urlTitle"] . "]]></Url>
                                     </item>";
						}
						$this->content = $t1;
						$resultStr = $this->news($sl);
					} 
					// 添加会员
					$fromid = (array)$this->fromUsername;
					$tj = explode('_',$eventkey);
					$fuser = $this->finds('user', " username='" . $this->fromUsername . "' and qy=1 ", 'id asc');
					if (!$fuser) { // 没有找到
						$yy = str_replace("-", "", date("Y-m-d"));
						$yy1 = str_replace(":", "", date("H:i:s"));
						$inBillNo = md5($yy . "-" . $yy1);

						$nr = array();
						$nr['username'] = $fromid[0];
						$nr['regtime'] = date("Y-m-d H:i:s",json_decode($this->msgtime, true));
						$nr['gztime'] = date("Y-m-d H:i:s",json_decode($this->msgtime, true));
						$nr['LastLoginTime'] = $this->addtime;
						$nr['LoginTimes'] = 1;
						$nr['passed'] = 1;
						$nr['codee'] = $inBillNo;
						$nr['qy'] = 1;
						$nr['subscribe'] = 1;
						$arr=$this->usertj((int)$tj['1']);
						$nr['prv_id'] = (int)$arr['prv_id'];
						$nr['prv_link'] = $arr['prv_link'];
						$ret = $this->add("user", $nr); 

						// 更新会员信息
						$access_tokens = $this->token();
						$src = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_tokens . '&openid=' . $this->fromUsername . '&lang=zh_CN';
						$touser = $this->curlget($src);
						$touser = json_decode($touser, true);
						$name = $touser['nickname'];
						$sex = $touser['sex'];
						$sex=($sex==1)?0:1;
						$wxaddress = $touser['city'].$touser['province'].$touser['country'];						
						$headimgurl = $touser['headimgurl'];
						$name = str_replace("\xF09F92A2", '', $name);
						$name = htmlspecialchars($name);
						$nr = array();
						$nr['nickname'] = $name;
						$nr['sex'] = (int)$sex;
						$nr['wxaddress'] = $wxaddress;
						$nr['headimgurl'] = $headimgurl;
						$this->save('user', $nr, "username='" . $this->fromUsername . "' and qy=1");
						$tjuser = $this->finds('user', " id=".(int)$tj['1']." and qy=1 ", 'id asc');
						if ($tjuser) {
							$this->sendmsg($tjuser['username']);	
						}
					} else {
						// 已在用户表中
						$nr = array();
						$nr['subscribe'] = 1;
						$nr['gztime'] = date("Y-m-d H:i:s");
						$this->save('user', $nr, "username='" . $this->fromUsername . "' and qy=1");
						$my = $this->finds('user', "username='" . $this->fromUsername . "' and qy=1 ", 'id asc');
						if ($my['prv_id']) {
							$tjuser = $this->finds('user', " id=".(int)$my['prv_id']." and qy=1 ", 'id asc');
							if ($tjuser) {
								$this->sendmsg($tjuser['username']);	
							}
						}
					} 
					$this->log_resultall($resultStr);
					echo $resultStr;
					exit;
				}elseif ($event == "unsubscribe") {
					// 取消订阅开始
					$nr = array();
					$nr['subscribe'] = 0;
					$this->save('user', $nr, "username='" . $this->fromUsername . "' and qy=1"); //1					
				}elseif ($event == "SCAN") {
					// 已关注时的事件推送
				}elseif ($event == "LOCATION") {
					// 用户同意上报地理位置
					$latitude = (array)$postObj->Latitude; //地理位置纬度 
					$longitude = (array)$postObj->Longitude; //地理位置经度
					$precision = (array)$postObj->Precision; //地理位置精度
					$nr = array();
					$nr['latitude'] = $latitude[0];
					$nr['longitude'] = $longitude[0];
					$nr['precisions'] = $precision[0];
					$nr['gxtime'] = $this->msgtime;
					//$this->save('weixuser', $nr, "openid='" . $this->fromUsername . "' and userid=1"); 
				}elseif ($event == "CLICK") {
					// 点击菜单拉取消息时的事件推送
					// EventKey 	事件KEY值，与自定义菜单接口中KEY值对应
					$eventkey = explode("_", $eventkey);
					$id = (int)$eventkey[1];

					$value = $this->finds('weixmenu', ' userid=1 and id=' . $id . ' ', 'id asc'); //1
					if ($value['style'] == '0') {
						$this->content = $value['content'];
						$resultStr = $this->text();
					}elseif ($value['style'] == '1') {
						$con = str_replace('\\', '', $value['content']);
						$con = (json_decode($con, true));
						$t1 = "";
						$sl = count($con);
						foreach($con as $k1 => $v1) {
							$t1 .= "<item><Title><![CDATA[" . $v1["title"] . "]]></Title> 
                                    <Description><![CDATA[" . $v1["title"] . "]]></Description>
									<PicUrl><![CDATA[".C("pic_url"). str_replace("../", "", $v1["imgUrl"]) . "]]></PicUrl>
                                    <Url><![CDATA[" . $v1["urlTitle"] . "]]></Url>
                                    </item>";
						}
						$this->content = $t1;
						$resultStr = $this->news($sl);
					}
					$this->log_resultall($resultStr);
					echo $resultStr;
					if($value['mtitle']=="在线客服")$this->getkf();
					exit;
				}elseif ($event == "VIEW") {
					// 点击菜单跳转链接时的事件推送
					// EventKey 	事件KEY值，设置的跳转URL
				}elseif ($event == "MASSSENDJOBFINISH") {
					// 事件推送群发结果
					// $Status=$postObj->Status;//群发的结构
					// $TotalCount=$postObj->TotalCount;//group_id下粉丝数；或者openid_list中的粉丝数
					// $FilterCount =$postObj->FilterCount ;//过滤
					// $SentCount=$postObj->SentCount;//发送成功的粉丝数
					// $ErrorCount =$postObj->ErrorCount ;//发送失败的粉丝数
				} 
				// 接收事件end
			} 
			// 处理结束
		}else {
			echo "";
			exit;
		}
	} 
// 发送文字//
public function text() {
	$textTpl ="<xml>
               <ToUserName><![CDATA[%s]]></ToUserName>
               <FromUserName><![CDATA[%s]]></FromUserName>
               <CreateTime>%s</CreateTime>
               <MsgType><![CDATA[%s]]></MsgType>
               <Content><![CDATA[%s]]></Content>
               <FuncFlag>0</FuncFlag>
               </xml>";
		$msgType = "text";
		$contentStr = $this->content;
		$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, $this->times, $msgType, $contentStr);
		return $resultStr;
	} 

// 发送图片//
public function news($sl) {
		$picTpl = "<xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <ArticleCount>%s</ArticleCount>
                   <Articles>%s</Articles>
                   </xml> ";
		$msgType = "news";
		$t1 = $this->content;
		$resultStr = sprintf($picTpl, $this->fromUsername, $this->toUsername, $this->times, $msgType, $sl, $t1);
		return $resultStr;
} 

// 发送微信消息//
public function sendmsg($openid) {
		$access_tokens = $this->token();
		$src = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=" . $access_tokens;
		$date = '{
		"touser":"'.$openid.'", 
		"text":{           
		"content":"恭喜您!\n您的推荐人关注了'.$this->wxset['wxname'].'公众号,他的购买将会给你带来一定福利.<a href=\"'.C("web_url").__APP__.'/usersale\">请点击进入我的客户查看</a>"            
		},     
		"msgtype":"text"
		}';
		$ret = $this->curlpost($date, $src); 
		$this->log_resultall($ret);
}
//客服
public function getkf(){
			    $value=$this->finds('kf',' passed=1 and kf_wx<>"" ','rand()');//1
				if($value){					
					$access_tokens=$this->token();
					$this->hqcontent=($this->hqcontent)?$this->hqcontent:"有新的咨询服务!";
					$src="https://api.weixin.qq.com/customservice/kfsession/create?access_token=".$access_tokens;
					$date='{
							"kf_account" :"'.$value["model"].$value["kfpre"].'",
							"openid" : "'.$this->fromUsername.'",
							"text" : "'.$this->hqcontent.'"
							}';
				   $this->curlpost($date,$src);	
				   //$this->content="等待客服帮你解答,谢谢!";
				   //$resultStr=$this->text();
				   //echo $resultStr;
				   exit;			   
				}
	}
// 获取access_token//
public function token() {
		if (empty($this->appid) || empty($this->appsecret)) {
			$gtoken = "";
		}else {
			$sjx = $this->gxtime + 7000;
			if (empty($this->access_token) || $sjx < ($this->times)) {
				$src = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appid . '&secret=' . $this->appsecret;
				$token = $this->curlget($src);
				$token = json_decode($token, true);
				$gtoken = $token['access_token'];
				$nr = array();
				$nr['access_token'] = $gtoken;
				$nr['gxtime'] = $this->times;
				$this->save('weixin', $nr, "id=1");
			}else {
				$gtoken = $this->access_token;
			}
		}
		return $gtoken;
} 

//////////////////////////////////////////////////////////////////	
// 成为开发者//
public function valid() {
		$echoStr = $_GET["echostr"];
		if ($this->checkSignature()) {
			echo $echoStr;
			exit;
		}
}

private function checkSignature() {
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature) {
			$nr = array();
			$nr['kfz'] = 1;
			$this->save('weixin', $nr, "id=1");	
			return true;
		}else {
			return false;
		}
} 
// 成为开发者//
}
?>