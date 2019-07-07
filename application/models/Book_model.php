<?php

class Book_model extends CI_Model {

	// method untuk menampilkan data buku
	public function showBook($id = false,$limitStart = null,$limitRows = null){
		if($id=='-'){$id=false;}
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$this->db->select("books.idbuku as idbuku,books.judul as judul, books.pengarang as pengarang, books.penerbit as penerbit, books.thnterbit as thnterbit, coalesce(kategori.kategori,'No Category') as kategori");
			$this->db->from("books");
			$this->db->join("kategori","books.idkategori=kategori.idkategori","left");
			$this->db->order_by("books.judul","asc");
			$this->db->limit($limitRows,$limitStart);
			$query = $this->db->get();
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$this->db->select("books.idbuku as idbuku,books.judul as judul, books.pengarang as pengarang, books.penerbit as penerbit, books.imgfile as imgfile, books.sinopsis as sinopsis, books.thnterbit as thnterbit, coalesce(kategori.kategori,'No Category') as kategori");
			$this->db->from("books");
			$this->db->join("kategori","books.idkategori=kategori.idkategori","left");
			$this->db->where("books.idbuku",$id);
			$query = $this->db->get();
			return $query->row_array();
		}
	}

	// method untuk hapus data buku berdasarkan id
	public function delBook($id){
		$this->db->delete('books', array("idbuku" => $id));
	}

	// method untuk mencari data buku berdasarkan key
	public function findBook($key,$limitStart = null,$limitRows = null){
		$this->db->select("books.idbuku as idbuku,books.judul as judul, books.pengarang as pengarang, books.penerbit as penerbit, books.thnterbit as thnterbit, coalesce(kategori.kategori,'No Category') as kategori");
			$this->db->from("books");
			$this->db->join("kategori","books.idkategori=kategori.idkategori","left");
			$this->db->like("books.judul",$key);
			$this->db->or_like("books.pengarang",$key);
			$this->db->or_like("books.penerbit",$key);
			$this->db->or_like("books.thnterbit",$key);
			$this->db->or_like("kategori.kategori",$key);
			$this->db->order_by("books.judul","asc");
			$this->db->limit($limitRows,$limitStart);
		$query = $this->db->get();
		return $query->result_array();
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"sinopsis" => $sinopsis,
					"idkategori" => $idkategori,
					"thnterbit" => $thnterbit,
					"imgfile" => $filename
		);
		$query = $this->db->insert('books', $data);
	}

	public function updateBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename,$sts,$id){
		if($sts==true){
			$data = array(
						"judul" => $judul,
						"pengarang" => $pengarang,
						"penerbit" => $penerbit,
						"sinopsis" => $sinopsis,
						"idkategori" => $idkategori,
						"thnterbit" => $thnterbit,
						"imgfile" => $filename
			);
		}else{
			$data = array(
						"judul" => $judul,
						"pengarang" => $pengarang,
						"penerbit" => $penerbit,
						"sinopsis" => $sinopsis,
						"idkategori" => $idkategori,
						"thnterbit" => $thnterbit,
			);
		}
		$query = $this->db->update('books', $data,array("idbuku"=>$id));
	}

	// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori(){
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	public function countByCatHelper(){
		$qry = $this->db->query("select count(*) as num from books where idkategori='".$idKat['idkategori']."'");
	}

	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat(){
		$getKat = $this->book_model->getKategori();
		$jumlah = array();
		foreach($getKat as $idKat){
			$qry = $this->db->query("select count(*) as num from books where idkategori='".$idKat['idkategori']."'");
			$qryx = $qry->row()->num;
			array_push($jumlah,array($idKat['kategori'],$qryx));
		}
		//$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
		return $jumlah;
	}

	public function getTotalRow(){
		$query = $this->db->query("SELECT count(*) as jum FROM books");
		return $query->row()->jum;
	}
	
	public function getFindTotalRow($key){
	    $this->db->select("count(*) as jum");
	    $this->db->from("books");
	    $this->db->join("kategori",'books.idkategori=kategori.idkategori',"left");
	    $this->db->like("books.judul",$key);
		$this->db->or_like("books.pengarang",$key);
		$this->db->or_like("books.penerbit",$key);
		$this->db->or_like("books.thnterbit",$key);
		$this->db->or_like("kategori.kategori",$key);
		$query = $this->db->get();
		return $query->row()->jum;
	}

}
?>