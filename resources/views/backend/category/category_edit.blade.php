<x-admin.layouts.master>
    <x-slot name='pageTitle'>Update Category</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.category', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('category_name_eng', $category->category_name_eng) }}"
                                            type="text" name="category_name_eng" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('category_name_eng')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Category Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_ban" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false"
                                            value="{{ old('category_name_ban', $category->category_name_ban) }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('category_name_ban')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Brand Icon Class Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false"
                                            value="{{ old('category_icon', $category->category_icon) }}">
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
