<form action="/admins/saveBuildings?id=<?=$_GET["id"]?>" method="POST" style="width: 80%; margin: 10px;">
  <div class="form-group">
    <label for="exampleInputEmail1">Здания для <?=$user["name"]?></label>

	<select name="buildings[]" multiple size="20"  class="form-control">
		
	<?php foreach ($buildings as $key => $building) { ?>
			<?php if (in_array($building["id"], $userBuildings)) { ?>
				<option value="<?=$building["id"]?>" selected><?=$building["title"]?> (<?=$building["city"]?>)</option>
			<?php } else { ?>
				<option value="<?=$building["id"]?>"><?=$building["title"]?> (<?=$building["city"]?>)</option>
			<?php } ?>
	<?php } ?>

	</select>
	</div>
	 <button type="submit" class="btn btn-primary">Сохранить</button>
</form>