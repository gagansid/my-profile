<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Edit Project</h2>
    </x-slot>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="admin-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form')
            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.projects.index') }}" class="admin-hint">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
