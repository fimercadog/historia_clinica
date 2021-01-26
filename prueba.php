<?php

$pass = password_hash('123456', PASSWORD_DEFAULT, ['cost' => 12]);
$pass1 = password_hash('12345', PASSWORD_DEFAULT, ['cost' => 12]);
echo ($pass);
echo ('<br>');
echo ($pass1);