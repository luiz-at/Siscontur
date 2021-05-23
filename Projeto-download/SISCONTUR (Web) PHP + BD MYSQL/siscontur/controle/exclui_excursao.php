<?php

    require_once("../modelo/Excursao.php");
    require_once("../persistencia/ExcursaoDAO.php");

    $cr = $_GET["id"]; 

    ExcursaoDAO::excluirexcursao($cr);

    header("location: ../pag_exibe_excursoes.php");

?>