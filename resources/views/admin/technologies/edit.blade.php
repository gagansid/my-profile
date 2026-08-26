<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Technology</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.technologies.update', $technology) }}" class="admin-form">
            @csrf
            @method('PUT')
            @include('admin.technologies._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.technologies.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
