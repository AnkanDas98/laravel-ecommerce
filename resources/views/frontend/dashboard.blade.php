<x-frontend.layouts.master>
    <x-slot name='pageTitle'>User Dashboard</x-slot>
    <div class="body-content mt-3" style="min-height: 48.1vh;">
        <div class="container">
            <div class="row">
                <x-frontend.partials.user_sidebar />
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
