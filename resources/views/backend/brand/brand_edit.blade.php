<x-admin.layouts.master>
    <x-slot name='pageTitle'>All Brands</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Brand</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.brand', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <img id="showImage" class="img-thumbnail"
                                        src="{{ asset('storage/' . $brand->brand_image) }}"
                                        alt="{{ $brand->brand_name_eng }}" style="width:200px; height:200px;">
                                </div>

                                <div class="form-group">
                                    <h5>Brand Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('brand_name_eng', $brand->brand_name_eng) }}"
                                            type="text" name="brand_name_eng" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('brand_name_eng')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Brand Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_ban" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false"
                                            value="{{ old('brand_name_ban', $brand->brand_name_ban) }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('brand_name_ban')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Brand Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="image" type="file" name="brand_image" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('brand_image')
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
