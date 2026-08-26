<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Project</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.projects.update', $project)" form-method="PUT" form-enctype="multipart/form-data">
        @include('admin.projects._form')

        <x-slot:footer>
            <a href="{{ route('admin.projects.index') }}" class="button button__gray button__small">Batal</a>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
