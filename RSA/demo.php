<?php
require_once "rsa.php";
$rsa = new Rsa();
$data['uid'] = '12231';
$data['iat']  = time();
$data['ext']  = 3600;
$privEncrypt = $rsa->privEncrypt(json_encode($data));
echo '私钥加密后:'.$privEncrypt.'<br>';

$publicDecrypt = $rsa->publicDecrypt($privEncrypt);
echo '公钥解密后:'.$publicDecrypt.'<br>';

print_r(json_encode($data));
$publicEncrypt = $rsa->publicEncrypt(json_encode($data));
echo '公钥加密后:'.$publicEncrypt.'<br>';
echo '压缩后：'.gzcompress($publicEncrypt);



$privDecrypt = $rsa->privDecrypt($publicEncrypt);
echo '私钥解密后:'.$privDecrypt.'<br>';