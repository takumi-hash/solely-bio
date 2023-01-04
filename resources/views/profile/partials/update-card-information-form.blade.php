<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit My Card') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your public profile card.") }}
        </p>
    </header>

    <form id="send-verification" method="patch" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {!! Form::open(['action' => 'App\Http\Controllers\ImageController@store', 'method' => 'POST' , 'files'=>true]) !!}
        <h3 class="text-primary">Upload Image</h3><br>

        <div class="form-group">
            {!! Form::label('image', 'Uplode Picture') !!}
            <br>
            {!! Form::file('image', null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\ImageController@destroy',"delete"]]) !!}
        <div class="form-group pt-2">
            {!! Form::submit('Delete Image', ['class'=>'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-2">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>

    </form>

    <form method="post" action="{{ route('links.update') }}" class="mt-8">
        @csrf
        @method('patch')
        <div id="dynamic-table">
            <script type="module">
                const existing = '{{$links->count()}}';
                var i = existing == '0' ? 1 : existing;
                $("#add-button").click(function () {
                    ++i;
                    const forms_to_add = `
                        <div class="mt-8 space-y-2">
                            <x-input-label for="links[${i}][title]" :value="'Title ${i}'" />
                            <x-text-input id="links[${i}][title]" name="links[${i}][title]" type="text" class="mt-1 block w-full" />
                            <x-input-label for="links[${i}][url]" :value="'URL ${i}'" />
                            <x-text-input id="links[${i}][url]" name="links[${i}][url]" type="url" class="mt-1 block w-full" />
                            <x-secondary-button type="button" name="remove" class=".remove-input-field">Remove</x-secondary-button>
                        </div>`
                    ;
                    $("#dynamic-table").append(forms_to_add)
                });
                $(document).on('click', '.remove-input-field', function () {
                    $(this).parents('div').remove();
                });
            </script>
            @if($links->count() > 0)
                @foreach ($links as $link)
                <div class="mt-8 space-y-2">
                    <x-text-input id="{{'links['.$loop->index.'][id]'}}" name="{{'links['.$loop->index.'][id]'}}" type="hidden" class="" :value="$link->id" />
                    <x-input-label for="{{'links['.$loop->index.'][title]'}}" :value="'Title ' . ($loop->index)+1" />
                    <x-text-input id="{{'links['.$loop->index.'][title]'}}" name="{{'links['.$loop->index.'][title]'}}" type="text" class="mt-1 block w-full" :value="old('Title', $link->title)" />
                    <x-input-label for="{{'links['.$loop->index.'][url]'}}" :value="'URL ' . ($loop->index)+1" />
                    <x-text-input id="{{'links['.$loop->index.'][url]'}}" name="{{'links['.$loop->index.'][url]'}}" type="url" class="mt-1 block w-full" :value="old('URL', $link->url)" />
                    <x-input-error class="mt-2" :messages="$errors->get('links')" />
                    <x-secondary-button type="button" name="remove" class="remove-input-field">Remove Link</x-secondary-button>
                </div>
                @endforeach
            @else
                <!-- displays forms to input user's first url. -->
                <div class="mt-8 space-y-2">
                    <x-input-label for="links[1][title]" :value="'Title 1'" />
                    <x-text-input id="links[1][title]" name="links[1][title]" type="text" class="mt-1 block w-full" />
                    <x-input-label for="links[1][url]" :value="'URL 1'" />
                    <x-text-input id="links[1][url]" name="links[1][url]" type="url" class="mt-1 block w-full" />
                    <x-secondary-button type="button" name="remove" class="remove-input-field">Remove</x-secondary-button>
                <div>
            @endif
        </div>
        <div class="mt-8">
            <x-secondary-button type="button" name="add" id="add-button" class="">+ Add New Link</x-secondary-button>
        </div>
        <div class="mt-8 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'card-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
