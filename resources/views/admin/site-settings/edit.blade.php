<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">Site Settings</h2>
    </x-slot>

    <x-admin.card :form-action="route('admin.site-settings.update')" form-method="PUT">
        @if (session('status') === 'site-settings-updated')
            <p class="admin-alert admin-alert--success">Tersimpan.</p>
        @endif

        <label class="admin-checkbox">
                <input type="checkbox" name="is_site_public" value="1" @checked(old('is_site_public', $setting->is_site_public))>
                Situs publik aktif (matikan untuk tampilkan halaman maintenance)
            </label>

            <div>
                <x-input-label for="maintenance_message" value="Pesan Maintenance (opsional)" />
                <textarea id="maintenance_message" name="maintenance_message" rows="3" class="form-input">{{ old('maintenance_message', $setting->maintenance_message) }}</textarea>
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

        <x-slot:footer>
            <x-primary-button>Simpan</x-primary-button>
        </x-slot:footer>
    </x-admin.card>
</x-app-layout>
