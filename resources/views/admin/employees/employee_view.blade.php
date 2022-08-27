@extends('admin.master_layout')
@section('page_title', 'Add New Employee')
@section('content')
@php
$companies = App\Models\Company::all();
@endphp
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="@if($employee->exists) {{route('employee.update',[$employee])}} @else  {{route('employee.store')}} @endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if($employee->exists)
                @method("PUT")
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="first_name" value="{{$employee->first_name?? old('first_name')}}" class="form-control">
                    @if ($errors->has('first_name'))
                        <small class="text-danger">{{$errors->first('first_name')}}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="{{$employee->last_name?? old('last_name')}}" class="form-control">
                    @if ($errors->has('last_name'))
                        <small class="text-danger">{{$errors->first('last_name')}}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{$employee->email?? old('email')}}" class="form-control">
                    @if ($errors->has('email'))
                        <small class="text-danger">{{$errors->first('email')}}</small>
                    @endif
                  </div>
                  
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{$employee->phone?? old('phone')}}" class="form-control">
                    @if ($errors->has('phone'))
                        <small class="text-danger">{{$errors->first('phone')}}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="company_id">Companies</label>
                    <select class="form-control" name="company_id">
                      <option value="">Select</option>
                      @foreach($companies as $company)
                        <option value="{{$company->id}}" {{($employee->company_id==$company->id)?'selected':'' }}   >{{$company->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('company_id'))
                        <small class="text-danger">{{$errors->first('company_id')}}</small>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection