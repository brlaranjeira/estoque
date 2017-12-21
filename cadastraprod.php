<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 21/12/2017
 * Time: 16:49
 */


?>
<html>
<head>
    <title>Controle</title>
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome/font-awesome.min.css">
</head>
<body>
<?

include __DIR__ . '/fragment/navbar.php';

require_once (__DIR__ . '/dao/Container.php');
require_once (__DIR__ . '/dao/Produto.php');
$containers = Container::getAll();

?>
<div id="div-cadastraprod" class="container">
    <section>
    <div class="row">
        <div class="col-xs-12 form-group">
            <label for="idcontainer">Caixa/sacola</label>
            <div class="input-group">
                <select id="select-container" class="form-control">
                    <?
                    foreach ($containers as $container) {
                        ?><option value="<?=$container->getId()?>"><?=$container->getReferencia()?></option> <?
                    }
                    ?>
                </select>
                <div class="input-group-addon">
                    <span id="span-novocontainer" class="fa fa-plus">&nbsp;Nova</span>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section>
        <?
        $a = Produto::getAll();
        echo '';
        ?>
    </section>
</div>



</body>
<script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.mask.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/bootstrap/bootstrap.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/cadastraprod.js"></script>
</html>
