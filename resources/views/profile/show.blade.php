<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div className="min-w-[80%] md:min-w-[50%] mx-auto py-12">
            <x-card :user="$user" :links="$links">
            </x-card>
        </div>
    </div>
</x-guest-layout>