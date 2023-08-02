<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        @$action = $_POST['ACTION'];
        @$id_kajian = $_POST['id_kajian'];
        @$nm_kajian = $_POST['nm_kajian'];
        @$jam_start_kajian = $_POST['jam_start_kajian'];
        @$jam_end_kajian = $_POST['jam_end_kajian'];
        @$tgl_kajian = $_POST['tgl_kajian'];     
        @$id_user_absensi = $_POST['id_user'];  

        @$data_kajian = $data->data_kajian(
            @$id_kajian,
            @$nm_kajian,
            @$foto_kajian,
            @$jam_start_kajian,
            @$jam_end_kajian,
            @$tgl_kajian                 
        ); 

            while ($row_kajian = $data_kajian->fetch_object()) {
                if (isset($row_kajian)) {
                $id_kajian = $row_kajian->id_kajian;
                $id_kajian_help = $row_kajian->id_kajian;
                $nm_kajian = $row_kajian->nm_kajian;
                $foto_kajian = $row_kajian->foto_kajian;
                $jam_start_kajian = $row_kajian->jam_start_kajian;
                $jam_end_kajian = $row_kajian->jam_end_kajian;
                $tgl_kajian = $row_kajian->tgl_kajian;

                }else{
                $id_kajian = "";	
                $nm_kajian = "";	
                $foto_kajian = "";
                $jam_start_kajian = "";	
                $jam_end_kajian = "";	
                $tgl_kajian = "";                
                }
            $b['id_kajian'] = $id_kajian; 
            $b['nm_kajian'] = $nm_kajian; 
            $b['foto_kajian'] = $foto_kajian;
            $b['jam_start_kajian'] = $jam_start_kajian; 
            $b['jam_end_kajian'] = $jam_end_kajian; 
            $b['tgl_kajian'] = $tgl_kajian;      
            $b['tgl_kajian_help'] = date("d-M-Y",strtotime($tgl_kajian));      
             
            @$data_absensi_cek = $data->data_absensi_cek(
                @$id_absensi,
                @$id_kajian_help,
                @$id_user_absensi,
                @$datetime_absen
            ); 
    
                $row_absensi_cek = $data_absensi_cek->fetch_object();
                if (isset($row_absensi_cek)) {
                $id_absensi = $row_absensi_cek->id_absensi;
                $id_user = $row_absensi_cek->id_user;
                $datetime_absen = $row_absensi_cek->datetime_absen;

                }else{
                $id_absensi = "";		
                $id_user = "";
                $datetime_absen = "";                
                }
                $b['id_absensi'] = $id_absensi; 
                $b['id_user'] = $id_user;
                $b['datetime_absen'] = $datetime_absen;   

            array_push($result, $b);

        }
        echo json_encode($result);
    }
?>