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

        @$data_user = $data->data_user(
            @$id_user,
            @$name
        );

            while ($row_user = $data_user->fetch_object()) {
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
            $b['id_user'] = $id_user; 
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