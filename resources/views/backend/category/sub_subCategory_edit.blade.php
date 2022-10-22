<x-admin.layouts.master>
    <x-slot name='pageTitle'>{{ $subSubCategory->sub_sub_category_name_eng }}</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Sub Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.sub.subCategory', $subSubCategory->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select data-need="update" name="category_id" id="category" required=""
                                            class="form-control" aria-invalid="false">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $subSubCategory->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name_eng }}
                                                </option>
                                            @endforeach
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Sub Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="sub_category_id" id="sub_category" required=""
                                            class="form-control" aria-invalid="false"
                                            data-subSubCategoryId="{{ $subSubCategory->sub_category_id }}">
                                            <option value="">Select Category</option>

                                            @error('sub_category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input
                                            value="{{ old('sub_sub_category_name_eng', $subSubCategory->sub_sub_category_name_eng) }}"
                                            type="text" name="sub_sub_category_name_eng" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('sub_sub_category_name_eng')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Sub Subcategory Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_sub_category_name_ban" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false"
                                            value="{{ old('sub_sub_category_name_ban', $subSubCategory->sub_sub_category_name_ban) }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('sub_sub_category_name_ban')
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
