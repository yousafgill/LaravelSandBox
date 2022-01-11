@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-weight-bold text-danger-600">{{ __('Validation Error.') }}</div>
        <ul class="mt-3 list-disc list-inside text-sm text-danger-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
