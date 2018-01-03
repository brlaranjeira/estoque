<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 22/12/2017
 * Time: 19:05
 */
require_once (__DIR__ . '/../dao/Produto.php');

$prods = Produto::getAll();
$ret = '{ "produtos": [';
$prim = true;
foreach ($prods as $prod) {
    $ret .= $prim ? '' : ',';
    $prim = false;
    $ret .= $prod->asJSON();
}
$ret .= ']}';
echo $ret;