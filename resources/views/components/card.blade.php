<div class="rounded-lg bg-white p-8">
    <img width="200" height="200" class="rounded-full mx-auto my-4" src="{{ isset($user->imageUrl) ? $user->imageUrl : "https://placehold.jp/ff5e00/ffffff/150x150.png" }}" />
    <h1 class="text-2xl text-slate-800 text-center">
        {{ $user->name }}
    </h1>
    <p class="text-slate-500 mb-8 text-center">
        {{ $user->intro }}
    </p>
    <div class="text-left">
        @foreach ($links as $link)
        <h2 class="text-slate-500 font-bold mb-2">
            <a href="{{ $link->url }}">{{ $link->title }}</a>
        </h2>
        @endforeach
    </div>
</div>