<?php
header('Content-Type: application/json');
$array = array(
    "paises" => array(
        array(
            "Code" => "ESP",
            "Name" => "Spain"
        ),
        array(
            "Code" => "BRA",
            "Name" => "Brasil"
        ),
        array(
            "Code" => "CHN",
            "Name" => "China"
        ))
);
//echo json_encode($array);
require '../clases/AutoCarga.php';
header('Content-Type: application/json');
$pagina = Request::req("pagina");
if($pagina === null){
    $pagina = 1;
}
$bd = new DataBase();
$gestor = new ManageCountry($bd);
$pager = new Pager($gestor->count());
$paginas = $pager->getPaginas();
$paises = $gestor->getListJson($pagina);
echo '{"paises":' . $paises . ', "paginas": ' . $paginas . '}';
$bd->close();