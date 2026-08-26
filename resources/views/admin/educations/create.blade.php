@php($education = null)
<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tambah Education</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.educations.store')">
        @include('admin.educations._form')

        <x-slot:footer>
            <a href="{{ route('admin.educations.index') }}" class="button button__gray button__small">Batal</a>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
