<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin_registration extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }
    
    public function index_post(){
        //Nama
        //Nip
        //Password

        $data = array(
            'nama_guru' => $this->post('nama_guru'),
            'nip'       => $this->post('nip'),
            'password'  => md5($this->post('password'))
        );
        $insert_data =  $this->Admin_model->post_register_guru($data);

        if ($insert_data != false) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Disimpan'
            ], Self::HTTP_CREATED);
        } else {
            $this->response( [
                'status' => false,
                'message' => "Data Guru Gagal Disimpan"
            ], Self::HTTP_BAD_REQUEST );
        }
    }

    public function index_get(){
        $id = $this->get('id_guru');

        $data_guru = $this->Admin_model->get_register_guru($id);

        if ( $id == NULL || '' ){
            if ($data_guru != NULL) {
                $this->response([
                    'status' => true,
                    'message' => 'Data Guru Ditampilkan',
                    'data'=> $data_guru
                ], Self::HTTP_OK);
            }else{
                $this->response( [
                    'status' => false,
                    'message' => 'Data Guru Kosong'
                ], Self::HTTP_NOT_FOUND );
            }
        }else{
            if ($data_guru != NULL) {
                $this->response([
                    'status' => true,
                    'message' => 'Data Guru Ditampilkan',
                    'data'=> $data_guru
                ], Self::HTTP_OK);
            } else {
                $this->response( [
                    'status' => false,
                    'message' => "Data Guru Tidak Ditemukan"
                ], Self::HTTP_NOT_FOUND );
            }
        }
    }

    public function index_delete(){

    }
}