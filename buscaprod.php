<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 22/12/2017
 * Time: 17:40
 */



?>
    <html>
    <head>
        <title>Controle</title>
        <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./css/font-awesome/font-awesome.min.css">
        <link rel="stylesheet" href="./css/cadastraprod.css">
    </head>
    <body>
<?

include __DIR__ . '/fragment/navbar.php';

require_once (__DIR__ . '/dao/Container.php');
require_once (__DIR__ . '/dao/Produto.php');
$containers = Container::getAll();

?>

<div class="container">
    <div id="div-busca">
        <div class="row">
            <div class="col-xs-12">
                <label for="busca-ref">Busca por refer&ecirc;ncia</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="busca-ref" name="busca-ref">
                    <div class="input-group-addon">
                        <span class="fa fa-search span-busca ref"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label for="busca-txt">Busca por texto</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="busca-txt" name="busca-txt">
                    <div class="input-group-addon">
                        <span class="fa fa-search span-busca txt"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="div-resultados">

    </div>
</div>








    </body>
    <script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.min.js"></script>
    <script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.mask.min.js"></script>
    <script type="application/ecmascript" language="ecmascript" src="./js/bootstrap/bootstrap.min.js"></script>
    <script type="application/ecmascript" language="ecmascript" src="./js/buscaprod.js"></script>
    </html>
