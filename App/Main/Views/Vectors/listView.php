<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/buildings/create?id=<?=$_GET["id"]?>" style="color: #fff;">+ Добавить здание</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Здания</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Имя</th>
				<th>Адрес</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($buildings as $key => $building) { ?>
					<tr>
						<td><?=$building["id"]?></td>
						<td><?=$building["title"]?></td>
						<td><?=$building["address"]?></td>
						
						<td><a class="btn btn-info" href="/buildings/edit?id=<?=$building["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/buildings/delete?id=<?=$building["id"]?>&city_id=<?=$_GET["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>