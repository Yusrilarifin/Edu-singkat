<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand font-italic font-weight-bold" href="<?= site_url() ?>">EDU-SINGKAT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
          aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <!-- Left menu -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= uri_string() === 'materi' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('materi') ?>">Daftar Materi</a>
      </li>
      <?php if(session()->get('userRole') === 'admin'): ?>
      <li class="nav-item <?= uri_string() === 'admin/approval' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin/approval') ?>">Approval</a>
      </li>
      <?php endif; ?>
    </ul>

    <!-- Search form -->
    <form class="form-inline my-2 my-lg-0 mr-3" action="<?= site_url('materi') ?>" method="get">
      <input class="form-control mr-sm-2"
       type="search"
       name="q"
       value="<?= esc(request()->getGet('q') ?? '') ?>"
       placeholder="Search"
       aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
        Search
      </button>
    </form>

    <!-- User dropdown -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
          <i class="fa fa-user"></i>
          <?php if(session()->get('isLoggedIn')): ?>
            <?= esc(session()->get('userEmail')) ?>
          <?php endif; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php if(! session()->get('isLoggedIn')): ?>
            <a class="dropdown-item" href="<?= site_url('login') ?>">Login</a>
            <a class="dropdown-item" href="<?= site_url('register') ?>">Register</a>
          <?php else: ?>
            <span class="dropdown-item-text">
              <?= esc(session()->get('userEmail')) ?>
            </span>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= site_url('logout') ?>">Logout</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
  </div>
</nav>