@props(['linkto', 'text'])

<div {{ $attributes->merge(['class' => 'py-8 px-4']) }}>
    {{ $value ?? $slot }}
</div>
<button {{ $attributes->merge(['class' => 'solely-btn solely-gradient font-bold text-xl px-8 my-4']) }}>
    <a href={{$linkto}}>{{$text}}</a>
</button>