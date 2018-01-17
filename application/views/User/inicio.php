<?php $this->load->view('Helpers/User/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/avisos.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/styles/zabuto_calendar.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles/bootstrap-dialog.min.css'); ?>">
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/zabuto_calendar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/avisos.js'); ?>"></script>
<script src="https://use.fontawesome.com/eb49eee3f9.js"></script>
<div class="row container col-xs-12 col-sm-12 col-md-12">
	<div id="my-calendar" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
	</div>
	<div id="tabla-buttons" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
	    <div id="div-tabla" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        <table id="tabla" class="table table-hover">
	            <thead>
	                <tr>
	                    <th colspan="3" id ="notif">Recordatorios</th>
	                </tr>
	                <tr>
	                    <th>Fecha</th>
	                    <th>Título</th>
	                    <th>Detalles</th>
	                </tr>
	            </thead>
				<tbody class="">
              <?php
                echo
                '<script type="application/javascript">
                var eventData= [];
                var scrollCounter=0;
                </script>';
				$count=0;
				foreach ($query as $usuario) {
				 	$inputId = $usuario->idRecordatorios;
	                $fecha = date_format(date_create($usuario->Dia),"d / m / Y");
	                echo '<tr>
	                      <td hidden id="id">'.$usuario->idRecordatorios.'</td>
	                      <td hidden id="date">'.$usuario->Dia.'</td>
	                        <td>'.$fecha.'</td>
	                          <td id="title">'.$usuario->Titulo.'</td>
	                            <td id ="details">'.$usuario->Descripcion.'</td>
	                      </tr>';

	                echo  '<script type="application/javascript">
	                        eventData.push({date:"'.$usuario->Dia.'",badge:true,title:"'.$usuario->Titulo.'",body:"'.$usuario->Descripcion.'"});
	                        if(scrollCounter > 2)
	                        {
	                          $("#div-tabla").addClass("scroll");
	                        }
	                        scrollCounter++;
	                        </script>';
                }
				if($count ==0){
					echo '<tr><td hidden id="noRegistro"><td align="right"colspan="2">No hay recordatorios<td></td></tr>';
				}
                echo
                '<script type="application/javascript">
                  $("#my-calendar").zabuto_calendar({
                      language:"es",
                      cell_border: true,
                      today: true,
                      weekstartson: 0,
                      data: eventData,
                    });
                </script>';
              ?>
            </tbody>
	        </table>

	      </div>
	      <div id="buttons">
	        <button id="delete" class="btn btn-danger">Eliminar</button>
	        <button id="edit" class="btn btn-primary">Modificar</button>
	        <button id="add" class="btn btn-success">Agregar</button>
	      </div>
	      <div id="divParaError" class="DivELetrasrojas">
	        <p></p>
	      </div>
	      <form id="formu"hidden></form>
	    </div>
	  </div>

<?php $this->load->view('User/Helpers/footer'); ?>
