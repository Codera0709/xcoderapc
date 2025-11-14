XCODERA DASHBOARD BUILD BLUEPRINT (V2 - ENHANCED)
Project : xcodera
Framework : Laravel 12.x
Stack : Blade + TailwindCSS + Alpine.js (TALL Stack)
Mode : Coding AI / Vibe Code Automation
Output : Premium Dashboard Design System (I–XVI)

====================================================================
I. INSTALASI LARAVEL 12
--------------------------------------------------------------------
1. Jalankan:
   composer create-project laravel/laravel="^12.0" xcodera
   cd xcodera
   php artisan key:generate
2. Salin file .env.example ke .env dan ubah konfigurasi database:
   DB_CONNECTION=mysql
   DB_DATABASE=xcodera
   DB_USERNAME=root
   DB_PASSWORD=
3. Jalankan migrasi awal:
   php artisan migrate
4. Jalankan server:
   php artisan serve
5. Route /dashboard (Akan dilindungi setelah langkah I.B)

Checklist:
[ ] Laravel terpasang dan berjalan di http://localhost:8000
[ ] Database terhubung tanpa error
[ ] Key aplikasi telah digenerate

---
I.B. INSTALASI DAN KONFIGURASI AUTENTIKASI (Penyempurnaan)
--------------------------------------------------------------------
1. Instal Laravel Breeze:
   composer require laravel/breeze --dev
2. Instal Breeze menggunakan Blade:
   php artisan breeze:install blade
3. Jalankan migrasi ulang untuk tabel users:
   php artisan migrate
4. Lindungi rute utama dashboard:
   // Tambahkan middleware 'auth' pada file routes/web.php
   Route::view('/dashboard', 'pages.dashboard.index')->middleware(['auth', 'verified'])->name('dashboard');

Checklist:
[ ] Sistem autentikasi Laravel Breeze terpasang
[ ] Halaman Login/Register/Forgot Password tersedia
[ ] Rute /dashboard hanya bisa diakses setelah login

====================================================================
II. KONFIGURASI FRONTEND DAN DEPENDENSI
--------------------------------------------------------------------
1. Instal paket frontend:
   npm init -y
   npm install --save-dev vite laravel-vite-plugin tailwindcss postcss autoprefixer @tailwindcss/forms alpinejs chart.js  // Tambah chart.js
   npx tailwindcss init -p
2. Konfigurasi tailwind.config.js:
   - Tambahkan darkMode: 'class'
   - Tambahkan content: ["./resources/**/*.blade.php","./resources/**/*.js"]
   - Tambahkan plugin require('@tailwindcss/forms')
3. Tambahkan ke resources/css/app.css:
   @tailwind base;
   @tailwind components;
   @tailwind utilities;
4. Tambahkan ke resources/js/app.js:
   import 'alpinejs';
   import Chart from 'chart.js'; // Impor Chart.js
   window.Chart = Chart; // Daftarkan ke global scope jika perlu untuk Alpine
5. Perbarui vite.config.js agar memuat resources/css/app.css dan resources/js/app.js
6. Jalankan build test:
   npm install
   npm run dev

Checklist:
[ ] Tailwind berjalan
[ ] Alpine aktif
[ ] Vite auto-refresh bekerja
[ ] Chart.js terinstal via NPM

====================================================================
III. STRUKTUR FOLDER PROYEK
--------------------------------------------------------------------
Buat struktur (pastikan resources/views/components/ sudah ada):
resources/views/components/layout/
resources/views/components/ui/
resources/views/components/form/
resources/views/components/data/
resources/views/components/utils/
resources/views/components/premium/
resources/views/pages/dashboard/
resources/views/pages/users/
resources/views/pages/settings/

Checklist:
[ ] Semua folder tersedia
[ ] Struktur sesuai konvensi

====================================================================
IV. SISTEM LAYOUT DASAR
--------------------------------------------------------------------
1. Buat file:
   layout/layout.blade.php (Main structure)
   layout/navbar.blade.php
   layout/sidebar.blade.php
   layout/footer.blade.php
2. Struktur:
   - Layout utama berisi slot konten (`@yield('content')` atau `$slot`)
   - Navbar dengan search, profile, theme toggle
   - Sidebar berisi menu navigasi utama
   - Footer dinamis (versi aplikasi, hak cipta)
3. Tambahkan direktif `@vite` di layout utama

Checklist:
[ ] Layout tampil dengan struktur modular
[ ] Navbar dan sidebar berfungsi
[ ] Footer muncul

