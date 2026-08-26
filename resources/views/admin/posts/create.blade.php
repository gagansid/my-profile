@php($post = null)
<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tambah Post</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.posts.store') }}" class="admin-form" enctype="multipart/form-data">
            @csrf
            @include('admin.posts._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.posts.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
