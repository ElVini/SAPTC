
          <form method="post" name="registro" id="registro" action="./">
              <div class="row" >
              <div class="col-md-4">
                  <label>Titulo*: </label>
                  <input type="text" name="Titulo" id="Titulo" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Año*: </label>
                  <input type="text" name="Ano" id="Ano" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Citas*: </label>
                  <input type="text" name="Citas" id="Citas" class="form-control">
              </div>
          </div>

		  <br>
          <div class="row">
            <div class="col-md-4">
              <label>Seleccione un tipo de producción: </label>
                <select name="tipoproduccion" id="tipoproduccion" class="form-control">
                    <option value="Articulo-dif">Artículo de difusión y divulgación</option>
                    <option value="Articulo-arb">Artículo Arbitrado</option>
                    <option value="Articulo-rev">Artículo en revista indexada</option>
                    <option value="Asesoría">Asesoria</option>
                    <option value="CAapitulo">Capítulo del libro</option>
                    <option value="Consultoria">Consultoría</option>
                    <option value="Informe">Informe técnico</option>
                    <option value="Libro">Libro</option>
                    <option value="Manuales">Manuales de opercacion</option>
                    <option value="Material-ap">Material de apoyo</option>
                    <option value="Material didáctico">Material didáctico</option>
                    <option value="Memorias">Memorias</option>
                    <option value="Memorias-ext">Memorias en extenso</option>
                    <option value="Productividad">Productividad innovadora</option>
                    <option value="Producción">Producción artistica</option>
                    <option value="Prototipo">Prototípo</option>
                    <option value="Otra">Otra</option>
                </select>
              </div>
              <div class="col-md-4">
                  <label>LGACs Ind</label>
                  <input type="text" name="Ind" id="Ind" class="form-control">
              </div>
              <div class="col-md-4">
                  <label>Miembros CA*: </label>
                  <input type="text" name="Miembros" id="Miembros" class="form-control">
              </div>
          </div>
		  <br>
          <div class="row">
            <div class="col-md-4">
                <label>LAGCs CA*: </label>
                <input type="text" name="CA" id="CA" class="form-control">
            </div>
              <div class="col-md-4">
                  <label>Horas semanales*: </label>
                  <input type="text" name="Horas" id="Horas" class="form-control">
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
      <p>Por favor llene todos los campos</p>
    </div>
