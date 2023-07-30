<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);

        @$id_user = $_POST['id_user'];
        @$name = $_POST['name'];
        @$username = $_POST['username'];
        @$password1 = $_POST['password1'];
        @$password2 = $_POST['password2'];
        @$address = $_POST['address'];
        @$level = $_POST['level'];
        @$email = $_POST['email'];
        @$no_telp = $_POST['no_telp'];
        @$token = $_POST['token'];

        if (@$level == "" || @$level == null) {
            @$level = "user";
        }
       
        @$data_user = $data->data_user(
            @$id_user,
            @$name
        );

        if (@$password1 == @$password2) {
            @$password = md5(@$password1);
        }

        @$row_user = $data_user->fetch_object();
        if (@$name == "") {
            $response["value"] = "0";
            $response["message"] = "Nama Harus Diisi";  
        }elseif(@$username == ""){
            $response["value"] = "0";
            $response["message"] = "Username Harus Diisi";
        }elseif(@$password1 != @$password2){
            $response["value"] = "0";
            $response["message"] = "Password Yang Diketik Tidak Sama !";
        }elseif(@$password == "" || @$password == null){
            $response["value"] = "0";
            $response["message"] = "Password Harus Diisi";
        }elseif(@$address == ""){
            $response["value"] = "0";
            $response["message"] = "Alamat Harus Diisi";
        }elseif(@$level == ""){
            $response["value"] = "0";
            $response["message"] = "Level Harus Diisi";
        }elseif(isset($row_user)){
            $response["value"] = "0";
            $response["message"] = "Data User Sudah Ada";
        }else {
            @$add_user = $data->add_user(
                @$id_user,
                @$name,
                @$username,
                @$password,
                @$address,
                @$level,
                @$email,
                @$no_telp,
                @$token);
            if ($add_user) {
                $response["value"] = "1";
                $response["message"] = "Tambah User Berhasil";
                
            }else{
                $response["value"] = "0";
                $response["message"] = "Tambah User Gagal";
            }                  
        }
        array_push($result, $response);  
        echo json_encode($result);
    }
?>