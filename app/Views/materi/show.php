<?= view('partials/header', ['title' => $materi['judul']]) ?>
<?= view('partials/navbar') ?>

<div class="container my-4 materi-content">
    <h2><?= esc($materi['judul']) ?></h2>
    <div>
        <?= $materi['isi'] ?>
    </div>
</div>

<?= view('partials/footer') ?>

