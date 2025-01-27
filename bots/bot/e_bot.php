<?php
/*
https: //api.telegram.org/bot~token~/setWebhook?url=https: //example.ru/path, где
https: //example.ru/ — это ссылка на ваш сайт, куда будет перенаправлять бот запросы.
~token~ — это токен, который вы получили при регистрации своего бота.
path — это часть url, на которую будут приходить обращения.
*/
/*https://api.telegram.org/bot7797700155:AAHKlVdh8IxwbpliF1BL5Bb4Bz8sXER74ZE/setWebhook?url=https://dekatreis.ru/bots/bot/e_bot.php

*/


// создаем объект бота
$newBot = new HelloBot();
// запускаем бота
$newBot->init();

/** Класс Бота
 * Class HelloBot
 */
class HelloBot
{
    // токен вашего бота
    private $token = "7797700155:AAHKlVdh8IxwbpliF1BL5Bb4Bz8sXER74ZE";
    // Приветствие пользователя
    private $helloText = "Приветствую Тебя, {%username%}! 
Рады знакомству и общению.

<b>Прежде всего, обсудим условия:</b>

<i>1. Мы за конфиденциальность - что происходит в клубе, закатано асфальтом.</i>

<i>2. Обязательное соблюдение личных границ, как в чате, так и на
вечеринках (без грубости, оскорблений и хамства).</i>

<i>3. Никаких эскорт-услуг: мы - за чувственное отношение и
раскрытие женственности и сексуальности.</i>

<i>4. Мы категорически против наркотиков и чрезмерного
алкогольного состояния.</i>


<b>Навигатор комнат:</b>
                    
<i>1. <a href='https://t.me/c/2292074623/1/16'>СходЧат (для общения)</a></i>

<i>2. <a href='https://t.me/c/2292074623/5/21'>Анкеты (краткая информация)</a></i>

<i>3. <a href='https://t.me/c/2292074623/7/10'>Сходняк (анонсы мероприятий)</a></i>"; 

    /** Стартуем  бота
     * @return bool
     */
    public function init()
    {
        // получаем данные от АПИ и преобразуем их в ассоциативный массив
        $rawData = json_decode(file_get_contents('php://input'), true);
        // направляем данные из бота в метод
        // для определения дальнейшего выбора действий
        $this->router($rawData);
        // в любом случае вернем true для бот апи
        return true;
    }

    /** Роутер - Определяем что делать с данными от АПИ
     * @param $data
     * @return bool
     */
    private function router($data)
    {
        // $this->botApiQuery("sendMessage", [
        //             'chat_id' => $data['message']['chat']['id'],
        //             'text' => str_replace("{%username%}", "asd", $this->helloText), 
        //             'parse_mode' => "HTML"
        //         ]
        //     );  
        mail("volodya.grab@yandex.ru","THENA",serialize($data));
        // проверяем массив данных на нужный нам ключ
        if (array_key_exists("new_chat_participant", $data['message'])) {
            // достаем имя нового пользователя
            $name = trim($data['message']['new_chat_participant']['username']
                // . ' ' . $data['message']['new_chat_participant']['last_name']
            ); 
            // отправляем приветствие в чат
            $this->botApiQuery("sendMessage", [
                    'chat_id' => $data['message']['chat']['id'],
                    'text' => str_replace("{%username%}", $name, $this->helloText),
                    'parse_mode' => "HTML"
                ]
            );
        }
        return true;
    }

    /** Запрос к BotApi
     * @param $method
     * @param array $fields
     * @return mixed
     */
    private function botApiQuery($method, $fields = array())
    {
        $ch = curl_init('https://api.telegram.org/bot' . $this->token . '/' . $method);
        curl_setopt_array($ch, array(
            CURLOPT_POST => count($fields),
            CURLOPT_POSTFIELDS => http_build_query($fields),
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 10
        ));
        $r = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $r;
    }
}