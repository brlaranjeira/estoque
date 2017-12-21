<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 7/5/17
 * Time: 7:29 PM
 */
require_once (__DIR__ . '/EntidadeAbstrata.php');
class Usuario extends EntidadeAbstrata {

    private $login;
    private $prenome;
    private $sobrenome;
    private $iteracoes;
    private $passwd;
    private $salt;
    /**
     * @var TipoUsuario
     */
    private $tipo;

    const USER_SESSION = 'spoiler_md_user';

    protected static $tbName = 'usuario';
    protected static $dicionario = [
        'login' => 'login',
        'prenome' => 'prenome',
        'sobrenome' => 'sobrenome',
        'iteracoes' => 'iteracoes',
        'passwd' => 'passwd',
        'salt' => 'salt'
    ];
    protected static $hasOne = [
        'tipo' => [
            'clEntityName' => 'TipoUsuario',
            'tbForeignKey' => 'id_tipo'
        ]
    ];


    public function geraPW( $raw ) {
        require_once (__DIR__ . "/../lib/ConfigClass.php");
        $this->iteracoes = ConfigClass::pw_iter;
        $tmpSalt = array();
        while (sizeof($tmpSalt) < ConfigClass::pw_saltLength) {
            $current = unpack('C*',pack("L",rand()));
            for ($i = 1; $i <= sizeof($current) && sizeof($tmpSalt) < ConfigClass::pw_saltLength; $i++ ) {
                $tmpSalt[] = $current[$i];
            }
        }
        $saltStr = implode(array_map("chr", $tmpSalt));
        $saltStr = utf8_encode($saltStr);
        $this->salt = $saltStr;

        $hashed = self::calculaPW($raw,$saltStr,$this->iteracoes);
        $this->passwd = $hashed;
    }

    private static function calculaPW( $raw, $salt, $iters ) {
        return hash_pbkdf2(ConfigClass::pw_algo,$raw,$salt,$iters,ConfigClass::pw_outputLength);
    }

    public static function auth($login, $passwd) {
    	$usuario = Usuario::getByAttr('login',$login);
    	if (!isset($usuario)) {
		    return false;
	    }
        $sql = 'SELECT id, prenome, sobrenome, iteracoes,passwd,salt,id_tipo FROM usuario WHERE login = ?';
        require_once (__DIR__ . "/../lib/ConexaoBD.php");
        $conn = ConexaoBD::getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($login));
        $res = $stmt->fetch();
        if (!$res) {
            return false;
        }
        $calculado = self::calculaPW($passwd,$res['salt'],$res['iteracoes']);
        if ($res['passwd'] == $calculado) {
            $usr = new Usuario();
            //$res['sobrenome'],$res['passwd'],$res['id_tipo'],false,$res['id']
            $usr->setLogin($login);
            $usr->setId($res['id']);
            $usr->setPrenome($res['prenome']);
            $usr->setSobrenome($res['sobrenome']);
            $usr->setTipo(TipoUsuario::getById($res['id_tipo']));
            $usr->salt = $res['salt'];
            $usr->iteracoes = $res['iteracoes'];
            if ($usr->iteracoes != ConfigClass::pw_iter) {
                $usr->geraPW($passwd);
                $usr->save();
            }
            unset($usr->salt);
            return $usr;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPrenome() {
        return $this->prenome;
    }

    /**
     * @param mixed $prenome
     */
    public function setPrenome($prenome) {
        $this->prenome = $prenome;
    }

    /**
     * @return mixed
     */
    public function getSobrenome() {
        return $this->sobrenome;
    }

    /**
     * @param mixed $sobrenome
     */
    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return mixed
     */
    public function getIteracoes() {
        return $this->iteracoes;
    }

    /**
     * @param mixed $iteracoes
     */
    public function setIteracoes($iteracoes) {
        $this->iteracoes = $iteracoes;
    }

    /**
     * @return mixed
     */
    public function getPasswd() {
        return $this->passwd;
    }

    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function saveToSession() {
        (session_status() != PHP_SESSION_ACTIVE) and session_start();
        $json = $this->asJSON();
        $_SESSION[Usuario::USER_SESSION] = base64_encode($json);
    }

    public static function destroySession() {
        session_start();
        session_destroy();
        session_commit();
    }

    public static function restoreFromSession() {
        (session_status() != PHP_SESSION_ACTIVE) and session_start();
        if (isset($_SESSION[Usuario::USER_SESSION]) ) {
            $decoded = json_decode(base64_decode($_SESSION[Usuario::USER_SESSION]));
            $usr = new Usuario();
            $usr->setId($decoded->id);
            $usr->setLogin($decoded->login);
            $usr->setPrenome($decoded->prenome);
            $usr->setSobrenome($decoded->sobrenome);
            $tipoArr = json_decode($decoded->tipo);
            require_once (__DIR__ . '/TipoUsuario.php');
            $tp = new TipoUsuario();
            $tp->setId($tipoArr->id);
            $tp->setDescricao($tipoArr->descricao);
            $usr->setTipo($tp);
//            $usr->setLogin()
            return $usr;
        }
        return null;
    }

    public function asJSON($extraAttrs = array()) {
        $arr = [
            'id' => $this->id,
            'login' => $this->login,
            'prenome' => $this->prenome,
            'sobrenome' => $this->sobrenome,
            'tipo' => $this->tipo->asJSON()
        ];
        $a = json_encode($arr);
        return $a;
    }


}