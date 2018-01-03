<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 22/12/2017
 * Time: 13:41
 */

require_once (__DIR__ . '/../dao/Usuario.php');
require_once (__DIR__ . '/../dao/Produto.php');

$prod = new Produto();
$usuario = Usuario::restoreFromSession();
$prod->setDescricao($_POST['proddesc']);
$prod->setObservacao($_POST['prodobs']);
$prod->setVariacao($_POST['prodvar']);
$prod->setContainer($_POST['containerid']);
$prod->setUsuarioCriacao($usuario);
$prod->save();
echo '{ "referencia": "' . $prod->getReferencia() . '"}';
echo '';