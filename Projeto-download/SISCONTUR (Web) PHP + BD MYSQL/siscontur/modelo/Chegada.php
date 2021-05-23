<?php

class Chegada{

    public $id_chegada;
    public $data_chegada;
    public $data_provavel_retorno;
    public $qtd_total_pessoas;
    public $cidade_origem;
    public $tipo_estabelecimento;

    public function __construct($data_chegada,$data_provavel_retorno,$qtd_total_pessoas,$cidade_origem,$tipo_estabelecimento)
    {
        $this->id_chegada = NULL;
        $this->data_chegada = $data_chegada;
        $this->data_provavel_retorno = $data_provavel_retorno;
        $this->qtd_total_pessoas = $qtd_total_pessoas;
        $this->cidade_origem = $cidade_origem;
        $this->tipo_estabelecimento = $tipo_estabelecimento;
    }

    

    public function __toString()
    {
		return json_encode($this);
	}

}
?>