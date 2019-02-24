<?php
/**
* 	配置账号信息
*/

class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	static $addid = '';
	//受理商ID，身份标识
	static $mchid = '';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	static $key = '';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	static $appsecret = '';
	
//	const APPID = 'wxf530acf82693f5ab';
//	//受理商ID，身份标识
//	const MCHID = '1261962901';
//	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
//	const KEY = '6h9f4S6R8K7s8t65trgde67u76yt567y';
//	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
//	const APPSECRET = '2119c6747becfe8c9aaad3fcb8c0071b';
	
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = '';
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '/cacertcj/apiclient_cert.pem';
	const SSLKEY_PATH = '/cacertcj/apiclient_key.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = '';

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>