<h1>Cur empresas List</h1>

<table>
  <thead>
    <tr>
      <th>Id cur empresa</th>
      <th>Nombre</th>
      <th>Descripcion</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cur_empresas as $cur_empresa): ?>
    <tr>
      <td><a href="<?php echo url_for('curEmpresa/edit?id_cur_empresa='.$cur_empresa->getIdCurEmpresa()) ?>"><?php echo $cur_empresa->getIdCurEmpresa() ?></a></td>
      <td><?php echo $cur_empresa->getNombre() ?></td>
      <td><?php echo $cur_empresa->getDescripcion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('curEmpresa/new') ?>">New</a>
