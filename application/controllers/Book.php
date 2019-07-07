<?php
class Book extends CI_Controller {

	public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
            
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}
            
		}


	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk tambah data buku
	public function insert(){

		// target direktori fileupload
		
		// baca nama file upload
		if(!empty($_FILES["imgcover"])){
			$target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/images/";
			$filename = $_FILES["imgcover"]["name"];
			// menggabungkan target dir dengan nama file
			$target_file = $target_dir . basename($filename);

			// proses upload
			if(move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file)){


			// baca data dari form insert buku
			$judul = $_POST['judul'];
			$pengarang = $_POST['pengarang'];
			$penerbit = $_POST['penerbit'];
			$sinopsis = $_POST['sinopsis'];
			$thnterbit = $_POST['thnterbit'];
			$idkategori = $_POST['idkategori'];

			// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
			$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

			// arahkan ke method 'books' di kontroller 'dashboard'
			redirect('dashboard/books');
			}else{
			}
		}else{
			$judul = $_POST['judul'];
			$pengarang = $_POST['pengarang'];
			$penerbit = $_POST['penerbit'];
			$sinopsis = $_POST['sinopsis'];
			$thnterbit = $_POST['thnterbit'];
			$idkategori = $_POST['idkategori'];
			$filename = "2";

			// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
			$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

			// arahkan ke method 'books' di kontroller 'dashboard'
			redirect('dashboard/books');
		}
	}

	// method untuk edit data buku berdasarkan id
	public function edit($id){
		$data['fullname'] = $_SESSION['fullname'];
		
		$getBook = $this->book_model->showBook($id);
		$data['kategori'] = $this->book_model->getKategori();

		$data['idbuku'] = $getBook['idbuku'];
		$data['judul'] = $getBook['judul'];
		$data['pengarang'] = $getBook['pengarang'];
		$data['penerbit'] = $getBook['penerbit'];
		$data['kategoriID'] = $getBook['kategori'];
		$data['imgfile'] = $getBook['imgfile'];
		$data['sinopsis'] = $getBook['sinopsis'];
		$data['thnterbit'] = $getBook['thnterbit'];

		$data['stsUpload'] = "update/".$id;
		$data['isEdit'] = true;

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/addBook', $data);
        $this->load->view('dashboard/footer', $data);
	}

	// method untuk update data buku berdasarkan id
	public function update($id){
		
		// baca nama file upload
		$isUpdateImg = empty($_POST['imgIsUpdt'])? "" : $_POST['imgIsUpdt'];

		if($isUpdateImg != ""){
			$target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/images/";
			$updtImg = true;
			$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
			$target_file = $target_dir . basename($filename);
			move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);
		}else{
			$updtImg = false;
			$filename = "";
		}

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->updateBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename,$updtImg,$id);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	public function show($id){
		$getBook = $this->book_model->showBook($id);
		$data['fullname'] = $_SESSION['fullname'];

		$data['idbuku'] = $getBook['idbuku'];
		$data['judul'] = $getBook['judul'];
		$data['pengarang'] = $getBook['pengarang'];
		$data['penerbit'] = $getBook['penerbit'];
		$data['kategori'] = $getBook['kategori'];
		$data['imgfile'] = $getBook['imgfile'];
		$data['sinopsis'] = $getBook['sinopsis'];
		$data['thnterbit'] = $getBook['thnterbit'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/showBook', $data);
        $this->load->view('dashboard/footer', $data);
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks($page=1,$key=false){
		
		// baca key dari form cari data
		if($key==false){$key = empty($_POST['key'])? "" : $_POST['key'];}
		//------------------------------ start pagination section --------------------------\\

            $rowPerPage = 10;                                       //jumlah row per baris
            $totalRow = $this->book_model->getFindTotalRow($key);           //total row yang ada
            $pages = ceil($totalRow / $rowPerPage);                 //jumlah halaman
            $startQry = $page * $rowPerPage - $rowPerPage;      //start query per halaman
            $data['links'] = array();                               //inisiasi links container, for later use
            $data['page_1'] = $page-1;
            $data['page1'] = $page+1;

            array_push($data['links'],site_url("book/findbooks/".$data['page_1']."/".$key));
            array_push($data['links'],site_url("book/findbooks/".$data['page1']."/".$key));
            if($page!=1){
                $data['firstPage'] = site_url("book/findbooks/1"."/".$key);
            }else{
                $data['firstPage'] = "";
            }
            if($page!=$pages){
                $data['lastPage'] = site_url("book/findbooks/".$pages."/".$key);
            }else{
                $data['lastPage'] = "";
            }
            if($page!=$pages){
                $data['nextPage'] = site_url("book/findbooks/".$data['page1']."/".$key);
            }else{
                $data['nextPage'] = "";
            }
            if($page!=1){
                $data['prevPage'] = site_url("book/findbooks/".$data['page_1']."/".$key);
            }else{
                $data['prevPage'] = "";
            }

            //------------------------------- end pagination section ---------------------------\\

            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['page'] = $page;
            $data['pages'] = $pages;
            $data['totalRow'] = $totalRow;
            $data['rowPerPage'] = $rowPerPage;

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key,$startQry,$rowPerPage);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

}
?>