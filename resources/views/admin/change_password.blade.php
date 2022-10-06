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
                <form action="{{route('admin.profile.password.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-12">	
                        
                        <div class="form-group">
                            <h5>Old Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="old_password" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false"> <div class="help-block"></div></div>
                                @error('old_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>New Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="new_password" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false"> <div class="help-block"></div></div>
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Confirm Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="confirm_password" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false"> <div class="help-block"></div></div>
                                @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
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