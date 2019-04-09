<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/countries/create" style="color: #fff;">+ Добавить страну</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Список стран</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Название</th>
				<th>Города</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($countries as $key => $country) { ?>
					<tr>
						<td><?=$country["id"]?></td>
						<td><?=$country["title"]?></td>
						<td><a class="btn btn-success" href="/cities/?id=<?=$country["id"]?>" style="color: #fff;">Города</a></td>
						<td><a class="btn btn-info" href="/countries/edit?id=<?=$country["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/countries/delete?id=<?=$country["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>