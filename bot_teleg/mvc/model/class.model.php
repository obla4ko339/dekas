<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );

class ModelBot{

    public static $wpdb2;  

    private $user = "cn50487_dekatr";
    private $bd = "cn50487_dekatr";
    private $pas = "2wmtXUM4";
    private $host = "localhost"; 

    function __construct()
    {
        self::$wpdb2 = new wpdb( $this->user, $this->pas, $this->bd, $this->host );
        
    } 


    function createBtn($type = "callback_data", array $params) : array{
        if( !is_array($params) ) return false;
        $props["text"] = $params[0];
        $props[$type] = $params[1];
        return $props;
    }




    function sendMessage($chatId, $text, $menu){
        $arrayQuery = array(
                'method' => "sendMessage",
                'chat_id' => $chatId, 
                'text'	=> $text,
                'parse_mode'	=> "html",
                'reply_markup' => json_encode(array(
                    'inline_keyboard' => $menu,
                )
            ) 
        );
        return $arrayQuery;
    }



    function sendPhoto($chatId, $text, $menu, $photo){
        $arrayQuery = array(
                'method' => "sendPhoto", 
                'chat_id' => $chatId, 
                'text'	=> $text,
                'photo' => $photo,
                'parse_mode'	=> "html",
                'reply_markup' => json_encode(array(
                    'inline_keyboard' => $menu,
                )
            ) 
        );
        return $arrayQuery;
    }



    function sendDocument($chatId, $text, $menu, $doc){
        $arrayQuery = array(
                'method' => "sendDocument",
                'chat_id' => $chatId, 
                'text'	=> $text,
                'document' => $doc,
                'parse_mode'	=> "html",
                'reply_markup' => json_encode(array(
                    'inline_keyboard' => $menu,
                )
            ) 
        );
        return $arrayQuery;
    }



    //Метод получения Файл по ID
    function getFile($file_id){
        $arrayQuery = array(
                'method' => "getFile",
                'file_id' => $file_id, 
            );
        return $arrayQuery;
    }


    // function sendDocumentAndFile($chatId, $text, $menu, $doc, $photo){
    //     $arrayQuery = array(
    //             'chat_id' => $chatId, 
    //             'text'	=> $text,
    //             'document' => $doc,
    //             'photo' => $photo,
    //             'parse_mode'	=> "html",
    //             'reply_markup' => json_encode(array(
    //                 'inline_keyboard' => $menu,
    //             )
    //         ) 
    //     );
    //     return $arrayQuery;
    // }





}