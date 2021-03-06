<?php
/**
 * Created by PhpStorm.
 * User: SSI-Bruno
 * Date: 20/12/2017
 * Time: 18:48
 */

require_once (__DIR__ . '/EntidadeAbstrata.php');
class Produto extends EntidadeAbstrata {

    private $container;
    private $referencia;
    private $descricao;
    private $observacao;
    private $variacao;
    private $usuarioCriacao;
    private $dthrCriacao;

    protected static $tbName = 'produto';

    protected static $dicionario = [
        'referencia' => 'referencia',
        'descricao' => 'descricao',
        'dthrCriacao' => 'dthr_criacao',
        'observacao' => 'observacao',
        'variacao' => 'variacao'
    ];
    protected static $hasOne = [
        'container' => [
            'clEntityName' => 'Container',
            'tbForeignKey' => 'id_container'
        ], 'usuarioCriacao' => [
            'clEntityName' => 'Usuario',
            'tbForeignKey' => 'usuario_criacao'
        ]
    ];

//    public function asJSON($extraAttrs = array()) {
//        require_once(__DIR__ . '/Usuario.php');
//        require_once(__DIR__ . '/Container.php');
//        $arr = [
//            'id' => $this->id,
//            'referencia' => $this->referencia,
//            'descricao' => $this->descricao,
//            'observacao' => $this->observacao,
//            'variacao' => $this->variacao,
//            'dthrCriacao' => $this->dthrCriacao,
//            'usuarioCriacao' => $this->usuarioCriacao->asJSON(),
//            'container' => $this->container->asJSON()
//        ];
//        return json_encode($arr);
//    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container) {
        require_once(__DIR__ . '/Container.php');
        $this->container = is_object($container) ? $container : isset($container) ? Container::getById($container) : null;
    }

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }

    public function getVariacao() {
        return $this->variacao;
    }

    public function setVariacao( $variacao ) {
        $this->variacao = $variacao;
    }

    /**
     * @return mixed
     */
    public function getUsuarioCriacao()
    {
        return $this->usuarioCriacao;
    }

    /**
     * @param mixed $usuarioCriacao
     */
    public function setUsuarioCriacao($usuarioCriacao) {
        require_once (__DIR__ . '/Usuario.php');
        $this->usuarioCriacao = is_object($usuarioCriacao) ? $usuarioCriacao : Usuario::getById($usuarioCriacao);
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



}