@if (Auth::user()->hasRole('applicant'))
    <x-app-layout>
        <x-slot name="header">
            {{ __('Account Settings') }}
        </x-slot>

        <div class="container py-5">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')

                <x-section-border/>
            @endif

            {{--        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
            {{--            @livewire('profile.two-factor-authentication-form')--}}

            {{--            <x-section-border/>--}}
            {{--        @endif--}}

            @livewire('profile.logout-other-browser-sessions-form')

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border/>

                @livewire('profile.delete-user-form')
            @endif
        </div>
    </x-app-layout>

@else
    <x-portal-layout>
        <x-slot name="header">
            {{ __('Account Settings') }}
        </x-slot>

        <div class="container py-5">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')

                <x-section-border/>
            @endif

            {{--        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
            {{--            @livewire('profile.two-factor-authentication-form')--}}

            {{--            <x-section-border/>--}}
            {{--        @endif--}}

            @livewire('profile.logout-other-browser-sessions-form')

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border/>

                @livewire('profile.delete-user-form')
            @endif
        </div>
    </x-portal-layout>
@endif
