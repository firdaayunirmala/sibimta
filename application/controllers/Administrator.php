<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['jurusan'] = $this->db->count_all_results('jurusan');

        $data['pimp'] = $this->db->count_all('pimpinan');
        $data['dsn'] = $this->db->count_all('dosen');
        $data['mhs'] = $this->db->count_all('mahasiswa');
        $data['d'] = $this->db->count_all('datata');

        $this->db->like('is_active', 1);
        $this->db->from('user');
        $data['dosen'] = $this->db->count_all_results();

        $this->db->like('is_active', 1);
        $this->db->from('user');
        $data['mahasiswa'] = $this->db->count_all_results();

        $this->db->like('is_active', 1);
        $this->db->from('user');
        $data['pimpinan'] = $this->db->count_all_results();

        $this->db->like('role_id', 2);
        $this->db->from('user');
        $data['admin'] = $this->db->count_all_results();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function countdown()
    {
        $data['title'] = 'Countdown Timer';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['countdown'] = $this->db->get('countdown')->row_array();

        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('time', 'Time', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('administrator/countdown', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->updateCountDown();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Waktu Hitung Mundur Telah Diatur!</div>');
            redirect('admin/countdown');
        }
    }

    public function countdownAccess()
    {
        $status = $this->input->post('status');

        $data = [
            'status' => $status
        ];

        $this->db->set($data);
        $this->db->update('countdown');

        if ($status == 1) {
            $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Countdown Berhasil ditampilkan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Countdown Berhasil Disembunyikan!</div>');
        }
    }
}
