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
        @$jam_start_kajian = $_POST['jam_start_kajian'];
        @$jam_end_kajian = $_POST['jam_end_kajian'];
        @$tgl_kajian = $_POST['tgl_kajian'];  

        

        @$data_kajian = $data->data_kajian(
            @$id_kajian,
            @$nm_kajian,
            @$foto_kajian,
            @$jam_start_kajian,
            @$jam_end_kajian,
            @$tgl_kajian                
        );
        @$row_kajian = $data_kajian->fetch_object();
        @$id_kajian_help = $row_kajian->id_kajian;
        @$nm_kajian_help = $row_kajian->nm_kajian;
        @$foto_kajian_help = $row_kajian->foto_kajian;
        @$jam_start_kajian_help = $row_kajian->jam_start_kajian;
        @$jam_end_kajian_help = $row_kajian->jam_end_kajian;
        @$tgl_kajian_help = $row_kajian->tgl_kajian;
        
        if (@$file != null) {
            $temp = explode(".", @$file);
            $foto_kajian = @$nm_kajian . '.' . end($temp);
            
        }else{
            @$foto_kajian = @$foto_kajian_help;
        }

        @$target_file = $target_dir.basename(@$foto_kajian);

        if (@$nm_kajian == "") {
            $response["value"] = "0";
            $response["message"] = "Nama Kajian Harus Diisi";  
        }else {
            @$edit_kajian = $data->edit_kajian(
                @$id_kajian,
                @$nm_kajian,
                @$foto_kajian,
                @$jam_start_kajian,
                @$jam_end_kajian,
                @$tgl_kajian                
            );
            if ($edit_kajian) {
                $response["value"] = "1";
                $response["message"] = "Ubah Data Kajian Berhasil";

                if (@$file != null) {
                    if (file_exists(@$target_dir.$foto_kajian_help)) {
                        $delete  = unlink(@$target_dir.$foto_kajian_help);
                        $response["value_delete_image"] = "1";
                    }
                    @$move_uploaded_files = move_uploaded_file(@$file_tmp,@$target_file);
                    if (@$move_uploaded_files) {
                        $response["value_image"] = "1";
                        $response["foto_kajian"] = $foto_kajian;
                    }else{
                        $response["value_image"] = "0";                    
                    }    
                }

            }else{
                $response["value"] = "0";
                $response["message"] = "Ubah Data Kajian Gagal";
            }                  
        }
        array_push($result, $response);  
        echo json_encode($result);
    }
?>