<?php

class Kategori_model extends CI_Model {

	public function getKategori($id = ""){
		if ($id == ""){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	public function insert($kategori){
		if($kategori==""){
			//do nothing
		}else{
			$query = $this->db->insert('kategori',array("kategori" => $kategori));
		}
	}

	public function edit($id = null, $kat = null){
		if($kat!=""){
			$query = $this->db->update("kategori",$kat,"idkategori=".$id);
		}
	}

	public function delete($id = null){
		$query = $this->db->query("DELETE FROM kategori WHERE idkategori=?",array($id));
	}

	public function filter($key = null){
		$this->db->select("*");
		$this->db->from("kategori");
		$this->db->like("kategori",$key);
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>