<?php

class City {
    private $ID, $Name, $CountryCode, $District, $Population;
    
    //1º constructor -> null
    function __construct($ID = null, $Name = null, $CountryCode = null, $District = null, $Population = null) {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->CountryCode = $CountryCode;
        $this->District = $District;
        $this->Population = $Population;
    }
    
    //2º getter y setter
    function getID() {
        return $this->ID;
    }

    function getName() {
        return $this->Name;
    }

    function getCountryCode() {
        return $this->CountryCode;
    }

    function getDistrict() {
        return $this->District;
    }

    function getPopulation() {
        return $this->Population;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setName($Name) {
        $this->Name = $Name;
    }

    function setCountryCode($CountryCode) {
        $this->CountryCode = $CountryCode;
    }

    function setDistrict($District) {
        $this->District = $District;
    }

    function setPopulation($Population) {
        $this->Population = $Population;
    }

    //3º getJson
    function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            //$r .= '"' . $indice . '":"' . $valor . '",';
            //$r.='"' . $indice . '":' . json_encode(htmlspecialchars_decode($valor)) . ',';
            $r.='"' . $indice . '":' . json_encode($valor) . ',';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
    
    //4º set genérico
    function setOld($valores, $inicio=0){
        $this->ID = $valores[0+$inicio];
        $this->Name = $valores[1+$inicio];
        $this->CountryCode = $valores[2+$inicio];
        $this->District = $valores[3+$inicio];
        $this->Population = $valores[4+$inicio];
    }

    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i+$inicio];
            $i++;
        }
    }
    
    public function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key $valor ";
        }
        return $r;
    }
    
    function read(){
        foreach($this as $key => $valor) {
            $this->$key = Request::req($key);
        }
    }
}