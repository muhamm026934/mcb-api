<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        @$id_user = $_POST['id_user'];
        if (@$id_user != ""|| @$id_user != null) {
            @$delete_user = $data->delete_user(
                @$id_user,
                @$name,
                @$username,
                @$password,
                @$address,
                @$level,
                @$email,
                @$no_telp,
                @$token
            );
                           
                if (@$delete_user) {
                    $response["value"] = "1";
                    $response["message"] = "Hapus User Berhasil";              
                }else{
                    $response["value"] = "0";
                    $response["message"] = "Hapus User Gagal";	
                }  

        }else {
            $response["value"] = "0";
            $response["message"] = "Hapus User Gagal";	               
        }
        array_push($result, $response); 
        echo json_encode($result);
    }
?>