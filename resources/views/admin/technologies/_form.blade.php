<div>
    <x-input-label for="name" value="Nama" />
    <x-text-input id="name" name="name" type="text" :value="old('name', $technology->name ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="icon" value="Icon (class Remixicon)" />
    <x-text-input id="icon" name="icon" type="text" :value="old('icon', $technology->icon ?? '')" required placeholder="ri-laravel-line" />
    <x-input-error class="mt-2" :messages="$errors->get('icon')" />
</div>

<label class="admin-checkbox">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $technology->is_active ?? true))>
    Aktif
</label>
