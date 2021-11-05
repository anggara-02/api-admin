<?php 

class Admin_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function get_siswa($id){
        if ($id == NULL || '') {
            $cek = " SELECT * FROM siswa ";
            $query_cek = $this->db->query($cek);
    
            if($query_cek->num_rows() > 0){
                $result = $query_cek->result();
            } else {
                $result = NULL;
            }
            return $result;
        }else{
            $cek = " SELECT * FROM siswa WHERE id_siswa = '$id'";
            $query_cek = $this->db->query($cek);
    
            if($query_cek->num_rows() > 0){
                $result = $query_cek->result();
            } else {
                $result = NULL;
            }
            return $result;
        }
    }
    
    public function post_siswa($data){
        $result = false;
        $this->db->insert('siswa', $data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            $result = true;
        }
        return $result;
    }
    
    public function update_siswa($data){
        $status = false;
        $result = array();

        $result['nama_siswa']       = $data['nama'];
        $result['kelas_siswa']      = $data['kelas'];
        $result['jurusan_siswa']    = $data['jurusan'];

        $id         = $data['id'];
        $nama       = $data['nama'];
        $kelas      = $data['kelas'];
        $jurusan    = $data['jurusan'];
        
        $this->db->where('id_siswa', $data['id']);
        $update = $this->db->update('siswa', $result);

        if($update){
            $status = true;
        }
        return $status;
    }

    public function delete_siswa($id){
        $result = false;

        $this->db->where('id_siswa', $id);
        $delete = $this->db->delete('siswa');

        if($delete){
            $result = true;

            //Set autoincrement after delete 1 data 
            
            /*$sql = "set @autoid :=0;";
            $this->db->query($sql);
            $sql = "update `siswa` set id_siswa = @autoid := (@autoid+1);";
            $this->db->query($sql);
            $sql = "alter table siswa Auto_Increment = 1;";
            $this->db->query($sql);*/
        }
        return $result;
    }

    public function post_register_guru($data){
        $result = false;
        $this->db->insert('guru', $data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            $result = true;
        }
        return $result;
    }

    public function get_register_guru($id){
        if ($id == NULL) {
            $sql = "SELECT * FROM guru";
            $cek_guru = $this->db->query($sql);

            if ($cek_guru->num_rows() > 0) {
                $result = $cek_guru->result();
            }
        } else {
            $sql = "SELECT * FROM guru WHERE id_guru = '$id'";
            $query_cek = $this->db->query($sql);
    
            if($query_cek->num_rows() > 0){
                $result = $query_cek->result();
            } else {
                $result = NULL;
            }
        }
        return $result;
    }
}