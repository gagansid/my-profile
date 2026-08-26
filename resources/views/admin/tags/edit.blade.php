<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Tag</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.tags.update', $tag)" form-method="PUT">
        @include('admin.tags._form')

        <x-slot:footer>
            <a href="{{ route('admin.tags.index') }}" class="button button__gray button__small">Batal</a>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
