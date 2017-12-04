<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/datosLaborales.css') ?>">

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dialog.min.js'); ?>"></script>
  <div class="row">
    <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1container col-xm-12 col-md-8 col-md-offset-2">
      <section class="TituloPag">
        <h1><b>Premios o Distinciones</b></h1>
      </section>
    </div>
  </div>
  <div class="row"><p></p></div>
  <div class="row"><p></p></div>
  <div class="row"><p></p></div>
  <!--/////////////////////////////////////////////////////////////// -->
  <div class="row">
    <div class="container col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
      <section class="TituloTabla">
        <h4><b>Lista de Premios o Distinciones</b></h4>
      </section>
    </div>
  </div>
  <div class="row"><p></p></div>
  <div class="row">
    <div class="container col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="table-responsive">
        <table class="table table-hover" id="tablaEstudios">
          <thead id="EncabezadoTabla">
            <tr>
              <td hidden><b>ID</b></td>
              <td><b>Nombre del Premio o Distincion</b></td>
              <td><b>Fecha</b></td>
              <td><b>Institucion Otorgante</b></td>
              <td><b>Motivo</b></td>
            </tr>
          </thead>
          <tbody>
            <?php
            if($datos!= null)
            { foreach ($datos->result() as $row){
            ?>
            <tr id="TablaLinea" onclick="datos('<?php echo $row->idPremios?>')">
              <td><?= $row->Nombre?></td>
              <td><?= date_format(date_create($row->Fecha), "d / m / Y")?></td>
              <?php foreach($inst->result() as $raw){
                if($row->Instituciones_idInstituciones== $raw->idInstituciones ){
              ?>
              <td><?= $raw->Nombre ?></td>
            <?php } }?>
              <td><?= $row->Motivo?></td>
            </tr>
             <?php
               }
            }
            else
            { echo '<tr><td colspan = "5" align="center">No tiene registros</td></tr>';
            }
            ?>
           </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row container" align="right" >
    <button class="btn btn-danger" id="delete">Eliminar</button>
    <button class="btn btn-info" id="modify" >Modificar</button>
    <button class="btn btn-success" id="add">Agregar</button>
  </div>
  <div class="container error">
  	<script type="text/javascript">
  		$(".error").hide();
  	</script>
  	<p>*No ha seleccionado ningun elemento</p>
  </div>
  <input type="text" name="id_p" id="id_p" hidden="">
<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaEstudios').on('click', 'tbody tr', function(event) {
    		$(".error").hide();
    		$(this).addClass('highlight');
    		$('tbody tr').removeClass('highlight');
    		$(this).addClass('highlight');
    	});
    });
    function datos(id)
    {
    	$('#id_p').val(id);
    }
    function otraInstitucion()
    {
      if ($('#io').val() == 0)
    	{
    		$('.otra').show();
    	}
    	else if ($('#io').val() != 0)
    	{
    		$('.otra').hide();
        $('#oio').val('');
      }
    }

    $("#add").on('click', function(event) {
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
            {	'pageToLoad':'<?= base_url()?>index.php/User/formu_premios/'+0
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
    				        {
    									if( $('#npd').val() !='' && $('#f').val()!='' && ($('#io').val()!=0 || ($('#io').val()==0 && $('#oio').val()!='')) && $('#m').val()!='' )
    			            {
                        if ($('#oio').val()!='')
                        {
                          $.ajax({
      											type:"POST",
      											url: "<?= base_url()?>index.php/User/agregaPremiosoDistinciones",
      											data:{	'npd': $('#npd').val(),
      															'f': $('#f').val(),
      															'io':0,
      															'm': $('#m').val(),
      															'oio': $('#oio').val(),
      															'profe':<?= $loginid?>,
                                    'ins': $('#oio').val()// es para agregar la otra Institucion
      														},
                                  success: function() {
                    								location.reload();
                    							}
      											});
                        }
                        else
                        {
                          $.ajax({
      											type:"POST",
      											url: "<?= base_url()?>index.php/User/agregaPremiosoDistinciones",
      											data:{	'npd': $('#npd').val(),
      															'f': $('#f').val(),
      															'io':$('#io').val(),
      															'm': $('#m').val(),
      															'oio': $('#oio').val(),
      															'profe':<?= $loginid?>
      														},
                                  success: function() {
                    								location.reload();
                    							}
      											});
                        }
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
    			var id= $('#id_p').val();
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
    	      {	'pageToLoad': '<?= base_url()?>index.php/User/formu_premios/'+id
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
                      if( $('#npd').val() !='' && $('#f').val()!='' && ($('#io').val()!=0 || ($('#io').val()==0 && $('#oio').val()!='')) && $('#m').val()!='' )
                      {
                        if ($('#oio').val()!='')
                        {
                          $.ajax({
                            type:"POST",
                            url: "<?= base_url()?>index.php/User/actualizaPremios",
                            data:{	'id': id,
                                    'npd': $('#npd').val(),
                                    'f': $('#f').val(),
                                    'io':0,
                                    'm': $('#m').val(),
                                    'oio': $('#oio').val(),
                                    'ins': $('#oio').val()// es para agregar la otra Institucion
                                  },
                                  success: function() {
                                    location.reload();
                                  }
                            });
                        }
                        else
                        {
                          $.ajax({
                            type:"POST",
                            url: "<?= base_url()?>index.php/User/actualizaPremios",
                            data:{	'id': id,
                                    'npd': $('#npd').val(),
                                    'f': $('#f').val(),
                                    'io':$('#io').val(),
                                    'm': $('#m').val(),
                                    'oio': $('#oio').val()
                                  },
                                  success: function() {
                                    location.reload();
                                  }
                            });
                        }
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
    $('#delete').click(function(){
  	var id= $('#id_p').val();
  	console.log(id);
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
  					{	window.location= "<?= base_url()?>index.php/User/deletePremios/" + id;
  					}
  				}]
  			});
  		}
  		else
  		{	$(".error").show();
  		}
  });
</script>
