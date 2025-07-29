<!-- app/Views/auth/register.php -->
<?= view('partials/header', ['title'=>'Register']) ?>
<?= view('partials/navbar') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-4 text-center">Register</h3>

          <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
              <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <p class="mb-1"><?= esc($error) ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?= form_open('register') ?>
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
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input 
                type="password" 
                name="password" 
                id="password"
                class="form-control" 
                required 
                minlength="6"
              >
            </div>
            <div class="form-group mb-4">
              <label for="pass_confirm">Confirm Password</label>
              <input 
                type="password" 
                name="pass_confirm" 
                id="pass_confirm"
                class="form-control" 
                required 
                minlength="6"
              >
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
          <?= form_close() ?>

          <p class="text-center mt-3 mb-0">
            Sudah punya akun? 
            <a href="<?= site_url('login') ?>">Login di sini</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('partials/footer') ?>
