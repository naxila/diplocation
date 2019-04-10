<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/points/create?id=<?=$_GET["id"]?>" style="color: #fff;">+ Добавить точку</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Точки</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Название</th>
				<th>ID устройства</th>
				<th>Изменил</th>
				<th>Время изменения</th>
				<th>Алиасы</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($points as $key => $point) { ?>
					<tr>
						<td><?=$point["id"]?></td>
						<td><?=$point["title"]?></td>
						<td><?=$point["device_id"]?></td>
						<td><?=$point["editor"]?></td>
						<td><?=$point["last_update"]?></td>
						<td><a class="btn btn-success" href="/aliases/?id=<?=$point["id"]?>" style="color: #fff;">Алиасы</a></td>
						<td><a class="btn btn-info" href="/points/edit?id=<?=$point["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/points/delete?id=<?=$point["id"]?>&building_id=<?=$_GET["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>