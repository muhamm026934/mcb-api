<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        @$id_kajian = $_POST['id_kajian'];
        if (@$id_kajian != ""|| @$id_kajian != null) {
            @$delete_kajian = $data->delete_kajian(
                @$id_kajian,
                @$nm_kajian,
                @$foto_kajian,
                @$jam_start_kajian,
                @$jam_end_kajian,
                @$tgl_kajian                    
            );
                           
                if (@$delete_kajian) {
                    $response["value"] = "1";
                    $response["message"] = "Hapus Kajian Berhasil";              
                }else{
                    $response["value"] = "0";
                    $response["message"] = "Hapus Kajian Gagal";	
                }  

        }else {
            $response["value"] = "0";
            $response["message"] = "Hapus Kajian Gagal";	               
        }
        array_push($result, $response); 
        echo json_encode($result);
    }
?>