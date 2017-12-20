<?
require_once (__DIR__ . '/dao/Usuario.php');
require_once (__DIR__ . '/dao/TipoUsuario.php');
$usuario = new Usuario();
$usuario->setLogin('bruno');
$usuario->setPrenome('Bruno');
$usuario->setSobrenome('Rezende Laranjeira');
$usuario->geraPW('M0squit40601');
$usuario->setTipo(TipoUsuario::getByAttr('descricao','ADMIN')[0]);
$usuario->save();


$testeerrado = Usuario::auth('bruno','aaa');
$testecerto = Usuario::auth('bruno','M0squit40601');


die();

require_once (__DIR__ . '/dao/Usuario.php');
$diretorio = dirname($_SERVER['PHP_SELF']) . '/';


$usr = Usuario::restoreFromSession();
$to = isset($usr) ? './main.php' : './login.php';
$addr = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$proto = isset($_SERVER['HTTPS']) ? 'https' : 'http';

$redir = $addr.$diretorio.$to;
header("Location: $proto://$redir" );