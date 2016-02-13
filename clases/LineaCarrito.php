<?php

class LineaCarrito {
    private $producto, $cantidad;
    
    function __construct($producto = null, $cantidad = 1) {
        $this->producto = $producto;
        $this->cantidad = $cantidad;
    }

    function getProducto() {
        return $this->producto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    
    function add(){
        $this->cantidad ++;
    }
    
    function sub(){
        if($this->cantidad > 0){
            $this->cantidad --;
        }
        return $this->cantidad;
    }
    
    function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            if(is_object($valor)){
                $r.='"' . $indice . '":' . $valor->getJson() . ',';
            } else {
                $r.='"' . $indice . '":' . json_encode($valor) . ',';
            }
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

}