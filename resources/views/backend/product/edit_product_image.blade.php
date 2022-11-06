<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <h5>Product Thumnail Image<span class="text-danger">*</span></h5>
            <div class="controls">
                <input id="image" type="file" name="product_thumbnail" class="form-control">
                @error('product_thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <img id="showImage" src="{{ asset('storage/' . $product->product_thumbnail) }}"
                    alt="{{ $product->product_name_en }}" class="mt-3 img-thumbnail"
                    style="width: 120px; height: 120px;" title="{{ $product->product_name_en }}">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <h5>Choose Product Imges<span class="text-danger">*</span></h5>
            <div class="controls">
                <input id="multiImage" type="file" name="product_image[]" class="form-control" multiple>
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
