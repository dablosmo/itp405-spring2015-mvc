<!DOCTYPE html>
<html>
<head>
	<title>DVD Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

</head>
<body>
	<h1>DVD Search</h1>	
	<div>
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

	<h2>Genres:</h2>

	<div>
	@foreach ($genres as $genre)
		<div>
			<a href="{{url('genres/'.$genre->genre_name.'/dvds')}}">{{$genre->genre_name}}</a>
		</div>
	@endforeach
	</div>
	
</body>
</html>