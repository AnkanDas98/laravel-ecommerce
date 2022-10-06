@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-success font-weight-bold']) }}>
        {{ $status }}
    </div>
@endif
