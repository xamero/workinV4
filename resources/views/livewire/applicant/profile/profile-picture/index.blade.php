<div>

    @if (isset(Auth::user()->profile_photo_url))

        <img src="{{asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}"
             class="rounded-circle"
             height="125px" width="125px"/>
    @else
        <span>No profile picture</span>
    @endif

</div>
