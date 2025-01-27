<?php

require_once "class.model.php";
require_once dirname(dirname(dirname(__FILE__)))."/config/config.php";
require_once ROOT_BOT."/lang/ru.php"; 
require_once ROOT_BOT."/helper/class.helpers.bot.php"; 

class ModelApi extends ModelBot{

    private $numberItem = 5;
    public static $startPage = 0;
    protected $url = "https://iac.yanao.ru/wp-content/plugins/vakanda/api/apibot/api_list_vakanda.php?";



    private function pages($page=1){
        $number = $this->numberItem;
        for( $i=1; $i<=$page; $i++ ){
            $start = $number * ($i-1);
        }
        return $start;
    }

    public function getApiListVacancy($page = 1){

            $start = $this->pages($page); // щаг
            $number = $this->numberItem; // Количество для вывода

            $params = "";
            $params .= "&start=".$start;
            $params .= "&number=".$number;  

            

            $data = file_get_contents('https://iac.yanao.ru/wp-content/plugins/vakanda/api/apibot/api_list_vakanda.php?data=getListVakanda'.$params);
            $data = json_decode($data, true);
        if( is_array($data) ){
            if( count($data) > 0  ){
                $result = $data; 
            }else{
                $result = VACANCY_NOT;
            }
        }
        return $result;
    }


    public function getApiListVacancyCat($cat){

        
        $params = "&cat=".$cat; 
        $data = file_get_contents('https://iac.yanao.ru/wp-content/plugins/vakanda/api/apibot/api_list_vakanda.php?data=getListVakandaCat'.$params);
        $data = json_decode($data, true); 
    if( is_array($data) ){
        if( count($data) > 0  ){
            $result = $data; 
            return $result;
        }else{
            return []; 
        }

    }
    
}


    public function getVacancySearch($title){
        if( !$title ) return false;
        $data = "data=search";
        $params = "&title=".$title; 
        $res = file_get_contents($this->url.$data.$params);
        $res = json_decode($res, true); 
        
        return $res; 
    }

}