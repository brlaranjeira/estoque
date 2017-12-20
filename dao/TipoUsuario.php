<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 7/5/17
 * Time: 7:18 PM
 */

require_once (__DIR__ . '/EntidadeAbstrata.php');
class TipoUsuario extends EntidadeAbstrata {

    private $descricao;

    protected static $tbName = 'tipo_usuario';
    protected static $dicionario = ['descricao'=>'descricao'];

    /**
     * @return mixed
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }




}