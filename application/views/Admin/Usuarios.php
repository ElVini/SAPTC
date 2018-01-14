<?php $this->load->view('Helpers/Admin/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/Admin_usuarios.css'); ?>">

<div class="container">
    <table class="table table-responsive">
        <thead>
            <td>Imagen</td>
            <td>Nombre</td>
            <td>Rol</td>
            <td>Opciones</td>
        </thead>
        <?php
            foreach($query->result() as $res)
            {
                if($res->Estatus == 1)
                    $msg = 'Desactivar';
                else if($res->Estatus == 0)
                    $msg = 'Activar';
                echo '<tr>';
                echo '<td>';
                echo '<img src="'.base_url($res->foto).'" class="img-perfil">';
                echo '</td>';
                echo '<td><a href="'.base_url('index.php/Administrador/User?id='.$res->idDatosprofesor).'" class="nombre">'.$res->Nombres. ' ' .$res->Primerapellido. ' ' .$res->Segundoapellido;
                echo '</td>';
                echo '<td> <h5 class="nombre">'. $res->Rol. '</h5></td>';
                echo '<td> <a href="'.base_url('index.php/Administrador/modPerfil?id='.$res->idDatosprofesor).'">'.$msg.'</a></td>';
                echo '</tr>';
            }
        ?>
    </table>
</div>

<?php $this->load->view('Helpers/Global/footer'); ?>
