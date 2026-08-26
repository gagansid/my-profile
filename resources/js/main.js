import ScrollReveal from 'scrollreveal'

/*=============== DARK LIGHT THEME ===============*/
// themeButton only exists on the public site layout, not the admin layout
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'ri-sun-line'

if (themeButton) {
    // Previously selected topic (if user selected)
    const selectedTheme = localStorage.getItem('selected-theme')
    const selectedIcon = localStorage.getItem('selected-icon')

    // We obtain the current theme that the interface has by validating the dark-theme class
    const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
    const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-line' : 'ri-sun-line'

    // We validate if the user previously chose a topic
    if (selectedTheme) {
        // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
        document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
        themeButton.classList[selectedIcon === 'ri-moon-line' ? 'add' : 'remove'](iconTheme)
    }

    // Activate / deactivate the theme manually with the button
    themeButton.addEventListener('click', () => {
        // Add or remove the dark / icon theme
        document.body.classList.toggle(darkTheme)
        themeButton.classList.toggle(iconTheme)
        // We save the theme and the current icon that the user chose
        localStorage.setItem('selected-theme', getCurrentTheme())
        localStorage.setItem('selected-icon', getCurrentIcon())
    })
}

/*=============== SCROLL REVEAL ANIMATION ===============*/
// ScrollReveal/profile/filters markup only exists on the public site layout
if (document.querySelector('.profile')) {
    const sr = ScrollReveal({
        origin: 'top',
        distance: '60px',
        duration: 2500,
        delay: 400,
    })

    sr.reveal(`.profile__border`)
    sr.reveal(`.profile__name`, { delay: 500 })
    sr.reveal(`.profile__profession`, { delay: 600 })
    sr.reveal(`.profile__social`, { delay: 700 })
    sr.reveal(`.profile__info-group`, { interval: 100, delay: 700 })
    sr.reveal(`.profile__buttons`, { delay: 800 })
    sr.reveal(`.filters__content`, { delay: 900 })
    sr.reveal(`.filters`, { delay: 1000 })
}

/*=============== IMAGE SKELETON LOADING ===============*/
const revealSkeletonImages = (root = document) => {
    root.querySelectorAll('.skeleton-wrapper img').forEach((img) => {
        const wrapper = img.closest('.skeleton-wrapper')

        const reveal = () => wrapper.classList.remove('is-loading')

        if (img.complete && img.naturalWidth > 0) {
            reveal()
        } else {
            img.addEventListener('load', reveal)
            img.addEventListener('error', reveal)
        }
    })
}

revealSkeletonImages()

/*=============== AJAX FILTER / PAGINATION (no full page reload) ===============*/
document.querySelectorAll('[data-ajax-region]').forEach((region) => {
    const regionName = region.dataset.ajaxRegion

    const loadRegion = async (url, pushState = true) => {
        region.classList.add('is-ajax-loading')

        try {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            if (!response.ok) throw new Error('Request failed')

            const html = await response.text()
            const next = new DOMParser().parseFromString(html, 'text/html')
                .querySelector(`[data-ajax-region="${regionName}"]`)

            if (!next) {
                window.location.href = url
                return
            }

            region.innerHTML = next.innerHTML
            document.title = new DOMParser().parseFromString(html, 'text/html').title
            revealSkeletonImages(region)

            if (pushState) {
                history.pushState({ ajaxRegion: regionName }, '', url)
            }

            region.scrollIntoView({ behavior: 'smooth', block: 'start' })
        } catch (error) {
            window.location.href = url
        } finally {
            region.classList.remove('is-ajax-loading')
        }
    }

    region.addEventListener('click', (event) => {
        const link = event.target.closest('a')

        if (!link || !link.getAttribute('href') || link.target === '_blank' || link.hasAttribute('download')) return
        if (event.metaKey || event.ctrlKey || event.shiftKey) return

        event.preventDefault()
        loadRegion(link.href)
    })

    window.addEventListener('popstate', () => loadRegion(window.location.href, false))
})
