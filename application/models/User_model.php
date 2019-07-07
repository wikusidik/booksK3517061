<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user berdasar username
	public function getUser($username = null){
		if($username == null){
			$this->db->select("users.username as username, users.fullname as fullname, role.role as role");
			$this->db->from("users");
			$this->db->join("role","users.role=role.id","inner");
			$query = $this->db->get();
			return $query->result_array();
		}else{
			$query = $this->db->get_where('users', array('username' => $username));
			return $query->row_array();
		}
	}

	public function getUserLogin($username = null){
		$this->db->select("users.username as username, users.password as password,role.role as role,users.fullname as fullname");
		$this->db->from("users");
		$this->db->join("role","users.role=role.id","inner");
		$this->db->where("users.username",$username);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getRole(){
		$query = $this->db->get("role");
		return $query->result_array();
	}

	public function tambah($data){
		$query = $this->db->insert("users",$data);
	}

	public function update($id,$data){
		$query = $this->db->update("users",$data,array("username"=>$id));
	}

	public function delete($data){
		$query = $this->db->delete("users",$data);
	}

	public function filter($key = null){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->like("username",$key);
		$this->db->or_like("fullname",$key);
		$query = $this->db->get();
		return $query->result_array();
	}
}

?>