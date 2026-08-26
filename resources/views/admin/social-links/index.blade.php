<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Social Links</h2>
    </x-slot>

    <x-admin.card>
        <x-slot:header>
            <div class="admin-toolbar">
                <p class="admin-hint">Link sosial media & kontak yang tampil di halaman publik.</p>
                <a href="{{ route('admin.social-links.create') }}" class="button button__small">Tambah</a>
            </div>
        </x-slot:header>

        @if (session('status'))
            <p class="admin-alert admin-alert--success">Tersimpan.</p>
        @endif

        @if ($socialLinks->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Platform</th>
                            <th>URL</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socialLinks as $socialLink)
                            <tr>
                                <td>{{ $socialLink->platform }}</td>
                                <td>{{ $socialLink->url }}</td>
                                <td>{{ $socialLink->order }}</td>
                                <td>
                                    <span class="admin-badge {{ $socialLink->is_active ? 'admin-badge--success' : 'admin-badge--muted' }}">
                                        {{ $socialLink->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.social-links.edit', $socialLink) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'social-link-'.$socialLink->id"
                                        :action="route('admin.social-links.destroy', $socialLink)"
                                        :label="$socialLink->platform"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($socialLinks->isNotEmpty())
            <x-slot:footer>
                {{ $socialLinks->links() }}
            </x-slot:footer>
        @endif
    </x-admin.card>
</x-app-layout>
    </div>
</x-app-layout>
