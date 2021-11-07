<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_categories()
	{

		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('parent_id', 0);

		$parent = $this->db->get();

		$categories = $parent->result();
		$i = 0;
		foreach ($categories as $p_cat) {

			$categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
			$i++;
		}
		return $categories;
	}

	public function sub_categories($id)
	{

		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('parent_id', $id);

		$child = $this->db->get();
		$categories = $child->result();
		$i = 0;
		foreach ($categories as $p_cat) {

			$categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
			$i++;
		}
		return $categories;
	}
}
