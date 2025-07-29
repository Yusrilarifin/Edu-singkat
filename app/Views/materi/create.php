
<div class="container my-4">
  <h2>Tambah Materi</h2>

  <!-- tampilkan error -->
  <?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
      <?php foreach(session()->getFlashdata('errors') as $e): ?>
        <p><?= esc($e) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form action="<?= site_url('materi/store') ?>"
      method="post"
      novalidate
      id="formMateri">
  <?= csrf_field() ?>

  <div class="form-group">
    <label for="judul">Judul</label>
    <input type="text"
           name="judul"
           id="judul"
           class="form-control"
           required
           value="<?= set_value('judul') ?>">
  </div>

  <div class="form-group">
    <label for="editor">Isi Materi</label>
    <textarea id="isi"
              name="isi"
              class="form-control"
              style="min-height:250px;"><?= set_value('isi') ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="<?= site_url('materi') ?>" class="btn btn-secondary">Batal</a>
</form>
<script src="https://cdn.ckeditor.com/4.20.1/standard-all/ckeditor.js"></script>
<script>
  CKEDITOR.replace('isi', {
    extraPlugins: 'image2,uploadimage,embed,autoembed',
    removePlugins: 'cloudservices',  // hapus plugin cloud yang tidak perlu
    // agar URL otomatis menjadi embed
    autoEmbed_widget: 'embed',       
    // tentukan provider oEmbed (iframe.ly)
    embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
    // Base64 adapter otomatis karena uploadUrl kosong
    uploadUrl: ''
  });
</script>



