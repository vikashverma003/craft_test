<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container"> 
	<br></br><br></br>
<form method="POST" action="{{url('wish')}}/{{$wish->id}}/update" class="form-sample" enctype="multipart/form-data">
	@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Wish Name</label>
    <input type="text" class="form-control" id="wishlist_name"  value="{{$wish->wishlist_name}}" name="wishlist_name"  placeholder="wishlist_name">
  </div>   
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body></html>