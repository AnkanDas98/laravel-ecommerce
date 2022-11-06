<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Sliders</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Slider List</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Slider</li>
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
                    <h3 class="box-title">Slider List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Slider</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>

                                        <td><img src="{{ asset('storage/' . $slider->slider) }}"
                                                alt="{{ $slider->title }}" width="70px" height="40px"></td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>{{ $slider->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('edit.slider', $slider->id) }}" class="btn btn-info mr-2"
                                                title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('delete.slider', $slider->id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger deleteBtn"
                                                    title="Delete Data"><i class="fa fa-trash"></i></button>
                                            </form>

                                            <form action="{{ route('update.slider.status') }}" method="POST"
                                                class="d-inline-block mr-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                                <button type="submit"
                                                    class="btn {{ $slider->status ? 'btn-danger' : 'btn-success' }}"
                                                    title="{{ $slider->status ? 'Inactive Now' : 'Actice Now' }}"><i
                                                        class="fa {{ $slider->status ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Slider</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
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
                    <h3 class="box-title">Add Slider</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Slider Title <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('title') }}" type="text" name="title"
                                            class="form-control"
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
                                        <input type="text" name="description" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false" value="{{ old('description') }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Slider Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('slider')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>



                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Add Slider</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
