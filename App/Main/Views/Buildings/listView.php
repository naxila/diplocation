<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/admins/create" style="color: #fff;">+ Создать пользователя</a>
</div>

<?php
	$nameColors = ["#333", "#33cc33"];
?>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Администраторы</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Имя</th>
				<th>E-mail</th>
				<th>Здания</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($users as $key => $user) { ?>
					<tr>
						<td><?=$user["id"]?></td>
						<td> <font color="<?=$nameColors[$user["super_user"]]?>"> <?=$user["name"]?> </font> </td>
						<td><?=$user["email"]?></td>
						<td><?php if ($user["super_user"] == 0) { ?> <a class="btn btn-success" href="/admins/buildings?id=<?=$user["id"]?>" style="color: #fff;">Здания</a> <?php } ?></td>
						<td><a class="btn btn-info" href="/admins/edit?id=<?=$user["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/admins/delete?id=<?=$user["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>