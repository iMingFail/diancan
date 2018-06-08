<?php
class templateMessage
{
    function __construct()
    {

    }

    public function send_template_message($touser, $template_id, $postdata, $access_token, $url = '', $topcolor = '#FF683F')
    {
        $data = array();
        $data['person'] = 1;
        $data['speedd'] = 40;
        $data['touser'] = $touser;
        $data['template_id'] = trim($template_id);
        $data['url'] = trim($url);
        $data['topcolor'] = trim($topcolor);
        $data['data'] = $postdata;
        $data = json_encode($data);
        $posturl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        $res = $this->https_request($posturl, $data);
        return json_decode($res, true);
    }

    public function getYuyin($text){
        define('DEMO_CURL_VERBOSE', false);
        $apiKey = "g9rO5gfVxlgcs0GkBAHB4yFp";
        $secretKey = "3d3b1a5e6fdf4c7a5e1a710302e08824";

        //$text = "再创佳绩。";
        $text2 = iconv("UTF-8", "GBK", $text);
        //echo mb_strlen($text2, "GBK");

        #发音人选择, 0为普通女声，1为普通男生，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女声
        $per = 0;
        #语速，取值0-9，默认为5中语速
        $spd = 5;
        #音调，取值0-9，默认为5中语调
        $pit = 5;
        #音量，取值0-9，默认为5中音量
        $vol = 5;
        $t = time();
        file_put_contents('./baidu.yuyin.txt',$t);
        $token_time = file_get_contents('./baidu.yuyin.txt');
        $cuid = "123456PHP";
        if($t-86000>=$token_time){

            $auth_url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=".$apiKey."&client_secret=".$secretKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $auth_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 检查证书中是否设置域名,0不验证
            curl_setopt($ch, CURLOPT_VERBOSE, DEMO_CURL_VERBOSE);
            $res = curl_exec($ch);
            if(curl_errno($ch))
            {
                print curl_error($ch);
            }
            curl_close($ch);
            $response = json_decode($res, true);
            $token = $response['access_token'];

            file_put_contents('./baidu.yuyin.txt',$t);
            file_put_contents('./'.$t.".txt",$token);
        }else{
            $token = file_get_contents('./'.$token_time.".txt");
        }

        $params = array(
            'tex' => $text,
            'per' => $per,
            'spd' => $spd,
            'pit' => $pit,
            'vol' => $vol,
            'cuid' => $cuid,
            'tok' => $token,
            'lan' => 'zh', //固定参数
            'ctp' => 1, // 固定参数
        );

        $url = 'http://tsn.baidu.com/text2audio?' . http_build_query($params);
        return $url;
    }


    function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}