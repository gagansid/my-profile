@php($skill = null)
<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tambah Skill</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.skills.store') }}" class="admin-form">
            @csrf
            @include('admin.skills._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.skills.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
