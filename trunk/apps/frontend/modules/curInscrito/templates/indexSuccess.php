<h1>Cur inscritos List</h1>

<table>
  <thead>
    <tr>
      <th>Id cur inscrito</th>
      <th>Primer nombre</th>
      <th>Segundo nombre</th>
      <th>Primer apellido</th>
      <th>Segundo apellido</th>
      <th>Documento</th>
      <th>Id tipo documento</th>
      <th>Lugar expedicion</th>
      <th>Telefono1</th>
      <th>Telefono2</th>
      <th>Correo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cur_inscritos as $cur_inscrito): ?>
    <tr>
      <td><a href="<?php echo url_for('curInscrito/edit?id_cur_inscrito='.$cur_inscrito->getIdCurInscrito()) ?>"><?php echo $cur_inscrito->getIdCurInscrito() ?></a></td>
      <td><?php echo $cur_inscrito->getPrimerNombre() ?></td>
      <td><?php echo $cur_inscrito->getSegundoNombre() ?></td>
      <td><?php echo $cur_inscrito->getPrimerApellido() ?></td>
      <td><?php echo $cur_inscrito->getSegundoApellido() ?></td>
      <td><?php echo $cur_inscrito->getDocumento() ?></td>
      <td><?php echo $cur_inscrito->getIdTipoDocumento() ?></td>
      <td><?php echo $cur_inscrito->getLugarExpedicion() ?></td>
      <td><?php echo $cur_inscrito->getTelefono1() ?></td>
      <td><?php echo $cur_inscrito->getTelefono2() ?></td>
      <td><?php echo $cur_inscrito->getCorreo() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('curInscrito/new') ?>">New</a>
