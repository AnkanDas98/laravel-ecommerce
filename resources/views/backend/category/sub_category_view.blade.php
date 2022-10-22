<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Sub Categories</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Sub Category List</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Sub Category List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub Category Name English</th>
                                    <th>Sub Category Name Bangla</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCat)
                                    <tr>
                                        <td>{{ $subCat['category']['category_name_eng'] }}</span>
                                        </td>
                                        <td>{{ $subCat->sub_category_name_eng }}</td>
                                        <td>{{ $subCat->sub_category_name_ban }}</td>
                                        <td style="width: 30%;">
                                            <a href="{{ route('edit.subCategory', $subCat->id) }}"
                                                class="btn btn-info mr-2" title="Edit Data"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="deleteForm"
                                                action="{{ route('delete.subCategory', $subCat->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger deleteBtn"
                                                    title="Delete Data"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub Category Name English</th>
                                    <th>Sub Category Name Bangla</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

        {{-- ---------------Add Brand Form-------------------- --}}
        <div class="col-lg-4 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Sub Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('store.subCategory') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="select" required="" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_eng }}
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
                                    <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('sub_category_name_eng') }}" type="text"
                                            name="sub_category_name_eng" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('sub_category_name_eng')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Sub Category Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_category_name_ban" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false" value="{{ old('sub_category_name_ban') }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('sub_category_name_ban')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                        </div>

                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Add Category</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