====================================================================
V. THEME SYSTEM (DARK / LIGHT)
--------------------------------------------------------------------
1. Aktifkan `darkMode: 'class'` di tailwind.config.js
2. Tambahkan Alpine toggle di Navbar atau Theme Drawer:
   `x-data="{dark: localStorage.getItem('theme') === 'dark'}" @click="dark=!dark; localStorage.setItem('theme', dark ? 'dark' : 'light')" :class="{'dark':dark}" x-init="$watch('dark', (value) => document.documentElement.classList.toggle('dark', value)); document.documentElement.classList.toggle('dark', dark)"`
3. Simpan preferensi di localStorage
4. Gunakan kelas Tailwind yang sensitif tema:
   `bg-white dark:bg-gray-800`
   `text-gray-900 dark:text-gray-100`

Checklist:
[ ] Toggle bekerja dengan halus
[ ] Warna menyesuaikan tema
[ ] Mode tersimpan setelah reload

====================================================================
VI. NAVIGATION ELEMENTS
--------------------------------------------------------------------
Buat komponen di `components/utils/`:
breadcrumbs.blade.php
searchbar.blade.php
tabs.blade.php
pagination.blade.php
dropdown.blade.php

Fungsi:
- Breadcrumb menampilkan path halaman secara dinamis
- Searchbar filter data (dengan *debounce* Alpine.js)
- Tabs navigasi antar section
- Pagination Laravel native
- Dropdown untuk aksi atau menu sekunder

Checklist:
[ ] Breadcrumb dinamis berfungsi
[ ] Searchbar responsif dengan filter dasar
[ ] Tabs berfungsi
[ ] Pagination tampil

====================================================================
VII. UI COMPONENTS (ATOMS)
--------------------------------------------------------------------
Komponen di `components/ui/`:
button, badge, card, alert, modal, tooltip, progress, toast

Langkah:
1. Buat semua komponen.
2. Beri props/slot untuk `variant`, `size`, `color`.
3. Tambahkan transisi halus dan state loading (`x-show` dengan `transition`).

Checklist:
[ ] Button multi-variant dan state loading
[ ] Badge status aktif
[ ] Alert berwarna dengan tombol tutup
[ ] Modal buka/tutup (via Alpine.js)
[ ] Toast auto-hide
[ ] Progress animasi

====================================================================
VIII. FORM COMPONENTS
--------------------------------------------------------------------
Komponen di `components/form/`:
input, select, textarea, switch, checkbox, radio, file, form-group

Langkah:
1. Buat setiap komponen.
2. Gunakan Tailwind forms.
3. Tambahkan validasi Laravel `@error` untuk menampilkan pesan kesalahan yang benar.
4. Tambahkan label, placeholder, dan helper text.
5. Gunakan `wire:model` atau *native* input.

Checklist:
[ ] Input dan textarea berfungsi
[ ] Select dan radio menampilkan data
[ ] File upload aktif
[ ] Validasi `@error` muncul dengan benar

====================================================================
IX. DATA DISPLAY COMPONENTS
--------------------------------------------------------------------
Komponen di `components/data/`:
table, stat-card, chart-card, empty-state, timeline

Langkah:
1. Table responsif dengan *sticky header* jika perlu.
2. Stat-card menampilkan data ringkas (Icon, Nilai, Persentase Perubahan).
3. **Chart-card** menggunakan Chart.js (yang telah diinstal via NPM) untuk grafik interaktif.
4. Empty-state menampilkan pesan kosong atau instruksi.
5. Timeline menampilkan aktivitas berurutan.

Checklist:
[ ] Table menampilkan data dengan *styling* yang baik
[ ] Chart berjalan menggunakan Chart.js NPM
[ ] State kosong tampil
[ ] Timeline berurutan

====================================================================
X. INTERACTIVE COMPONENTS (ALPINE.JS)
--------------------------------------------------------------------
Komponen utama untuk interaktivitas:
sidebar toggle, modal control, toast store, dark mode persistence

Langkah:
1. Gunakan Alpine `x-data` dan `$store` untuk *state global* (misalnya, untuk sidebar terbuka/tertutup).
2. Tambahkan *event dispatch* & *listen* untuk komunikasi antar komponen (misalnya, tombol di navbar memicu sidebar).
3. Simpan preferensi di `localStorage` (Dark Mode).
4. Pastikan Modal dapat ditutup via tombol **ESC** (`@keydown.escape.window="show = false"`).

Checklist:
[ ] Sidebar toggle berfungsi
[ ] Modal menutup via ESC
[ ] Toast tampil otomatis
[ ] Dark mode tersimpan

====================================================================
XI. FEEDBACK & NOTIFICATION
--------------------------------------------------------------------
Komponen:
alert, toast, spinner (di folder ui)

Langkah:
1. Alert untuk pesan statis (Error/Success) di atas form.
2. Toast untuk notifikasi sementara (misalnya, "Data berhasil disimpan!").
3. Spinner untuk *loading state* (digunakan saat permintaan AJAX).

