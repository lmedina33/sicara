<h1>Lib categorias List</h1>

<table>
  <thead>
    <tr>
      <th>Codigo lib categoria</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Dias prestamo</th>
      <th>Cantidad sancion</th>
      <th>Id tipo sancion</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lib_categorias as $lib_categoria): ?>
    <tr>
      <td><a href="<?php echo url_for('libCategoria/edit?codigo_lib_categoria='.$lib_categoria->getCodigoLibCategoria()) ?>"><?php echo $lib_categoria->getCodigoLibCategoria() ?></a></td>
      <td><?php echo $lib_categoria->getNombre() ?></td>
      <td><?php echo $lib_categoria->getDescripcion() ?></td>
      <td><?php echo $lib_categoria->getDiasPrestamo() ?></td>
      <td><?php echo $lib_categoria->getCantidadSancion() ?></td>
      <td><?php echo $lib_categoria->getIdTipoSancion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('libCategoria/new') ?>">New</a>
