<?php
    class MultaDAO{
        public static function registraMulta($m)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "insert into Multa (valor_multa)
            values (:valor_multa)";

            $acao = $con->prepare($sql);

            $param = array(":valor_multa"=>$m->valor_multa);

            return $acao->execute($param);

        }


        public static function retornaIdMulta()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "SELECT MAX(id_multa) as id_multa FROM Multa";

            $sql = $con->query($sql);
            $row = $sql->fetch();

            $ultimoid = $row["id_multa"];
            return $ultimoid;
        }

        public static function buscaPorCodigoRegistro($cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Multa where id_multa=:id";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$cod);

            $acao->execute($parametros);            

            $retorno = NULL;
		
            if($obj = $acao->fetchObject())
            {
			    $retorno = new Multa($obj->valor_multa);
		    }
		
		    return $retorno;            
        }

}
?>