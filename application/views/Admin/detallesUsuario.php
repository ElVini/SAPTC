<?php $this->load->view('helpers/admin/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/Admin_usuarios.css'); ?>">
<?php
    foreach($query->result() as $res)
    {
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo base_url($res->foto); ?>" class="img-perfil">
        </div>
        <div class="col-md-6">
            <?php echo $res->Nombres. ' '. $res->Primerapellido. ' '. $res->Segundoapellido; ?>
        </div>
    </div>
</div>
<?php } ?>
