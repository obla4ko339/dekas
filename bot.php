<?

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


$data = file_get_contents('php://input');
$data = json_decode($data, true);

$textMessage = mb_strtolower($data["message"]["text"]);
$chatId = $data["message"]["chat"]["id"];
$callback_query = $data["callback_query"]['data'];
$callback_query_chat_id = $data["callback_query"]['message']['chat']['id'];

// writeLogFile($data, true);

writeLogFile($callback_query, true); 


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
                    'text' => 'Канал где поубликуются все актуальные вакансии',
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
}