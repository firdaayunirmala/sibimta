<?php

class Datata_model extends CI_Model
{
    public function getAllDatata($where)
    {
        return $this->db->query(
            "SELECT
                d.datata_id ,
                d.tanggal ,
                d.mhs_id ,
                d.tanggal,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                dd.status as status_dosen,
                d2.name dosen
            FROM
                datata d
            inner join datata_detail dd on
                dd.datata_id = d.datata_id 
            inner join mahasiswa m on
                m.mhs_id = d.mhs_id 
            inner join dosen d2 on
                d2.dosen_id = dd.dosen_id 
            WHERE
                0 = 0
                $where
            ORDER BY
                m.nim,
                dd.pembimbing_ke"
        )->result();

        // return $this->db->get('datata')->result_array();
    }


    // get mahasiswa
    public function get_mahasiswa($jurusan_id)
    {
        $sql = "SELECT
                    m.mhs_id ,
                    m.name ,
                    m.nim
                FROM
                    mahasiswa m
                where
                    m.is_active = 1
                    and m.jurusan_id = $jurusan_id
                    and m.mhs_id not in (
                    SELECT
                        d.mhs_id
                    FROM
                        datata d)
                order by
                    m.nim";
        $res = $this->db->query($sql)->result();
        return $res;
    }


    // tambah data tugas akhir
    public function tambahDataTa($data)
    {
        $this->db->insert('datata', $data);
        return $this->db->insert_id();
    }


    // tambah data detail tugas akhir
    public function tambahDataTaBanyak($data)
    {
        $this->db->insert_batch('datata_detail', $data);
    }


    // ambil data tugas akhir berdasarkan id
    public function getDatataById($id)
    {
        // return $this->db->get_where('datata', ['id' => $id])->row_array();
        return $this->db->query(
            "SELECT
                d.datata_id ,
                d.mhs_id ,
                d.tanggal,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                d.jurusan_id,
                dd.dosen_id,
                dd.id as id_detail,
                dd.status as status_dosen
            FROM
                datata d
            inner join datata_detail dd on
                dd.datata_id = d.datata_id
            inner join mahasiswa m on
                m.mhs_id = d.mhs_id
            where
                d.datata_id = $id"
        )->result();
    }


    // update data tugas akhir berdasarkan id
    public function ubahdatata($data, $id)
    {
        $this->db->where('datata_id', $id);
        $this->db->update('datata', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


    // update data detail tugas akhir berdasarkan id
    public function ubahDataTaBanyak($data)
    {
        $this->db->update_batch('datata_detail', $data, 'id');
    }


    // hapus data tugas akhir berdasarkan id
    public function hapusTa($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('datata', ['datata_id' => $id]);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function upload()
    {
        $upload_file = $_FILES['sinopsis']['name'];
        if ($upload_file) {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'doc|docx|pdf';
            $config['max_size']             = 1000000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sinopsis')) {
                $sinopsis =  $this->upload->data('sinopsis');
            } else {
                echo $this->upload->display_errors();
            }
            $data = [
                'sinopsis' =>  $sinopsis
            ];
            $this->db->insert('datata', $data);
        }
    }
}
