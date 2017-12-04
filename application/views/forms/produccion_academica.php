    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tagsinput.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/jquery.tagsinput.css');?>">
    <style media="screen">
        div.tagsinput span.tag{
            background-color: #EEEEEE;
            color: black;
            border: 1px solid #EEEEEE;
        }

        div.tagsinput span.tag a{
            color: black;
        }
    </style>
          <form method="post" name="registro" id="registro" action="<?php echo base_url('index.php/User/addProduccion') ?>">
              <div class="row" >
              <div class="col-md-4">
                  <label>Titulo*: </label>
                  <input type="text" name="Titulo" id="Titulo" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Año*: </label>
                  <input type="number" min="1900" max="2100" name="Ano" id="Ano" class="form-control" value="<?php echo date('Y');?>">
              </div>
              <div class="col-md-4">
                  <label>Num. Citas*: </label>
                  <input type="number" name="Citas" id="Citas" class="form-control">
              </div>
          </div>

		  <br>
          <div class="row">
            <div class="col-md-4">
              <label>Seleccione un tipo de producción: </label>
                <select name="tipoproduccion" id="tipoproduccion" class="form-control">
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
                </select>
              </div>
              <div class="col-md-4">
                  <label>LGACs Ind</label>
                  <select class="form-control" name="Ind" id="Ind">
                      <option value="">Seleccione línea </option>
                      <?php
                      foreach ($query->result() as $linea) {
                          echo '<option value="'.$linea->Nombre.'">'.$linea->Nombre;
                      } ?>
                  </select>
                  <!-- <input type="text" name="Ind" id="Ind" class="form-control"> -->
              </div>
              <div class="col-md-4">
                  <label>Miembros CA*: </label>
                  <input type="text" name="Miembros" id="Miembros" class="form-control" data-role="tagsinput">
              </div>
          </div>
		  <br>
          <div class="row">
            <div class="col-md-4">
                <label>LAGCs CA*: </label>
                <input type="number" name="CA" id="CA" class="form-control">
            </div>
              <div class="col-md-4">
                  <label>Horas semanales*: </label>
                  <input type="number" name="Horas" id="Horas" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Para CA*: <br></label>
                  <input type="text" name="Para" id="Para" class="form-control">
              </div>
          </div>
              <div id="msj">
                  <p>* Campos obligatorios</p>
              </div>
    </form>
    <div class="ErrorInputs" hidden>
      <p>Por favor llene los campos obligatorios</p>
    </div>
    <script type="text/javascript">

        $('#Miembros').tagsInput({
           'height':'auto',
           'width':'100%',
           'interactive':true,
           'defaultText':'Agregar miembro',
           'delimiter': [';'],   // Or a string with a single delimiter. Ex: ';'
           'removeWithBackspace' : true,
           'placeholderColor' : 'black'
        });
    </script>
