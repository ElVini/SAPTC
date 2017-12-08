<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <meta charset="UTF-8">
    <title><?=$titulo ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/estudiosRealizadosUsuario.css'); ?>">

<?php $this->load->view('Helpers/User/header');?>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>

<div class="row">
	<div class="container col-sm-10 col-sm-offset-1 col-md-10 container col-xm-12 col-md-8 col-md-offset-2">
		<section class="TituloPag">
			<h1><b>Docencias</b></h1>
		</section>
	</div>
</div>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<!--/////////////////////////////////////////////////////////////// -->
<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<section class="TituloTabla">
			<h4><b>Docencias registradas.</b></h4>
		</section>
	</div>
</div>

<div class="row">
	<div class="container col-xm-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-hover" id="tablaCA">
				<thead id="TablaCabeza">
					<tr>
						<th hidden>id</th>
						<th>Nombre del curso</th>
            <th>Programa educativo</th>
						<th>Fecha de inicio</th>
            <th>No. de alumnos</th>
            <th>Duración en semanas</th>
            <th hidden>Horas de asesorías mensuales</th>
            <th hidden>Horas semanales</th>
            <th hidden>Nombre de la Dependencia</th>
            <th hidden>Fecha de inicio</th>
            <th></th>
					</tr>
				</thead>
				<tbody>
          <?php if(isset($docencias)){
          foreach ($docencias->result() as $d) {
          ?>
              <tr id="tablaCuerpo">
                <td hidden><?php echo $d->idDocencias; ?> </td>
                <td><?php echo $d->Nombre; ?></td>
                <td><?php echo $d->Programaeducativo; ?></td>
                <td><?php $fecha = date_format(date_create($d->Fechainicio),"d / m / Y"); echo $fecha;?></td>
                <td><?php echo $d->Numerodealumnos; ?></td>
                <td><?php echo $d->Duracionsem; ?></td>
                <td hidden><?php echo $d->Horasasesoriamensual; ?></td>
                <td hidden><?php echo $d->Horassemanales; ?></td>
                <td hidden><?php echo $d->NombreDependencia; ?></td>
                <td hidden><?php echo $d->Fechainicio; ?></td>
                <td id="detalles"><a href="#">Ver detalles.</a></td>
              </tr>
              <?php
                }
              } ?>
				</tbody>
			</table>
		</div>
    <div class="DivELetrasrojas error">
      <script type="text/javascript">
        $(".error").hide();
      </script>
      <p>No ha seleccionado ningun elemento</p>
    </div>
		<div id="BotonesTabla">
      <button type="button" id="agDocencia" class="btn btn-success agregarD">Agregar</button>
      <button type="button" id="eliminarD" class="btn btn-danger">Eliminar</button>
      <button type="button" id="modDocencia" class="btn btn-primary agregarD">Modificar</button>
		</div>
	</div>
</div>

<style media="screen">
.DivELetrasrojas{
  color: red;
  font-size: 20px;
  display: none;
}
</style>

<script type="text/javascript">
var id="", nombre="", programae="", fechai="", numa="", durs="", horam="", horas="", nombredep="";
$('td:not(#detalles)').click(function(){
		if($(this).parent().attr('class') == 'highlight'){
			$(this).parent().removeClass('highlight');
      id="";
      nombre = "";
      programae = "";
      fechai = "";
      numa = "";
      durs = "";
      horam = "";
      horas = "";
      nombredep = "";
		}
		else{
      id=$(this).parent().children('td:nth-child(1)').first().html();
      nombre = $(this).parent().children('td:nth-child(2)').first().html();
      programae = $(this).parent().children('td:nth-child(3)').first().html();
      fechai = $(this).parent().children('td:nth-child(10)').first().html();
      numa = $(this).parent().children('td:nth-child(5)').first().html();
      durs = $(this).parent().children('td:nth-child(6)').first().html();
      horam = $(this).parent().children('td:nth-child(7)').first().html();
      horas = $(this).parent().children('td:nth-child(8)').first().html();
      nombredep = $(this).parent().children('td:nth-child(9)').first().html();
			$(this).parent().addClass('highlight').siblings().removeClass('highlight');
			$(".DivELetrasrojas").hide('slow');
		}
	});
//VER DETALLES
	$('#detalles a').click(function(){
		$('tr').removeClass('highlight');
    id=$(this).parent().parent().children('td:nth-child(1)').first().html();
    nombre = $(this).parent().parent().children('td:nth-child(2)').first().html();
    programae = $(this).parent().parent().children('td:nth-child(3)').first().html();
    fechai = $(this).parent().parent().children('td:nth-child(10)').first().html();
    numa = $(this).parent().parent().children('td:nth-child(5)').first().html();
    durs = $(this).parent().parent().children('td:nth-child(6)').first().html();
    horam = $(this).parent().parent().children('td:nth-child(7)').first().html();
    horas = $(this).parent().parent().children('td:nth-child(8)').first().html();
    nombredep = $(this).parent().parent().children('td:nth-child(9)').first().html();
  /*  BootstrapDialog.show({
          message: $('<div></div>').load(base_url+'index.php/User/formDocencia'),
          type: BootstrapDialog.TYPE_PRIMARY,
          title: 'Docencia',
          buttons: [{
                id: 'btnAcepD',
                label: 'Enviar',
                cssClass: 'btn-primary',
                action: function() {
                }
            }, {
              id: 'btnCanD',
              label: 'Cancelar',
              cssClass: 'btn-danger',
              action: function(dialog){
                   dialog.close();
              }
           }]
      });*/
	});

  $('#eliminarD').click(function(){
    if(id==""){
      $(".error").show('slow');
    } else {
      BootstrapDialog.confirm({
              title: '¡Atención!',
              message: '¿Estás seguro que desea eliminar la docencia?',
              type: BootstrapDialog.TYPE_DANGER,
              closable: true,
              btnCancelLabel: 'No',
              btnOKLabel: 'Sí',
              btnOKClass: 'btn-danger',
              callback: function(result) {
                  if(result) {
                      location.href = base_url+'index.php/User/elimDocencia/'+id;
                  }
              }
          });
    }
  });

  $('.agregarD').click(function(){
    console.log($(this).attr('id'));
    if($(this).attr('id') == 'modDocencia' && id==""){
      console.log($(this).attr('id'));
      $(".error").show('slow');
    }
    else{
      if($(this).attr('id') == 'agDocencia' && id != ""){
        id="";
        $('td').parent().removeClass('highlight');
      }
      BootstrapDialog.show({
            message: $('<div></div>').load(base_url+'index.php/User/formDocencia'),
            type: BootstrapDialog.TYPE_PRIMARY,
            title: 'Docencia',
            buttons: [{
                  id: 'btnAcepD',
                  label: 'Enviar',
                  cssClass: 'btn-primary',
                  action: function() {
                  }
              }, {
                id: 'btnCanD',
                label: 'Cancelar',
                cssClass: 'btn-danger',
                action: function(dialog){
                     dialog.close();
                }
             }]
        });
    }
  });
</script>
