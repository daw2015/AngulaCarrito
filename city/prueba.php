<?php
require '../clases/AutoCarga.php';

$city1 = new City(12, 'Granada', 'ESP', '', 12000);
$city2 = new City(2, 'Sevilla', 'ESP', '', 1000);
$city3 = new City(3, 'Córdoba', 'ESP', '', 2000);

//Carrito::add($city2);
//Carrito::add($city1);
//Carrito::add($city2);
//Carrito::sub($city1);
//Carrito::del($city2);
$r = Carrito::get();
$pe = $r[12];
echo $pe->getJson();
echo "<hr>";
$pe = $r[2];
echo $pe->getJson();
echo "<hr>";
echo Carrito::getSize();
echo "<hr>";
$r = Carrito::get(0);
echo $r->getJson();
echo "<hr>";
echo Carrito::getJson();