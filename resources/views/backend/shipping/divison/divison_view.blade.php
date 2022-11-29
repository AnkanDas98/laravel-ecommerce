<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Divisons</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Divison List</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Tables</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
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
                    <h3 class="box-title">Divison List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Divison Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisons as $divison)
                                    <tr>
                                        <td>{{ $divison->divison_name }}</td>
                                        <td>
                                            <a href="{{ route('edit.divison', $divison->id) }}"
                                                class="btn btn-info mr-2" title="Edit Data"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('delete.divison', $divison->id) }}"
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
                    <h3 class="box-title">Add Divison</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('store.divison') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Divison Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('divison_name') }}" type="text" name="divison_name"
                                            class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('divison_name')
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
