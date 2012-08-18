<h1>Cur cursos List</h1>

<table>
  <thead>
    <tr>
      <th>Id cur curso</th>
      <th>Nombre</th>
      <th>Duracion</th>
      <th>Horario</th>
      <th>Fecha inicio</th>
      <th>Fecha fin</th>
      <th>Id cur empresa</th>
      <th>Codigo profesor</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cur_cursos as $cur_curso): ?>
    <tr>
      <td><a href="<?php echo url_for('curCurso/edit?id_cur_curso='.$cur_curso->getIdCurCurso()) ?>"><?php echo $cur_curso->getIdCurCurso() ?></a></td>
      <td><?php echo $cur_curso->getNombre() ?></td>
      <td><?php echo $cur_curso->getDuracion() ?></td>
      <td><?php echo $cur_curso->getHorario() ?></td>
      <td><?php echo $cur_curso->getFechaInicio() ?></td>
      <td><?php echo $cur_curso->getFechaFin() ?></td>
      <td><?php echo $cur_curso->getIdCurEmpresa() ?></td>
      <td><?php echo $cur_curso->getCodigoProfesor() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('curCurso/new') ?>">New</a>
