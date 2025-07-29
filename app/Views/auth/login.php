<?= view('partials/header', ['title'=>'Login']) ?>
<?= view('partials/navbar') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-4 text-center">Login</h3>

          <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
          <?php endif; ?>

          <?= form_open('login') ?>
            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input 
                type="email" 
                name="email" 
                id="email"
                class="form-control" 
                value="<?= set_value('email') ?>" 
                required
              >
            </div>
            <div class="form-group mb-4">
              <label for="password">Password</label>
              <input 
                type="password" 
                name="password" 
                id="password"
                class="form-control" 
                required
              >
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          <?= form_close() ?>

          <p class="text-center mt-3 mb-0">
            Belum punya akun? 
            <a href="<?= site_url('register') ?>">Daftar di sini</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('partials/footer') ?>
