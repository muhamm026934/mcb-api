<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);


        @$id_absensi = $_POST['id_absensi'];
        @$id_kajian = $_POST['id_kajian'];
        @$id_user = $_POST['id_user'];
        @$datetime_absen = $_POST['datetime_absen'];

        @$data_absensi = $data->data_absensi_cek(
            @$id_absensi,
            @$id_kajian,
            @$id_user,
            @$datetime_absen
        );

        @$row_absensi = $data_absensi->fetch_object();
        if (@$id_kajian == "") {
            $response["value"] = "0";
            $response["message"] = "Judul Kajian Harus Dipilih";  
        }elseif($id_user == "" || $id_user == null){
            $response["value"] = "0";
            $response["message"] = "Anda Belum Login !";
        }elseif(isset($row_absensi)){
            $response["value"] = "0";
            $response["message"] = "Anda Sudah Absen !";
        }else {
            @$add_absensi = $data->add_absensi(
                @$id_absensi,
                @$id_kajian,
                @$id_user,
                @$datetime_absen
            );
            if ($add_absensi) {
                $response["value"] = "1";
                $response["message"] = "Absensi Berhasil";
                
            }else{
                $response["value"] = "0";
                $response["message"] = "Absensi Gagal";
            }                  
        }
        array_push($result, $response);  
        echo json_encode($result);
    }
?>