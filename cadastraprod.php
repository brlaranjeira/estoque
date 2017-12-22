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
    <link rel="stylesheet" href="./css/cadastraprod.css">
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
                    for ( $i = sizeof($containers)-1; $i >= 0; $i-- ) {
                        $container = $containers[$i];
                        $selectedStr = $_GET['container'] == $container->getId() ? 'selected' : '';
                        ?><option <?=$selectedStr?> value="<?=$container->getId()?>"><?=$container->getReferencia()?></option> <?
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
        <form action="./ajax/novoproduto.php" method="post" id="form-novoprod">
                <?
                $produtos = Produto::getByAttr('container', $_GET['container']);
                if (empty($produtos)) {
                    ?>Nenhum produto nesta caixa/sacola<?
                }
                $even = true;
                foreach ( $produtos as $produto ) { ?>
                    <div class="row <?=$even? 'even' : ''?>">
                        <div class="col-xs-12">[<?=$produto->getReferencia()?>]</div>
                        <div class="col-xs-4"><?=$produto->getDescricao()?></div>
                        <div class="col-xs-4"><?=$produto->getObservacao()?></div>
                        <div class="col-xs-4"><?=$produto->getVariacao()?></div><?
                        $even = !$even;
                    ?></div><?
                }
                ?>
            <div class="row">
                <div class="col-xs-12"><h4>Novo</h4></div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="novoprod-desc">Nome</label>
                    <input type="text" class="form-control" id="novoprod-desc" name="novoprod-desc">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="novoprod-obs">Descri&ccedil;&atilde;o</label>
                    <textarea placeholder="n&atilde;o obrigat&oacute;rio" class="form-control" id="novoprod-obs" name="novoprod-obs"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <label for="novoprod-var">Detalhe</label>
                    <div class="input-group">
                        <input placeholder="tamanho, cor, etc" type="text" class="form-control" id="novoprod-var" name="novoprod-var">
                        <div class="input-group-btn">
                            <button type="submit" class="form-control btn btn-success">Envia</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>



</body>
<script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/jquery/jquery.mask.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/bootstrap/bootstrap.min.js"></script>
<script type="application/ecmascript" language="ecmascript" src="./js/cadastraprod.js"></script>
</html>