Checklist:
[ ] Alert muncul
[ ] Toast auto-hide dan antrian notifikasi
[ ] Spinner tampil saat loading

====================================================================
XII. DASHBOARD PAGES (SCENES)
--------------------------------------------------------------------
Halaman di `resources/views/pages/`:
dashboard, users, settings, reports

Langkah:
1. **Dashboard**: Isi dengan Stat-card dan Chart (menggunakan data dummy/seeder awal).
2. **Users**: Berisi table data pengguna, form CRUD, dan *Role/Permission* dasar.
3. **Settings**: Memiliki Tabs dan Switch untuk konfigurasi.
4. **Reports**: Menampilkan grafik kompleks dan tabel data.
5. **Route**: Pastikan semua rute terlindungi oleh middleware `auth`.

Checklist:
[ ] Dashboard tampil dengan komponen
[ ] Form dan Tabel CRUD users lengkap
[ ] Settings tabs aktif
[ ] Reports memuat data

---
XII.B. STRUKTUR DATA (Penyempurnaan)
--------------------------------------------------------------------
1. Buat Model/Migration/Seeder untuk data awal dashboard (misalnya, `Stats`, `ActivityLog`).
2. Buat **Resource Controller** untuk data yang ditampilkan:
   `php artisan make:controller DashboardController --resource`
3. Gunakan Laravel **API Resources** untuk data kompleks:
   `php artisan make:resource StatCardResource`

Checklist:
[ ] Data Seeder tersedia
[ ] Controller resource terbuat
[ ] Data disajikan menggunakan API Resources (opsional, disarankan)

====================================================================
XIII. UTILITIES & PREMIUM EXPERIENCE
--------------------------------------------------------------------
Komponen di `components/utils/` dan `components/premium/`:
skeleton, tooltip, scrolltop, avatar, theme-drawer, command-palette, notification-center, chat-widget

Langkah:
1. Buat utilitas dasar (`skeleton`, `tooltip`, `scrolltop`, `avatar`).
2. Tambahkan fitur premium (`theme-drawer`, `command-palette` [Ctrl+K], `notification-center`, `chat-widget`).
3. Buat halaman 404 dan *empty page state* yang *stylish*.

Checklist:
[ ] Skeleton loader aktif
[ ] Tooltip hover
[ ] Scroll to top berfungsi
[ ] Command palette (Ctrl+K) berfungsi
[ ] Notification center muncul
[ ] Chat widget aktif
[ ] 404 dan *empty page* tersedia

====================================================================
XIV. PENGUJIAN KUALITAS (TESTING) (Penyempurnaan)
--------------------------------------------------------------------
1. Pastikan PHPUnit terinstal dan dikonfigurasi.
2. Buat *Feature Test* untuk memastikan sistem autentikasi berfungsi:
   `php artisan make:test AuthenticationTest`
3. Buat *Feature Test* untuk rute dashboard (hanya bisa diakses setelah login):
   `php artisan make:test DashboardAccessTest`
4. Buat *Feature Test* untuk fungsionalitas CRUD Users:
   `php artisan make:test UserManagementTest`

Checklist:
[ ] Testing framework (PHPUnit/Pest) siap
[ ] Feature test untuk Login sukses dibuat
[ ] Feature test untuk rute dashboard terlindungi
[ ] Feature test untuk CRUD users dibuat

====================================================================
XV. DOKUMENTASI & PEMBERSIHAN
--------------------------------------------------------------------
1. Bersihkan *code* yang tidak terpakai (komentar, file lama).
2. Dokumentasikan komponen utama (props, fungsi, contoh penggunaan).
3. Buat file `README.md` yang menjelaskan cara instalasi dan penggunaan.

Checklist:
[ ] Codebase bersih
[ ] Dokumentasi komponen dasar tersedia
[ ] README.md proyek terisi

====================================================================
XVI. DEPLOYMENT
--------------------------------------------------------------------
1. Jalankan build frontend:
   npm run build
2. Cache konfigurasi dan rute:
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
3. Jalankan migrasi di *production*:
   php artisan migrate --force
4. Instal dependensi *production only*:
   composer install --optimize-autoloader --no-dev

Checklist:
[ ] Build sukses
[ ] Aplikasi stabil
[ ] Semua fitur berfungsi di production

====================================================================
OUTPUT AKHIR
--------------------------------------------------------------------
- Laravel 12 dashboard premium
- Blade modular layout
- Tailwind + Alpine integrasi penuh (TALL Stack)
- Dark/Light theme yang persisten
- Sistem autentikasi dasar (Breeze)
- CRUD ready dengan fitur *premium* (Command Palette, Skeleton)
- Komponen reusable dan arsitektur yang kuat
- Uji coba fitur dasar disertakan
====================================================================
END OF FILE — xcoderabuild_v2.md