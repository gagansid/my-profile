<div>
    <x-input-label for="platform" value="Platform" />
    <x-text-input id="platform" name="platform" type="text" class="mt-1 block w-full" :value="old('platform', $socialLink->platform ?? '')" required placeholder="Instagram" />
    <x-input-error class="mt-2" :messages="$errors->get('platform')" />
</div>

<div>
    <x-input-label for="url" value="URL" />
    <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" :value="old('url', $socialLink->url ?? '')" required placeholder="https://instagram.com/username" />
    <x-input-error class="mt-2" :messages="$errors->get('url')" />
</div>

<div>
    <x-input-label for="icon" value="Icon (class Remixicon)" />
    <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon', $socialLink->icon ?? '')" required placeholder="ri-instagram-line" />
    <x-input-error class="mt-2" :messages="$errors->get('icon')" />
</div>

<div>
    <x-input-label for="order" value="Urutan" />
    <x-text-input id="order" name="order" type="number" min="0" class="mt-1 block w-full" :value="old('order', $socialLink->order ?? 0)" required />
    <x-input-error class="mt-2" :messages="$errors->get('order')" />
</div>

<label class="admin-checkbox">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $socialLink->is_active ?? true))>
    Aktif
</label>
