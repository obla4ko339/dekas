<?php

require_once "class.model.php";
require_once "class.model.api.php";
require_once "class.model.indb.php";
require_once dirname(dirname(dirname(__FILE__)))."/config/config.php";
require_once ROOT_BOT."/lang/ru.php"; 
require_once ROOT_BOT."/helper/class.helpers.bot.php"; 
require_once ROOT_BOT."/Api.bot.php";  


class ModelMenu extends ModelBot{

    protected $api;
    protected $helper;
    protected $rout;
    protected $alldata;
    protected $inDB;

    function __construct()
    {
        $this->api = new ModelApi();
        $this->helper = new HelpersBot(); 
        $this->inDB = new ModelInDB();
    }

 

     // Вывести пункты именю исходя и выбранного пункта меню в телеге
     function getItemsMenu($item, $chatId){ 
        // HelpersBot::logTXTs($item.$chatId, ROOT_BOT);   
        if( !$item ) return false;
        
        // SEARCH
        if($this->inDB->getLastRout($chatId) == "/searchvacancy" && $item != "/searchvacancy" ){ 
            $item = "/searchvacancy/".$item;
        }else if( $item == "/start" ){ 
            $item = "/start";   
        }else{
            $item = $this->inDB->getLastRout($chatId);
        }
        
        
        // SEARCH 
        $this->rout = $item;
        $exp = explode("/",$item);
        $method = "getMenu_".$exp[1];
        if( call_user_func(array($this, $method), $chatId) ){
            return call_user_func(array($this, $method), $chatId); 
        } 
    } 

    // Получить Массив данных
    function allData($data){
        if( !is_array($data) ) return false;
        $this->alldata = $data; 
    }
    // Получить Массив данных

    function explodeRout($item){
        //Пример вывода если такой пусть /prevvacancy/bible
        // Array
        // (
        // [0] => 
        // [1] => prevvacancy
        // [2] => bible
        // )

        if(!$item) return false;
            $exp = explode("/",$item);
        return $exp; 
    }



    




    

    
    



   

 
    // О Ямале
    function getMenu_infoservice($chatId){ 
        $photo = "https://dekatreis.ru/wp-content/uploads/2024/02/img.jpg"; 
        $menu = array(
            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
        );
        $res = parent::sendPhoto($chatId, " ", $menu, $photo );
        return $res;
    }


    //Подбор Вакансий, разбивка на категории 
    function getMenu_findvacancy($chatId){
        
        if( count( $this->explodeRout($this->rout) ) < 3 ){

        $text = "Выберите себе вакансию по направлениям";
        $menu = array(
            array(
                array(
                    'text' => CAT_BIBLE,
                    'callback_data' => "/findvacancy/biblioteki", 
                ),
                array(
                    'text' => CAT_MUZ,
                    'callback_data' => "/findvacancy/muzei",
                ),
                array(
                    'text' => CAT_PARKI,
                    'callback_data' => "/findvacancy/parki",
                )
            ),
            array(
                array(
                    'text' => CAT_KULT_DOCUG_ORG,
                    'callback_data' => "/findvacancy/kulturno-dosugovyye-uchrezhdeniya",
                ),
            ),
            array(
                array(
                    'text' => CAT_OBRZ_UCHR,
                    'callback_data' => "/findvacancy/obrazovatelnyye-uchrezhdeniya",
                ),
            ),
            array(
                array(
                    'text' => CAT_KON_ORG,
                    'callback_data' => "/findvacancy/kontsertnyye-organizatsii",
                ),
                array(
                    'text' => CAT_INIE,
                    'callback_data' => "/findvacancy/inie",
                )
            ),
            $this->helper->getCreateItemCallBack([MENU_SEARCH_VACANCY,"/searchvacancy"]),
            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
        );
        $res = parent::sendMessage($chatId, $text, $menu); 
        return $res;
        
        }else if( count( $this->explodeRout($this->rout) ) == 3){

          
            $listPage = array("biblioteki"=>6,"muzei"=>9,"parki"=>11,"kulturno-dosugovyye-uchrezhdeniya"=>8,"obrazovatelnyye-uchrezhdeniya"=>10,"kontsertnyye-organizatsii"=>7,"inie"=>12);
            $listPageRevers = array_flip($listPage);
            $curentCat = $listPageRevers[$listPage[$this->explodeRout($this->rout)[2]]];

            
            $menu = array(
                $this->helper->getCreateItemCallBack([MENU_PREVVACANCY,"/findvacancy"]),
                $this->helper->getCreateItemUrl([MENU_VACANCY_SITE,"https://iac.yanao.ru/vakansii/?type=".$curentCat."&id=".$listPage[$this->explodeRout($this->rout)[2]]."#vakanda_data"]),
                $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
            );
  
            
            HelpersBot::logTXTs($this->api->getApiListVacancyCat( $listPage[$this->explodeRout($this->rout)[2]] ), ROOT_BOT);  
            $res = parent::sendMessage($chatId, $this->helper->handlerAllList( $this->api->getApiListVacancyCat( $listPage[$this->explodeRout($this->rout)[2]] ) ) , $menu);

            return $res;


        }
    }



    // Поиск по вакансиям
    function getMenu_searchvacancy($chatId){

      

        if( count( $this->explodeRout($this->rout) ) == 2 ){
            $text = "Введите название вакансии, которая Вас интересует";
            $menu = array(
                $this->helper->getCreateItemCallBack([MENU_PREVVACANCY,"/findvacancy"]),
                $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
            );
            $res = parent::sendMessage($chatId, $text, $menu);
            return $res;
        }else if( count( $this->explodeRout($this->rout) ) == 3){

            $menu = array(
                $this->helper->getCreateItemCallBack([MENU_PREVVACANCY,"/findvacancy"]),
                $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
            );

            // $res = parent::sendMessage($chatId, print_r($this->explodeRout($this->rout)[2], true), $menu);

            $res = parent::sendMessage($chatId, 
                    $this->helper->handlerAllListSearch( 
                            $this->api->getVacancySearch( $this->explodeRout($this->rout)[2] ) ) 
                    ,$menu);

            return $res;

        }
    }



