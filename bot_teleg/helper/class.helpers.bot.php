<?php

class HelpersBot{


    public function handlerAllList( array $data){
        if( !$data ) return "Вакансии отсутствуют, попробуйте выбрать другую категорию";
        // if( !$data ) return false;  
            $text = "";
        foreach( $data as $key=>$val ){
            $text .= "<b>".$val['item_name']."</b>\n";   
            $text .= "Зарплата от: ".$val['item_zarplata_ot']." руб. \n";   
            $text .= "<a href='https://iac.yanao.ru/vakansii/?detail=".$val['ID_item']."#vakanda_data'>Смотреть подробнее...</a> ";   
            $text .= "\n\n";   
        }
        return $text;
    }
    
    public function handlerAllListSearch( array $data){
        if( !$data ) return " Поиск не дал результатов, попробуйте изменить запрос "; 
            $text = "";
        foreach( $data as $key=>$val ){
            $text .= "<b>".$val['item_name']."</b>\n";   
            $text .= "Зарплата от: ".$val['item_zarplata_ot']." руб. \n";   
            $text .= "<a href='https://iac.yanao.ru/vakansii/?detail=".$val['ID_item']."#vakanda_data'>Смотреть подробнее...</a> ";   
            $text .= "\n\n";   
        }
        $text .= "Можете снова ввести новый запрос, для поиска другой вакансии";
        $text .= "\n\n";
        return $text;
    }

    public function getCreateItemUrl(array $data){
        if( is_array($data) ){
            if($data){
                $result = array(
                    array(
                    'text' => $data[0],
                    'url' => $data[1],  
                    )
                );
                return $result;
            }
        }else{
            return;
        }
    }



    public function getCreateItemCallBack($data){
        if( is_array($data) ){
            if($data){
                $result = array(
                    array(
                    'text' => $data[0],
                    'callback_data' => $data[1],  
                    )
                );
                return $result;
            }
        }else{
            return;
        }
    }


    public function logTXT($string, $dir,  $clear = false){ 
        $log_file_name = $dir."/message.txt";
        $now = date("Y-m-d H:i:s");
        if($clear == false) {
            file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
        }
        else {
            file_put_contents($log_file_name, '');
            file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
        }
    }


    static public function logTXTs($string, $dir,  $clear = false){ 
        $log_file_name = $dir."/message.txt";
        $now = date("Y-m-d H:i:s");
        if($clear == false) {
            file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
        }
        else {
            file_put_contents($log_file_name, '');
            file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
        } 
    }



}