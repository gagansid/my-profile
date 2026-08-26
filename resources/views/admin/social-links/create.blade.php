@php($socialLink = null)
<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tambah Social Link</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.social-links.store')">
        @include('admin.social-links._form')

        <x-slot:footer>
            <a href="{{ route('admin.social-links.index') }}" class="button button__gray button__small">Batal</a>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