    //Обработка резюме
    function getMenu_resume($chatId){

        if( count( $this->explodeRout($this->rout) ) == 2 ){
            $text = TEXT_START_RESUME;
            $menu = array(
                $this->helper->getCreateItemCallBack([MENU_RESUME_PDF,"/resume/resume-downpdf"]),
                // $this->helper->getCreateItemCallBack([MENU_RESUME_ANKETA,"/resume/resume-anketa"]),
                $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
            );
            $res = parent::sendMessage($chatId, $text, $menu );
            return $res; 
        }else if( count( $this->explodeRout($this->rout) ) == 3){
           if( $this->explodeRout($this->rout)[2] == "resume-downpdf" ){

                if($this->alldata['message']['document']['file_id']){
                    // HelpersBot::logTXTs($this->alldata, ROOT_BOT);
                    // return false;
                    if( $this->alldata['message']['document']['mime_type'] == "application/pdf"){
                        $res = parent::getFile($this->alldata['message']['document']['file_id']);
                        $apiBot = new ApiBot();
                        $response = $apiBot->apiSendTG($res);
                        $responseArr = json_decode($response, true);
                        if( $responseArr['ok'] ){ 
                            $apiBot->copyPhoto($responseArr['result']['file_path'], ROOT_BOT."/pdfResume", $this->alldata['message']['chat']['username'] );   
                            $text = TEXT_RESULT_PDF_OK;
                            $menu = array(
                                $this->helper->getCreateItemCallBack([MENU_FIND_VACANCY,"/findvacancy"]), 
                                $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
                            );
                            $res = parent::sendMessage($chatId, $text, $menu );
                            return $res;
                        }
                    }else{
                        $text = TEXT_RESULT_PDF_NO; 
                        $menu = array(
                            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
                        );
                        $res = parent::sendMessage($chatId, $text, $menu );
                        return $res; 
                    }
                }else{
                    $text = TEXT_RESUME_PDF;
                    $menu = array(
                        $this->helper->getCreateItemCallBack([MENU_PREVVACANCY,"/resume"]),
                        $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"])
                    );
                    $res = parent::sendMessage($chatId, $text, $menu );
                    return $res; 
                }
                 
           }
        }
    }




  

    // Стартовое меню
    function getMenu_start($chatId){
        $photo = "https://dekatreis.ru/wp-content/uploads/2024/02/vakan.jpg"; 
        $text = "Вакансии в сфере культуры ЯНАО!!!";
        $menu = array(
            $this->helper->getCreateItemCallBack([MENU_INFO_SERVICE,"/infoservice"]),
            $this->helper->getCreateItemCallBack([MENU_FIND_VACANCY,"/findvacancy"]),
            $this->helper->getCreateItemCallBack([MENU_VIEW_VACANCY,"/viewvacancy"]),
            // $this->helper->getCreateItemCallBack([MENU_VIEW,"/obzor"]), 
            // $this->helper->getCreateItemUrl([MENU_CHANEL_VACANCY,"https://t.me/iac_vakansii"]),
            $this->helper->getCreateItemUrl([MENU_VACANCY_SITE,"https://iac.yanao.ru/vakansii/"]),
            $this->helper->getCreateItemCallBack([MENU_RESUME,"/resume"])
            //$this->helper->getCreateItemUrl([MENU_SITE_MAIN_VACANCY,"https://iac.yanao.ru/"]),
        );
        $res = parent::sendPhoto($chatId, $text, $menu, $photo );
        return $res; 
    } 



    function getMenu_obzor($chatId) : array{
        $text = " Описание разной работы "; 
        $menu = array(
            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"]),
        );
        $res = parent::sendMessage($chatId, $text, $menu);
        return $res;
    }



    // Просмотр всех Вакансий
    function getMenu_viewvacancy($chatId){
        $menu = array(
            array(
                array(
                    'text' => MENU_PREVVACANCY,
                    'callback_data' => "/prevvacancy",  
                ),
                array(
                    'text' => MENU_NEXTVACANCY,
                    'callback_data' => "/nextvacancy",  
                )
            ),
            $this->helper->getCreateItemUrl([MENU_VACANCY_SITE,"https://iac.yanao.ru/vakansii/"]),
            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"]),
            
        );
        $res = parent::sendMessage($chatId, $this->helper->handlerAllList( $this->api->getApiListVacancy() ) , $menu);

        return $res;
    }

    static public $iterator = 0;
    function getMenu_nextvacancy($chatId){
        // ModelApi::$startPage +=1;
        self::$iterator +=1; 

        $menu = array(
            array(
                array(
                    'text' => "Назад",
                    'callback_data' => "/prevvacancy",  
                ),
                array(
                    'text' => "Вперед",
                    'callback_data' => "/nextvacancy",  
                )
            ),
            $this->helper->getCreateItemUrl([MENU_VACANCY_SITE,"https://iac.yanao.ru/vakansii/"]),
            $this->helper->getCreateItemCallBack([MENU_MAIN,"/start"]),
            
        );
        $res = parent::sendMessage($chatId, $this->helper->handlerAllList( $this->api->getApiListVacancy( self::$iterator ) ) , $menu);

        return $res;
    }
 


    
}