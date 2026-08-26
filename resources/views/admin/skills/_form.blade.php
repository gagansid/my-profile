<div>
    <x-input-label for="name" value="Nama" />
    <x-text-input id="name" name="name" type="text" :value="old('name', $skill->name ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="category" value="Kategori" />
    <select id="category" name="category" class="form-input" required>
        @foreach (['frontend' => 'Frontend', 'backend' => 'Backend', 'other' => 'Other'] as $value => $label)
            <option value="{{ $value }}" @selected(old('category', $skill->category ?? '') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('category')" />
</div>

<div>
    <x-input-label for="icon" value="Icon (class Remixicon)" />
    <x-text-input id="icon" name="icon" type="text" :value="old('icon', $skill->icon ?? '')" required placeholder="ri-html5-line" />
    <x-input-error class="mt-2" :messages="$errors->get('icon')" />
</div>

<div>
    <x-input-label for="order" value="Urutan" />
    <x-text-input id="order" name="order" type="number" min="0" :value="old('order', $skill->order ?? 0)" required />
    <x-input-error class="mt-2" :messages="$errors->get('order')" />
</div>
