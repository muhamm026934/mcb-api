<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);

        @$username = $_POST['username'];
        @$password = md5($_POST['password']);

        if (@$username == "" || @$password == "" ) {
            $response['value'] = "0";
            $response['message'] = "Login Gagal , Password atau Username Harus Diisi ";
        }else {
            @$user = $data->login($username,$password);
            @$data_user = $user->fetch_object();
            if (isset($data_user)) {
                $id_user = $data_user->id_user;
                $name = $data_user->name;            
                $username = $data_user->username;
                $password = $data_user->password;
                $address = $data_user->address;
                $level = $data_user->level;
                $email = $data_user->email;
                $no_telp = $data_user->no_telp;
                $token = $data_user->token;
    
                $response['value'] = "1";
                $response['message'] = "Login Berhasil";
                $response['id_user'] = strval($id_user);
                $response['name'] = $name;            
                $response['username'] = $username;
                $response['password'] = $password;
                $response['address'] = $address;
                $response['level'] = $level;            
                $response['no_telp'] = $no_telp;
                $response['email'] = $email;
                $response['token'] = $token;
            }else{
                $response['value'] = "0";
                $response['message'] = "Login Gagal";
                
            }
        }
        echo json_encode($response);
    }
?>