<?php

class Country {
    private $Code, $Name, $Continent, $Region, $SurfaceArea, $IndepYear, 
            $Population, $LifeExpectancy, $GNP, $GNPOld, $LocalName, 
            $GovernmentForm, $HeadOfState, $Capital, $Code2;
    
    function __construct($Code=null, $Name=null, $Continent=null, $Region=null, 
            $SurfaceArea=null, $IndepYear=null, $Population=null, 
            $LifeExpectancy=null, $GNP=null, $GNPOld=null, $LocalName=null, 
            $GovernmentForm=null, $HeadOfState=null, $Capital=null, $Code2=null) {
        $this->Code = $Code;
        $this->Name = $Name;
        $this->Continent = $Continent;
        $this->Region = $Region;
        $this->SurfaceArea = $SurfaceArea;
        $this->IndepYear = $IndepYear;
        $this->Population = $Population;
        $this->LifeExpectancy = $LifeExpectancy;
        $this->GNP = $GNP;
        $this->GNPOld = $GNPOld;
        $this->LocalName = $LocalName;
        $this->GovernmentForm = $GovernmentForm;
        $this->HeadOfState = $HeadOfState;
        $this->Capital = $Capital;
        $this->Code2 = $Code2;
    }
    
    function getCode() {
        return $this->Code;
    }

    function getName() {
        return $this->Name;
    }

    function getContinent() {
        return $this->Continent;
    }

    function getRegion() {
        return $this->Region;
    }

    function getSurfaceArea() {
        return $this->SurfaceArea;
    }

    function getIndepYear() {
        return $this->IndepYear;
    }

    function getPopulation() {
        return $this->Population;
    }

    function getLifeExpectancy() {
        return $this->LifeExpectancy;
    }

    function getGNP() {
        return $this->GNP;
    }

    function getGNPOld() {
        return $this->GNPOld;
    }

    function getLocalName() {
        return $this->LocalName;
    }

    function getGovernmentForm() {
        return $this->GovernmentForm;
    }

    function getHeadOfState() {
        return $this->HeadOfState;
    }

    function getCapital() {
        return $this->Capital;
    }

    function getCode2() {
        return $this->Code2;
    }

    function setCode($Code) {
        $this->Code = $Code;
    }

    function setName($Name) {
        $this->Name = $Name;
    }

    function setContinent($Continent) {
        $this->Continent = $Continent;
    }

    function setRegion($Region) {
        $this->Region = $Region;
    }

    function setSurfaceArea($SurfaceArea) {
        $this->SurfaceArea = $SurfaceArea;
    }

    function setIndepYear($IndepYear) {
        $this->IndepYear = $IndepYear;
    }

    function setPopulation($Population) {
        $this->Population = $Population;
    }

    function setLifeExpectancy($LifeExpectancy) {
        $this->LifeExpectancy = $LifeExpectancy;
    }

    function setGNP($GNP) {
        $this->GNP = $GNP;
    }

    function setGNPOld($GNPOld) {
        $this->GNPOld = $GNPOld;
    }

    function setLocalName($LocalName) {
        $this->LocalName = $LocalName;
    }

    function setGovernmentForm($GovernmentForm) {
        $this->GovernmentForm = $GovernmentForm;
    }

    function setHeadOfState($HeadOfState) {
        $this->HeadOfState = $HeadOfState;
    }

    function setCapital($Capital) {
        $this->Capital = $Capital;
    }

    function setCode2($Code2) {
        $this->Code2 = $Code2;
    }

    //3º getJson
    function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
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
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores=true){
        $array = array();
        foreach($this as $key => $valor) {
            if($valores===true){
                $array[$key] = $valor;
            }else{
                $array[$key]=null;
            }
        }
        return $array;
    }
    
    function read(){
        foreach($this as $key => $valor) {
            $this->$key = Request::req($key);
        }
    }
}