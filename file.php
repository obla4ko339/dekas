<?php

// https://dekatreis.ru/file.php?make=ok&file=last


file_put_contents($tempFile, $source);

if( strip_tags($_GET['make']) == "ok" ){
    // $data[0] = "https://dekatreis.ru/wp-content/uploads/2022/12/close-up-burning-lamp-in-the-dark-copy-space-.jpg";
    // // $video1 = "<a href='https://dekatreis.ru/wp-content/uploads/2024/12/IMG_1474.mov'>https://dekatreis.ru/wp-content/uploads/2024/12/IMG_1474.mov</a>";
    // $data[1] = "https://dekatreis.ru/wp-content/uploads/2024/12/IMG_1474.mov";
    $data = "https://dekatreis.ru/wp-content/uploads/2024/12/IMG_1474.mov";
    // $data = array(
    //     "img"=>"https://dekatreis.ru/wp-content/uploads/2022/12/close-up-burning-lamp-in-the-dark-copy-space-.jpg",
    //     "video"=>"https://dekatreis.ru/wp-content/uploads/2024/12/IMG_1474.mov",
    // );
    // echo json_encode($data);  
    echo $data;  
}


if( strip_tags($_GET['type']) == "img" ){
    $img = "https://dekatreis.ru/wp-content/uploads/2022/12/close-up-burning-lamp-in-the-dark-copy-space-.jpg";
    echo $img;
}



// $curl_file = curl_file_create(__DIR__ . '/wp-content/uploads/2024/12/IMG_1474.mov');
 
// $ch = curl_init('https://example.com');  
// curl_setopt($ch, CURLOPT_POST, 1);  
// curl_setopt($ch, CURLOPT_HTTPHEADER, "Content-Type: multipart/form-data;charset=utf-8");
// curl_setopt($ch, CURLOPT_POSTFIELDS, array('video' => $curl_file));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_HEADER, false);
// $res = curl_exec($ch);
// curl_close($ch);

// echo $res;