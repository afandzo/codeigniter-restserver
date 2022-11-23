<?php

class siswa_model extends CI_Model
{
  public function getSiswa($id = null)
  {
    if ($id == null) {
      return $this->db->get('tb_siswa')->result_array();
    } else {
      return $this->db->get_where('tb_siswa', ['id' => $id])->result_array();
    }
  }


  public function deleteSiswa($id)
  {
    $this->db->delete('tb_siswa', ['id' => $id]);
    return $this->db->affected_rows();
  }


  public function createSiswa($data)
  {
    $this->db->insert('tb_siswa', $data);
    return $this->db->affected_rows();
  }


  public function updateSiswa($data, $id)
  {
    $this->db->update('tb_siswa', $data, ['id' => $id]);
    return $this->db->affected_rows();
  }
}
