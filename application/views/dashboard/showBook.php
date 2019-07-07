  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo ucwords($judul);?></h1>
    </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <tbody>
            <tr>
              <td>Judul</td>
              <td><?php echo ucwords($judul);?></td>
            </tr>
            <tr>
              <td>Pengarang</td>
              <td><?php echo ucwords($pengarang);?></td>
            </tr>
            <tr>
              <td>Penerbit</td>
              <td><?php echo ucwords($penerbit);?></td>
            </tr>
            <tr>
              <td>Tahun Terbit</td>
              <td><?php echo $thnterbit;?></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><?php echo $kategori;?></td>
            </tr>
            <tr>
              <td>Gambar Sampul</td>
              <td><img src="<?php echo base_url().'/assets/images/'.$imgfile;?>"></td>
            </tr>
            <tr>
              <td>Sinopsis</td>
              <td><?php echo $sinopsis;?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  