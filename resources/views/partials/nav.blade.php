@php
    $settings = \App\Models\SiteSetting::current();

    $navItems = [
        ['route' => 'home', 'label' => __('nav.home'), 'show' => true],
        ['route' => 'about', 'label' => __('nav.about'), 'show' => $settings->show_about],
        ['route' => 'projects.index', 'label' => __('nav.projects'), 'show' => $settings->show_projects],
        ['route' => 'blog.index', 'label' => __('nav.blog'), 'show' => $settings->show_blog],
        ['route' => 'contact.index', 'label' => __('nav.contact'), 'show' => $settings->show_contact],
    ];
@endphp

<ul class="filters__content">
    @foreach ($navItems as $item)
        @continue(! $item['show'])
        <a href="{{ route($item['route']) }}"
            class="filters__button {{ request()->routeIs($item['route']) || request()->routeIs(str($item['route'])->before('.').'.*') ? 'filter-tab-active' : '' }}">
            {{ $item['label'] }}
        </a>
    @endforeach
</ul>
