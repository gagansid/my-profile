<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Categories</h2>
    </x-slot>

    <div class="admin-card">
        <div class="admin-toolbar mb-2">
            <p class="admin-hint">Kategori untuk Project & Post.</p>
            <a href="{{ route('admin.categories.create') }}" class="button button__small">Tambah</a>
        </div>

        @if (session('status'))
            <p class="admin-alert admin-alert--success mb-2">Tersimpan.</p>
        @endif

        @if ($categories->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ ucfirst($category->type) }}</td>
                                <td>
                                    <span class="admin-badge {{ $category->is_active ? 'admin-badge--success' : 'admin-badge--muted' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'category-'.$category->id"
                                        :action="route('admin.categories.destroy', $category)"
                                        :label="$category->name"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        @endif
    </div>
</x-app-layout>
