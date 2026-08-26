<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Education</h2>
    </x-slot>

    <x-admin.card>
        <x-slot:header>
            <div class="admin-toolbar">
                <p class="admin-hint">Riwayat pendidikan yang tampil di halaman About.</p>
                <a href="{{ route('admin.educations.create') }}" class="button button__small">Tambah</a>
            </div>
        </x-slot:header>

        @if (session('status'))
            <p class="admin-alert admin-alert--success">Tersimpan.</p>
        @endif

        @if ($educations->isEmpty())
            <p class="admin-empty">Belum ada data.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Institusi</th>
                            <th>Jenjang</th>
                            <th>Periode</th>
                            <th>Urutan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $education)
                            <tr>
                                <td>{{ $education->institution }}</td>
                                <td>{{ $education->degree }}</td>
                                <td>{{ $education->start_date->format('M Y') }} - {{ $education->end_date?->format('M Y') ?? 'Sekarang' }}</td>
                                <td>{{ $education->order }}</td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.educations.edit', $education) }}" class="button button__gray button__small">Edit</a>
                                    <x-admin.delete-confirm
                                        :id="'education-'.$education->id"
                                        :action="route('admin.educations.destroy', $education)"
                                        :label="$education->institution"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($educations->isNotEmpty())
            <x-slot:footer>
                {{ $educations->links() }}
            </x-slot:footer>
        @endif
    </x-admin.card>
</x-app-layout>
