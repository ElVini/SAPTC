<form method="post" id="formul">
    <div class="row form-group">
        <div class="col-md-4">
            <label for="nivel">Nivel:</label>
            <select id="nivelb" name="nivel" class="form-control">
                <option value="0">Seleccionar. . .</option>
                <option <?php if($nivel === 'Doctorado')  echo 'selected="selected"'; ?>value="Doctorado">Doctorado</option>
                <option <?php if($nivel === 'Especialidad')  echo 'selected="selected"'; ?>value="Especialidad">Especialidad</option>
                <option <?php if($nivel === 'Especialidad médica')  echo 'selected="selected"'; ?>value="Especialidad médica">Especialidad médica (CIFRHS)</option>
                <option <?php if($nivel === 'Licenciatura')  echo 'selected="selected"'; ?>value="Licenciatura">Licenciatura</option>
                <option <?php if($nivel === 'Maestría')  echo 'selected="selected"'; ?>value="Maestría">Maestría</option>
                <option <?php if($nivel === 'Técnico')  echo 'selected="selected"'; ?>value="Técnico">Técnico</option>
                <option <?php if($nivel === 'Técnico superior universitario')  echo 'selected="selected"'; ?>value="Técnico superior universitario">Técnico superior universitario</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="programa">Programa educativo:</label>
            <select id="programab" name="programa" class="form-control">
                <option value="0">Seleccionar. . .</option>
                <option <?php if($programa === 'Ing. en informática')  echo 'selected="selected" '; ?>value="Ing. en informática">Ing. en informática</option>
                <option <?php if($programa === 'Ing. en nanotecnología')  echo 'selected="selected" '; ?> value="Ing. en nanotecnología">Ing. en nanotecnología</option>
                <option <?php if($programa === 'Ing. en mecatrónica')  echo 'selected="selected" '; ?> value="Ing. en mecatrónica">Ing. en mecatrónica</option>
                <option <?php if($programa === 'Ing. en biomédica')  echo 'selected="selected" '; ?> value="Ing. en biomédica">Ing. en biomédica</option>
                <option <?php if($programa === 'Ing. en biotecnología')  echo 'selected="selected" '; ?> value="Ing. en biotecnología">Ing. en biotecnología</option>
                <option <?php if($programa === 'Ing. en energía')  echo 'selected="selected" '; ?> value="Ing. en energía">Ing. en energía</option>
                <option <?php if($programa === 'Ing. en tecnología ambiental')  echo 'selected="selected" '; ?> value="Ing. en tecnología ambiental">Ing. en tecnología ambiental</option>
                <option <?php if($programa === 'Ing. en animación y efectos visuales')  echo 'selected="selected" '; ?> value="Ing. en animación y efectos visuales">Ing. en animación y efectos visuales</option>
                <option <?php if($programa === 'Ing. en logística y transporte')  echo 'selected="selected" '; ?> value="Ing. en logística y transporte">Ing. en logísitca y transporte</option>
                <option <?php if($programa === 'Lic. en terapia física')  echo 'selected="selected" '; ?> value="Lic. en terapia física">Lic. en terapia física</option>
                <option <?php if($programa === 'Lic. en administración y gestión de PyMes')  echo 'selected="selected" '; ?> value="Lic. en administración y gestión de PyMes">Lic. en administración y gestión de PyMes</option>
                <option <?php if($programa === 'Maestría en enseñanza de las ciencias')  echo 'selected="selected" '; ?> value="Maestría en enseñanza de las ciencias">Maestría en enseñanza de las ciencias</option>
                <option <?php if($programa === 'Maestría en ciencias aplicadas')  echo 'selected="selected" '; ?> value="Maestría en ciencias aplicadas">Maestría en ciencias aplicadas</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="tipo">Tipo:</label>
            <select id="tipob" name="tipo" class="form-control" onchange="append()">
                <option value="0">Seleccionar. . .</option>
                <option <?php if($tipo === 'Grupal')  echo 'selected="selected"'; ?> value="Grupal">Grupal</option>
                <option <?php if($tipo === 'Individual')  echo 'selected="selected"'; ?> value="Individual">Individual</option>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-4" id="grupal">
            <?php if($tipo === 'Grupal') {
                echo '<label for="n">Número de estudiantes:</label>';
                echo '<input id="nb" class="form-control" type="number" name="n" value="'.$n.'">';
            }
            else {
                echo '<label for="n">Nombre del estudiante:</label>';
                echo '<input id="nb" class="form-control" type="text" name="n" value="'.$n.'">';
            } ?>
        </div>

        <div class="col-md-4">
            <label for="fechaInicio">Fecha de inicio:</label>
            <input type="date" class="form-control" name="fechaInicio" id="fechaIniciob" value="<?php echo $fechaInicio; ?>">
        </div>

        <div class="col-md-4">
            <label for="fechaFin">Fecha de término:</label>
            <input type="date" class="form-control" name="fechaFin" id="fechaFinb" value="<?php echo $fechaFin; ?>">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-4">
            <label for="estado">Estado:</label>
            <select id="estadob" name="estado" class="form-control">
                <option value="0">Seleccionar. . .</option>
                <option <?php if($estado === 'En proceso')  echo 'selected="selected"'; ?>value="En proceso">En proceso</option>
                <option <?php if($estado === 'Concluida')  echo 'selected="selected"'; ?>value="Concluida">Concluida</option>
            </select>
        </div>
    </div>
</form>

<script type="text/javascript">
</script>
