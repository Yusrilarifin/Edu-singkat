<?= view('partials/header', ['title' => 'Semua Materi']) ?>
<?= view('partials/navbar') ?>

<div class="container my-4">
    <h1>Semua Materi</h1>

    <?php if (empty($materiList)): ?>
        <p>Belum ada materi.</p>
    <?php else: ?>
        <?php foreach ($materiList as $item): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($item['judul']) ?></h5>
                    <p class="card-text">
                        <?= 
                            // potong isi, hilangkan tag HTML, 200 karakter
                            esc(mb_strimwidth(strip_tags($item['isi']), 0, 200, '...')) 
                        ?>
                    </p>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= site_url('materi/' . $item['id']) ?>" class="btn btn-primary">
                            Read More
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('login') ?>" class="btn btn-secondary">
                            Read More
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-muted">
                    <?= date('d M Y H:i', strtotime($item['created_at'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= view('partials/footer') ?>
