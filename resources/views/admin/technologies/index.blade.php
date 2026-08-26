<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Technologies</h2>
    </x-slot>

    <div class="admin-card">
        <div class="admin-toolbar mb-2">
            <p class="admin-hint">Tech stack yang bisa dipilih di form Project.</p>
            <a href="{{ route('admin.technologies.create') }}" class="button button__small">Tambah</a>
        </div>

        @if (session('status'))
            <p class="admin-alert admin-alert--success mb-2">Tersimpan.</p>
        @endif

        @if ($technologies->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <td>{{ $technology->name }}</td>
                                <td>{{ $technology->icon }}</td>
                                <td>
                                    <span class="admin-badge {{ $technology->is_active ? 'admin-badge--success' : 'admin-badge--muted' }}">
                                        {{ $technology->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'technology-'.$technology->id"
                                        :action="route('admin.technologies.destroy', $technology)"
                                        :label="$technology->name"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $technologies->links() }}
        @endif
    </div>
</x-app-layout>
