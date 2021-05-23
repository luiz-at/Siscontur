<?php
    class ChegadaDAO{

        public static function registraChegada($c)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "insert into Chegada (data_chegada,data_provavel_retorno,qtd_total_pessoas,cidade_origem,tipo_estabelecimento)
             values (:data_chegada,:data_provavel_retorno,:qtd_total_pessoas,:cidade_origem,:tipo_estabelecimento)";

            $acao = $con->prepare($sql);

            $param = array(":data_chegada"=>$c->data_chegada,
                           ":data_provavel_retorno"=>$c->data_provavel_retorno,
                           ":qtd_total_pessoas"=>$c->qtd_total_pessoas,
                           ":cidade_origem"=>$c->cidade_origem,
                           ":tipo_estabelecimento"=>$c->tipo_estabelecimento);

            return $acao->execute($param);
        }


        public static function buscaPorCodigoRegistro($cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Chegada where id_chegada=:id";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$cod);

            $acao->execute($parametros);            

            $retorno = NULL;
		
            if($obj = $acao->fetchObject())
            {
			    $retorno = new Chegada($obj->data_chegada,$obj->data_provavel_retorno,
                                          $obj->qtd_total_pessoas,$obj->cidade_origem,
                                          $obj->tipo_estabelecimento);
		    }
		
		    return $retorno;            
        }


        public static function retornaIdChegada()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "SELECT MAX(id_chegada) as id_chegada FROM Chegada";

            $sql = $con->query($sql);
            $row = $sql->fetch();

            $ultimoid = $row["id_chegada"];
            return $ultimoid;
        }

        public static function atualizainformacoes($id,$dataChegada,$dataProvavelRetorno,$qdtTotalPessoas,$cidadeOrigem,$estabelecimento)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "UPDATE Chegada SET data_chegada = :dt_chegada , data_provavel_retorno = :dt_provavel_retorno ,
            qtd_total_pessoas = :qtd_t_pessoas , cidade_origem = :cd_origem , tipo_estabelecimento = :tp_estabelecimento WHERE id_chegada = :id";

            $acao = $con->prepare($sql);

            $parametros = array(":dt_chegada"=>$dataChegada,
                                ":dt_provavel_retorno"=>$dataProvavelRetorno,":qtd_t_pessoas"=>$qdtTotalPessoas,
                                ":cd_origem"=>$cidadeOrigem,":tp_estabelecimento"=>$estabelecimento,":id"=>$id);

            $acao->execute($parametros);
        }
    }

?>