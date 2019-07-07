
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <form method="post" action="<?php echo site_url('book/findbooks'); // arahkan form submit ke kontroller 'book/findbooks ?>">
    <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search" name="key" style="border: 1px solid #cccccc; margin-top: 20px;">
    </form>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Buku</h1>
        <h3 class="h4 pull-right">Jumlah Buku : <?php echo $totalRow;?></h3>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Judul Buku</th>
              <th>Pengarang</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>Genre</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data buku
            foreach ($book as $book_item): 

            ?>
            <tr>
              <td><?php echo $book_item['judul']?></td>
              <td><?php echo $book_item['pengarang']?></td>
              <td><?php echo $book_item['penerbit']?></td>
              <td><?php echo $book_item['thnterbit']?></td>
              <td><?php echo $book_item['kategori'];?></td>
              <td><?php echo anchor('book/show/'.$book_item['idbuku'], 'View', 'Lihat Buku'); ?> | <?php echo anchor('book/edit/'.$book_item['idbuku'], 'Edit', 'Edit Buku'); ?> | <?php echo anchor('book/delete/'.$book_item['idbuku'], 'Del', 'Hapus Buku'); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <center>
          <?php
          if($totalRow<$rowPerPage){
              
          }else{
              if($firstPage!=""){echo "<a href='".$firstPage."'>&laquo;</a>&ensp;";}else{echo "&laquo;&ensp;";}
              if($prevPage!=""){echo "<a href='".$prevPage."'>Prev</a>&ensp;";}else{echo "Prev&ensp;";}
              if($page==1){echo "1&ensp;<a href='".$nextPage."'>2</a> ...&ensp;";}elseif($page==$pages){echo "... <a href='".$prevPage."'>".$page_1."</a>&ensp;".$page."&ensp;";}else{echo "... <a href='".$prevPage."'>".$page_1."</a>&ensp;".$page." <a href='".$nextPage."'>".$page1."</a>&ensp;... &ensp;";}
              if($nextPage!=""){echo "<a href='".$nextPage."'>Next</a>&ensp;";}else{echo "Next&ensp;";}
              if($lastPage!=""){echo "<a href='".$lastPage."'>&raquo;</a>";}else{echo "&raquo;";}
          }
          ?>
        </center>

      </div>
    </main>
  