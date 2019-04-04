<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Номер</th>
				<th>Имя</th>
				<th>E-mail</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($users as $key => $user) { ?>
					<tr>
						<td><?=$user["id"]?></td>
						<td><?=$user["name"]?></td>
						<td><?=$user["email"]?></td>
						<td><a class="btn btn-info" href="/admins/edit?id=<?=$user["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><button type="button" class="btn btn-danger" style="color: #fff;">Х</button></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>