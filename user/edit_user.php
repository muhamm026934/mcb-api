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
            "",
            @$name
        );

        @$row_user = $data_user->fetch_object();
        @$id_user_cek = $row_user->id_user;
        @$name_cek = $row_user->id_user;
        @$username_cek = $row_user->username;
        @$password_cek = $row_user->password;
        
        if (@$password1 == @$password2) {
            
            if (@$password_cek == @$password1 ) {
                @$password = @$password1;
            }else {
                @$password = md5(@$password1);
            }
        }



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
        }elseif(@$id_user != @$id_user_cek && $username == $username_cek){
            $response["value"] = "0";
            $response["message"] = "Username Sudah Ada Silahkan Ganti !";
        }else {
            @$edit_user = $data->edit_user(
                @$id_user,
                @$name,
                @$username,
                @$password,
                @$address,
                @$level,
                @$email,
                @$no_telp,
                @$token);
            if ($edit_user) {
                $response["value"] = "1";
                $response["message"] = "Ubah Data Berhasil";
                
            }else{
                $response["value"] = "0";
                $response["message"] = "Ubah Data Gagal";
            }                  
        }
        array_push($result, $response);  
        echo json_encode($result);
    }
?>