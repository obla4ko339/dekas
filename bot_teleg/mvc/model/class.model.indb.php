<?php

require_once "class.model.php";



class ModelInDB extends ModelBot{


    // Получить последний выбранный пунки в меню
    function getLastRout($chatId){
        if( !$chatId ) return false;
        $sql = " SELECT * FROM `bot_iac_rout` WHERE `chat_id` = ".$chatId." order by  `ID_rout` desc  LIMIT 1 ";
        $result =  ModelBot::$wpdb2->get_results( $sql ,ARRAY_A);  
        if($result){
            return $result[0]["data"];
        }else{
            return;
        }
    }





}