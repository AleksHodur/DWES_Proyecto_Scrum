<?php

require_once('../services/UsuarioService.php');

class UsuarioController{

    //???public $servicio; //objeto UsuarioService

    public function getUsuario($id){
        return json_encode(UsuarioService::getUsuario($id));
    }

    public function guardarUsuario($json){//post
        $parseado = json_decode($json);
        UsuarioService::postUsuario($parseado);
    }

    public function actualizarUsuario($json){//put: mismo json que post
        $parseado = json_decode($json);
        UsuarioService::putUsuario($parseado);
    }

    public function deleteUsuario($id){
        UsuarioService::deleteUsuario($id);
    }
}