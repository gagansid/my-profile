<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Detail Message</h2>
    </x-slot>

    <div class="admin-card">
        <p><strong>Nama:</strong> {{ $message->fullname }}</p>
        <p><strong>Email:</strong> {{ $message->email }}</p>
        <p><strong>Tanggal:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
        <hr class="mt-2 mb-2">
        <p style="white-space: pre-line;">{{ $message->message }}</p>

        <div class="admin-form__actions mt-2">
            <a href="{{ route('admin.messages.index') }}" class="button button__gray button__small">Kembali</a>
            <x-admin.delete-confirm
                :id="'message-'.$message->id"
                :action="route('admin.messages.destroy', $message)"
                :label="'pesan dari '.$message->fullname"
            />
        </div>
    </div>
</x-app-layout>
