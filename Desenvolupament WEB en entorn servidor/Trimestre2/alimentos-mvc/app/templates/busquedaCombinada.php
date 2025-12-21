<?php ob_start() ?>
<form action="index.php?ctl=buscarCombinada" method="post">
	<label>Nombre:</label>
	<input type="text" name="nombre" value="<?php echo $params['nombre'] ?>">

	<label>Energía:</label>
	<input type="text" name="energia" value="<?php echo $params['energia'] ?>">

	<span>(puedes usar % como comodín)</span>

	<input type="submit" value="Buscar" class="nav-btn">
</form>

<?php if (count($params['resultado']) > 0): ?>
<table class="tabla-calida">
	<tr>
		<th>Alimento</th>
		<th>Energía</th>
		<th>Grasa</th>
	</tr>
	<?php foreach ($params['resultado'] as $alimento): ?>
	<tr>
		<td>
			<a href="index.php?ctl=ver&id=<?php echo $alimento['id'] ?>">
				<?php echo $alimento['nombre'] ?>
			</a>
		</td>
		<td><?php echo $alimento['energia'] ?></td>
		<td><?php echo $alimento['grasatotal'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
