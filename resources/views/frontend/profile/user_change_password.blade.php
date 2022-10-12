@php
$userData = App\Models\User::find(auth()->user()->id);
@endphp

<x-frontend.layouts.master>
    <x-slot name='pageTitle'>Change Password</x-slot>
    <div class="body-content mt-3" style="min-height: 48.1vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="margin-top: 6rem">

                    <img class="card-img-top" style="border-radius: 50%; margin-bottom: 10px; object-fit: cover"
                        src="{{ !empty($userData->profile_image) ? url('storage/' . $userData->profile_image) : url('storage/images/no_profile.png') }}"
                        alt="" height="100%" width="100%">
                    <ul class="list-group list-group-flash">
                        <li style="margin-bottom: 5px"><a href="{{ route('dashboard') }}"
                                class='btn btn-primary btn-sm btn-block'>Home</a></li>
                        <li style="margin-bottom: 5px"><a href="{{ route('user.profile') }}"
                                class='btn btn-primary btn-sm btn-block'>Profile Update</a></li>
                        <li style="margin-bottom: 5px"><a href="" class='btn btn-primary btn-sm btn-block'>Change
                                Password</a></li>
                        <li style="margin-bottom: 5px">
                            <form class="w-100 d-inline-block" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class='btn btn-danger btn-sm btn-block'>Logout</button>
                        </li>
                        </form>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ $userData->name }}
                            </strong>
                            Update your Password
                        </h3>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.profile.password.update') }}"
                                style="margin-top: 15px; margin-bottom: 15px">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <h5>Old Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="old_password" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>New Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="new_password" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Confirm Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="confirm_password" class="form-control"
                                            required="" data-validation-required-message="This field is required"
                                            aria-invalid="false">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-rounded btn-info">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
