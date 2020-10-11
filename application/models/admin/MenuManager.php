<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuManager extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function createProduct($data)
	{
		$this->db->insert('menu', $data);
		return $this->db->insert_id();
	}

	public function updateAvtProduct($id, $avt)
	{
		$data = array(
			'avt' => $avt
		);
		$this->db->where('id', $id);
		return $this->db->update('menu', $data);
	}
}

/* End of file MenuManager.php */
/* Location: ./application/models/MenuManager.php */