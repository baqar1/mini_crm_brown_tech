@extends('admin.master_layout')
@section('page_title', 'All Companies')
@section('content')
<!-- Main content -->
@if (session()->has('message'))    
    <div class="alert alert-success  border-0 mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
        <strong>Success!</strong> {{session('message')}}</button>
    </div> 
@endif
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <a href="{{route('company.create')}}" class="btn btn-success mb-2 ml-2">Add</a>

            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.list_all_companies')}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="company" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Logo</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @foreach($records as $record)
                        <tr>
                        <td>{{$no++}}</td>
                        @if($record->logo)
                            <td class="avatar avatar-xl"><img src="{{asset('storage/company').'/'.$record->logo}}" alt="avatar"></td>
                        @else
                            <td class="avatar avatar-xl"><img src="{{asset('storage/company/90x90.jpg')}}" alt=""></td>
                        @endif
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>
                            <a href="{{route('company.edit',[$record->id])}}"><i class="fas fa-edit"></i></a>
                            <form style="display: inline;" action="{{route('company.destroy',[$record->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit"  onclick="return confirm('Are you sure to delete this user?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('scripts')
<script>
    $(document).ready( function () {
    $('#company').DataTable();
} );
</script>
@endsection