<?php

$config = array(
    "digest_alg"    => "sha512",
    "private_key_bits" => 4096,           //字节数  512 1024 2048  4096 等 ,不能加引号，此处长度与加密的字符串长度有关系，可以自己测试一下
    "private_key_type" => OPENSSL_KEYTYPE_RSA,   //加密类型
  );
$res =    openssl_pkey_new($config); 

//提取私钥
openssl_pkey_export($res, $private_key);

//生成公钥
$public_key = openssl_pkey_get_details($res);
// var_dump($public_key);

$public_key=$public_key["key"];

//显示数据
var_dump($private_key);    //私钥
var_dump($public_key);     //公钥

//要加密的数据
$data = "http://www.cnblogs.com/wt645631686/";
echo '加密的数据：'.$data."\r\n";  

//私钥加密后的数据
openssl_private_encrypt($data,$encrypted,$private_key);

//加密后的内容通常含有特殊字符，需要base64编码转换下
$encrypted = base64_encode($encrypted);
echo "私钥加密后的数据:".$encrypted."\r\n";  

//公钥解密  
openssl_public_decrypt(base64_decode($encrypted), $decrypted, $public_key);
echo "公钥解密后的数据:".$decrypted,"\r\n";  
  
//----相反操作。公钥加密 
openssl_public_encrypt($data, $encrypted, $public_key);
$encrypted = base64_encode($encrypted);  
echo "公钥加密后的数据:".$encrypted."\r\n";
  
openssl_private_decrypt(base64_decode($encrypted), $decrypted, $private_key);//私钥解密  
echo "私钥解密后的数据:".$decrypted."n";