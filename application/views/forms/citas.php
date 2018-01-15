<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css') ?>">
<div class="row">
  <div class="container col-sm-12 col-lg-10 col-lg-offset-1">
	<div class="table-responsive">
		<input type="hidden" name="id_cita" id="id_cita" value="<?php echo $idProd;?>">
	  <table class="table table-hover"id="Tablacitas">
		<thead id="">
		  <tr>
			<td><b>Titulo</b></td>
			<td><b>Tipo de producción</b></td>
			<td><b>Año</b></td>
			<td><b>Información adicional</b></td>
		  </tr>
		</thead>
		<tbody id="tablebody">
			<?php foreach ($citas as $cita){
				echo '<tr>
						<td hidden>'.$cita->idCita.'</td>
						<td>'.$cita->Nombrepublicacion.'</td>
						<td>'.$cita->Tipoproduccion.'</td>
						<td>'.$cita->Ano.'</td>
						<td>'.$cita->Infadicional.'</td>
					 </tr>';
			} ?>
		</tbody>
	</table>
	<div id="aux">

	</div>
	<div id="buttons" style="float:right;">
		<button type="button" id="delete" class="btn btn-danger">Eliminar</button>
		<button type="button" id="edit" class="btn btn-primary">Modificar</button>
		<button type="button" id="add" class="btn btn-success">Agregar</button>
	</div>
	<div class="divError" hidden>
		<p style="color:red;">Seleccione un registro</p>
	</div>
</div>
</div>
<div id="deletecita_form"></div>
<script type="text/javascript">
	var citas_id=-1;
	$('#Tablacitas').on('click','#tablebody td',function(){
		if($(this).parent().attr('class') == 'highlight'){
			$(this).parent().removeClass('highlight');
		}
		else{
			$(this).parent().addClass('highlight').siblings().removeClass('highlight');
			citas_id = -1;
			$(".divError").hide('slow');
		}
	});

	$('#add').click(function(){
		citas_id=-1;
		$('tr').removeClass('highlight');
		var id_prod=$('#id_cita').val();
		$('#aux').append("<div id='aux2'></div>");
		BootstrapDialog.show({
		  size: BootstrapDialog.SIZE_SMALL,
		  closable: true,
		  title: 'Agregar citas',
		  type: BootstrapDialog.TYPE_PRIMARY,
		  message: $('#aux2').load(base_url+'index.php/User/form_citas?id='+id_prod),
		  buttons: [{
			label: 'Cancelar',
			id: 'cancel',
			cssClass: 'btn-danger',
			action: function(dialogRef){
					dialogRef.close();
			  }
		  },{
			  label: 'Enviar',
			  id: 'send',
			  cssClass: 'btn-primary',
			  action: function(dialogRef){
				  		enviar();
						dialogRef.close();
				}
		  }]
		});
	})

	$('#edit').click(function(){
		$('#aux').append("<div id='aux2'></div>");
		citas_id=$(".highlight ").children('#Tablacitas td:nth-child(1)').first().html();
		if(citas_id!= undefined)
		{
			var id_prod=$('#id_cita').val();
			BootstrapDialog.show({
			  size: BootstrapDialog.SIZE_SMALL,
			  closable: true,
			  title: 'Agregar citas',
			  type: BootstrapDialog.TYPE_PRIMARY,
			  message: $('#aux2').load(base_url+'index.php/User/form_citas?id='+id_prod),
			  buttons: [{
				label: 'Cancelar',
				id: 'cancel',
				cssClass: 'btn-danger',
				action: function(dialogRef){
						dialogRef.close();
				  }
			  },{
				  label: 'Enviar',
				  id: 'send',
				  cssClass: 'btn-primary',
				  action: function(dialogRef){
					  		enviar();
							dialogRef.close();
					}
			  }]
			});
		}
		else{
			$(".divError").show('slow');
			id=-1;
		}
	});

	$('#delete').click(function(){
		citas_id=$(".highlight ").children('#Tablacitas td:nth-child(1)').first().html();
		if(citas_id!= undefined)
		{
		BootstrapDialog.confirm({
			title: "Advertencia",
			type: BootstrapDialog.TYPE_DANGER,
			message: "¿Seguro que desea eliminar el registro actual?",
			btnCancelLabel: 'Cancelar',
			btnOKLabel: 'Eliminar',
			closable: true,
			callback: function(result){
				if(result){
					$('#deletecita_form').append(`
						<form id="formDelete"method="post" action="`+base_url+`index.php/User/deleteCita">
							<input type="hidden"name="id" value="`+citas_id+`">
							<input type="hidden"name="idProd" value="`+$('#id_cita').val()+`">
						</form>`);
					var form = $('#formDelete');
					alert(JSON.stringify(form));
					$.ajax({
						url: form.attr('action'),
						type: 'POST',
						data: form.serialize(),
						success: function(result) {
							$("#tablebody").html(result);
							form.remove();
						}
					});

				}
			}
		});
	}
	else{
		$(".divError").show('slow');
		id=-1;
	}
	})

	function enviar(){
		var vacio=false;
		if($('titulo_cita').val() != '' && $('ano_cita').val() != '' && $('infAdic').val() != '' && $('#tipoproduccion_cita').val() != ''){
			if($('#tipoproduccion_cita').val()=="Otra" && $('#otraProduccion_cita').val() == ''){
				vacio = true;
			}
		}
		else{
			vacio = true;
		}
		if(vacio){
			BootstrapDialog.alert({
              title: '¡Atención!',
              message: 'Favor de llenar todos los campos',
              type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
              closable: true, // <-- Default value is false
              buttonLabel: 'OK', // <-- Default value is 'OK',
          });
		}
		else{
			var form = $('#form_citas');
			$.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(result) {
                    $("#tablebody").html(result);
                }
            });
		}
	}
</script>
