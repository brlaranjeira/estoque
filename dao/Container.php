<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 20/12/2017
 * Time: 18:47
 */

require_once (__DIR__ . '/EntidadeAbstrata.php');
class Container extends EntidadeAbstrata {

    private $referencia;
    private $dthrCriacao;
    private $usuarioCriacao;

    protected static $dicionario = [
        'referencia' => 'referencia',
        'dthrCriacao' => 'dthr_criacao',
        'usuarioCriacao' => 'usuario_criacao'
    ];

    protected static $tbName = 'container';


    /**
     * @return mixed
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * @param mixed $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    /**
     * @return mixed
     */
    public function getDthrCriacao()
    {
        return $this->dthrCriacao;
    }

    /**
     * @param mixed $dthrCriacao
     */
    public function setDthrCriacao($dthrCriacao)
    {
        $this->dthrCriacao = $dthrCriacao;
    }

    /**
     * @return mixed
     */
    public function getUsuarioCriacao()
    {
        return $this->usuarioCriacao;
    }

    /**
     * @param mixed $usuario_criacao
     */
    public function setUsuarioCriacao($usuarioCriacao) {
        require_once (__DIR__ . '/Usuario.php');
        $this->usuarioCriacao = is_object($usuarioCriacao) ? $usuarioCriacao : Usuario::getById($usuarioCriacao);
    }

    public function asJSON($extraAttrs = array()) {
        require_once (__DIR__ . '/Usuario.php');
        $arr = [
            'id' => $this->id,
            'referencia' => $this->referencia,
            'dthrCriacao' => $this->dthrCriacao,
            'usuarioCriacao' => $this->usuarioCriacao->asJSON()
        ];
        return json_encode($arr);
    }


}