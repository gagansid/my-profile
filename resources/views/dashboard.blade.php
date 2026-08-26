<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-heading" style="margin-bottom: 0;">
            Dashboard
        </h2>
    </x-slot>

    <div class="admin-grid">
        <a href="{{ route('admin.profile-info.edit') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Profile Info</div>
            <div class="admin-grid-card__desc">Bio, statistik, avatar & CV</div>
        </a>
        <a href="{{ route('admin.experiences.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Experience</div>
            <div class="admin-grid-card__desc">Riwayat pekerjaan</div>
        </a>
        <a href="{{ route('admin.educations.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Education</div>
            <div class="admin-grid-card__desc">Riwayat pendidikan</div>
        </a>
        <a href="{{ route('admin.skills.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Skills</div>
            <div class="admin-grid-card__desc">Daftar keahlian</div>
        </a>
        <a href="{{ route('admin.technologies.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Technologies</div>
            <div class="admin-grid-card__desc">Tech stack untuk project</div>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Categories</div>
            <div class="admin-grid-card__desc">Kategori project & post</div>
        </a>
        <a href="{{ route('admin.tags.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Tags</div>
            <div class="admin-grid-card__desc">Tag project & post</div>
        </a>
        <a href="{{ route('admin.projects.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Projects</div>
            <div class="admin-grid-card__desc">Portofolio project</div>
        </a>
        <a href="{{ route('admin.posts.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Posts</div>
            <div class="admin-grid-card__desc">Artikel blog</div>
        </a>
        <a href="{{ route('admin.social-links.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Social Links</div>
            <div class="admin-grid-card__desc">Instagram, GitHub, dsb</div>
        </a>
        <a href="{{ route('admin.site-settings.edit') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Site Settings</div>
            <div class="admin-grid-card__desc">Visibilitas situs & maintenance</div>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="admin-grid-card">
            <div class="admin-grid-card__title">Messages</div>
            <div class="admin-grid-card__desc">Pesan dari form contact</div>
        </a>
    </div>
</x-app-layout>
