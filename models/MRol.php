<?php

class MRol {
    //put your code here
    private $id_rol;
    private $nombre;
    private $estatus;
    
    function getId_rol() {
        return $this->id_rol;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setId_rol($id_rol) {
        $this->id_rol = $id_rol;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


    
}
