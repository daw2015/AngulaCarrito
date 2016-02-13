<?php

class Carrito{
    private static $carrito;
    private static $session = NULL;
    const NOMBRECARRITO = '__carrito';


    function __construct() {
    }

    /*
        Carrito::add($producto);
        Carrito::del($producto);
        Carrito::sub($producto);
    */
    
    static function add(City $producto){ // Producto
        self::loadCarrito();
        if(isset(self::$carrito[$producto->getID()])){
            $linea = self::$carrito[$producto->getID()];
            $linea->add();      
        }else{
            $linea = new LineaCarrito($producto);
            self::$carrito[$producto->getID()] = $linea;   
        } 
        return self::saveCarrito();
    }
    
    static function del(City $producto){
        self::loadCarrito();
        unset(self::$carrito[$producto->getID()]);
        return self::saveCarrito();
        //return self::$carrito;
    }
    
    static function get($index = null){
        self::loadCarrito();
        if($index===null){
            return self::$carrito;
        }
        $indices = array_keys(self::$carrito);
        if(isset($indices[$index])){
            return self::$carrito[$indices[$index]];
        }
        /*$contador = 0;
        foreach (self::$carrito as $key => $value) {
            if($contador === $index){
                return $value;
            }
            $contador++;
        }*/
        
        return null;
    }

    static function getJson(){
        self::loadCarrito();
        $r = '[';
        foreach (self::$carrito as $value) {
            $r .= $value->getJson() . ',';
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    static function getSize(){
        self::loadCarrito();
        return count(self::$carrito);
    }
    
    static function sub(City $producto){
        self::loadCarrito();
        if(isset(self::$carrito[$producto->getID()])){
            $linea = self::$carrito[$producto->getID()];
            if($linea->sub() == 0){
                self::del($producto);
                return;
            }      
        } 
        return self::saveCarrito();
    }
    
    private static function loadCarrito(){
        if(self::$session == NULL){
            self::$session = new Session();
        }
        self::$carrito = self::$session->get(self::NOMBRECARRITO);
        if(self::$carrito == NULL){
            self::$carrito = array();
        }
    }
    
    private static function saveCarrito(){
        $res = self::$session->set(self::NOMBRECARRITO, self::$carrito);
        //var_dump($res);
        //echo'<hr/>';
        return $res;
    }

}