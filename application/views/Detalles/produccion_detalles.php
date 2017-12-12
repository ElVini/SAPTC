<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tagsinput.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/styles/jquery.tagsinput.css');?>">
<style>
    #registro div{
        margin-top: 7px;
    }

    #registro div input{
        cursor: default;
    }
    #registro div select{
        cursor: default;
    }
</style>
      <form method="post" name="registro" id="registro" action="">
          <div class="row" >
              <div class="col-md-12">
                  <label>Titulo*: </label>
                  <input disabled type="text" name="Titulo" id="Titulo" class="form-control">
              </div>
         </div>
         <div class="row" >
              <div class="col-md-12">
                  <label>Año*: </label>
                  <input disabled type="number" min="1900" max="2100" name="Ano" id="Ano" class="form-control" value="">
              </div>
          </div>
          <div class="row" >
              <div class="col-md-12">
                  <label>Num. Citas*: </label>
                  <input disabled type="number"min="0" name="Citas" id="Citas" class="form-control">
              </div>
          </div>

      <div class="row">
        <div class="col-md-12">
          <label>Seleccione un tipo de producción: </label>
            <select disabled name="tipoproduccion" id="tipoproduccion" class="form-control">
                <option value="">Seleccione producción</option>
                <option value="Articulo de difusión y divulgación">Artículo de difusión y divulgación</option>
                <option value="Articulo Arbitrado">Artículo Arbitrado</option>
                <option value="Articulo en revista indexada">Artículo en revista indexada</option>
                <option value="Asesoría">Asesoria</option>
                <option value="Capítulo del libro">Capítulo del libro</option>
                <option value="Consultoria">Consultoría</option>
                <option value="Informe técnico">Informe técnico</option>
                <option value="Libro">Libro</option>
                <option value="Manuales de opercacion">Manuales de opercacion</option>
                <option value="Material de apoyo">Material de apoyo</option>
                <option value="Material didáctico">Material didáctico</option>
                <option value="Memorias">Memorias</option>
                <option value="Memorias en extenso">Memorias en extenso</option>
                <option value="Productividad innovadora">Productividad innovadora</option>
                <option value="Producción artistica">Producción artistica</option>
                <option value="Prototipo">Prototípo</option>
                <option value="Otra">Otra</option>
            </select disabled>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <label>Para CA*: <br></label>
              <select disabled class="form-control" name="Para" id="para">
                  <option value="0">No</option>
                  <option value="1" select disableded>Sí</option>
              </select disabled>
              <!-- <input disabled type="text" name="Ind" id="Ind" class="form-control"> -->
          </div>
      </div>
      <div class="row">
          <div class="col-md-12" id="div-miembros">
              <label>Miembros CA*: </label>
              <input disabled type="text" name="Miembros" id="Miembros" class="form-control" data-role="tagsinput disabled">
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <label>LAGCs CA*: </label>
            <input disabled type="number" min="0"name="CA" id="CA" class="form-control">
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <!-- <label>Horas semanales*: </label>
              <input disabled type="number" min="0" name="Horas" id="Horas" class="form-control"> -->
              <label>LGACs Ind</label>
              <select disabled class="form-control" name="Ind" id="Ind">
                  <option value="">Seleccione línea </option>
                  <?php
                  foreach ($query->result() as $linea) {
                      echo '<option value="'.$linea->idLineageneracion.'">'.$linea->Nombre;
                  } ?>
              </select disabled>
          </div>
      </div>
          <input disabled type="hidden" name="id" id="id"value="">

          <script type="text/javascript">
              $(document).ready(function(){
                  var id= $(".detalles").children('td:nth-child(1)').first().html();
                  var paraCA = $(".detalles ").children('td:nth-child(6)').first().html() == 'Sí'? 1:0;
                  $('#id').val(id);
                  $('#Titulo').val($(".detalles ").children('td:nth-child(2)').first().html());
                  $('#Ano').val($(".detalles ").children('td:nth-child(3)').first().html());
                  $('#Citas').val($(".detalles ").children('td:nth-child(4)').first().html());
                  $('#tipoproduccion').val($(".detalles ").children('td:nth-child(5)').first().html());
                  $('#para').val(paraCA);
                  if($('#para').val() == 1){
                      $('#Miembros').importTags($(".detalles ").children('td:nth-child(7)').first().html());
                  }
                  else{
                      $('#div-miembros').hide();
                  }
                  $('#Ind').val($(".detalles ").children('td:nth-child(8)').first().html());
                  $('#CA').val($(".detalles ").children('td:nth-child(9)').first().html());
                  //$('#Horas').val($(".detalles ").children('td:nth-child(10)').first().html());

              });
          </script>
</form>
