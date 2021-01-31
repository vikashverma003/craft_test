<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- font awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    
    <!-- Swal -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

</head>
<style type="text/css">
        i{
            font-size: 20px !important;
            padding: 5px;
        }
    </style>
<body>

<div class="container">
  <h2>Wish List</h2>
  <a href="{{url('user/wish/create')}}">Add Wishes</a>
    <a href="{{url('user/ajax_create')}}">Add Wishes AJax</a>

  @if (session('er_status'))
                  <div class="alert alert-danger">{!! session('er_status') !!}</div>
                @endif
                @if (session('su_status'))
                  <div class="alert alert-success">{!! session('su_status') !!}</div>
                @endif
  <table class="table table-striped">
    <thead>
      <tr>
  
        <th>wish name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($wish as $wishes)
      
      <tr class="del{{$wishes->id}}">
        <td>{{$wishes->wishlist_name}}</td>
        <td><a href="{{url('/user/wish/')}}/{{$wishes->id}}/edit"><i class="fa fa-edit"></i></a><a href="#" onclick="delete_confirmation('{{$wishes->id}}')"
> <i class="fa fa-trash"></i></a></td>
  
      </tr>
    
     @endforeach
    </tbody>
  </table>
</div>

</body>

<script type="text/javascript">
  

   function delete_confirmation(id)
  {
    swal({
        title: "Are you sure want to delete this user?",
        text: "Please ensure and then confirm",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ab8be4",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    })
   
    .then((willDelete) => {
      if (willDelete) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          type: 'GET',
          url: "{{url('user/wish')}}/"+id+'/'+'delete',
          success:function(data){
            console.log("dddd"+data.id);
                //$('.del'+id).remove();
            if(data.success == true)
            {
              console.log(1);
             swal("Done!", data.message, "success");
            }
            else
            {
              console.log(11);

              swal("Error!", data.message, "error");
            }
            setTimeout(function(){ location.reload()}, 3000);
          }
        });
      } 
    });
  }
 
</script>
</html>
