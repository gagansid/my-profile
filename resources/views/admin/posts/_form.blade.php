<div>
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" :value="old('title', $post->title ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('title')" />
</div>

<div>
    <x-input-label for="category_id" value="Kategori" />
    <select id="category_id" name="category_id" class="form-input" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
</div>

<div>
    <x-input-label for="excerpt" value="Ringkasan" />
    <textarea id="excerpt" name="excerpt" rows="2" class="form-input" required>{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
</div>

<div>
    <x-input-label for="content" value="Konten (Markdown)" />
    <textarea id="content" name="content" rows="10" class="form-input" required>{{ old('content', $post->content ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('content')" />
</div>

<div>
    <x-input-label for="thumbnail" value="Thumbnail" />
    @if ($post?->thumbnail_path)
        <p class="admin-hint mb-1">Saat ini: {{ $post->thumbnail_path }}</p>
    @endif
    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="form-input">
    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
</div>

<div>
    <x-input-label for="tags" value="Tags (pisahkan dengan koma)" />
    <x-text-input id="tags" name="tags" type="text" :value="old('tags', $post?->tags?->pluck('name')->join(', ') ?? '')" placeholder="Laravel, Tutorial" />
    <x-input-error class="mt-2" :messages="$errors->get('tags')" />
</div>

<div>
    <x-input-label for="status" value="Status" />
    <select id="status" name="status" class="form-input" required>
        <option value="draft" @selected(old('status', $post->status ?? 'draft') === 'draft')>Draft</option>
        <option value="published" @selected(old('status', $post->status ?? 'draft') === 'published')>Published</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('status')" />
</div>

<div>
    <x-input-label for="published_at" value="Tanggal Publish (kosongkan = sekarang saat publish)" />
    <x-text-input id="published_at" name="published_at" type="datetime-local" :value="old('published_at', optional($post?->published_at)->format('Y-m-d\TH:i'))" />
    <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
</div>
