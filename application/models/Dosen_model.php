<?php

class Dosen_model extends CI_Model
{
    public function getAllDosen()
    {
        return $this->db->get('dosen')->result_array();
    }

    public function getAllBimbingan()
    {
        return $this->db->get('bimbingan_dsn')->result_array(); //semua baris
    }

    public function getDosenById($dosen_id)
    {
        return $this->db->get_where('dosen', ['dosen_id' => $dosen_id])->row_array();
    }

    public function upload()
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagedosen']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/dosen';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagedosen')) {
                return $this->upload->data('file_name');
            }
        }
        return "default.jpg";
    }

    public function tambahDataDosen()
    {
        $dosen_id = $this->input->post('dosen_id', true);
        $data = [
            'dosen_id' => $dosen_id,
            'nik' => $this->input->post('nik', true),
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'hp' => $this->input->post('hp', true),
            'image' => $this->upload(),
            'is_active' => $this->input->post('aktif', true),
        ];

        $this->db->insert('dosen', $data);
    }


    public function ubahDataDosen($dosen, $dosen_id)
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagedosen']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/dosen';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagedosen')) {

                $old_image = $dosen['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/dosen/' . $old_image);
                }
                $new_image =  $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $nik = $this->input->post('nik', true);
        $name = $this->input->post('namalengkap', true);
        $email = $this->input->post('email', true);
        $hp = $this->input->post('hp', true);

        $data = [
            'nik' => $nik,
            'name' => $name,
            'email' => $email,
            'hp' => $hp,
        ];
        $this->db->set($data);
        $this->db->where('dosen_id', $dosen_id);
        $this->db->update('dosen');
    }

    public function hapusDataDosen($dosen_id, $dosen)
    {
        $old_image = $dosen['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/dosen/' . $old_image);
        }
        //$this->db->where('id', $id);
        $this->db->delete('dosen', ['dosen_id' => $dosen_id]);
    }
}
