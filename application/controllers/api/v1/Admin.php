<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index_get()
    {
        //Search by id
        $id = $this->get('id_siswa');
        
        /*
        $nama = $this->get('nama');
        $kelas = $this->get('kelas');
        $jurusan = $this->get('jurusan');
        */
 
        $users = $this->Admin_model->get_siswa($id);
        
        if ( $id == NULL || '' ){
            if ($users != NULL) {
                $this->response([
                    'status' => true,
                    'message' => 'Data Siswa Ditampilkan',
                    'data'=> $users
                ], Self::HTTP_OK);
            }else{
                $this->response( [
                    'status' => false,
                    'message' => 'Data Siswa Kosong'
                ], Self::HTTP_NOT_FOUND );
            }
        }else{
            if ($users != NULL) {
                $this->response([
                    'status' => true,
                    'message' => 'Data Siswa Ditampilkan',
                    'data'=> $users
                ], Self::HTTP_OK);
            } else {
                $this->response( [
                    'status' => false,
                    'message' => "Data Siswa Tidak Ditemukan"
                ], Self::HTTP_NOT_FOUND );
            }
        }
        // echo json_encode($result);
    }
    
    public function index_post(){
        $data = array(
            'nama_siswa'    => $this->post('nama'),
            'kelas_siswa'   => $this->post('kelas'),
            'jurusan_siswa' => $this->post('jurusan')                       
        );
        $insert_data = $this->Admin_model->post_siswa($data);

        if ($insert_data != false) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Disimpan'
            ], Self::HTTP_CREATED);
        } else {
            $this->response( [
                'status' => false,
                'message' => "Data Siswa Gagal Disimpan"
            ], Self::HTTP_BAD_REQUEST );
        }
    }

    public function index_put(){
        $id = $this->put('id');
        $data = array(
            'id'      => $id,            
            'nama'    => $this->put('nama'),
            'kelas'   => $this->put('kelas'),
            'jurusan' => $this->put('jurusan')
        );
        $update_data = $this->Admin_model->update_siswa($data);

        if ($update_data != false) {
            $this->response([
                'status' => true,
                'message' => "Data Siswa Berhasil Update"
            ], Self::HTTP_OK);
        } else {
            $this->response( [
                'status' => false,
                'message' => "Data Siswa Gagal Diupdate"
            ], Self::HTTP_BAD_REQUEST );
        }
    }

    public function index_delete(){
        $id = $this->delete('id_siswa');

        $delete_siswa = $this->Admin_model->delete_siswa($id);
        if ($delete_siswa != false) {
            $this->response([
                'status' => true,
                'message' => "Siswa Berhasil Dihapus"
            ], Self::HTTP_OK);
        }else {
            $this->response( [
                'status' => false,
                'message' => "Siswa Gagal Dihapus"
            ], Self::HTTP_BAD_REQUEST );
        }
    }
}