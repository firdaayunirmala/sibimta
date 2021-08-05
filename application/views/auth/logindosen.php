<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-lg-5">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-5">Login Dosen Pembimbing</h1>
                </div>

                <?php if ($this->session->flashdata('message')) : ?>
                  <?= $this->session->flashdata('message'); ?>
                  <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <form class="user" method="post" action="<?= base_url('auth/dosen'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="user_name" name="user_name" placeholder="Masukan NIDN..." value="<?= set_value('user_name'); ?>">
                    <?= form_error('user_name', ' <small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    <input type="checkbox" onclick="myFunction()"> Show Password
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                  <a href="<?= base_url(); ?>home" class="btn btn-primary btn-user btn-block">
                    Logout
                  </a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<script>
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>