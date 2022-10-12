<x-frontend.layouts.master>
    <x-slot name='pageTitle'>User Dashboard</x-slot>
    <div class="body-content mt-3" style="min-height: 48.1vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="margin-top: 3rem">

                    <img class="card-img-top" style="border-radius: 50%; margin-bottom: 10px"
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
                            Welcome to Starby online shop
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
