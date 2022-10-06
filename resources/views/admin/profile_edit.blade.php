<x-admin.layouts.master >
    <x-slot name='pageTitle'>Profile Edit</x-slot>
    <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Edit Profile</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
                <form action="{{route('admin.profile.update', $adminData->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-12">	
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <img id="showImage" style="width: 120px; height: 120px;" src="{{$adminData->profile_image ? asset('storage/'.$adminData->profile_image)  : asset('storage/images/no_profile.png')  }}" alt="User Avatar">
                            </div>
                           </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">   
                                     <input type="email" value="{{old('email', $adminData->email)}}" name="email" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                     @error('email')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" value="{{old('name', $adminData->name)}}" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @error('name')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                        </div>
                       
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Profile Image </h5>
                                <div class="controls">
                                    <input id="image" type="file" name="profile_image" class="form-control"  aria-invalid="false"> <div class="help-block"></div></div>
                                    @error('profile_image')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Phone </h5>
                                <div class="controls">
                                    <input type="text" name="phone" value="{{old('name', $adminData->phone)}}" class="form-control" > <div class="help-block"></div></div>
                                    @error('phone')
                                     <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </div>
                        </div>
                       </div>
                       
                       
                       
                    </div>
                   
                  </div>
                    
                   
                    
                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

</x-admin.layouts.master>