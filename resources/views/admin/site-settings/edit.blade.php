<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Site Settings</h2>
    </x-slot>

    <div class="admin-card">
        @if (session('status') === 'site-settings-updated')
            <p class="admin-alert admin-alert--success mb-2">Tersimpan.</p>
        @endif

        <form method="POST" action="{{ route('admin.site-settings.update') }}" class="admin-form">
            @csrf
            @method('PUT')

            <label class="admin-checkbox">
                <input type="checkbox" name="is_site_public" value="1" @checked(old('is_site_public', $setting->is_site_public))>
                Situs publik aktif (matikan untuk tampilkan halaman maintenance)
            </label>

            <div>
                <x-input-label for="maintenance_message" value="Pesan Maintenance (opsional)" />
                <textarea id="maintenance_message" name="maintenance_message" rows="3" class="form-input mt-1 block w-full">{{ old('maintenance_message', $setting->maintenance_message) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('maintenance_message')" />
            </div>

            <div class="admin-checkbox-group">
                <label class="admin-checkbox">
                    <input type="checkbox" name="show_about" value="1" @checked(old('show_about', $setting->show_about))>
                    Tampilkan About
                </label>
                <label class="admin-checkbox">
                    <input type="checkbox" name="show_projects" value="1" @checked(old('show_projects', $setting->show_projects))>
                    Tampilkan Projects
                </label>
                <label class="admin-checkbox">
                    <input type="checkbox" name="show_blog" value="1" @checked(old('show_blog', $setting->show_blog))>
                    Tampilkan Blog
                </label>
                <label class="admin-checkbox">
                    <input type="checkbox" name="show_contact" value="1" @checked(old('show_contact', $setting->show_contact))>
                    Tampilkan Contact
                </label>
            </div>

            <div class="admin-form__actions">
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
