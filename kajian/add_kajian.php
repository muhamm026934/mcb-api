<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once ('../conn/conf.php');
	    require_once ('../model/dbs.php');

        $connection = new Dbs($host,$user,$pass,$db);
        include "../model/m_proses.php";
        $result = array();
        $data = new Proses_sql($connection);

        @$target_dir = "../foto_kajian/";
        @$file = $_FILES['files']['name'];
        @$file_tmp = $_FILES['files']['tmp_name'];
        @$id_kajian = $_POST['id_kajian'];
        @$nm_kajian = $_POST['nm_kajian'];

        $temp = explode(".", @$file);
        $foto_kajian = @$nm_kajian . '.' . end($temp);
        @$target_file = $target_dir.basename(@$foto_kajian);
        
        @$data_kajian = $data->data_kajian(
            @$id_kajian,
            @$nm_kajian,
            @$foto_kajian
        );
        @$row_kajian = $data_kajian->fetch_object();
        if (@$nm_kajian == "") {
            $response["value"] = "0";
            $response["message"] = "Nama Kajian Harus Diisi";  
        }elseif($file == "" || $file == null){
            $response["value"] = "0";
            $response["message"] = "Foto Harus Diupload";
        }elseif(isset($row_kajian)){
            $response["value"] = "0";
            $response["message"] = "Data Kajian Sudah Ada";
        }else {
            @$add_kajian = $data->add_kajian(
                @$id_kajian,
                @$nm_kajian,
                @$foto_kajian
            );
            if ($add_kajian) {
                $response["value"] = "1";
                $response["message"] = "Tambah Data Kajian Berhasil";
                @$move_uploaded_files = move_uploaded_file(@$file_tmp,@$target_file);
                if (@$move_uploaded_files) {
                    $response["value_image"] = "1";
                    $response["foto_kajian"] = $foto_kajian;
                }else{
                    $response["value_image"] = "0";                    
                }
                
            }else{
                $response["value"] = "0";
                $response["message"] = "Tambah Data Kajian Gagal";
            }                  
        }
        array_push($result, $response);  
        echo json_encode($result);
    }
?>