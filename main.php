<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 21/12/2017
 * Time: 16:42
 */

require_once (__DIR__ . '/dao/Usuario.php');
$usr = Usuario::restoreFromSession();
$to = isset($usr) ? './cadastraprod.php' : './login.php';
$addr = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$proto = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$diretorio = dirname($_SERVER['PHP_SELF']) . '/';
$redir = $addr.$diretorio.$to;
header("Location: $proto://$redir" );