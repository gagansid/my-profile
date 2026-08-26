<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Messages</h2>
    </x-slot>

    <div class="admin-card">
        <p class="admin-hint mb-2">Pesan yang masuk dari form contact publik.</p>

        @if (session('status') === 'message-deleted')
            <p class="admin-alert admin-alert--success mb-2">Pesan dihapus.</p>
        @endif

        @if ($messages->isEmpty())
            <p class="admin-empty">Belum ada pesan.</p>
        @else
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->fullname }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <span class="admin-badge {{ $message->is_read ? 'admin-badge--muted' : 'admin-badge--success' }}">
                                        {{ $message->is_read ? 'Sudah dibaca' : 'Baru' }}
                                    </span>
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="button button__gray button__small">Lihat</a>
                                    <x-admin.delete-confirm
                                        :id="'message-'.$message->id"
                                        :action="route('admin.messages.destroy', $message)"
                                        :label="'pesan dari '.$message->fullname"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $messages->links() }}
        @endif
    </div>
</x-app-layout>
