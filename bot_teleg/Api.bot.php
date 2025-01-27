<?php


class ApiBot {

    private $token;
    private $urlSendMessBot = "https://api.telegram.org/bot";

    function __construct($token)
    {
        if(!$token) return false;
        $this->token = $token; 
    }


    public function apiSendMessage($getQuery) {
        if(!$getQuery) return; 
        $ch = curl_init($this->urlSendMessBot. $this->token ."/sendMessage?" . http_build_query($getQuery));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function apiSendTG($response) {
        if(!$response) return; 
        $method = $response['method'];
        $ch = curl_init($this->urlSendMessBot. $this->token . '/' . $method);  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }


    // public function getApiRequest($props){
    //     if(!$props) return false;
    //     $get = "data=".$props;
    //     $data = file_get_contents('https://iac.yanao.ru/wp-content/plugins/vakanda/api/apibot/api_list_vakanda.php?'.$get);
    //     $result = json_decode($data, true);
    //     return $result;
    // }


} 