<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/datosLaborales.css') ?>">

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>

<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
<div class="row"><p></p></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
				<section  class="TituloPag">
					<h1><b>Datos Laborales</b></h1>
				</section>
			</div>
		</div>

				<div class="row"><p></p></div>
        <div class="row"><p></p></div>
        <div class="row"><p></p></div>

        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
            <section class="TituloTabla">
              <h4><b>Lista de Datos Laborales</b></h4>
            </section>
          </div>
        </div>
        <div class="row"><p></p> </div>
		<div class="row">
			<div class="col-sm-12 col-lg-10 col-lg-offset-1"><!--table table-inverse-->
				<table  class="table-responsive table table-hover" id="tablaEstudios">
					<thead class="EncabezadoTabla">
						<tr>
							<th><p>Nombramiento</p></th>
							<th><p>Dedicacion</p></th>
							<th><p>Unidad Academica de abscripción</p></th>
							<th><p>Fecha de inicio de contrato</p></th>
							<th><p>Cronología</p></th>
						</tr>
					</thead>
					<tbody>
          <?php
					if($datos!= null)
					{
						foreach ($datos->result() as $row){
					?>
						<tr id="TablaLinea" onclick="datos('<?php echo $row->idDatoslaborales?>')">
				        <td><?= $row->Nombramiento?></td>
				        <td><?= $row->Dedicacion?></td>
				        <td><?= $row->Unidadacademica?></td>
				        <td><?= date_format(date_create($row->Fechadeiniciocontrato), "d / m / Y")?></td>
				        <td><?= $row->Cronologia?></td>
						</tr>
					<?php
						}
					}
					else
					{
						echo '<tr><td colspan = "5" align="center">No tiene registros</td></tr>';
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="container" align="center">
			<div class="row">
				<div class="col-sm-5 col-md-6 col-lg-6">
					<div class="row">
						<button class="btn btn-default" id="contratonow">Contrato actual</button>
						<button  class="btn btn-default" id="firstcontrato">Primer contrato</button>
					</div>
				</div>
				<div class="col-sm-2 col-md-2 col-lg-3">

				</div>
				<div class="col-sm-5 col-md-4 col-lg-3">
					<div class="row" >
						<button class="btn btn-danger" id="delete">Eliminar</button>
						<button class="btn btn-info" id="modify" >Modificar</button>
						<button class="btn btn-success" id="add">Agregar</button>
					</div>
				</div>
			</div>
		</div>
			<div class="container error">
				<script type="text/javascript">
					$(".error").hide();
				</script>
				<p>*No ha seleccionado ningun elemento</p>
			</div>
			<br>
			<input type="text" name="eid" id="eid" hidden="">
<script type="text/javascript" src="<?php echo base_url('assets/js/datosLaborales.js'); ?>"></script>
<script type="text/javascript">

  function datos(id)
  {
  	$('#eid').val(id);
  }
  $('#delete').click(function(){
  	var id= $('#eid').val();
  	if(id!='')
  	{
  		BootstrapDialog.show({
  			type: BootstrapDialog.TYPE_DANGER,
  			size: BootstrapDialog.SIZE_LARGE,
  			title: 'Eliminar',
  			animate: false,
  			cssClass: 'dialog',
  			message: '¿Esta seguro de borrar este registro?',
  			closable: false,
  			draggable: true,
  			buttons: [{
  					label: 'Cancelar',
  					cssClass: 'btn-danger',
  					action: function(dialogRef)
  					{	dialogRef.close();
  					}
  				},
  				{
  					label: 'Borrar',
  					id: 'btnBorrar',
  					cssClass: 'btn-primary',
  					action: function()
  					{	window.location= "<?= base_url() ?>index.php/User/deleteDatol/" + id;
  					}
  				}]
  			});
  		}
  		else
  		{	$(".error").show();
  		}
  });
  $('#contratonow').click(function(){
  	var id= $('#eid').val();
  	if(id !='')
  	{
  		BootstrapDialog.show({
  			type: BootstrapDialog.TYPE_SUCCESS,
  			size: BootstrapDialog.SIZE_LARGE,
  			title: 'Atención',
  			animate: false,
  			cssClass: 'dialog',
  			message: '¿Esta seguro de marcar este registro como contrato actual?',
  			closable: false,
  			draggable: true,
  			buttons: [{
  						label: 'Cancelar',
  						cssClass: 'btn-danger',
  						action: function(dialogRef)
  						{	dialogRef.close();
  						}
  					},
  					{
  						label: 'OK',
  						id: 'btnOk',
  						cssClass: 'btn-primary',
  						action: function()
  						{	window.location= "<?= base_url()?>index.php/User/contratoactual/" + id;
  						}
  					}]
  				});
  		}
  		else
  		{	$(".error").show();
  		}
  	});
  $('#firstcontrato').click(function(){
  	var id= $('#eid').val() ;
  	if(id!='')
  	{
  		BootstrapDialog.show({
  			type: BootstrapDialog.TYPE_SUCCESS,
  			size: BootstrapDialog.SIZE_LARGE,
  			title: 'Atención',
  			animate: false,
  			cssClass: 'dialog',
  			message: '¿Esta seguro de marcar este registro como primer contrato?',
  			closable: false,
  			draggable: true,
  			buttons: [{
  						label: 'Cancelar',
  						cssClass: 'btn-danger',
  						action: function(dialogRef)
  						{	dialogRef.close();
  						}
  					},
  					{
  						label: 'OK',
  						id: 'btnOk',
  						cssClass: 'btn-primary',
  						action: function()
  						{	window.location= "<?= base_url() ?>index.php/User/contratoprimero/" + id;
  						}
  					}]
  			});
  	}
  	else
  	{	$('.error').show();
  	}
  });
  $("#add").on('click', function(event) {
  			formu=false;
  			BootstrapDialog.show({
  			type: BootstrapDialog.TYPE_PRIMARY,
  			size: BootstrapDialog.SIZE_LARGE,
  			title: 'Agregar Nuevo ',
  			animate: false,
  			cssClass: 'dialog',
  			draggable: true, // es para que puedas mover el dialogo
        message: function(dialog)
  		          {		var $message = $('<div></div>');
  		              var pageToLoad = dialog.getData('pageToLoad');
  		              $message.load(pageToLoad);
  		              return $message;
  		          },
        data:
          {	'pageToLoad': base_url+'index.php/User/form_datoslaborales/'+0
          },
  		    closable: false,
  		    buttons:[{
  					    label: 'Cancelar',
  			        cssClass: 'btn-danger',
  			        action: function(dialogRef)
  			        			{	dialogRef.close();
  				          	}
  		        	},
  		        	{
  				        label: 'Enviar',
  				        id: 'btnEnviar',
  				        cssClass: 'btn-primary',
  				        action: function()
  				        {	var nom= $('#nom').val();
  				        	var tipo_nom= $('#tipo_nom').val();
  				        	var dedicacion= $('#dedicacion').val();
  				        	var dependencia= $('#dependencia').val();
  									var unidad= $('#unidad').val();
  									var fecha_init= $('#fecha_init').val();
  									var fecha_fin= $('#fecha_fin').val();
  									var cronologia=$('#cronologia').val();
  									var profe= <?= $loginid?>;
  									if(nom !='' && tipo_nom!='' && dedicacion!='' && dependencia!='' && unidad!='' && fecha_init!='' && (fecha_fin!='' || formu == false))
  			            {	$.ajax({
  											type:"POST",
  											url: "<?= base_url()?>index.php/User/agregaDatosLaborales",
  											data:{	'nom': nom,
  															'fecha_init': fecha_init,
  															'fecha_fin':fecha_fin,
  															'tipo_nom': tipo_nom,
  															'dedicacion': dedicacion,
  															'dependencia':dependencia,
  															'unidad': unidad,
  															'profe': profe
  														},
															success: function() {
																location.reload();
															}
  														});
  			               }
  			               else
  			               {	BootstrapDialog.alert({
  												 title: '¡Atención!',
  												 message: 'Favor de llenar todos los campos',
  												 type: BootstrapDialog.TYPE_DANGER
  										 		});
  			               }
  		            	}
  		     			}]
  		  });
  });
  $("#modify").on('click', function(event) {
  			var base_url = "<?php echo base_url(); ?>";
  			var id= $('#eid').val();
				formu= false;
  			if(id!='')
  			{
  				BootstrapDialog.show({
  				type: BootstrapDialog.TYPE_PRIMARY,
  				size: BootstrapDialog.SIZE_LARGE,
  				title: 'Modificar',
  				animate: false,
  				cssClass: 'dialog',
  				draggable: true, // es para que puedas mover el dialogo
  	      message: function(dialog)
  	          {		var $message = $('<div></div>');
  	              var pageToLoad = dialog.getData('pageToLoad');
  	              $message.load(pageToLoad);
  	              return $message;
  	          },
  	      data:
  	      {	'pageToLoad': base_url+'index.php/User/form_datoslaborales/'+id
  	      },
  		    closable: false,
  		    buttons:[{
  				    label: 'Cancelar',
  			      cssClass: 'btn-danger',
  			      action: function(dialogRef)
  			        		 {	dialogRef.close();
  					         }
  		        	},
  		        	{	label: 'Enviar',
  				        id: 'btnEnviar',
  				        cssClass: 'btn-primary',
  				        action: function()
  				        {
  									var nom= $('#nom').val();
  									var tipo_nom= $('#tipo_nom').val();
  									var dedicacion= $('#dedicacion').val();
  									var dependencia= $('#dependencia').val();
  									var unidad= $('#unidad').val();
  									var fecha_init= $('#fecha_init').val();
  									var fecha_fin= $('#fecha_fin').val();
  									var cronologia=$('#cronologia').val();
  									var profe= <?= $loginid?>;
  									if( nom !='' && tipo_nom!='' && dedicacion!='' && dependencia!='' && unidad!='' && fecha_init!='' && (fecha_fin!='' || formu == false ))
  				          {	$.ajax({
  											type:"POST",
  											url: "<?= base_url()?>index.php/User/actualizaDatosLaborales",
  											data:{
  														'id_d': id,
  														'nom': nom,
  														'fecha_init': fecha_init,
  														'fecha_fin':fecha_fin,
  														'tipo_nom': tipo_nom,
  														'dedicacion': dedicacion,
  														'dependencia':dependencia,
  														'unidad': unidad,
  														'profe': profe
  														},
															success: function() {
																location.reload();
															}
  										});
  				          }
  									else
  									{	BootstrapDialog.alert({
  											title: '¡Atención!',
  											message: 'Favor de llenar todos los campos',
  											type: BootstrapDialog.TYPE_DANGER
  										});
  				          }
  		            }
  		     		}]
  		  });
  		}
  		else
  		{	$('.error').show();
  		}
  });
  var formu;
  function fecha(dec)
  {
  	if ($('#tipo_nom').val() == "Temporal")
  	{
  		$('.fecha').show();
  		formu=true;
  	}
  	else if($('#tipo_nom').val() == "Indeterminado" && dec== null)
  				{	$('.fecha').hide();
  					formu=false
  				}
  				else
  					{	$('.fecha').show();
  						formu=false;
  					}
  }


</script>
</body>
</html>
