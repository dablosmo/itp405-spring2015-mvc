<!doctype html>
<html>
<head>
	<title>Create a DVD</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<style type="text/css">
		.error {
			background-color: red;
			color: white;
		}
		.success {
			background-color: green;
		}
	</style>
</head>

<body>
	<?php foreach ($errors->all() as $errorMessage): ?>
		<p class="error">Error! <?php echo $errorMessage; ?></p>
	<?php endforeach; ?>

	<?php if (Session::has('success')): ?>
		<p class="success"><?php echo Session::get('success'); ?></p>
	<?php endif; ?>

	<h1>Add a DVD to the database</h1>

	<form action="{{url("dvds/insert")}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div>
			<label>Title</label><br>
			<input type="text" name="title">
		</div>

		<div>
			<label>Label</label><br>
			<select name="label">
				<?php foreach ($labels as $label): ?>
					<option value="{{ $label->id }}">{{ $label->label_name }}</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div>
			<label>Sound</label><br>
			<select name="sound">
				<?php foreach ($sounds as $sound): ?>
					<option value="{{ $sound->id }}">{{ $sound->sound_name }}</option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div>
			<label>Genre</label><br>
			<select name="genre">
				<?php foreach ($genres as $genre): ?>
					<option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div>
			<label>Rating</label><br>
			<select name="rating">
				<?php foreach ($ratings as $rating): ?>
					<option value="{{ $rating->id }}">{{ $rating->rating_name }}</option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div>
			<label>Format</label><br>
			<select name="format">
				<?php foreach ($formats as $format): ?>
					<option value="{{ $format->id }}">{{ $format->format_name }}</option>
				<?php endforeach; ?>
			</select>
		</div>

		<input class="submit" type="submit" name="submit" value="Submit">
	</form>
</body>
</html>