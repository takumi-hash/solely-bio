@props(['linkto', 'text'])

<button {{ $attributes->merge(['class' => 'solely-btn solely-gradient font-bold text-xl px-8 my-4']) }}>
    <a href={{$linkto}}>{{ $slot }}</a>
</button>