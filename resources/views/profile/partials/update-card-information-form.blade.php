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

    <form method="post" action="{{ route('links.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            @if($links->count() > 0)
                @foreach ($links as $link)
                    <x-text-input id="{{'links[' . $link->id .'][id]'}}" name="{{'links[' . $link->id .'][id]'}}" type="hidden" class="mt-1 block w-full" :value="$link->id" />
                    <x-input-label for="{{'links[' . $link->id .'][title]'}}" :value="'Title ' . ($loop->index)+1" />
                    <x-text-input id="{{'links[' . $link->id .'][title]'}}" name="{{'links[' . $link->id .'][title]'}}" type="text" class="mt-1 block w-full" :value="old('Title', $link->title)" />
                    <x-input-label for="{{'links[' . $link->id .'][url]'}}" :value="'URL ' . ($loop->index)+1" />
                    <x-text-input id="{{'links[' . $link->id .'][url]'}}" name="{{'links[' . $link->id .'][url]'}}" type="url" class="mt-1 block w-full" :value="old('URL', $link->url)" />
                    <x-input-error class="mt-2" :messages="$errors->get('links')" />
                @endforeach
            @else
            <!--  TODO: implement add form button -->
                <x-input-label for="{{'links[' . $link->id .'][title]'}}" :value="'Title ' . ($loop->index)+1" />
                <x-text-input id="{{'links[' . $link->id .'][title]'}}" name="{{'links[' . $link->id .'][title]'}}" type="text" class="mt-1 block w-full" :value="old('Title', $link->title)" />
            @endif
        </div>

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
