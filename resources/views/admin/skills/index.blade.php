<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Skills</h2>
    </x-slot>

    <div class="admin-card">
        <div class="admin-toolbar mb-2">
            <p class="admin-hint">Daftar keahlian yang tampil di halaman About.</p>
            <a href="{{ route('admin.skills.create') }}" class="button button__small">Tambah</a>
        </div>

        @if (session('status'))
            <p class="admin-alert admin-alert--success mb-2">Tersimpan.</p>
        @endif

        @if ($skills->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Icon</th>
                            <th>Urutan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <td>{{ $skill->name }}</td>
                                <td>{{ ucfirst($skill->category) }}</td>
                                <td>{{ $skill->icon }}</td>
                                <td>{{ $skill->order }}</td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'skill-'.$skill->id"
                                        :action="route('admin.skills.destroy', $skill)"
                                        :label="$skill->name"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $skills->links() }}
        @endif
    </div>
</x-app-layout>
