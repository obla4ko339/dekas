<?php

require_once "class.model.php";
require_once "class.model.api.php";

class ModelAddData extends ModelBot{

    protected $data;

    function __construct($data)
    {
            $this->data = $data;
    }

    function addDataBotMess(){
        if( is_array($this->data) && count($this->data) > 0 ){
            if( $this->data["message"] ){
                $data = $this->data["message"];
                $table = "bot_iac_vakanda";
                $field = array(
                    "message_id"=>$data["message_id"],
                    "from_id"=>$data["from"]["id"],
                    "from_first_name"=>$data["from"]["first_name"],
                    "from_last_name"=>$data["from"]["last_name"], 
                    "from_username"=>$data["from"]["username"],
                    "from_language_code"=>$data["from"]["language_code"],
                    "chat_id"=>$data["chat"]["id"],
                    "chat_first_name"=>$data["chat"]["first_name"],
                    "chat_last_name"=>$data["chat"]["last_name"],
                    "chat_username"=>$data["chat"]["username"],
                    "chat_type"=>$data["chat"]["type"],
                    "date"=>$data["date"],
                    "text"=>$data["text"] 
                );
                ModelBot::$wpdb2->insert($table, $field);
            }
        }
    }


    function addDataBotRout(){
        if( is_array($this->data) && count($this->data) > 0 ){
            if( $this->data["callback_query"] ){
                $data = $this->data["callback_query"];
                $table = "bot_iac_rout";
                $field = array(
                    "update_id"=>$this->data["update_id"],
                    "message_id"=>$data["message"]["message_id"],
                    "chat_id"=>$data["message"]["chat"]["id"],
                    "first_name"=>$data["message"]["chat"]["first_name"],
                    "last_name"=>$data["message"]["chat"]["last_name"],
                    "username"=>$data["message"]["chat"]["username"],
                    "type"=>$data["message"]["chat"]["type"],
                    "date"=>$data["message"]["date"],
                    "data"=>$data["data"]
                );
                ModelBot::$wpdb2->insert($table, $field);
            }
            // else if( $this->data["message"] ){
            //     $data = $this->data["message"];
            //     $table = "bot_iac_rout";
            //     $field = array(
            //         "message_id"=>$data["message_id"],
            //         "chat_id"=>$data["chat"]["id"],
            //         "first_name"=>$data["chat"]["first_name"],
            //         "last_name"=>$data["chat"]["last_name"],
            //         "username"=>$data["chat"]["username"],
            //         "type"=>$data["chat"]["type"],
            //         "date"=>$data["date"],
            //         "data"=>$data["text"] 
            //     ); 
            //     ModelBot::$wpdb2->insert($table, $field);
            // }
        }
    }


}