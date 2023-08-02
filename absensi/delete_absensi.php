<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        
        @$id_absensi = $_POST['id_absensi'];
        if (@$id_absensi != ""|| @$id_absensi != null) {
            @$delete_absensi = $data->delete_absensi(
                @$id_absensi,
                @$id_kajian,
                @$id_user,
                @$datetime_absen               
            );
                           
                if (@$delete_absensi) {
                    $response["value"] = "1";
                    $response["message"] = "Hapus Absensi Berhasil";              
                }else{
                    $response["value"] = "0";
                    $response["message"] = "Hapus Absensi Gagal";	
                }  

        }else {
            $response["value"] = "0";
            $response["message"] = "Hapus Absensi Gagal";	               
        }
        array_push($result, $response); 
        echo json_encode($result);
    }
?>