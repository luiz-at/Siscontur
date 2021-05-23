<?php

class Partida{

    public $id_partida;
    public $data_saida;
    public $ocorrencias;
    public $valor_taxa_pago;

    public function __construct($data_saida,$ocorrencias,$valor_taxa_pago)
    {
        $this->id_partida = NULL;
        $this->data_saida = $data_saida;
        $this->ocorrencias = $ocorrencias;
        $this->valor_taxa_pago = $valor_taxa_pago;        
    }

    public function __toString()
    {
		return json_encode($this);
	}

}
?>