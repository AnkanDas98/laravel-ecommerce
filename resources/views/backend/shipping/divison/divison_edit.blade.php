<x-admin.layouts.master>
    <x-slot name='pageTitle'>Update Divison</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Divison</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.divison', $divison->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Divison Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('divison_name', $divison->divison_name) }}" type="text"
                                            name="divison_name" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('divison_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                        </div>



                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
