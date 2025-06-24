<?php

// if ('https' === $_SERVER['REQUEST_SCHEME']) {
//     header("Location: http://".$_SERVER['HTTP_HOST']);
//     die();
// }

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

echo "<h1> My app </h1>".'<br/><br/>';

echo 'Date: '.date(DATE_ATOM).'<br/>';
echo 'Dir:'.__DIR__.'<br/>';
echo 'HTTP_HOST: '.$_SERVER['HTTP_HOST'].'<br/>';
echo 'REQUEST_SCHEME: '.$_SERVER['REQUEST_SCHEME'].'<br/>';
echo 'REMOTE_PORT: '.$_SERVER['REMOTE_PORT'].'<br/>';
echo 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL'].'<br/>';
echo 'SERVER_SIGNATURE: '.$_SERVER['SERVER_SIGNATURE'].'<br/>';

// TRAEFIK
if (isset($_SERVER['HTTP_X_FORWARDED_PORT'])) echo 'HTTP_X_FORWARDED_PORT: '.$_SERVER['HTTP_X_FORWARDED_PORT'].'<br/>';
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) echo 'HTTP_X_FORWARDED_PROTO: '.$_SERVER['HTTP_X_FORWARDED_PROTO'].'<br/>';
if (isset($_SERVER['HTTP_X_REAL_IP'])) echo 'HTTP_X_REAL_IP: '.$_SERVER['HTTP_X_REAL_IP'].'<br/>';

var_dump($_SERVER);
var_dump($_ENV);