   @foreach($wish as $wishes)
      
      <tr class="del{{$wishes->id}}">
        <td>{{$wishes->wishlist_name}}</td>
        <td><a href="{{url('/user/wish/')}}/{{$wishes->id}}/edit"><i class="fa fa-edit"></i></a><a href="#" onclick="delete_confirmation('{{$wishes->id}}')"
> <i class="fa fa-trash"></i></a></td>
  
      </tr>
    
     @endforeach