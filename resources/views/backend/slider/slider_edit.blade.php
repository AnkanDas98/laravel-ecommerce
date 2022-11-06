<x-admin.layouts.master>
    <x-slot name='pageTitle'>{{ $slider->title }}</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Brand</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.slider', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <img id="showImage" class="img-thumbnail"
                                        src="{{ asset('storage/' . $slider->slider) }}" alt="{{ $slider->title }}"
                                        style="width:200px; height:200px;">
                                </div>

                                <div class="form-group">
                                    <h5>Slider Title <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('title', $slider->title) }}" type="text" name="title"
                                            class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Slider Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false" value="{{ old('description', $slider->description) }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Slider Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="image" type="file" name="slider" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('slider')
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
