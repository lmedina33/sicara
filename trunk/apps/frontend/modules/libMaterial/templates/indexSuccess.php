<h1>Lib materials List</h1>

<table>
  <thead>
    <tr>
      <th>Codigo lib material</th>
      <th>Titulo</th>
      <th>Sub titulo</th>
      <th>Autores</th>
      <th>Editorial</th>
      <th>Fecha publicacion</th>
      <th>Fecha actualizacion</th>
      <th>Descripcion</th>
      <th>Temas</th>
      <th>Is referencia</th>
      <th>Is solo profesor</th>
      <th>Is prestado</th>
      <th>Codigo lib categoria</th>
      <th>Id lib estado</th>
      <th>Id lib tipo material</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lib_materials as $lib_material): ?>
    <tr>
      <td><a href="<?php echo url_for('libMaterial/edit?codigo_lib_material='.$lib_material->getCodigoLibMaterial()) ?>"><?php echo $lib_material->getCodigoLibMaterial() ?></a></td>
      <td><?php echo $lib_material->getTitulo() ?></td>
      <td><?php echo $lib_material->getSubTitulo() ?></td>
      <td><?php echo $lib_material->getAutores() ?></td>
      <td><?php echo $lib_material->getEditorial() ?></td>
      <td><?php echo $lib_material->getFechaPublicacion() ?></td>
      <td><?php echo $lib_material->getFechaActualizacion() ?></td>
      <td><?php echo $lib_material->getDescripcion() ?></td>
      <td><?php echo $lib_material->getTemas() ?></td>
      <td><?php echo $lib_material->getIsReferencia() ?></td>
      <td><?php echo $lib_material->getIsSoloProfesor() ?></td>
      <td><?php echo $lib_material->getIsPrestado() ?></td>
      <td><?php echo $lib_material->getCodigoLibCategoria() ?></td>
      <td><?php echo $lib_material->getIdLibEstado() ?></td>
      <td><?php echo $lib_material->getIdLibTipoMaterial() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('libMaterial/new') ?>">New</a>
