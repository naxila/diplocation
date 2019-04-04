<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Номер</th>
				<th>Название</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($users as $key => $user) { ?>
					<tr>
						<td><?=$user["id"]?></td>
						<td><?=$user["name"]?></td>
						<td><?=$user["email"]?></td>
					</tr>
			<?php } ?>

		</tbody>
	</table>