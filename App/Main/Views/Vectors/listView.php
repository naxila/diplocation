<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/vectors/create?id=<?=$_GET["id"]?>" style="color: #fff;">+ Добавить связь</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Связи точек</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Начальная точка</th>
				<th>Конечная точка</th>
				<th>Расстояние</th>
				<th>Направление</th>
				<th>Изменил</th>
				<th>Дата изменения</th>

				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($vectors as $key => $vector) { ?>
					<tr>
						<td><?=$vector["id"]?></td>
						<td><?=$vector["start"]?></td>
						<td><?=$vector["endp"]?></td>
						<td><?=$vector["distance"]?></td>
						<td><?=$vector["direction"]?></td>
						<td><?=$vector["editor"]?></td>
						<td><?=$vector["last_update"]?></td>
						
						<td><a class="btn btn-info" href="/vectors/edit?id=<?=$vector["id"]?>&building_id=<?=$_GET["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/vectors/delete?id=<?=$vector["id"]?>&building_id=<?=$_GET["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>