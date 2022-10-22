<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Products</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Add Product</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                            class="mdi mdi-home-outline"></i></a></li>

                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('add-product') }}">Add Product</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Product</h4>

        </div>
        @if ($errors->any())

            <div class="box-header with-border">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Brands</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name_eng }}
                                                </option>
                                            @endforeach
                                            @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="category" class="form-control"
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
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Sub Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" id="sub_category" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Category</option>

                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Sub subcategory <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subsubcategory_id" id="subsubcategory" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Category</option>

                                            @error('subsubcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Name English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control"
                                            value="{{ old('product_name_en') }}">
                                        @error('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Name Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_bn" class="form-control"
                                            value="{{ old('product_name_bn') }}">
                                        @error('product_name_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Code<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" class="form-control">
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Quantity<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="product_qty" class="form-control">
                                        @error('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Tags English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" data-role="tagsinput" placeholder="add-tags"
                                            name="product_tags_en" class="form-control"
                                            value="{{ old('product_tags_en') }}">
                                        @error('product_tags_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Tags Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" data-role="tagsinput" placeholder="add-tags"
                                            name="product_tags_bn" class="form-control"
                                            value="{{ old('product_tags_bn') }}">
                                        @error('product_tags_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Color English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" placeholder="add-colors" data-role="tagsinput"
                                            name="product_color_en" class="form-control"
                                            value="{{ old('product_color_en') }}">
                                        @error('product_color_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Color Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" placeholder="add-colors" data-role="tagsinput"
                                            product_size_en name="product_color_bn" class="form-control"
                                            value="{{ old('product_color_bn') }}">
                                        @error('product_color_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Size English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" placeholder="add-size" data-role="tagsinput"
                                            value="{{ old('product_size_en') }}" name="product_size_en"
                                            class="form-control">
                                        @error('product_size_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Size Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" placeholder="add-size" data-role="tagsinput"
                                            value="{{ old('product_size_bn') }}" name="product_size_bn"
                                            class="form-control">
                                        @error('product_size_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="selling_price" class="form-control">
                                        @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="discount_price" class="form-control">

                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Product Thumnail Image<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="image" type="file" name="product_thumbnail"
                                            class="form-control">
                                        @error('product_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <img id="showImage"
                                            src="{{ asset('storage/images/no-photo-available.png') }}"
                                            alt="No photo available image" class="mt-3 img-thumbnail"
                                            style="width: 120px; height: 120px; display: none;">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Choose Product Imges<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="multiImage" type="file" name="product_image[]"
                                            class="form-control" multiple>
                                        @error('product_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <img id="showMultiImage"
                                            src="{{ asset('storage/images/no-photo-available.png') }}"
                                            alt="No photo available image" class="mt-3 img-thumbnail"
                                            style="width: 150px; height: 150px; display: none;"> --}}
                                        <div class="row" id="showMultiImage">

                                        </div>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Short Description English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_en" id="textarea" class="form-control">{{ old('short_descp_en') }}</textarea>

                                        @error('short_descp_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Short Description Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_bn" id="textarea" class="form-control">{{ old('short_descp_bn') }}</textarea>
                                        <div class="help-block"></div>
                                        @error('short_descp_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Long Description English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="long_descp_en" id="editor1" class="form-control">{{ old('long_descp_en') }}</textarea>

                                        @error('long_descp_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5>Long Description Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="long_descp_bn" id="editor2" class="form-control">{{ old('long_descp_bn') }}</textarea>

                                        @error('long_descp_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input name="hot_deals" type="checkbox" id="checkbox_1" value="1">
                                            <label for="checkbox_1">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input name="featured" type="checkbox" id="checkbox_2" value="1">
                                            <label for="checkbox_2">Feaured</label>
                                        </fieldset>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input name="special_offer" type="checkbox" id="checkbox_3"
                                                value="1">
                                            <label for="checkbox_3">Speacial Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input name="special_deal" type="checkbox" id="checkbox_4"
                                                value="1">
                                            <label for="checkbox_4">Speacial Deals</label>
                                        </fieldset>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Add Product</button>
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
