<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	public function tambah(){
		$data['fullname'] = $_SESSION['fullname'];
		$data['isTambah'] = true;
		$data['stsUpload'] = "submit";
		$data['userBy'] = "";
        $data['roles'] = $this->user_model->getRole();
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/user_edit', $data);
        $this->load->view('dashboard/footer');
	}

	public function submit(){
		$uname = $_POST["uname"];
		$fullname = $_POST['fullname'];
		$passwd = $_POST['passwd'];
		$level = $_POST['level'];

		$data = array("username"=>$uname,"fullname"=>$fullname,"password"=>$passwd,"role"=>$level);
		$this->user_model->tambah($data);
		redirect("dashboard/users");
	}
	
	public function edit($username){
        $data['userBy'] = $this->user_model->getUser($username);
        $data['fullname'] = $_SESSION['fullname'];
        $data['stsUpload'] = "update/".$username;
        $data['isTambah'] = false;
        $data['roles'] = $this->user_model->getRole();

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/user_edit', $data);
        $this->load->view('dashboard/footer');	
	}

	public function update($username){
		$uname = $_POST["uname"];
		$fullname = $_POST['fullname'];
		$passwd = $_POST['passwd'];
		$level = $_POST['level'];

		$data = array("username"=>$uname,"fullname"=>$fullname,"password"=>$passwd,"role"=>$level);
		$this->user_model->update($username,$data);

		redirect("dashboard/users");
	}

	public function hapus($username){
		$data = array("username"=>$username);
		$this->user_model->delete($data);

		redirect("dashboard/users");
	}

	public function filters(){
		
		// baca key dari form cari data
		$key = isset($_POST['key'])? $_POST['key'] : "";
		if($key!=""){
		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['users'] = $this->user_model->filter($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/users', $data);
        $this->load->view('dashboard/footer');
    	}else{
    		redirect("dashboard/users");
    	}
	}

}
?>