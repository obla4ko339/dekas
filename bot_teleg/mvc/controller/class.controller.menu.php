<?php

require_once dirname(dirname(dirname(__FILE__)))."/config/config.php";

require_once "Controller.php";
require_once "class.controller.responseapi.php";
require_once ROOT_BOT_MVC."/model/class.model.menu.php";
require_once ROOT_BOT_MVC."/model/class.model.addData.php";
require_once ROOT_BOT_MVC."/model/class.model.indb.php";
require_once ROOT_BOT."/helper/class.helpers.bot.php"; 

class ControllerMenu extends ControllerBot{


    private $response;
    private $menu;
    private $data; 
    private $indb;

    function __construct($response)
    {
        $this->data = $response; 
        $this->response = new ControllerResponseapi($response);
        $this->menu = new ModelMenu();
        $this->indb = new ModelInDB(); 
    }
    



    function createMenu( $data){
        if( !$data ) return;
        $res = $data;
        return $res;
    }

   


    function getMenu(){

        
 
        // if( !$this->response->getTitleMenu() ) return;

            $getTitleMenu = $this->response->getTitleMenu() ? $this->response->getTitleMenu() : $this->indb->getLastRout($this->response->getChatId());
            $this->menu->allData($this->data);
            
            

            $result = $this->createMenu( 
                                            $this->menu->getItemsMenu(
                                                $getTitleMenu, 
                                                $this->response->getChatId()
                                            )
                                        );
            
            // Роутинг 
            $this->menu->explodeRout( $this->response->getTitleMenu() );  
            
            // HelpersBot::logTXTs( $result ,ROOT_BOT); 
            
        return $result; 
    }


    function getMenuMethod(){

        return "";
    }




}