<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_indsn();
        $this->load->model('Dosen_model');
        $this->load->model('Pesan_model');
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['beranda'] = $this->db->get('datata')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function bimbingan()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['bimbingan_dsn'] = $this->Dosen_model->getAllBimbingan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/bimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function detaildata($id)
    {
        $data['title'] = 'Detail Bimbingan';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['mahasiswa'] = $this->Admin_model->get_mahasiswa();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        // $data['datata'] = $this->Admin_model->getDatataById($id);
        $datata = $this->Admin_model->getDatataById($id);

        $id = 0;
        foreach ($datata as $key => $value) {
            if ($value->id != $id) {
                $data['datata'] = [
                    'id' => $value->id,
                    'id_user' => $value->id_user,
                    'tanggal' => $value->tanggal,
                    'nim' => $value->nim,
                    'name' => $value->name,
                    'judul' => $value->judul,
                    'sinopsis' => $value->sinopsis,
                    'status' => $value->status,
                    'kode_jurusan' => $value->kode_jurusan,
                    'id_dosen1' => $value->id_dosen,
                    'id_detail1' => $value->id_detail,
                ];
                $id = $value->id;
            } else {
                $data['datata']['id_dosen2'] = $value->id_dosen;
                $data['datata']['id_detail2'] = $value->id_detail;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/detailbimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function kirimfile()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['bimbingan'] = $this->Dosen_model->getAllBimbingan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/kirimbimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function pesan()
    {
        $data['title'] = 'Pesan';
        $data['dosen'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata('user_data')['user_id']])->row();
        $data['target'] = $this->Pesan_model->ambil_target('mahasiswa', $this->session->userdata('user_data')['user_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function kirim_chat()
    {
        $this->form_validation->set_rules('user', 'User', 'required|trim');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim');
        $this->form_validation->set_rules('target', 'Target', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect("Dosen/ambil_pesan");
            //echo "salah";
        } else {
            $userid = $this->input->post("user");
            $pesan = $this->input->post("pesan");
            $id_target =  $this->input->post("target");
            $data = [
                'user_id' => $userid,
                'pesan' => $pesan,
                'target_id' => $id_target,
                'type_pengirim' => 'dosen',
            ];
            $result = $this->Pesan_model->send_pesan($data);
        }
        $hasil = [];
        if ($result > 0) {
            $req = [
                'user_id' => $userid,
                'target_id' => $id_target,
            ];
            $hasil['status'] = 200;
            $hasil['data'] = $this->ambil_pesan($req);
        } else {
            $hasil['status'] = 404;
            $hasil['message'] = 'Pesan tidak diketahui';
        }
        echo json_encode($hasil);
        // redirect("Mahasiswa/ambil_pesan");
    }

    public function ambil_pesan($custom = [])
    {
        if (count($custom) > 0) {
            $id_target = $custom['target_id'];
            $userid = $custom['user_id'];
        } else {
            $id_target = $this->input->GET('target');
            $userid = $this->input->get('user');
        }
        // echo "OYYYY = " . $id_target;
        $tampil = $this->Pesan_model->get_pesan($id_target, $userid, 'dosen');

        $pesan = '';
        foreach ($tampil as $r) {
            if ($r['user_id'] == $userid && $r['type_pengirim'] == 'dosen') {
                $pesan .= "<li class='p-2 mb-1 rounded bg-default'><h5><b>$r[name]</b> : $r[pesan] </h5>(<i>$r[waktu]</i>)</li>";
            } else {
                $pesan .= "<li class='p-2 mb-1 rounded bg-success text-white'><h6>$r[name] : $r[pesan] </h6>(<i>$r[waktu]</i>)</li>";
            }
        }

        if (count($custom) > 0) {
            return $pesan;
        } else {
            echo $pesan;
        }
    }

    public function dosenAccess()
    {
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $data = [
            'status' => $status
        ];
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('datata');
        if ($status == 1) {
            $this->session->set_flashdata('message', 'Disetujui');
        } elseif ($status == 2) {
            $this->session->set_flashdata('message', 'Belum Disetujui');
        } else {
            $this->session->set_flashdata('message', 'Tidak Disetujui');
        }
    }
}
