<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>{{ $product->product_name_en }}</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Edit Product</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                            class="mdi mdi-home-outline"></i></a></li>

                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('add-product') }}">{{ $product->product_name_en }}</a></li>
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
                    <form method="POST" action="{{ route('update.product', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Brands</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name_eng }}
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
                                            aria-invalid="false" data-need='update'>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
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
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <h5>Sub Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" id="sub_category" class="form-control"
                                            data-productSubCatId="{{ $product->subcategory_id }}" aria-invalid="false">
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
                                            aria-invalid="false"
                                            data-productSubSubId="{{ $product->subsubcategory_id }}">
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
                                            value="{{ old('product_name_en', $product->product_name_en) }}">
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
                                            value="{{ old('product_name_bn', $product->product_name_bn) }}">
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
                                        <input type="text" name="product_code" value="{{ $product->product_code }}"
                                            class="form-control">
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
                                        <input type="number" name="product_qty"
                                            value="{{ old('product_qty', $product->product_qty) }}"
                                            class="form-control">
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
                                            value="{{ old('product_tags_en', $product->product_tags_en) }}">
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
                                            value="{{ old('product_tags_bn', $product->product_tags_bn) }}">
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
                                            value="{{ old('product_color_en', $product->product_color_en) }}">
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
                                            value="{{ old('product_color_bn', $product->product_color_bn) }}">
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
                                            value="{{ old('product_size_en', $product->product_size_en) }}"
                                            name="product_size_en" class="form-control">
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
                                            value="{{ old('product_size_bn', $product->product_size_bn) }}"
                                            name="product_size_bn" class="form-control">
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
                                        <input type="number" name="selling_price"
                                            value="{{ old('selling_price', $product->selling_price) }}"
                                            class="form-control">
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
                                        <input type="number" name="discount_price"
                                            value="{{ old('discount_price', $product->discount_price) }}"
                                            class="form-control">

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
                                        <textarea name="short_descp_en" id="textarea" class="form-control">{{ old('short_descp_en', $product->short_descp_en) }}</textarea>

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
                                        <textarea name="short_descp_bn" id="textarea" class="form-control">{{ old('short_descp_bn', $product->short_descp_bn) }}</textarea>
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
                                        <textarea name="long_descp_en" id="editor1" class="form-control">{{ old('long_descp_en', $product->long_descp_en) }}</textarea>

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
                                        <textarea name="long_descp_bn" id="editor2" class="form-control">{{ old('long_descp_bn', $product->long_descp_bn) }}</textarea>

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
                                            <input name="hot_deals" type="checkbox" id="checkbox_1" value="1"
                                                {{ $product->hot_deals ? 'checked' : '' }}>
                                            <label for="checkbox_1">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input name="featured" type="checkbox" id="checkbox_2" value="1"
                                                {{ $product->featured ? 'checked' : '' }}>
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
                                                value="1" {{ $product->special_offer ? 'checked' : '' }}>
                                            <label for="checkbox_3">Speacial Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input name="special_deal" type="checkbox" id="checkbox_4"
                                                value="1" {{ $product->special_deal ? 'checked' : '' }}>
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

    <div class="row">
        <div class="col-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Multiple Image Update</h4>
                </div>


                <div class="row row-sm mt-4">
                    @foreach ($multPhotos as $photo)
                        <div class="col-md-3 ml-3 mx-auto">
                            <div class="card" style="position: relative; border: 1px solid rgba(40, 40, 40, 0.8)">
                                <img id="{{ 'showImage_' . $photo->id }}"
                                    src="{{ asset('storage/' . $photo->product_image) }}" class="card-img-top"
                                    alt="..." style="height: 300px; width: 100%;">
                                <form action="{{ route('delete.product-multiImage', $photo->id) }}" method="POST"
                                    style="position: absolute; top:5px; right:5px; ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background-color: transparent; border: none; color: red; font-size: 1.4rem"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                                <div class="card-body">
                                    <form action="{{ route('update.product-multiImage') }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="image_id" value="{{ $photo->id }}" />

                                        <div style="display: flex; justify-content: space-between">

                                            <input type="file" name="product_image"
                                                id="{{ 'multi_image_' . $photo->id }}" hidden />
                                            <label id="{{ 'image_label_' . $photo->id }}"
                                                for="{{ 'multi_image_' . $photo->id }}"
                                                class="btn btn-primary">Change
                                                Image</label>
                                            <button id="{{ 'image_button_' . $photo->id }}" type="submit"
                                                class="btn btn-info" style="display: none">Save</button>

                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    @endforeach
                    @if (count($multPhotos) < 6)
                        <div class="col-md-2 col-sm-3 my-auto mx-auto">
                            <div class="card" style="border: none; background-color: transparent">
                                <div class="card-body">
                                    <form action="{{ route('add.multiImage') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <input type="file" name="product_image[]" id="add_image" hidden
                                            multiple />
                                        <label for="add_image"><img src="{{ asset('storage/images/add.svg') }}"
                                                alt="plus svg"
                                                style="height: 150px; width: 150px; opacity: 0.6;"></label>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Thumbnail Update</h4>
                </div>


                <div class="row row-sm mt-4">

                    <div class="col-md-3 ml-3 ">
                        <div class="card" style="border: 1px solid rgba(40, 40, 40, 0.8)">
                            <img id="showImage" src="{{ asset('storage/' . $product->product_thumbnail) }}"
                                class="card-img-top" alt="..." style="height: 300px; width: 100%;">

                            <div class="card-body">
                                <form action="{{ route('update.thumbnail') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                    <div style="display: flex; justify-content: space-between">

                                        <input type="file" name="product_thumbnail" id="image" hidden />
                                        <label id="image_thumbnail_lebel" for="image"
                                            class="btn btn-primary">Change
                                            Image</label>
                                        <button id="image_thumbnail_button" type="submit" class="btn btn-info"
                                            style="display: none">Save</button>

                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('load', (event) => {
            @foreach ($multPhotos as $photo)
                document.querySelector("#multi_image_{{ $photo->id }}").addEventListener("change",
                    function() {
                        const reader = new FileReader();
                        reader.addEventListener("load", function() {
                            const uploadImage = reader.result;
                            document.querySelector("#showImage_{{ $photo->id }}").setAttribute(
                                "src",
                                uploadImage);
                            document.querySelector("#image_label_{{ $photo->id }}").style.display =
                                'none';
                            document.querySelector("#image_button_{{ $photo->id }}").style.display =
                                'block';
                        });

                        reader.readAsDataURL(this.files[0]);
                    });
            @endforeach
        });
    </script>

</x-admin.layouts.master>
