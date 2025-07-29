<?= view('partials/header', ['title' => 'Approval Materi']) ?>
<?= view('partials/navbar') ?>

<div class="container">
    <h2>Approval Materi</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal di Buat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pendingList as $index => $item): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= esc($item['judul']) ?></td>
                <td><?= date('d-m-Y H:i:s', strtotime($item['created_at'])) ?></td>
                <td>
                    <!-- Form Approve -->
                    <form action="<?= site_url('admin/approve/' . $item['id']) ?>"
                          method="post"
                          style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit"
                                onclick="return confirm('Approve materi ini?')">
                            Approve
                        </button>
                    </form>

                    |

                    <!-- Form Reject -->
                    <form action="<?= site_url('admin/reject/' . $item['id']) ?>"
                          method="post"
                          style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit"
                                onclick="return confirm('Reject materi ini?')">
                            Reject
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= view('partials/footer') ?>
