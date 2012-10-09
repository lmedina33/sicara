<h1>Cur formularios List</h1>

<table>
  <thead>
    <tr>
      <th>Id cur formulario</th>
      <th>Direccion</th>
      <th>Dependencia</th>
      <th>Cargo</th>
      <th>Telefono</th>
      <th>Horario</th>
      <th>Licencia basica1</th>
      <th>Numero licencia1</th>
      <th>Habilitacion1</th>
      <th>Fecha expedicion1</th>
      <th>Fecha repaso1</th>
      <th>Licencia basica2</th>
      <th>Numero licencia2</th>
      <th>Habilitacion2</th>
      <th>Fecha expedicion2</th>
      <th>Fecha repaso2</th>
      <th>Licencia basica3</th>
      <th>Numero licencia3</th>
      <th>Habilitacion3</th>
      <th>Fecha expedicion3</th>
      <th>Fecha repaso3</th>
      <th>Licencia basica4</th>
      <th>Numero licencia4</th>
      <th>Habilitacion4</th>
      <th>Fecha expedicion4</th>
      <th>Fecha repaso4</th>
      <th>Id cur inscrito</th>
      <th>Id cur curso</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cur_formularios as $cur_formulario): ?>
    <tr>
      <td><a href="<?php echo url_for('curFormulario/edit?id_cur_formulario='.$cur_formulario->getIdCurFormulario().'&id_cur_inscrito='.$cur_formulario->getIdCurInscrito().'&id_cur_curso='.$cur_formulario->getIdCurCurso()) ?>"><?php echo $cur_formulario->getIdCurFormulario() ?></a></td>
      <td><?php echo $cur_formulario->getDireccion() ?></td>
      <td><?php echo $cur_formulario->getDependencia() ?></td>
      <td><?php echo $cur_formulario->getCargo() ?></td>
      <td><?php echo $cur_formulario->getTelefono() ?></td>
      <td><?php echo $cur_formulario->getHorario() ?></td>
      <td><?php echo $cur_formulario->getLicenciaBasica1() ?></td>
      <td><?php echo $cur_formulario->getNumeroLicencia1() ?></td>
      <td><?php echo $cur_formulario->getHabilitacion1() ?></td>
      <td><?php echo $cur_formulario->getFechaExpedicion1() ?></td>
      <td><?php echo $cur_formulario->getFechaRepaso1() ?></td>
      <td><?php echo $cur_formulario->getLicenciaBasica2() ?></td>
      <td><?php echo $cur_formulario->getNumeroLicencia2() ?></td>
      <td><?php echo $cur_formulario->getHabilitacion2() ?></td>
      <td><?php echo $cur_formulario->getFechaExpedicion2() ?></td>
      <td><?php echo $cur_formulario->getFechaRepaso2() ?></td>
      <td><?php echo $cur_formulario->getLicenciaBasica3() ?></td>
      <td><?php echo $cur_formulario->getNumeroLicencia3() ?></td>
      <td><?php echo $cur_formulario->getHabilitacion3() ?></td>
      <td><?php echo $cur_formulario->getFechaExpedicion3() ?></td>
      <td><?php echo $cur_formulario->getFechaRepaso3() ?></td>
      <td><?php echo $cur_formulario->getLicenciaBasica4() ?></td>
      <td><?php echo $cur_formulario->getNumeroLicencia4() ?></td>
      <td><?php echo $cur_formulario->getHabilitacion4() ?></td>
      <td><?php echo $cur_formulario->getFechaExpedicion4() ?></td>
      <td><?php echo $cur_formulario->getFechaRepaso4() ?></td>
      <td><a href="<?php echo url_for('curFormulario/edit?id_cur_formulario='.$cur_formulario->getIdCurFormulario().'&id_cur_inscrito='.$cur_formulario->getIdCurInscrito().'&id_cur_curso='.$cur_formulario->getIdCurCurso()) ?>"><?php echo $cur_formulario->getIdCurInscrito() ?></a></td>
      <td><a href="<?php echo url_for('curFormulario/edit?id_cur_formulario='.$cur_formulario->getIdCurFormulario().'&id_cur_inscrito='.$cur_formulario->getIdCurInscrito().'&id_cur_curso='.$cur_formulario->getIdCurCurso()) ?>"><?php echo $cur_formulario->getIdCurCurso() ?></a></td>
      <td><?php echo $cur_formulario->getCreatedAt() ?></td>
      <td><?php echo $cur_formulario->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('curFormulario/new') ?>">New</a>
