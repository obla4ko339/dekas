<?
// $token = "6614016379:AAECAcJ3jFgP5y9bZ5-GvyGVFJTcppypNPg";
// https://api.telegram.org/bot6614016379:AAECAcJ3jFgP5y9bZ5-GvyGVFJTcppypNPg/setWebhook?url=https://iac.yanao.ru/wp-content/plugins/vakanda/bot/index.php
// https://api.telegram.org/bot6614016379:AAECAcJ3jFgP5y9bZ5-GvyGVFJTcppypNPg/getWebhookInfo
// echo "sss";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "mvc/model/class.model.php"; 
require_once "mvc/model/class.model.menu.php"; 
require_once "mvc/model/class.model.addData.php"; 
// require_once "mvc/model/class.model.indb.php"; 
require_once "mvc/controller/class.controller.menu.php"; 
require_once "mvc/controller/class.controller.responseapi.php"; 
require_once "Api.bot.php"; 
require_once "helper/class.helpers.bot.php"; 

$data = file_get_contents('php://input');
$data = json_decode($data, true);

// $bot = new ApiBot();
$bot = new ApiBot("6614016379:AAECAcJ3jFgP5y9bZ5-GvyGVFJTcppypNPg");
$contrMenu = new ControllerMenu($data); 
$dbBot = new ModelAddData($data); 
$dbBot->addDataBotMess();
$dbBot->addDataBotRout();    
$bot->apiSendTG( $contrMenu->getMenu() );

// HelpersBot::logTXTs( $bot->apiSendTG( $contrMenu->getMenu() ) ,ROOT_BOT);


// $modelBot = new ModelBot(); 
// $bot->apiSendTG( $modelBot->sendMessage("1302690739","Привет",[]) ); 



// $inDB = new ModelInDB();
// echo $inDB->getLastRout("313741177");

