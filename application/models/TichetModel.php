<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TichetModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getTichete()
	{
//		$this->db->order_by("created_at", "desc");
		$this->db->select('t.*, tp.denumire AS parentName', false);
		$this->db->from('tichete as t');
		$this->db->join('tichete as tp', 'tp.parent_id = t.id', "left");
		$query = $this->db->get();
		return $query->result();
	}

	public function insertTichet($data)
	{
		return $this->db->insert('tichete', $data);
	}

	public function editTichet($id)
	{
		$query = $this->db->get_where('tichete', ['id' => $id]);
		return $query->row();
	}

	public function updateTichet($data,$id){
		return $this->db->update('tichete', $data, ['id' => $id]);
	}

	public function checkTichetImage($id)
	{
		$query = $this->db->get_where('tichete', ['id' => $id]);
		return $query->row();
	}
	public function deleteTichet($id)
	{
		return $this->db->delete('tichete', ['id' => $id]);
	}
}
?>
