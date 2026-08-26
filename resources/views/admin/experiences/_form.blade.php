<div>
    <x-input-label for="company" value="Perusahaan" />
    <x-text-input id="company" name="company" type="text" :value="old('company', $experience->company ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('company')" />
</div>

<div>
    <x-input-label for="position" value="Posisi" />
    <x-text-input id="position" name="position" type="text" :value="old('position', $experience->position ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('position')" />
</div>

<div>
    <x-input-label for="start_date" value="Tanggal Mulai" />
    <x-text-input id="start_date" name="start_date" type="date" :value="old('start_date', optional($experience?->start_date)->format('Y-m-d'))" required />
    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
</div>

<div>
    <x-input-label for="end_date" value="Tanggal Selesai (kosongkan jika masih bekerja)" />
    <x-text-input id="end_date" name="end_date" type="date" :value="old('end_date', optional($experience?->end_date)->format('Y-m-d'))" />
    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
</div>

<div>
    <x-input-label for="description" value="Deskripsi" />
    <textarea id="description" name="description" rows="3" class="form-input">{{ old('description', $experience->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div>
    <x-input-label for="order" value="Urutan" />
    <x-text-input id="order" name="order" type="number" min="0" :value="old('order', $experience->order ?? 0)" required />
    <x-input-error class="mt-2" :messages="$errors->get('order')" />
</div>
