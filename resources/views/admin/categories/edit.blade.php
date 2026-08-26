<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Category</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="admin-form">
            @csrf
            @method('PUT')
            @include('admin.categories._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.categories.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
