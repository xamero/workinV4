

<div {{ $attributes->merge(['class' => 'mb-2']) }}>
    {{$slot}}
    @if(isset($message))
        <span class="help-block text-danger small">{{$message}}</span>
    @endif
</div>
