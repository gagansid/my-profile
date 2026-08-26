<div>
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" :value="old('title', $project->title ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('title')" />
</div>

<div>
    <x-input-label for="category_id" value="Kategori" />
    <select id="category_id" name="category_id" class="form-input" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id ?? '') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
</div>

<div>
    <x-input-label for="description" value="Deskripsi" />
    <textarea id="description" name="description" rows="4" class="form-input" required>{{ old('description', $project->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div>
    <x-input-label for="demo_url" value="Demo URL (opsional)" />
    <x-text-input id="demo_url" name="demo_url" type="url" :value="old('demo_url', $project->demo_url ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('demo_url')" />
</div>

<div>
    <x-input-label for="repo_url" value="Repo URL (opsional)" />
    <x-text-input id="repo_url" name="repo_url" type="url" :value="old('repo_url', $project->repo_url ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('repo_url')" />
</div>

<div>
    <x-input-label for="thumbnail" value="Thumbnail" />
    @if ($project?->thumbnail_path)
        <p class="admin-hint mb-1">Saat ini: {{ $project->thumbnail_path }}</p>
    @endif
    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="form-input">
    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
</div>

<div>
    <x-input-label value="Technology" />
    @php($selectedTechnologies = old('technologies', $project?->technologies?->pluck('id')->all() ?? []))
    <div class="admin-checkbox-group">
        @foreach ($technologies as $technology)
            <label class="admin-checkbox">
                <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" @checked(in_array($technology->id, $selectedTechnologies))>
                {{ $technology->name }}
            </label>
        @endforeach
    </div>
    <x-input-error class="mt-2" :messages="$errors->get('technologies')" />
</div>

<div>
    <x-input-label for="tags" value="Tags (pisahkan dengan koma)" />
    <x-text-input id="tags" name="tags" type="text" :value="old('tags', $project?->tags?->pluck('name')->join(', ') ?? '')" placeholder="Laravel, MySQL, PHP" />
    <x-input-error class="mt-2" :messages="$errors->get('tags')" />
</div>

<div>
    <x-input-label for="order" value="Urutan" />
    <x-text-input id="order" name="order" type="number" min="0" :value="old('order', $project->order ?? 0)" required />
    <x-input-error class="mt-2" :messages="$errors->get('order')" />
</div>

<div>
    <x-input-label for="status" value="Status" />
    <select id="status" name="status" class="form-input" required>
        <option value="draft" @selected(old('status', $project->status ?? 'draft') === 'draft')>Draft</option>
        <option value="published" @selected(old('status', $project->status ?? 'draft') === 'published')>Published</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('status')" />
</div>
