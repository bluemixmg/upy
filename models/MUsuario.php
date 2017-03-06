<?php

class MUsuario {
    //put your code here
    
    private $user;
    private $password;
    private $id_rol;
    private $estatus;
    
    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getId_rol() {
        return $this->id_rol;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setId_rol($id_rol) {
        $this->id_rol = $id_rol;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}
