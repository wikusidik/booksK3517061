<?php
class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	public function tambah(){
		
		$kategori = $_POST['nama'];

		$this->Kategori_model->insert($kategori);

		redirect('dashboard/kategori');
	}
	public function hapus($id){
		$this->Kategori_model->delete($id);
		redirect('dashboard/kategori');
	}
	
	public function edit($id){
		$kategori = array("kategori"=>$this->input->post("nama"));
		if($kategori == ""){
		}else{
			$this->Kategori_model->edit($id,$kategori);
		}
		redirect("dashboard/kategori");
	}

	public function filters(){
		
		// baca key dari form cari data
		$key = isset($_POST['key'])? $_POST['key'] : "";
		if($key!=""){
		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];
		$data['stsUpload'] = "tambah";
		$data['kategoriBy'] = "";

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['kategori'] = $this->Kategori_model->filter($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('dashboard/footer');
    	}else{
    		redirect("dashboard/kategori");
    	}
	}

}
?>