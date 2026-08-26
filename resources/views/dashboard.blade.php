<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="admin-card">
        {{ __("You're logged in!") }}
    </div>
</x-app-layout>
