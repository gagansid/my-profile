<div>
    <x-input-label for="name" value="Nama" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="type" value="Tipe" />
    <select id="type" name="type" class="form-input mt-1 block w-full" required>
        <option value="project" @selected(old('type', $category->type ?? '') === 'project')>Project</option>
        <option value="post" @selected(old('type', $category->type ?? '') === 'post')>Post</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('type')" />
</div>

<div>
    <x-input-label for="description" value="Deskripsi (opsional)" />
    <textarea id="description" name="description" rows="2" class="form-input mt-1 block w-full">{{ old('description', $category->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<label class="admin-checkbox">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))>
    Aktif
</label>
