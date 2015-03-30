<!DOCTYPE html>
<html>
<head>
	<title>DVD Search Results</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	
	@if (Session::has('success'))
		<h2 style="color:black">{{ Session::get('success') }}</h2>
	@endif

	@foreach ($errors->all() as $error)
		<h3 style="color:red">{{ $error }}</h3>
	@endforeach
	
	<h1> DVD Review </h1>

	<div>

	@if ($rottenTomatoes) 
	<div>
		<img src="{{$rottenTomatoes['poster']}}">
	</div>

	<table class="table table-striped"> 
		<thead> 
			<th>Critic Score</th> 
			<th>Audience Score</th>
			<th>Runtime</th>
			<th>Cast</th>
		</thead>
		<tbody> 
			<tr> 
				<td>{{$rottenTomatoes['critic_score']}}</td>
				<td>{{$rottenTomatoes['audience_score']}}</td>
				<td>{{$rottenTomatoes['runtime']}}</td>
				<td>{{$rottenTomatoes['abridged_cast']}}</td>

			</tr>
		</tbody>
	</table>


	@else 
	<table class="table table-striped"> 
		<thead> 
			<th>Error</th> 
		</thead>
		<tbody> 
			<tr> 
				<td>Movie does not exist in Rotten Tomatoes Database.</td>
			</tr>
		</tbody>
	</table>

	@endif

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Rating</th>
					<th>Genre</th>
					<th>Label</th>
					<th>Sound</th>
					<th>Format</th>
					<th>Release Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($dvds as $dvd)
				<tr>
					<td>{{$dvd->title}}</td>
					<td>{{$dvd->rating_name}}</td>
					<td>{{$dvd->genre_name}}</td>
					<td>{{$dvd->label_name}}</td>
					<td>{{$dvd->sound_name}}</td>
					<td>{{$dvd->format_name}}</td>
					<td>{{$dvd->release_date_f}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div>
		<h2> Submit a Review: </h2>
		<form action="{{url("dvds")+$id}}" method="get">
			<span> Rating: </span>
			<select name="rating">
				@for ($i=1;$i<=10;$i++)
					@if ($i == Request::old('rating'))
					<option  selected="1"  value="{{$i}}">{{$i}}</option>
					@else
					<option value="{{$i}}">{{$i}}</option>
					@endif
				@endfor
			</select>
			<span> Title: </span>
			<input class="title" name="title" type="text" placeholder="Enter Title" value="{{ Request::old('title') }}">
			<span> Description: </span>
			<input class="description" name="description" type="text" placeholder="Enter Description" value="{{ Request::old('description') }}">
			<input name="dvd_id" type="hidden" value="{{$id}}">
			<input class="submit" type="submit" name="submit" value="Submit">
		</form>
	</div>

	@if (Session::has('reviews'))
	<div>
	<h2> Complete Reviews: </h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Rating</th>
					<th>Dvd_id</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach (Session::get('reviews') as $review)
				<tr>
					<td>{{$review->id}}</td>
					<td>{{$review->title}}</td>
					<td>{{$review->rating}}</td>
					<td>{{$review->dvd_id}}</td>
					<td>{{$review->description}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	
	@endif

	

</body> 
</html>