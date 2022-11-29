<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Districts</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">District List</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Districts</li>
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
                    <h3 class="box-title">Districts List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Divison Name</th>
                                    <th>District Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($districts as $district)
                                    <tr>
                                        <td>{{ $district['divison']['divison_name'] }}</td>
                                        <td>{{ $district->district_name }}</td>
                                        <td>
                                            <a href="{{ route('edit.district', $district->id) }}"
                                                class="btn btn-info mr-2" title="Edit Data"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('delete.district', $district->id) }}"
                                                method="POST" class="d-inline-block">
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
                                    <th>Divison Name</th>
                                    <th>District Name</th>
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
                    <h3 class="box-title">Add District</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('store.district') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Divisons <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="divison_id" id="select" required="" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Divison</option>
                                            @foreach ($divisons as $divison)
                                                <option value="{{ $divison->id }}">{{ $divison->divison_name }}
                                                </option>
                                            @endforeach
                                            @error('divison_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>District Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('district_name') }}" type="text" name="district_name"
                                            class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('district_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>



                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Add</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
