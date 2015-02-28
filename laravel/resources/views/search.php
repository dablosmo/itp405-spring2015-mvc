<!DOCTYPE html>
<html>
<head>
	<title>DVD Search</title>
</head>
<body>

	<h1>DVD Search</h1>	
	<div class="search">
		<form action="/dvds/results" method="get">
			<div>DVD:</div>
			<input	type="text" name="dvd_title">
			<div>Genre:</div>
			<select name="Selgenre">
				<option value="">All</option>
				<?php foreach ($genres as $genre){?>
					<option value="<?php echo $genre->id ?>">
						<?php echo $genre->genre_name ?>
					</option>
				<?php } ?>
			</select>
			<div>Rating:</div>
			<select name="Selrating">
				<option value="">All</option>
				<?php foreach ($ratings as $rating):?>
					<option value="<?php echo $rating->id ?>">
						<?php echo $rating->rating_name ?>
					</option>
				<?php endforeach ?>
			</select>
			<input type="submit" value="Search">
		</form>
	</div>
</body>
</html>