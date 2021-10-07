@extends('layouts.admin')

@section('content')





@if (Session::has('msg'))
  <div class="alert alert-success" role="alert">
    {{Session::get('msg')}}
  </div>
@endif


  <div class="card-header">
    <h5>Danh sách người dùng</h5>
  <div>
  <div class="mr-auto">
    <button onclick="warningBeforeDelete()" class="btn btn-dark" >Delete</button>
  </div>

    
<div class="col-xl-12 col-md-12">

  <div class="card Recent-Users">

      <form method="POST" action="/deleteAllUser" id="formDelete">
        @method('DELETE')
        @csrf


      <div class="card-block px-0 py-3">
          <div class="table-responsive">
              <table class="table table-hover table-bordered">

                <thead>
                  <tr class="unread" >
                      <td>
                        <input type="checkbox" id="checkAll">
                      </td>
                      <td>
                        <h6 class="mb-1">Username</h6>
                      </td>
                      <td>
                        <h6 class="mb-1">Fullname</h6>
                      </td>
                      <td>
                        <h6 class="mb-1">Status</h6>
                      </td>
                      <td >
                        <h6 class="mb-1">Options</h6>
                      </td>
                  </tr>                                                                    
              </thead>

                  <tbody >
                      @foreach ($users as $item)
                        <tr class="unread">
                          <td>
                            <input type="checkbox" name="ids[]" id="checkbox_{{$item->id}}" value="{{$item->id}}">
                          </td>

                          <td>
                            {{$item->userName}}
                          </td>

                          <td>
                            {{$item->fullName}}
                          </td>

                          <td>
                            @if ($item->status)
                                Hoạt Động
                            @else
                                Vô Hiệu
                            @endif

                          </td>

                          <td >
                          <a href="{{route('nguoidung.edit',$item->id)}}" class="btn btn-outline-danger">Edit</a>
                          </td>
                      @endforeach  
                    </tr>
                  </tbody>
              </table>
              
          </div>
      </div>
      
      </form>
      {{$users->links()}}

  </div>
</div>

<script>

  $("#checkAll").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
  });


  function warningBeforeDelete(){
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $( "#formDelete" ).submit();
    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
      )
    }
  })
  }

  
  </script>

@endsection
