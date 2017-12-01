<?php $this->load->view('Helpers/User/header'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo base_url().$img; ?>" height="200px" width="150px" style="border-radius: 100%;" alt="imagen de perfil">
        </div>
        <div class="col-md-10">
            <h2><?= $nombre ?></h2>
        </div>
    </div>
</div>

<?php $this->load->view('User/Helpers/footer') ?>
