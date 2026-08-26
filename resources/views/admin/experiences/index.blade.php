<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Experience</h2>
    </x-slot>

    <x-admin.card>
        <x-slot:header>
            <div class="admin-toolbar">
                <p class="admin-hint">Riwayat pekerjaan yang tampil di halaman About.</p>
                <a href="{{ route('admin.experiences.create') }}" class="button button__small">Tambah</a>
            </div>
        </x-slot:header>

        @if (session('status') === 'experience-created' || session('status') === 'experience-updated' || session('status') === 'experience-deleted')
            <p class="admin-alert admin-alert--success">Tersimpan.</p>
        @endif

        @if ($experiences->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Posisi</th>
                            <th>Periode</th>
                            <th>Urutan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experiences as $experience)
                            <tr>
                                <td>{{ $experience->company }}</td>
                                <td>{{ $experience->position }}</td>
                                <td>{{ $experience->start_date->format('M Y') }} - {{ $experience->end_date?->format('M Y') ?? 'Sekarang' }}</td>
                                <td>{{ $experience->order }}</td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'experience-'.$experience->id"
                                        :action="route('admin.experiences.destroy', $experience)"
                                        :label="$experience->company"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($experiences->isNotEmpty())
            <x-slot:footer>
                {{ $experiences->links() }}
            </x-slot:footer>
        @endif
    </x-admin.card>
</x-app-layout>
