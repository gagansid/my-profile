@php($education = null)
<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tambah Education</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.educations.store') }}" class="admin-form">
            @csrf
            @include('admin.educations._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.educations.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
