<x-frontend.layouts.master>
    <x-slot name='pageTitle'>{{ $userData->name }}</x-slot>
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
                        <li style="margin-bottom: 5px"><a href="{{ route('user.profile.password.edit') }}"
                                class='btn btn-primary btn-sm btn-block'>Change
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
                        <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}
                            </strong>
                            Update your Profile
                        </h3>
                        <img id="showImage" style="width: 120px; height: 120px;"
                            src="{{ $userData->profile_image ? asset('storage/' . $userData->profile_image) : asset('storage/images/no_profile.png') }}"
                            alt="User Avatar">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.profile.update') }}"
                                style="margin-top: 15px; margin-bottom: 15px" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Name </label>
                                    <input type="text" name="name"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1"
                                        value="{{ old('name', $userData->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email Address
                                        <span>*</span></label>
                                    <input type="email" name="email"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1"
                                        value="{{ old('email', $userData->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Phone</label>
                                    <input type="tel" name="phone"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1"
                                        value="{{ old('phone', $userData->phone) }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Image
                                    </label>
                                    <input id="image" type="file" name="profile_image"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                    @error('profile_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-rounded btn-info">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
