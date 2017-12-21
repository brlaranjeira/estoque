<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 21/12/2017
 * Time: 18:21
 */

require_once (__DIR__ . '/../dao/Container.php');
require_once (__DIR__ . '/../dao/Usuario.php');
$usuario = Usuario::restoreFromSession();
$container = new Container();
$container->setUsuarioCriacao($usuario);
$container->save();
$container = Container::getById($container->getId());
$str = $container->asJSON();
echo $str;