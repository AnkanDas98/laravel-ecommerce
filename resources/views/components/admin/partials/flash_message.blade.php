@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-success alert-dismissible fade"
        style="width:250px; text-align: center; font-size: 15px; position: fixed; top: 10px; right: 16px;  z-index: 1030; opacity: 0.8;"
        role="alert">

        <strong style="width: 50%">✔️ {{ session('success') }}</strong>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-danger alert-dismissible fade"
        style="width:250px; text-align: center; font-size: 15px; position: fixed; top: 10px; right: 16px; z-index: 1030; opacity: 0.8"
        role="alert">
        <strong>❌ {{ session('error') }}</strong>
    </div>
@endif

@if (session('info'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-info alert-dismissible fade"
        style="width:250px; text-align: center; font-size: 15px; position: fixed; top: 10px; right: 16px; z-index: 1030; opacity: 0.8"
        role="alert">

        <strong>ℹ️ {{ session('info') }}</strong>
    </div>
@endif
