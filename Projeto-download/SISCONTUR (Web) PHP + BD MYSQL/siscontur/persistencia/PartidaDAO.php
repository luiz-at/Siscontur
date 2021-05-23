<?php

    class PartidaDAO{

        public static function registraPartida($p)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "insert into Partida (data_saida,ocorrencias,valor_taxa_pago)
             values (:data_saida,:ocorrencias,:valor_taxa_pago)";

            $acao = $con->prepare($sql);

            $param = array(":data_saida"=>$p->data_saida,
                           ":ocorrencias"=>$p->ocorrencias,
                           ":valor_taxa_pago"=>$p->valor_taxa_pago);      
            return $acao->execute($param);
        }

        public static function retornaIdPartida()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "SELECT MAX(id_partida) as id_partida FROM Partida";

            $sql = $con->query($sql);
            $row = $sql->fetch();

            $ultimoid = $row["id_partida"];
            return $ultimoid;
        }

        public static function buscaPorCodigoRegistro($cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Partida where id_partida=:id";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$cod);

            $acao->execute($parametros);            

            $retorno = NULL;
		
            if($obj = $acao->fetchObject())
            {
			    $retorno = new Partida($obj->data_saida,$obj->ocorrencias,
                                          $obj->valor_taxa_pago);
		    }
		
		    return $retorno;            
        }

        public static function atualizainformacoes($cod,$dataPartida,$ocorencia)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Partida set data_saida = :dt_saida , ocorrencias = :ocorrencia
                                                                where id_partida = :id";

            $acao = $con->prepare($sql);

            $parametros = array(":dt_saida"=>$dataPartida,
                                ":ocorrencia"=>$ocorencia,":id"=>$cod);                                

            $acao->execute($parametros);
        }

        public static function atualizaTaxaPartida($idPartida,$taxa)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Partida set valor_taxa_pago = :valor where id_partida = :id";

            $acao = $con->prepare($sql);

            $parametros = array(":valor"=>$taxa,
                                ":id"=>$idPartida);                                

            $acao->execute($parametros);
        }

    }
?>