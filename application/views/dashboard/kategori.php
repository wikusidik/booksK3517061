<?php if($_SESSION['level'] != "admin"){redirect("dashboard");}?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <form method="post" action="<?php echo site_url('kategori/filters'); // arahkan form submit ke kontroller 'kategori/filters ?>">
    <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search" name="key" style="border: 1px solid #cccccc; margin-top: 20px;">
    </form>
    <form method="post" action="<?php echo site_url('kategori/'.$stsUpload); //stsUpload isinya default tambah; edit ==> edit/$id, bisa disesuaikan di controller ?>">
      <input class="form-control" type="text" placeholder="Tambah" aria-label="Tambah" name="nama" value="<?php if($kategoriBy==""){}else{echo $kategoriBy['kategori'];}?>" style="border: 1px solid #cccccc; margin-top: 20px;">
    </form>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Kategori Buku</h1>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($kategori!=""){
              foreach ($kategori as $kat): 

              ?>
              <tr>
                <td><?php echo $kat['kategori']?></td>
                <td><?php echo anchor('dashboard/kategori/edit-'.$kat['idkategori'], 'Edit', 'Edit Kategori'); ?> | <?php echo anchor('kategori/hapus/'.$kat['idkategori'], 'Del', 'Hapus Kategori'); ?></td>
              </tr>
            <?php endforeach;}?>
          </tbody>
        </table>
      </div>
    </main>