<div class="table-responsive" style="margin: 10px; text-align: right;">
	<a class="btn btn-success" href="/aliases/create?id=<?=$_GET["id"]?>" style="color: #fff;">+ Добавить алиас</a>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Алиасы точки</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Имя</th>
				<th>Управление</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($aliases as $key => $alias) { ?>
					<tr>
						<td><?=$alias["id"]?></td>
						<td><?=$alias["title"]?></td>
						
						<td><a class="btn btn-info" href="/aliases/edit?id=<?=$alias["id"]?>" style="color: #fff;">Изменить</a></td>
						<td><a class="btn btn-danger" onclick="return alert('Вы уверены?');" href="/aliases/delete?id=<?=$alias["id"]?>&point_id=<?=$_GET["id"]?>" style="color: #fff;">Х</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>