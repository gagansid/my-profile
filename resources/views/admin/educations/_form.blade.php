<div>
    <x-input-label for="institution" value="Institusi" />
    <x-text-input id="institution" name="institution" type="text" :value="old('institution', $education->institution ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('institution')" />
</div>

<div>
    <x-input-label for="degree" value="Jenjang / Gelar" />
    <x-text-input id="degree" name="degree" type="text" :value="old('degree', $education->degree ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('degree')" />
</div>

<div>
    <x-input-label for="score" value="Nilai (opsional)" />
    <x-text-input id="score" name="score" type="text" :value="old('score', $education->score ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('score')" />
</div>

<div>
    <x-input-label for="start_date" value="Tanggal Mulai" />
    <x-text-input id="start_date" name="start_date" type="date" :value="old('start_date', optional($education?->start_date)->format('Y-m-d'))" required />
    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
</div>

<div>
    <x-input-label for="end_date" value="Tanggal Selesai" />
    <x-text-input id="end_date" name="end_date" type="date" :value="old('end_date', optional($education?->end_date)->format('Y-m-d'))" />
    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
</div>

<div>
    <x-input-label for="order" value="Urutan" />
    <x-text-input id="order" name="order" type="number" min="0" :value="old('order', $education->order ?? 0)" required />
    <x-input-error class="mt-2" :messages="$errors->get('order')" />
</div>