function writeLogFiles($string, $clear = false){
    $log_file_name = __DIR__."/message.txt";
    $now = date("Y-m-d H:i:s");
    if($clear == false) {
		file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
    else {
		file_put_contents($log_file_name, '');
        file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
}
// writeLogFiles( $contrMenu->getMenu(), true);    
// writeLogFiles( $data, true);      


$str = "/searchvacancy/Программист";
$re = explode("/",$str);
echo "<pre>";
print_r($re);
echo "</pre>";


return false;


// $textMessage = mb_strtolower($data["message"]["text"]);
// $chatId = $data["message"]["chat"]["id"];
// $callback_query = $data["callback_query"]['data'];
// $callback_query_chat_id = $data["callback_query"]['message']['chat']['id'];

// $li = $bot->getApiRequest("getListVakanda");





// echo "<pre>";
// print_r($li);
// echo "</pre>";






define("TG_TOKEN", "6614016379:AAECAcJ3jFgP5y9bZ5-GvyGVFJTcppypNPg");

function writeLogFile($string, $clear = false){
    $log_file_name = __DIR__."/message.txt";
    $now = date("Y-m-d H:i:s");
    if($clear == false) {
		file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
    else {
		file_put_contents($log_file_name, '');
        file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
}




// writeLogFile($data, true);

writeLogFile($data, true);  


function sendMessage($chat_id, $message, $replyMarkup) {
    file_get_contents('https://api.telegram.org/bot'.TG_TOKEN.'/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $replyMarkup);
}

function TG_sendMessage($getQuery) {
    $ch = curl_init("https://api.telegram.org/bot". TG_TOKEN ."/sendMessage?" . http_build_query($getQuery));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}
    

if($textMessage == "/start") {
    $textMessage_bot = "Вакансии в сфере культуры ЯНАО";

    $arrayQuery = array(
	'chat_id' => $chatId, 
	'text'	=> $textMessage_bot,
	'parse_mode'	=> "html",
	'reply_markup' => json_encode(array(
	    'inline_keyboard' => array(
            array(
                array(
                'text' => 'Информация о сервисе',
                'callback_data' => 'btn_info_service',
                )
            ),
            array(
                
                array(
                'text' => 'Очень большие преимущества',
                'callback_data' => 'btn',
                )
            ),
            array(
                array(
                    'text' => 'Подобрать вакансию',
                    'callback_data' => 'btn_find_vacancy',
                )
            ),
            array(
                array(
                    'text' => 'Просмотр всех вакансий',
                    'callback_data' => 'btn_view_vanacy',
                )
            ),
            array(
                array(
                    'text' => 'Канал где поубликуются все актуальные вакансии Новые',
                    'url' => 'https://t.me/iac_vakansii',
                )
            ),

            array(
                array(
                    'text' => 'Главное меню',
                    'callback_data' => 'btn_main_menu',
                )
            )
             
	    ),
	)), 
    );   
    TG_sendMessage($arrayQuery);
}

if($callback_query == "/start") {
    $textMessage_bot = "Вакансии в сфере культуры ЯНАО";

    $arrayQuery = array(
	'chat_id' => $callback_query_chat_id, 
	'text'	=> $textMessage_bot,
	'parse_mode'	=> "html",
	'reply_markup' => json_encode(array(
	    'inline_keyboard' => array(
            array(
                array(
                'text' => 'Информация о сервисе',
                'callback_data' => 'btn_info_service',
                )
            ),
            array(
                
                array(
                'text' => 'Очень большие преимущества',
                'callback_data' => 'btn',
                )
            ),
            array(
                array(
                    'text' => 'Подобрать вакансию',
                    'callback_data' => 'btn_find_vacancy',
                )
            ),
            array(
                array(
                    'text' => 'Просмотр всех вакансий',
                    'callback_data' => 'btn_view_vanacy',
                )
            ),
            array(
                array(
                    'text' => 'Канал где поубликуются все актуальные вакансии Новые',
                    'url' => 'https://t.me/iac_vakansii',
                )
            ),

            array(
                array(
                    'text' => 'Главное меню',
                    'callback_data' => 'btn_main_menu',
                )
            )
             
	    ),
	)), 
    );   
    TG_sendMessage($arrayQuery);
}

if($callback_query == "btn_main_menu"){

    
    
    $textMessage_bot = "Вакансии в сфере культуры ЯНАО";
    $arrayQuerys = array(
        'chat_id' => $callback_query_chat_id,  
        'text'	=> $textMessage_bot,
        'parse_mode'	=> "html",
        'reply_markup' => json_encode(array(
            'inline_keyboard' => array(
                array(
                    array(
                    'text' => 'Информация о сервисе',
                    'callback_data' => 'btn_info_service',
                    )
                ),
                array(
                    
                    array(
                    'text' => 'Очень большие преимущества',
                    'callback_data' => 'btn',
                    )
                ),
                array(
                    array(
                        'text' => 'Подобрать вакансию',
                        'callback_data' => 'btn_find_vacancy',
                    )
                ),
                array(
                    array(
                        'text' => 'Канал где поубликуются все актуальные вакансии',
                        'url' => 'https://t.me/iac_vakansii',
                    )
                )
                 
            ), 
        )), 
        );    
        writeLogFile($data, true); 
    TG_sendMessage($arrayQuerys);
}else if( $callback_query == "btn_view_vanacy" ){
    
    $data = file_get_contents('https://iac.yanao.ru/wp-content/plugins/vakanda/api/apibot/api_list_vakanda.php?data=getListVakanda');
    $data = json_decode($data, true);

    foreach( $data as $key=>$val ){
        $text .= "<b>".$val['item_name']."</b>\n";   
        $text .= "Зарплата от: ".$val['item_zarplata_ot']." руб. \n";   
        $text .= "<a href='https://iac.yanao.ru/vakansii/?detail=".$val['ID_item']."#vakanda_data'>Смотреть подробнее...</a> ";   
        $text .= "\n\n";   
         
    }
   
   
    $arrayQuery = array(
        'chat_id' => $callback_query_chat_id, 
        'text'	=> $text,
        'parse_mode'	=> "html",
        'reply_markup' => json_encode(array(
                            "inline_keyboard" => array(
                                array(
                                    array(
                                    'text' => 'Показать еще...',
                                    'callback_data' => 'next_vacancy',
                                    )
                                ),
                                array(
                                    array(
                                    'text' => 'Вернуться в меню',
                                    'callback_data' => '/start', 
                                    )
                                ),
                            )
                        ))
        );   
    TG_sendMessage($arrayQuery);

}

    