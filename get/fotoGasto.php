<?php
    require_once("../constantes.php");
    session_start();
    if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
        echo SESION_EXPIRADA;
        exit();
    } else {
        if(isset($_GET['id'])){
            require_once("../conexion.php");
            $q = "SELECT foto
                  FROM gasto
                  WHERE id_usuario=".$_SESSION['id_usuario'];
            $id = mysqli_real_escape_string($con, $_GET['id']);
            $q = $q." AND id_gasto=".$id;

            $result = mysqli_query($con, $q);

            if($result AND mysqli_num_rows($result)>0){
                $filename = "";
                while($row = mysqli_fetch_assoc($result)) {
                    $filename = $row['foto'];
                }
                if(file_exists($filename)){
                    ob_clean();
                    flush();
                    readfile($filename);
                    exit();
                } else {
                    echo ERROR_FOTO;
                }
            } else {
                echo ERROR_CONSULTA;
            }
            mysqli_close($con);
        } else{
            echo FALTAN_PARAMETROS;
        }
    }
?>