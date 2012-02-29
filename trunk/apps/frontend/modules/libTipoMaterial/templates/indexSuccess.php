<h1>Lib tipo materials List</h1>

<table>
  <thead>
    <tr>
      <th>Id lib tipo material</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Dias prestamo</th>
      <th>Cantidad sancion</th>
      <th>Id lib tipo sancion</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lib_tipo_materials as $lib_tipo_material): ?>
    <tr>
      <td><a href="<?php echo url_for('libTipoMaterial/edit?id_lib_tipo_material='.$lib_tipo_material->getIdLibTipoMaterial()) ?>"><?php echo $lib_tipo_material->getIdLibTipoMaterial() ?></a></td>
      <td><?php echo $lib_tipo_material->getNombre() ?></td>
      <td><?php echo $lib_tipo_material->getDescripcion() ?></td>
      <td><?php echo $lib_tipo_material->getDiasPrestamo() ?></td>
      <td><?php echo $lib_tipo_material->getCantidadSancion() ?></td>
      <td><?php echo $lib_tipo_material->getIdLibTipoSancion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('libTipoMaterial/new') ?>">New</a>
