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
  <form name="filter_listing">
  <table class="table table-striped">
    <thead>
      <tr>
  
        <th>wish name <td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-filter input-sm" name="name" id="name" placeholder="Name">
                                    </td></th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="dynamicContent">
   
   @include('wish.list_check')
    </tbody>
  </table>
</form>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    var full_path = "{{url('user')}}";
    var jqxhr = {abort: function () {  }};

  $(document).ready(function(){

     $(document).on('keyup', '#name, #email, #phone,#todz_id', function () {
      //alert(242);
            if($(this).val().length > 2)
            {
                loadListings(full_path + '/wish/?page=');
            }
            if($(this).val().length == 0)
            {
                loadListings(full_path + '/wish/?page=');
            }
        });

  })


        function loadListings(url){
            var filtering = $("form[name=filter_listing]").serialize();
            //abort previous ajax request if any
            alert(filtering);

            jqxhr.abort();
            jqxhr =$.ajax({
                type : 'get',
                url : url,
                data : filtering,
                dataType : 'html',
                
                success : function(data){
                    data = data.trim();
                    $("#dynamicContent").empty().html(data);
                },
                error : function(response){
                   // stopLoader('body');
                },
                complete:function(){
                   // stopLoader('body');
                }
            });
        }


</script>


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
