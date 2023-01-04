<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('My Links') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your links you want to display.") }}
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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
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
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>

    </form>

    <form method="post" action="{{ route('links.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div id="dynamic-table">
            @if($links->count() > 0)
                @foreach ($links as $link)
                <div>
                    <x-text-input id="{{'links['.$loop->index.'][id]'}}" name="{{'links['.$loop->index.'][id]'}}" type="hidden" class="mt-1 block w-full" :value="$link->id" />
                    <x-input-label for="{{'links['.$loop->index.'][title]'}}" :value="'Title ' . ($loop->index)+1" />
                    <x-text-input id="{{'links['.$loop->index.'][title]'}}" name="{{'links['.$loop->index.'][title]'}}" type="text" class="mt-1 block w-full" :value="old('Title', $link->title)" />
                    <x-input-label for="{{'links['.$loop->index.'][url]'}}" :value="'URL ' . ($loop->index)+1" />
                    <x-text-input id="{{'links['.$loop->index.'][url]'}}" name="{{'links['.$loop->index.'][url]'}}" type="url" class="mt-1 block w-full" :value="old('URL', $link->url)" />
                    <x-input-error class="mt-2" :messages="$errors->get('links')" />
                    <x-secondary-button type="button" name="remove" class=".remove-input-field">Remove</x-secondary-button>
                </div>
                @endforeach
            @else
                <!-- displays forms to input user's first url. -->
                <div>
                    <x-input-label for="{{'links[][title]'}}" :value="'Title ' . 1" />
                    <x-text-input id="{{'links[][title]'}}" name="{{'links[][title]'}}" type="text" class="mt-1 block w-full" :value="old('Title', '')" />
                    <x-input-label for="{{'links[][url]'}}" :value="'URL ' . 1" />
                    <x-text-input id="{{'links[][url]'}}" name="{{'links[][url]'}}" type="url" class="mt-1 block w-full" :value="old('URL', '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('links')" />
                    <x-secondary-button type="button" name="remove" class=".remove-input-field">Remove</x-secondary-button>
                <div>
            @endif
            <script type="module">
                const existing = '{{$links->count()}}';
                var i = 0+existing;
                $("#add-button").click(function () {
                    ++i;
                    const forms_to_add = `
                        <div>
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
        </div>
        <x-secondary-button type="button" name="add" id="add-button" class="">Add</x-secondary-button>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'card-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
