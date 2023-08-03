<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);
        @$action = $_POST['ACTION'];
        @$level = $_POST['level'];
        @$id_absensi = $_POST['id_absensi'];
        @$id_kajian = $_POST['id_kajian'];
        @$id_user = $_POST['id_user'];
        @$datetime_absen = $_POST['datetime_absen'];

        @$data_absensi = $data->data_absensi(
            @$id_absensi,
            @$id_kajian,
            @$id_user,
            @$datetime_absen
        ); 

            while ($row_absensi = $data_absensi->fetch_object()) {
                if (isset($row_absensi)) {
                $id_absensi = $row_absensi->id_absensi;
                $id_kajian = $row_absensi->id_kajian;
                $id_user = $row_absensi->id_user;
                $datetime_absen = $row_absensi->datetime_absen;

                }else{
                $id_absensi = "";	
                $id_kajian = "";	
                $id_user = "";
                $datetime_absen = "";                
                }
            $b['id_absensi'] = $id_absensi; 
            $b['id_kajian'] = $id_kajian; 
            $b['id_user'] = $id_user;
            $b['datetime_absen'] = $datetime_absen;             


            @$data_kajian = $data->data_kajian(
                @$id_kajian,
                @$nm_kajian,
                @$foto_kajian,
                @$jam_start_kajian,
                @$jam_end_kajian,
                @$tgl_kajian   
            ); 
    
                $row_kajian = $data_kajian->fetch_object();
                    if (isset($row_kajian)) {
                    $id_kajian = $row_kajian->id_kajian;
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

                @$data_user = $data->data_user(
                    @$id_user,
                    @$name
                );

                $row_user = $data_user->fetch_object();
                    if (isset($row_user)) {
                    $id_user = $row_user->id_user;
                    $name = $row_user->name;
                    $username = $row_user->username;
                    $password = $row_user->password;
                    $address = $row_user->address;
                    $level = $row_user->level;
                    $email = $row_user->email;
                    $no_telp = $row_user->no_telp;         
                    $token = $row_user->token;  
                    }else{
                    $id_user = "";	
                    $name = "";	
                    $username = "";
                    $password = "";
                    $address = "";	
                    $level = "";
                    $email = "";
                    $no_telp = "";
                    $token = "";
                    }
                $b['name'] = $name; 
                $b['username'] = $username;
                $b['password'] = $password;    
                $b['address'] = $address;   
                $b['level'] = $level;  
                $b['email'] = $email;  
                $b['no_telp'] = $no_telp;  
                $b['token'] = $token;   

            array_push($result, $b);

        }
        echo json_encode($result);
    }
?>