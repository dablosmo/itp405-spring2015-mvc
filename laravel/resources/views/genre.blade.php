<!DOCTYPE html>
<html>
<head>
	<title>Genre: {{ $genre->genre_name }}</title>

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

<h1>Genre: {{ $genre->genre_name }}</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Rating</th>
			<th>Genre</th>
			<th>Label</th>
			<th>Review</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($dvds as $dvd)
			<tr>
				<td>{{ $dvd->title }}</td>
				<td>{{ $dvd->rating->rating_name }}</td>
				<td>{{ $dvd->genre->genre_name }}</td>
				<td>{{ $dvd->label->label_name }}</td>
				<td>
					<form method="get" action="/dvds/<?php echo $dvd->id?>">
						<input type="submit" value="Review">
					</form>
				</td>
			</tr>
	@endforeach
	</tbody>
</table>

</body>
</html>