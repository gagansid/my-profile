<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Profile Info</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.profile-info.update')" form-method="PUT" form-enctype="multipart/form-data">
        @if (session('status') === 'profile-info-updated')
            <p class="admin-alert admin-alert--success">Tersimpan.</p>
        @endif

        <div>
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $profile->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="profession" value="Profesi" />
                <x-text-input id="profession" name="profession" type="text" :value="old('profession', $profile->profession)" required />
                <x-input-error class="mt-2" :messages="$errors->get('profession')" />
            </div>

            <div>
                <x-input-label for="summary" value="Ringkasan" />
                <textarea id="summary" name="summary" rows="4" class="form-input" required>{{ old('summary', $profile->summary) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('summary')" />
            </div>

            <div>
                <x-input-label for="years_experience" value="Tahun Pengalaman" />
                <x-text-input id="years_experience" name="years_experience" type="number" min="0" :value="old('years_experience', $profile->years_experience)" required />
                <x-input-error class="mt-2" :messages="$errors->get('years_experience')" />
            </div>

            <div>
                <x-input-label for="completed_projects" value="Project Selesai" />
                <x-text-input id="completed_projects" name="completed_projects" type="number" min="0" :value="old('completed_projects', $profile->completed_projects)" required />
                <x-input-error class="mt-2" :messages="$errors->get('completed_projects')" />
            </div>

            <div>
                <x-input-label for="satisfied_customers" value="Klien Puas" />
                <x-text-input id="satisfied_customers" name="satisfied_customers" type="number" min="0" :value="old('satisfied_customers', $profile->satisfied_customers)" required />
                <x-input-error class="mt-2" :messages="$errors->get('satisfied_customers')" />
            </div>

            <div>
                <x-input-label for="avatar" value="Avatar" />
                @if ($profile->avatar_path)
                    <p class="admin-hint mb-1">Saat ini: {{ $profile->avatar_path }}</p>
                @endif
                <input id="avatar" name="avatar" type="file" accept="image/*" class="form-input" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>

            <div>
                <x-input-label for="cv" value="CV (PDF)" />
                @if ($profile->cv_path)
                    <p class="admin-hint mb-1">Saat ini: {{ $profile->cv_path }}</p>
                @endif
                <input id="cv" name="cv" type="file" accept="application/pdf" class="form-input" />
                <x-input-error class="mt-2" :messages="$errors->get('cv')" />
            </div>

        <x-slot:footer>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
