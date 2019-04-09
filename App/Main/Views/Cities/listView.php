<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/cities/create?id=<?=$_GET["id"]?>" style="color: #fff;">+ Добавить город</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Список городов</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Название</th>
				<th>Здания</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($cities as $key => $city) { ?>
					<tr>
						<td><?=$city["id"]?></td>
						<td><?=$city["title"]?></td>
						<td><a class="btn btn-success" href="/buildings/?id=<?=$city["id"]?>" style="color: #fff;">Здания</a></td>
						<td><a class="btn btn-info" href="/cities/edit?id=<?=$city["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/cities/delete?id=<?=$city["id"]?>&country_id=<?=$_GET["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>