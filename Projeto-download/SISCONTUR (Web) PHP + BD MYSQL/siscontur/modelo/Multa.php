<?php

class Multa{

    public $id_multa;
    public $valor_multa;
    

    public function __construct($valor_multa)
    {
        $this->id_multa = NULL;
        $this->valor_multa = $valor_multa;
    }

    public function __toString()
    {
		return json_encode($this);
	}

    public function retornaId()
    {
        return $this->id_multa;
    }
}
?>