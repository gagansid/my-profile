"# gans-portofolio"

## Versions
- v1.0.0 (`release/v1.0.0`, branch `feature/my-profile`) — static PHP/HTML/SCSS portfolio
- v2.0.0 (`release/v2.0.0`, branch `feature/my-profile-laravel`) — Laravel + MySQL rewrite: multi-page (Home/About/Projects/Blog/Contact) + admin panel

## Deployment ke cPanel dari GitHub

Repository ini sudah disiapkan untuk pola deploy **push ke GitHub lalu trigger deploy ke cPanel**.

### File yang dipakai
- `/home/runner/work/my-profile/my-profile/.cpanel.yml` menjalankan langkah deploy di server cPanel
- `/home/runner/work/my-profile/my-profile/public/index.cpanel.php` menjadi `public_html/index.php` untuk entrypoint Laravel di hosting
- `/home/runner/work/my-profile/my-profile/.github/workflows/deploy-cpanel.yml` memanggil deployment hook cPanel setiap ada push ke branch produksi

### 1. Tentukan branch produksi
Pilih satu branch khusus deploy, misalnya:
- `production` (default yang dipakai workflow ini), atau
- `main`

Kalau ingin memakai branch selain default workflow:
1. buka **GitHub Repository Settings → Secrets and variables → Actions → Variables**
2. buat variable `CPANEL_DEPLOY_BRANCH`
3. isi dengan nama branch deploy, misalnya `main` atau `production`

### 2. Hubungkan repo GitHub ke cPanel
Di cPanel:
1. buka **Git Version Control**
2. clone repository `gagansid/my-profile`
3. arahkan ke branch deploy yang dipakai
4. pastikan working copy server berada di path aplikasi yang sesuai dengan `.cpanel.yml`

Path production yang dipakai saat ini:
- app path: `/home/gagc8689/repositories/my-profile-app/`
- document root: `/home/gagc8689/public_html/`

Kalau username/path hosting berubah, update **dua file ini sekaligus**:
- `/home/runner/work/my-profile/my-profile/.cpanel.yml`
- `/home/runner/work/my-profile/my-profile/public/index.cpanel.php`

### 3. Siapkan deployment hook
Di halaman repository Git cPanel, copy **Deployment URL / hook URL** lalu simpan ke GitHub:
1. buka **GitHub Repository Settings → Secrets and variables → Actions → Secrets**
2. buat secret `CPANEL_DEPLOY_HOOK_URL`
3. isi dengan deployment hook URL dari cPanel

Workflow GitHub akan melakukan `POST` ke hook itu setiap ada push ke branch deploy.

### 4. Siapkan environment Laravel di hosting
Pastikan file `.env` production di server sudah benar, minimal:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL` mengarah ke domain production
- kredensial database production
- mailer production
- permission untuk `storage` dan `bootstrap/cache`

Setelah `.env` siap, `.cpanel.yml` akan menjalankan:
- `composer install --no-dev`
- `npm ci && npm run build`
- `php artisan migrate --force`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan storage:link`

### 5. Alur deploy
1. push perubahan ke branch deploy
2. GitHub Actions menjalankan workflow deploy
3. workflow memanggil deployment hook cPanel
4. cPanel menjalankan `.cpanel.yml`
5. Laravel app dan asset terbaru dipublish ke hosting

### 6. Verifikasi
Setelah push:
1. cek tab **Actions** di GitHub untuk memastikan workflow sukses
2. cek log deployment di cPanel
3. buka website production
4. pastikan perubahan tampil dan tidak ada error 500
