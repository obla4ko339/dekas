<?php

require_once "Controller.php";

class ControllerResponseapi extends ControllerBot{

    private $response;

    function __construct($response)
    {
        $this->response = $response;
    }


    function getTitleMenu(){
        if( !$this->response ) return;

        if( $this->response["message"] ){
            $result = mb_strtolower($this->response["message"]["text"]);
        }else if( $this->response["callback_query"] ){
            $result = $this->response["callback_query"]['data'];
        }  
        return $result;
    }

    function getChatId(){
        if( !$this->response ) return;

        if( $this->response["message"] ){
            $result = $this->response["message"]["chat"]["id"];
        }else if( $this->response["callback_query"] ){
            $result = $this->response["callback_query"]['message']['chat']['id'];
        }  
        return $result;
    }


    

    

}