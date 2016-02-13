<?php
require '../clases/AutoCarga.php';
header('Content-Type: application/json');
echo '{"r":' . Carrito::getJson() . '}';