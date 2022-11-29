<x-admin.layouts.master>
    <x-slot name='pageTitle'>Update Divison</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update District</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.district', $district->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Divisons <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="divison_id" id="select" required="" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Divison</option>
                                            @foreach ($divisons as $divison)
                                                <option value="{{ $divison->id }}"
                                                    {{ $divison->id == $district->divison_id ? 'selected' : '' }}>
                                                    {{ $divison->divison_name }}
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
                                    <h5>District Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('district_name', $district->district_name) }}"
                                            type="text" name="district_name" class="form-control"
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
                            <button type="submit" class="btn btn-rounded btn-info">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</x-admin.layouts.master>
