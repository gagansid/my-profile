<div>
    <x-input-label for="name" value="Nama" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $tag->name ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<label class="admin-checkbox">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $tag->is_active ?? true))>
    Aktif
</label>
