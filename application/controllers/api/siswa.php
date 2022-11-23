<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class siswa extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model', 'siswa');
  }


  public function index_get()
  {
    $id = $this->get('id');
    if ($id == null) {
      $siswa = $this->siswa->getSiswa();
    } else {
      $siswa = $this->siswa->getSiswa($id);
    }


    if ($siswa) {
      $this->response([
        'status' => TRUE,
        'data' => $siswa
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'id not found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }


  public function index_delete()
  {
    $id = $this->delete('id');

    if ($id == null) {
      $this->response([
        'status' => FALSE,
        'message' => 'provide an id'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->siswa->deleteSiswa($id) > 0) {
        $this->response([
          'status' => TRUE,
          'id' => $id,
          'message' => 'deleted.'
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => FALSE,
          'message' => 'id not found'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }


  public function index_post()
  {
    $data = [
      'nis' => $this->post('nis'),
      'nama' => $this->post('nama'),
      'jenis_kelamin' => $this->post('jenis_kelamin'),
      'kelas' => $this->post('kelas'),
      'no_tlp' => $this->post('no_tlp'),
      'alamat' => $this->post('alamat')
    ];

    if ($this->siswa->createSiswa($data) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'new siswa has been created.'
      ], REST_Controller::HTTP_CREATED);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'failed to create new data'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }


  public function index_put()
  {
    $id = $this->put('id');
    $data = [
      'nis' => $this->put('nis'),
      'nama' => $this->put('nama'),
      'jenis_kelamin' => $this->put('jenis_kelamin'),
      'kelas' => $this->put('kelas'),
      'no_tlp' => $this->put('no_tlp'),
      'alamat' => $this->put('alamat')
    ];

    if ($this->siswa->updateSiswa($data, $id) > 0) {
      $this->response([
        'status' => TRUE,
        'message' => 'data siswa has been updated.'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'failed to updated data'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}
