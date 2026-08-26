<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">
            Profile
        </h2>
    </x-slot>

    <div class="admin-card">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="admin-card">
        @include('profile.partials.update-password-form')
    </div>

    <div class="admin-card">
        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
