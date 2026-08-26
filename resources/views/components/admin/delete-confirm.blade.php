@props(['id', 'action', 'label' => 'data ini'])

<span x-data x-on:click="$dispatch('open-modal', 'delete-{{ $id }}')">
    <button type="button" class="button button__danger button__small">Hapus</button>
</span>

<x-modal :name="'delete-'.$id" focusable>
    <div class="admin-form">
        <h2 class="admin-card__title">Hapus {{ $label }}?</h2>
        <p class="admin-hint">Tindakan ini tidak bisa dibatalkan.</p>

        <form method="POST" action="{{ $action }}">
            @csrf
            @method('DELETE')
            <div class="admin-form__actions">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <button type="submit" class="button button__danger button__small">Ya, Hapus</button>
            </div>
        </form>
    </div>
</x-modal>
