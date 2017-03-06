<?php

class MEmpresa {
    private $rif;
    private $nombre;
    private $direccion;
    private $dir_Latitud;
    private $dir_Longitud;
    private $correo;
    private $telefono;
    private $estatus;
    private $id_usuario;
    
    function getRif() {
        return $this->rif;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getDir_Latitud() {
        return $this->dir_Latitud;
    }

    function getDir_Longitud() {
        return $this->dir_Longitud;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setRif($rif) {
        $this->rif = $rif;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setDir_Latitud($dir_Latitud) {
        $this->dir_Latitud = $dir_Latitud;
    }

    function setDir_Longitud($dir_Longitud) {
        $this->dir_Longitud = $dir_Longitud;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

}
