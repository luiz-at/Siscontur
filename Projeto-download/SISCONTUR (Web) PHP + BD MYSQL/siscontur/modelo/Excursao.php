<?php

class Excursao{

    public $id_excursao;
    public $codigo_registro;
    public $nome_responsavel;
    public $cpf_responsavel;
    public $numero_turistas;
    public $tipo_transporte;    
    
    public $id_chegada;
    public $id_partida;
    public $id_multa;    


    public function __construct($nome_responsavel,$cpf_responsavel,$numero_turistas,$tipo_transporte,
                                $codigo_registro,$id_chegada,$id_partida,$id_multa)
    {       
        $this->nome_responsavel = $nome_responsavel;
        $this->cpf_responsavel = $cpf_responsavel;
        $this->numero_turistas = $numero_turistas;
        $this->tipo_transporte = $tipo_transporte;
        $this->codigo_registro = $codigo_registro;
        
        $this->id_excursao = NULL;  
        $this->id_chegada = $id_chegada;
        $this->id_partida = $id_partida;
        $this->id_multa = $id_multa;
    }


    public function get_id_chegada()
    {
        return $this->id_chegada;
    }

    public function __toString()
    {
		return json_encode($this);
	}

}
?>