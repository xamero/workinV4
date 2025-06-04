@props(['label' => null, 'message' => null])

<div {{ $attributes->merge(['class' => 'mb-3 row']) }}>
    {{$label}}
    <div class="col-sm-8">
        {{$slot}}
        @if(isset($message))
            <span class="help-block text-danger small">{{$message}}</span>
        @endif
    </div>
</div>
