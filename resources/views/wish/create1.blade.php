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
          <div class="portlet light md-shadow-z-2-i">
<!-- Image loader -->
<div id='loader' style='display: none;'>
  <img src='reload.gif' width='32px' height='32px'>
</div>

	<br></br><br></br>
<form  class="form-sample" id="ajaxForm">
	@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Wish Name</label>
    <input type="text" class="form-control" id="wishlist_name" name="wishlist_name"  placeholder="wishlist_name" >
     @if ($errors->has('wishlist_name'))
          <div class="alert alert-danger">
            {!! $errors->first('wishlist_name') !!}
          </div>
      @endif
  </div>   
   <div class="form-group">
	<select name="user_id" id="user_id" class="form-control" >
		@foreach($user as $users)
	  <option value="{{$users->id}}">{{$users->name}}</option>
	  @endforeach
	</select>
   </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).on('submit','#ajaxForm',function(e){
  //alert(343);
            e.preventDefault();
            var wishlist_name=$("#wishlist_name").val();            
              $.ajax({
                type:'POST',
                url:'{{url("user/ajax_create/wishy")}}',
                data:{
                      "_token": "{{ csrf_token() }}",
                      'status': 1,
                      'wishlist_name':wishlist_name,
                    },
                beforeSend: function(){
                  // Show image container
                  $("#loader").show();
                 },
                success:function(response){
                  console.log(response);
                  if(response.status==1)
                  {
                    window.location.href="{{url('/user/wish')}}";
                  console.log(232);
                 // location.reload();
                  }
                  else
                  {
                    console.log(333);
                  }
                                         
                },
                complete:function(data){
                // Hide image container
                $("#loader").hide();
               },
                error:function(data){
                   
                   console.log(data);
                   console.log(00);
                }
            });



});

</script>

</body></html>