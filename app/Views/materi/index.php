<?= view('partials/header', ['title' => 'Daftar Materi']) ?>
<?= view('partials/navbar') ?>

<div class="container my-4">
    <h2>Daftar Materi</h2>

    <!-- Tombol Tambah Materi untuk semua user -->
    <?php if(session()->get('isLoggedIn')): ?>
    <a href="<?= site_url('materi/create') ?>"
       class="btn btn-success mb-3">
      Tambah Materi
    </a>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <?php if(session()->get('userRole') === 'admin'): ?>
                <th>Status</th>
                <?php endif; ?>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($materiList as $i => $m): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($m['judul']) ?></td>
                <?php if(session()->get('userRole') === 'admin'): ?>
                <td><?= esc($m['status']) ?></td>
                <?php endif; ?>
                <td>
                    <?php if(session()->get('userRole') === 'admin'): ?>
                        <!-- Admin: Edit & Hapus -->
                        <a href="<?= site_url('materi/edit/'.$m['id']) ?>"
                           class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?= site_url('materi/delete/'.$m['id']) ?>"
                              method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus materi ini?')">
                              Hapus
                            </button>
                        </form>
                    <?php else: ?>
                        <!-- User biasa: Lihat saja -->
                        <a href="<?= site_url('materi/'.$m['id']) ?>"
                           class="btn btn-sm btn-info">Lihat</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('partials/footer') ?>
