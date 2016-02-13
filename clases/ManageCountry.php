<?php

class ManageCountry {

    private $bd = null;
    private $tabla = "country";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function count() {
        $r = $this->bd->count($this->tabla);
        return $r;
    }

    function getList() {
        $this->bd->select($this->tabla, "*", "1=1", array(), "Name, Continent, Code");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $country = new Country();
            $country->set($fila);
            $r[] = $country;
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

    function get($Code) {
        $parametros = array();
        $parametros['Code'] = $Code;
        $this->bd->select($this->tabla, '*', 'Code=:Code', $parametros);
        $fila = $this->bd->getRow();
        $country = new Country();
        $country->set($fila);
        return $country;
    }

    function delete($Code) {
        $parametros = array();
        $parametros['Code'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function forzarDelete($Code) {
        $parametros = array();
        $parametros['CountryCode'] = $Code;
        $gestor = new ManageCity($this->bd);
        $gestor->deleteCities($parametros);
        $this->bd->delete("countrylanguage", $parametros);
        $parametros = array();
        $parametros['Code'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Country $country) {

    }

    function set(Country $country, $pkCode) {
        $parametros = $country->getArray();
        $parametrosWhere = array();
        $parametrosWhere["Code"] = $pkCode;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }

    function insert(Country $country) {
        $parametros = $country->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "Code, Name", array(), "Name");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

}