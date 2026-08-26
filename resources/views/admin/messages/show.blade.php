<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Detail Message</h2>
    </x-slot>

    <x-admin.card>
        <p><strong>Nama:</strong> {{ $message->fullname }}</p>
        <p><strong>Email:</strong> {{ $message->email }}</p>
        <p><strong>Tanggal:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
        <hr>
        <p style="white-space: pre-line;">{{ $message->message }}</p>

        <x-slot:footer>
            <a href="{{ route('admin.messages.index') }}" class="button button__gray button__small">Kembali</a>
            <x-admin.delete-confirm
                :id="'message-'.$message->id"
                :action="route('admin.messages.destroy', $message)"
                :label="'pesan dari '.$message->fullname"
            />
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
