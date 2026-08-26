<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Experience</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.experiences.update', $experience)" form-method="PUT">
        @include('admin.experiences._form')

        <x-slot:footer>
            <a href="{{ route('admin.experiences.index') }}" class="button button__gray button__small">Batal</a>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
