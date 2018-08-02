<?php
use think\Model; 
use think\Request;
use think\Session;
class qq extends Model{
	//回调地址
	public $return_url;
	public $app_id;
	public $app_secret;
	public function __construct($config){
		$this->return_url = "http://".$_SERVER['HTTP_HOST']."/user/loginApi/callback/oauth/qq";
		$this->app_id = $config['app_id'];
		$this->app_secret = $config['app_secret'];
	}
	//构造要请求的参数数组，无需改动
	public function login(){
        $state = md5(uniqid(rand(), TRUE));
        session('state',$state);
		//拼接URL
		$dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
			. $this->app_id . "&redirect_uri=" . urlencode($this->return_url) . "&state="
			. $state;
		echo("<script> top.location.href='" . $dialog_url . "'</script>");
	}

	public function respon(){
		if(input('state') == session('state'))
		{
			$code = input("code");
			//拼接URL
			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
				. "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->return_url)
				. "&client_secret=" . $this->app_secret . "&code=" . $code;

			$response = $this->get_contents($token_url);
			if (strpos($response, "callback") !== false)
			{
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error))
				{
					echo "<h3>error:</h3>" . $msg->error;
					echo "<h3>msg  :</h3>" . $msg->error_description;
					exit;
				}
			}

			//Step3：使用Access Token来获取用户的OpenID
			$params = array();
			parse_str($response, $params);

			$graph_url = "https://graph.qq.com/oauth2.0/me?access_token="
				.$params['access_token'];

			$str  = $this->get_contents($graph_url);
			if (strpos($str, "callback") !== false)
			{
				$lpos = strpos($str, "(");
				$rpos = strrpos($str, ")");
				$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
			}
			$user = json_decode($str);
			if (isset($user->error))
			{
				echo "<h3>error:</h3>" . $user->error;
				echo "<h3>msg  :</h3>" . $user->error_description;
				exit;
			}
			//获取到openid
			$openid = $user->openid;
			$userInfo = json_decode($this->get_user_info($params,$openid,$this->app_id),true);
			session('state',null);
			return array(
				'openid'=>$openid,//用户号
				'oauth'=>'qq',
				'sex'=>$userInfo['gender']=='男'?1:($userInfo['gender']=='女'?2:''),
				'nickname'=>$userInfo['nickname'],
				'avatar'=>$userInfo['figureurl_2']
			);
		}else{
			return false;
		}
	}
	public function get_user_info($params,$openid,$app_id){
        $params['access_token'];
        $url= "https://graph.qq.com/user/get_user_info?access_token=".$params['access_token']."&oauth_consumer_key=".$app_id."&openid=".$openid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response =  curl_exec($ch);
        curl_close($ch);
        //-------请求为空
        if(empty($response)){
            exit("50001");
        }
        return $response;
	}


	public function get_contents($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$response =  curl_exec($ch);
		curl_close($ch);
		//-------请求为空
		if(empty($response)){
			exit("50001");
		}
		return $response;
	}

}


?>
