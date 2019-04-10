<div class="table-responsive">
	<table class="table table-striped">
		<caption style="caption-side: top;">Здания</caption>
		<thead>
			<tr>
				<th>Номер</th>
				<th>Имя</th>
				<th>Город</th>
				<th>Адрес</th>
				<th>Точки</th>
				<th>Связь</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($buildings as $key => $building) { ?>
					<tr>
						<td><?=$building["id"]?></td>
						<td><?=$building["title"]?></td>
						<td><?=$building["city"]?></td>
						<td><?=$building["address"]?></td>
						
						<td><a class="btn btn-success" href="/points/?id=<?=$building["id"]?>" style="color: #fff;">Точки</a></td>
						<td><a class="btn btn-info" href="/vectors/?id=<?=$building["id"]?>" style="color: #fff;">Связка точек</a></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>
</div>