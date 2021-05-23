<?php    
    class ExcursaoDAO{

        public static function retornaId()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "SELECT MAX(id_excursao) as id_excursao FROM excursao";

            $sql = $con->query($sql);
            $row = $sql->fetch();

            $ultimoid = $row["id_excursao"];
            return $ultimoid;
        }
       
        public static function buscaPorCodigoRegistro($cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Excursao where codigo_registro=:cod";

            $acao = $con->prepare($sql);

            $parametros = array(":cod"=>$cod);

            $acao->execute($parametros);            

            $retorno = NULL;
		
            if($obj = $acao->fetchObject())
            {
			    $retorno = new Excursao($obj->nome_responsavel,$obj->cpf_responsavel,
                                          $obj->numero_turistas,$obj->tipo_transporte,
                                          $obj->codigo_registro,$obj->id_chegada,$obj->id_partida,
                                          $obj->id_multa);
		    }		
		    return $retorno;            
        }

        public static function listaExcursoes()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Excursao";

            $acao = $con->prepare($sql);

            $acao->execute();

            $retorno = array();

            while($obj = $acao->fetchObject())
            {
                $retorno[] = new Excursao($obj->nome_responsavel,$obj->cpf_responsavel,
                                          $obj->numero_turistas,$obj->tipo_transporte,
                                          $obj->codigo_registro,$obj->id_chegada,$obj->id_partida,
                                          $obj->id_multa);
            }                     
            
            return $retorno;
        }

        public static function registrar($excursao)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "insert into Excursao(nome_responsavel,cpf_responsavel,numero_turistas,tipo_transporte,codigo_registro)
                    values(:nome_responsavel,:cpf_responsavel,:numero_turistas,:tipo_transporte,:codigo_registro)";

            $acao = $con->prepare($sql);

            $parametros = array(":nome_responsavel"=>$excursao->nome_responsavel,
                                ":cpf_responsavel"=>$excursao->cpf_responsavel,
                                ":numero_turistas"=>$excursao->numero_turistas,
                                ":tipo_transporte"=>$excursao->tipo_transporte,
                                ":codigo_registro"=>$excursao->codigo_registro);

            return $acao->execute($parametros);
        }

        public static function cadastraIdChegada($id,$cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Excursao set id_chegada = :id where codigo_registro = :cod";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$id,":cod"=>$cod);

            $acao->execute($parametros);
        }


        public static function cadastraIdPartida($id,$cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Excursao set id_partida = :id where codigo_registro = :cod";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$id,":cod"=>$cod);

            $acao->execute($parametros);
        }


        public static function cadastraIdMulta($id,$cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Excursao set id_multa = :id where codigo_registro = :cod";

            $acao = $con->prepare($sql);

            $parametros = array(":id"=>$id,":cod"=>$cod);

            $acao->execute($parametros);
        }

        public static function atualizainformacoes($cd_registro,$nome,$cpf,$nturistas,$tiptransporte)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "update Excursao set nome_responsavel = :nome , cpf_responsavel = :cpf ,
            numero_turistas = :nturistas , tipo_transporte = :tiptransporte where codigo_registro = :cd_registro ";

            $acao = $con->prepare($sql);

            $parametros = array(":cd_registro"=>$cd_registro,":nome"=>$nome,
                                ":cpf"=>$cpf,":nturistas"=>$nturistas,":tiptransporte"=>$tiptransporte);

            $acao->execute($parametros);
        }

        public static function excluirexcursao($cod)
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = ("delete FROM Excursao WHERE codigo_registro = :cod");

            $acao = $con->prepare($sql);

            $parametros = array(":cod"=>$cod);

            $acao->execute($parametros);
        }

        public static function listaExcursoesNaCidade()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Excursao where id_partida is null and id_chegada is not null";

            $acao = $con->prepare($sql);

            $acao->execute();

            $retorno = array();

            while($obj = $acao->fetchObject())
            {
                $retorno[] = new Excursao($obj->nome_responsavel,$obj->cpf_responsavel,
                                          $obj->numero_turistas,$obj->tipo_transporte,
                                          $obj->codigo_registro,$obj->id_chegada,$obj->id_partida,
                                          $obj->id_multa);
            }                     
            
            return $retorno;
        }

        public static function listaExcursoesForaDaCidade()
        {
            $con = new PDO("mysql:dbname=siscontur;host=localhost;port=3306","root","");

            $sql = "select * from Excursao where id_partida is not null and id_chegada is not null";

            $acao = $con->prepare($sql);

            $acao->execute();

            $retorno = array();

            while($obj = $acao->fetchObject())
            {
                $retorno[] = new Excursao($obj->nome_responsavel,$obj->cpf_responsavel,
                                          $obj->numero_turistas,$obj->tipo_transporte,
                                          $obj->codigo_registro,$obj->id_chegada,$obj->id_partida,
                                          $obj->id_multa);
            }                     
            
            return $retorno;
        }

   }
?>