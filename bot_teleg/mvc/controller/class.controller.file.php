<?php

require_once "Controller.php";

class ControllerFile extends ControllerBot{

     // общая функция загрузки картинки
     public function getPhoto($data)
     {
         // берем последнюю картинку в массиве
         $file_id = $data[count($data) - 1]['file_id'];
         // получаем file_path
         $file_path = $this->getPhotoPath($file_id);
         // возвращаем результат загрузки фото
         return $this->copyPhoto($file_path);
     }
 
     // функция получения метонахождения файла
     public function getPhotoPath($file_id) {
         // получаем объект File
         $array = json_decode($this->requestToTelegram(['file_id' => $file_id], "getFile"), TRUE);
         // возвращаем file_path
         return  $array['result']['file_path'];
     }
 
     // копируем фото к себе
     public function copyPhoto($file_path) {
         // ссылка на файл в телеграме
         $file_from_tgrm = "https://api.telegram.org/file/bot".$this->botToken."/".$file_path;
         // достаем расширение файла 
         $ext =  end(explode(".", $file_path));
         // назначаем свое имя здесь время_в_секундах.расширение_файла
         $name_our_new_file = time().".".$ext;
         return copy($file_from_tgrm, "img/".$name_our_new_file);
     }

} 