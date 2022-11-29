<x-admin.layouts.master>
    <x-slot name='pageTitle'>Update Coupon</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Coupon</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.coupon', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Coupon Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('coupon_name', $coupon->coupon_name) }}" type="text"
                                            name="coupon_name" class="form-control"
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
                                            aria-invalid="false"
                                            value="{{ old('coupon_discount', $coupon->coupon_discount) }}">
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
                                            aria-invalid="false"
                                            value="{{ old('coupon_validity', $coupon->coupon_validity) }}"
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
                            <button type="submit" class="btn btn-rounded btn-info">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
