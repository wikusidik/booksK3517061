<?php if($_SESSION['level'] != "admin"){redirect("dashboard");}?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <form method="post" action="<?php echo site_url('user/filters');?>">
    <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search" name="key" style="border: 1px solid #cccccc; margin-top: 20px;">
    </form>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Users</h1>
        <a href="<?php echo site_url('user/tambah');?>" class="btn btn-primary pull-right">Tambah User</a>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Username</th>
              <th>Nama Panjang</th>
              <th>Level Administrasi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data buku
            foreach ($users as $user): 

            ?>
            <tr>
              <td><?php echo $user['username']?></td>
              <td><?php echo $user['fullname']?></td>
              <td><?php echo $user['role'];?></td>
              <td><?php echo anchor('user/edit/'.$user['username'], 'Edit', 'Edit Kategori'); ?> | <?php echo anchor('user/hapus/'.$user['username'], 'Del', 'Hapus Kategori'); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  