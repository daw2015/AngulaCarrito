<?php
require '../clases/AutoCarga.php';
header('Content-Type: application/json');
$pagina = Request::req("pagina");
if($pagina === null){
    $pagina = 1;
}
$bd = new DataBase();
$gestor = new ManageCity($bd);
$pager = new Pager($gestor->count());
$paginas = $pager->getPaginas();
$ciudades = $gestor->getListJson($pagina);
echo '{"ciudades":' . $ciudades . ', "paginas": ' . $paginas . '}';
$bd->close();