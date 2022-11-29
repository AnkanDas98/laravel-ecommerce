<x-admin.layouts.master>
    <x-slot name='pageTitle'>Update State</x-slot>

    <div class="row">


        {{-- ---------------Edit Brand Form-------------------- --}}
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update State</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('update.state', $state->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Divisons <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="divison_id" id="selectDivison" required="" class="form-control"
                                            aria-invalid="false">
                                            <option value="">Select Divison</option>
                                            @foreach ($divisons as $divison)
                                                <option value="{{ $divison->id }}"
                                                    {{ $divison->id == $state->divison_id ? 'selected' : '' }}>
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
                                    <h5>District <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" id="selectDistrict" required=""
                                            class="form-control" aria-invalid="false" data-need='update'
                                            data-state-district-id={{ $state->district_id }}>
                                            <option value="">Select District</option>

                                            @error('district_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>State Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input value="{{ old('state_name', $state->state_name) }}" type="text"
                                            name="state_name" class="form-control"
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('state_name')
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
