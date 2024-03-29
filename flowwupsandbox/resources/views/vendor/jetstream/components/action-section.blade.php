<div class="md:grid md:grid-cols-3 md:gap-6" {{ $attributes }}>
    <!-- <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title> -->

    <div class="mt-0 mb-3 md:mt-0 md:col-span-2">
        <div class="px-0 py-0 sm:p-6 bg-light shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
