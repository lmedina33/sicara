<h1>Ref hoja vidas List</h1>

<table>
  <thead>
    <tr>
      <th>Id ref hoja vida</th>
      <th>Descripcion</th>
      <th>Id ref elemento</th>
      <th>Id usuario creador</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ref_hoja_vidas as $ref_hoja_vida): ?>
    <tr>
      <td><a href="<?php echo url_for('refHojaVida/edit?id_ref_hoja_vida='.$ref_hoja_vida->getIdRefHojaVida()) ?>"><?php echo $ref_hoja_vida->getIdRefHojaVida() ?></a></td>
      <td><?php echo $ref_hoja_vida->getDescripcion() ?></td>
      <td><?php echo $ref_hoja_vida->getIdRefElemento() ?></td>
      <td><?php echo $ref_hoja_vida->getIdUsuarioCreador() ?></td>
      <td><?php echo $ref_hoja_vida->getCreatedAt() ?></td>
      <td><?php echo $ref_hoja_vida->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('refHojaVida/new') ?>">New</a>
