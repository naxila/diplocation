<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Номер</th>
				<th>Название</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($countries as $key => $country) { ?>
					<tr>
						<td><?=$country["id"]?></td>
						<td><?=$country["title"]?></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>