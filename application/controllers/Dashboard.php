<?php
class Dashboard extends CI_Controller {

		public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
            
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}
            
		}

		// halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori

        public function index(){

        	// panggil method countByCat() di model book_model untuk menghitung jumlah data buku per kategori untuk ditampilkan di view

            /*foreach ($kategori = $this->Cat_model->get_kategori()){
                $data['$kategori[nama_kategori]'] = $this->book_model->countByKat($kategori[idKategori]);
        }*/
            $data['jumlah'] = $this->book_model->countByCat();

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/index'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/index');
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menambah data buku
		public function add(){
			// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
			$data['kategori'] = $this->book_model->getKategori();

            $data['stsUpload'] = "insert";
            $data['isEdit'] = false;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/add'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/addBook', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menampilkan seluruh data buku
        public function books($page = 1){
      		//------------------------------ start pagination section --------------------------\\

            $rowPerPage = 10;                                       //jumlah row per baris
            $totalRow = $this->book_model->getTotalRow();           //total row yang ada
            $pages = ceil($totalRow / $rowPerPage);                 //jumlah halaman
            $startQry = $page * $rowPerPage - $rowPerPage;      //start query per halaman
            $data['links'] = array();                               //inisiasi links container, for later use
            $data['page_1'] = $page-1;
            $data['page1'] = $page+1;

            array_push($data['links'],site_url("dashboard/books/".$data['page_1']));
            array_push($data['links'],site_url("dashboard/books/".$data['page1']));
            if($page!=1){
                $data['firstPage'] = site_url("dashboard/books/1");
            }else{
                $data['firstPage'] = "";
            }
            if($page!=$pages){
                $data['lastPage'] = site_url("dashboard/books/".$pages);
            }else{
                $data['lastPage'] = "";
            }
            if($page!=$pages){
                $data['nextPage'] = site_url("dashboard/books/".$data['page1']);
            }else{
                $data['nextPage'] = "";
            }
            if($page!=1){
                $data['prevPage'] = site_url("dashboard/books/".$data['page_1']);
            }else{
                $data['prevPage'] = "";
            }

            //------------------------------- end pagination section ---------------------------\\

            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['book'] = $this->book_model->showBook("-",$startQry,$rowPerPage);
            $data['page'] = $page;
            $data['pages'] = $pages;
            $data['totalRow'] = $totalRow;
            $data['rowPerPage'] = $rowPerPage;


        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/books', $data);
            $this->load->view('dashboard/footer', $data);
        }

        //kategori section --------------------------------

        public function kategori($id=""){
            $data['kategoriBy'] = "";
            if($id==""){
                $data['stsUpload'] = "tambah";
            }else{
                $dummy = explode("-",$id);

                $data['stsUpload'] = $dummy[0] . "/" . $dummy[1];
                $data['kategoriBy'] = $this->Kategori_model->getKategori($dummy[1]);
            }

            $data['kategori'] = $this->Kategori_model->getKategori();
            $data['fullname'] = $_SESSION['fullname'];
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/kategori', $data);
            $this->load->view('dashboard/footer', $data);

        }

        public function users(){
            $data['users'] = $this->user_model->getUser();
            $data['fullname'] = $_SESSION['fullname'];

            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/users', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk proses logout
        public function logout(){
            // hapus seluruh data session
            session_destroy();
            // redirect ke kontroller 'login'
            redirect('login');
        }

}