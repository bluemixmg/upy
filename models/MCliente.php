<?php

class MCliente {
    private $cedula;
    private $nombre;
    private $apellido;
    private $empresa;
    private $sexo;
    private $fechaNac;
    private $dir_latitud;
    private $dir_longitud;
    private $Parada;
    //---------------------------
    private $usuario;
    
    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getDir_latitud() {
        return $this->dir_latitud;
    }

    function getDir_longitud() {
        return $this->dir_longitud;
    }

    function getParada() {
        return $this->Parada;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setDir_latitud($dir_latitud) {
        $this->dir_latitud = $dir_latitud;
    }

    function setDir_longitud($dir_longitud) {
        $this->dir_longitud = $dir_longitud;
    }

    function setParada($Parada) {
        $this->Parada = $Parada;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}
