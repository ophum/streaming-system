<form action="/upload" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="file" name="file">
	<input type="submit" value="upload">
</form>
