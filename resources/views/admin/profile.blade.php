<x-admin.layouts.master >
    <x-slot name='pageTitle'>{{$adminData->name}}'s profile</x-slot>

    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-black " style="width: 100%;display: flex;justify-content: space-between">
            <div>
                <h3 class="widget-user-username">{{Str::ucfirst($adminData->name)}}</h3>
                <h6 class="widget-user-desc">Admin</h6>
            </div>
            <a href="{{route('admin.profile.edit', $adminData->id)}}" class="btn btn-rounded btn-success mb-5" style="align-self: start; padding: 9px 41px">Edit</a>
        </div>
        <div class="widget-user-image">
          <img class="rounded-circle" src="{{$adminData->profile_image ? asset('storage/'.$adminData->profile_image)  : asset('storage/images/no_profile.png')  }}" alt="User Avatar">
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-4">
              <div class="description-block">
                <h5 class="description-header">12K</h5>
                <span class="description-text">FOLLOWERS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 br-1 bl-1">
              <div class="description-block">
                <h5 class="description-header">550</h5>
                <span class="description-text">FOLLOWERS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
              <div class="description-block">
                <h5 class="description-header">158</h5>
                <span class="description-text">TWEETS</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
</x-admin.layouts.master>