<?php
class Modelo_Usuario
{
    private $conexion;
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function VerificarUsuario($usuario, $contra)
    {
        $sql = "call SP_VERIFICAR_USUARIO('$usuario')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                if (password_verify($contra, $consulta_VU["usu_contrasena"])) {
                    $arreglo[] = $consulta_VU;
                }
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Listar_Usuario()
    {
        $sql = "call SP_LISTAR_USUARIO()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo["data"][] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
}