<?php

class ManageCity {

    private $bd = null;
    private $tabla = "city";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($ID) {
        $parametros = array();
        $parametros['ID'] = $ID;
        $this->bd->select($this->tabla, '*', 'id=:ID', $parametros);
        $fila = $this->bd->getRow();
        $city = new City();
        $city->set($fila);
        return $city;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($ID) {
        $parametros = array();
        $parametros['ID'] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteCities($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(City $city) {
        return $this->delete($city->getID());
    }

    function set(City $city) {
        $parametrosSet = array();
        $parametrosSet['Name'] = $city->getName();
        $parametrosSet['CountryCode'] = $city->getCountryCode();
        $parametrosSet['District'] = $city->getDistrict();
        $parametrosSet['Population'] = $city->getPopulation();
        $parametrosWhere = array();
        $parametrosWhere['ID'] = $city->getID();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(City $city) {
        $parametrosSet = array();
        $parametrosSet['Name'] = $city->getName();
        $parametrosSet['CountryCode'] = $city->getCountryCode();
        $parametrosSet['District'] = $city->getDistrict();
        $parametrosSet['Population'] = $city->getPopulation();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP, $condicion = "1=1", $parametros = array()) {
        $ordenPredeterminado = "$orden, Name, CountryCode, ID";
        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "Name, CountryCode, ID";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", $condicion, $parametros, $ordenPredeterminado, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $city = new City();
            $city->set($fila);
            $r[] = $city;
        }
        return $r;
    }

    function getListJson($pagina = 1, $orden = "", $nrpp = Constants::NRPP, $condicion = "1=1", $parametros = array()) {
        $list = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "ID, Name", array(), "Name");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

}
