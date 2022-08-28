@extends('admin.master_layout')
@section('page_title', __('admin.add_company'))
@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.add_company')}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="@if($company->exists) {{route('company.update',[$company])}} @else  {{route('company.store')}} @endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if($company->exists)
                @method("PUT")
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">{{__('admin.name')}}</label>
                    <input type="text" name="name" value="{{$company->name?? old('name')}}" class="form-control">
                    @if ($errors->has('name'))
                        <small class="text-danger">{{$errors->first('name')}}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="email">{{__('admin.email')}}</label>
                    <input type="email" name="email" value="{{$company->email?? old('email')}}" class="form-control">
                    @if ($errors->has('email'))
                        <small class="text-danger">{{$errors->first('email')}}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">{{__('admin.logo')}}</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input">
                        @if ($errors->has('logo'))
                            <small class="text-danger">{{$errors->first('logo')}}</small>
                        @endif
                        <label class="custom-file-label" for="logo"> {{__('admin.choose_file')}}</label>
                      </div>
                      
                    </div>
                  </div>
                  @if($company->exists)
                    <div class="form-group">
                        @if($company->logo)
                            <img src="{{asset('storage/company').'/'.$company->logo}}" alt="avatar">
                        @else
                            <img src="{{asset('storage/company/90x90.jpg')}}" alt="">
                        @endif
                    </div>
                  @endif
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> {{__('admin.submit')}}</button>
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