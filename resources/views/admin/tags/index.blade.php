<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Tags</h2>
    </x-slot>

    <div class="admin-card">
        <div class="admin-toolbar mb-2">
            <p class="admin-hint">Tag untuk Project & Post (juga otomatis dibuat saat input tag baru di form Project/Post).</p>
            <a href="{{ route('admin.tags.create') }}" class="button button__small">Tambah</a>
        </div>

        @if (session('status'))
            <p class="admin-alert admin-alert--success mb-2">Tersimpan.</p>
        @endif

        @if ($tags->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <span class="admin-badge {{ $tag->is_active ? 'admin-badge--success' : 'admin-badge--muted' }}">
                                        {{ $tag->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'tag-'.$tag->id"
                                        :action="route('admin.tags.destroy', $tag)"
                                        :label="$tag->name"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        @endif
    </div>
</x-app-layout>
