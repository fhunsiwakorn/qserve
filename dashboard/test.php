<?php
$data = 'Test Symmetric Encryption';

$key = 'utrdn6kcxkfgs6keo23345kfniomgf4s';
$suffix = '4678965001980654';

$code = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CFB, $suffix); 
echo $code; exit;
