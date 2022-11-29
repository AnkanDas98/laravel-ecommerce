<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>All Coupons</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Coupon List</h3>
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
                    <h3 class="box-title">Coupon List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Coupon Name English</th>
                                    <th>Coupon Discount</th>
                                    <th>Validity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_discount }}</td>
                                        <td>{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}
                                        </td>
                                        <td>
                                            @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge badge-pill badge-success">Valid</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Invalid</span>
                                                <span class="text-info">(Change
                                                    Status or delate)</span>
                                            @endif
                                        </td>

                                        <td width="25%">
                                            <a href="{{ route('edit.coupon', $coupon->id) }}" class="btn btn-info mr-2"
                                                title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('delete.coupon', $coupon->id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger deleteBtn"
                                                    title="Delete Data"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <form action="{{ route('update.coupon.status') }}" method="POST"
                                                class="d-inline-block mr-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">
                                                <button type="submit"
                                                    class="btn {{ $coupon->status ? 'btn-danger' : 'btn-success' }}"
                                                    title="{{ $coupon->status ? 'Inactive Now' : 'Actice Now' }}"><i
                                                        class="fa {{ $coupon->status ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Coupon Name English</th>
                                    <th>Coupon Discount</th>
                                    <th>Validity</th>
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
                    <h3 class="box-title">Add Coupon</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('store.coupon') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Coupon Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('coupon_name') }}" type="text" name="coupon_name"
                                            class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="coupon_discount" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false" value="{{ old('coupon_discount') }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Coupon Validity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false" value="{{ old('coupon_validity') }}"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('coupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>



                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">Add Coupon</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
