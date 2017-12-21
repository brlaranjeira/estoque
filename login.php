<!DOCTYPE html>


<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ponto Bolsistas CTISM">
    <meta name="author" content="Noronha">
    <link rel="icon" href="img/CTISM.ico">

    <title>Ponto Bolsistas</title>
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">


</head>

<body>
<div class="container">
<?
require_once (__DIR__ . '/dao/Usuario.php');
if ( isset($_POST) == !empty($_POST) ) {
    $usuario = Usuario::auth($_POST['usuario'] , $_POST['senha'] );
    if ($usuario != null ) {
        $usuario->saveToSession();
        header("Location: ./main.php");
    } else {
        echo "Usuario não encontrado";
    }
}

?>
    <form method="POST" action="">
        <h2 >Controle</h2>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" class="form-control" placeholder="Digite seu usuário" autofocus><br />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite sua senha"  >
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>