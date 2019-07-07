<?php if($_SESSION['level'] != "admin"){redirect("dashboard");}?>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Users</h1>
      </div>
    <form method="post" id="formIni" action="<?php echo site_url('user/'.$stsUpload);?>">
      <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" id="username" placeholder="username" aria-label="username" value="<?php if($userBy != ""){echo $userBy['username'];}?>" name="uname">
        </div>
      </div>
      <div class="form-group row">
        <label for="fullname" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" id="fullname" value="<?php if($userBy != ""){echo $userBy['fullname'];}?>" placeholder="fullname" aria-label="fullname" name="fullname">
        </div>
      </div>
      <div class="form-group row">
        <label for="passwd" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input class="form-control" id="passwd" value="<?php if($userBy != ""){echo $userBy['password'];}?>" type="password" aria-label="password" name="passwd">
        </div>
      </div>
      <div class="form-group row">
        <label for="passwd2" class="col-sm-2 col-form-label">Re-Type Password</label>
        <div class="col-sm-10">
          <input class="form-control" id="passwd2" type="password" value="<?php if($userBy != ""){echo $userBy['password'];}?>" aria-label="password" name="passwd2">
        </div>
      </div>
      <div class="form-group row">
        <label for="level" class="col-sm-2 col-form-label">Level Admin</label>
        <div class="col-sm-10">
          <select class="form-control" name="level" id="level">
              <option <?php if($userBy == ""){echo "selected";}?>> --- Pilih Level --- </option>
              <?php
                foreach($roles as $role): ?>
                  <option value="<?php echo $role['id'];?>" <?php if($userBy != ""){if($role['id'] == $userBy['role']){echo "selected";}}?>><?php echo $role['role'];?></option>
              <?php
                endforeach;
              ?>
          </select>
        </div>
      </div>
    </form>
    <button onclick="submitForm()" class="btn btn-primary">Tambah User</button>

    <script>
      function submitForm(){
        var pass1 = $("#passwd").val();
        var pass2 = $("#passwd2").val();
        var username = $("#username").val();
        var fullname = $("#fullname").val();
        var level = $("#level").val();
        if(pass1 == pass2 && pass1 != "" && pass2 != ""){
          if(level == "" || username == "" || fullname == ""){
          }else{
            $("#formIni").submit();
          }
        }else{
          alert("Password tidak cocok gan");
        }
      }
    </script>
  </main>
  