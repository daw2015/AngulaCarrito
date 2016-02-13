<?php
require '../clases/AutoCarga.php';
header('Content-Type: application/json');
$id = Request::req("ID");
$bd = new DataBase();
$gestor = new ManageCity($bd);
$producto = $gestor->get($id);
Carrito::add($producto);
echo '{"r":' . Carrito::getJson() . '}';