<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 22/12/2017
 * Time: 19:05
 */
require_once (__DIR__ . '/../dao/Produto.php');

$prods = Produto::getAll();
$arr = array();
foreach ($prods as $prod) {
    $arr[] = $prod->asJSON();
}
$str = json_encode($arr);
echo $str;