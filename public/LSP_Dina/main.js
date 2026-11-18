/**
 * ============================================================================
 * PROFESSIONAL PORTFOLIO - LOGIC UTAMA
 * Penulis: Dina | Okupasi: Junior Programming | UKK Mapil
 * ----------------------------------------------------------------------------
 * Pemetaan Unit Kompetensi yang diterapkan di file ini:
 *   J.620100.004.02 - Struktur Data: Array of Objects & LocalStorage
 *   J.620100.009.01 - Menggunakan Spesifikasi Program (sesuai soal/tugas)
 *   J.620100.010.01 - Event Listener & Form Handling
 *   J.620100.016.01 - Clean Code, Indentasi Konsisten & Komentar
 *   J.620100.017.02 - Pemrograman Terstruktur: Looping & Filtering
 *   J.620100.023.02 - Membuat Dokumen Komentar Kode Program
 *   J.620100.025.02 - Debugging: Validasi Input & Penanganan Error Gambar
 *   J.620100.033.02 - Melaksanakan Pengujian Unit Program (lihat tests.html)
 * ============================================================================
 */

(function () {
    'use strict';

    /* ------------------------------------------------------------------------
     * 1. KONSTANTA & STRUKTUR DATA
     * Unit Kompetensi J.620100.004.02: Menggunakan Struktur Data
     * Data proyek direpresentasikan sebagai Array of Objects.
     * --------------------------------------------------------------------- */
    var STORAGE_KEY = 'dina_portfolio_projects_v1';
    var THEME_KEY = 'dina_portfolio_theme_v1';
    var VALID_CATEGORIES = ['Web', 'Mobile', 'IoT'];
    var FALLBACK_IMAGE = 'https://picsum.photos/seed/default/600/400';

    /**
     * Data awal (seed) berupa array of objects.
     * Dipakai saat localStorage masih kosong atau rusak.
     * @returns {Array<Object>} daftar proyek default
     */
    function getDefaultProjects() {
        return [
            {
                id: 'prj-001',
                name: 'Portfolio Pribadi Dina',
                category: 'Web',
                tech: 'HTML, CSS, JavaScript',
                image: 'https://picsum.photos/seed/dina-portfolio/600/400',
                description: 'Website portofolio responsif dengan filter proyek, dark mode, dan dashboard admin.'
            },
            {
                id: 'prj-002',
                name: 'Sistem Informasi Perpustakaan',
                category: 'Web',
                tech: 'PHP, MySQL, Bootstrap',
                image: 'https://picsum.photos/seed/perpustakaan/600/400',
                description: 'Aplikasi pengelolaan buku, anggota, dan peminjaman untuk perpustakaan sekolah.'
            },
            {
                id: 'prj-003',
                name: 'Aplikasi Catatan Harian',
                category: 'Mobile',
                tech: 'Flutter, Dart',
                image: 'https://picsum.photos/seed/catatan/600/400',
                description: 'Aplikasi pencatatan aktivitas harian dengan pengingat dan penyimpanan lokal.'
            },
            {
                id: 'prj-004',
                name: 'Monitoring Suhu Ruangan',
                category: 'IoT',
                tech: 'ESP32, Arduino, MQTT',
                image: 'https://picsum.photos/seed/iot-suhu/600/400',
                description: 'Sistem pemantauan suhu dan kelembapan ruangan secara real-time.'
            }
        ];
    }

    /* ------------------------------------------------------------------------
     * 2. PENYIMPANAN DATA (LOCALSTORAGE)
     * Unit Kompetensi J.620100.004.02 & J.620100.025.02
     * Fungsi menerima parameter storage agar dapat diuji (dependency injection).
     * --------------------------------------------------------------------- */

    /**
     * Mengambil objek storage yang aman. Jika browser melarang localStorage
     * (misal mode privat), dikembalikan storage palsu di memori.
     * @returns {Storage|Object} fasad storage
     */
    function getStorage() {
        try {
            var testKey = '__storage_test__';
            window.localStorage.setItem(testKey, '1');
            window.localStorage.removeItem(testKey);
            return window.localStorage;
        } catch (error) {
            var memory = {};
            return {
                getItem: function (key) { return Object.prototype.hasOwnProperty.call(memory, key) ? memory[key] : null; },
                setItem: function (key, value) { memory[key] = String(value); },
                removeItem: function (key) { delete memory[key]; }
            };
        }
    }

    /**
     * Memuat daftar proyek dari localStorage.
     * Jika data rusak/tidak valid, fallback ke data default (debugging).
     * @param {Storage|Object} storage - media penyimpanan (default: getStorage)
     * @returns {Array<Object>} daftar proyek
     */
    function loadProjects(storage) {
        var media = storage || getStorage();
        try {
            var raw = media.getItem(STORAGE_KEY);
            if (!raw) {
                return getDefaultProjects();
            }
            var parsed = JSON.parse(raw);
            if (!Array.isArray(parsed)) {
                return getDefaultProjects();
            }
            return parsed;
        } catch (error) {
            console.warn('Gagal membaca data proyek, menggunakan data awal.', error);
            return getDefaultProjects();
        }
    }

    /**
     * Menyimpan daftar proyek ke localStorage secara permanen.
     * @param {Array<Object>} projects - daftar proyek
     * @param {Storage|Object} storage - media penyimpanan
     * @returns {boolean} true jika berhasil disimpan
     */
    function saveProjects(projects, storage) {
        var media = storage || getStorage();
        try {
            media.setItem(STORAGE_KEY, JSON.stringify(projects));
            return true;
        } catch (error) {
            console.error('Gagal menyimpan data proyek.', error);
            return false;
        }
    }

    /* ------------------------------------------------------------------------
     * 3. LOGika MURNI (PURE FUNCTIONS) UNTUK PENGUJIAN UNIT
     * Unit Kompetensi J.620100.017.02 & J.620100.033.02
     * --------------------------------------------------------------------- */

    /**
     * Menyaring proyek berdasarkan kategori tanpa memuat ulang halaman.
     * @param {Array<Object>} projects - seluruh proyek
     * @param {string} category - 'Semua' | 'Web' | 'Mobile' | 'IoT'
     * @returns {Array<Object>} proyek yang sesuai filter
     */
    function filterProjects(projects, category) {
        if (!Array.isArray(projects)) {
            return [];
        }
        if (!category || category === 'Semua') {
            return projects.slice();
        }
        return projects.filter(function (project) {
            return project.category === category;
        });
    }

    /**
     * Membuat objek proyek baru dengan id unik.
     * @param {Object} data - data dari formulir
     * @returns {Object} objek proyek siap disimpan
     */
    function createProjectObject(data) {
        return {
            id: 'prj-' + Date.now() + '-' + Math.floor(Math.random() * 1000),
            name: String(data.name || '').trim(),
            category: String(data.category || 'Web').trim(),
            tech: String(data.tech || '').trim(),
            image: String(data.image || '').trim() || FALLBACK_IMAGE,
            description: String(data.description || '').trim()
        };
    }

    /**
     * Memvalidasi input formulir.
     * Unit Kompetensi J.620100.025.02: Penanganan Error & Validasi Input
     * @param {Object} data - data formulir
     * @returns {{valid: boolean, errors: Object<String, string>}} hasil validasi
     */
    function validateProject(data) {
        var errors = {};
        var name = String((data && data.name) || '').trim();
        var category = String((data && data.category) || '').trim();
        var tech = String((data && data.tech) || '').trim();
        var image = String((data && data.image) || '').trim();
        var description = String((data && data.description) || '').trim();

        if (name.length < 3) {
            errors.name = 'Nama proyek minimal 3 karakter.';
        }
        if (VALID_CATEGORIES.indexOf(category) === -1) {
            errors.category = 'Pilih kategori yang valid (Web/Mobile/IoT).';
        }
        if (tech.length < 3) {
            errors.tech = 'Kategori teknologi minimal 3 karakter.';
        }
        if (image !== '') {
            try {
                var url = new URL(image);
                if (url.protocol !== 'http:' && url.protocol !== 'https:') {
                    errors.image = 'URL thumbnail harus menggunakan http atau https.';
                }
            } catch (error) {
                errors.image = 'Format URL thumbnail tidak valid.';
            }
        }
        if (description.length < 10) {
            errors.description = 'Deskripsi minimal 10 karakter.';
        }

        return {
            valid: Object.keys(errors).length === 0,
            errors: errors
        };
    }

    /**
     * Fallback saat gambar gagal dimuat.
     * Unit Kompetensi J.620100.025.02: Penanganan Error Gambar
     * @param {HTMLImageElement} img - elemen gambar yang error
     */
    function handleImageError(img) {
        if (!img) {
            return;
        }
        img.onerror = null;
        img.src = FALLBACK_IMAGE;
        img.alt = 'Gambar tidak tersedia';
    }

    /* ------------------------------------------------------------------------
     * 4. RENDERING & DOM
     * Unit Kompetensi J.620100.017.02: Looping untuk membuat kartu proyek
     * --------------------------------------------------------------------- */

    /**
     * Membuat satu elemen kartu proyek.
     * @param {Object} project - data proyek
     * @returns {HTMLElement} kartu proyek
     */
    function createProjectCard(project) {
        var card = document.createElement('article');
        card.className = 'project-card';
        card.setAttribute('data-id', project.id);

        var thumb = document.createElement('img');
        thumb.className = 'project-thumb';
        thumb.src = project.image || FALLBACK_IMAGE;
        thumb.alt = 'Thumbnail ' + project.name;
        thumb.loading = 'lazy';
        thumb.addEventListener('error', function () { handleImageError(thumb); });

        var body = document.createElement('div');
        body.className = 'project-body';

        var badge = document.createElement('span');
        badge.className = 'project-category';
        badge.textContent = project.category;

        var title = document.createElement('h3');
        title.className = 'project-title';
        title.textContent = project.name;

        var tech = document.createElement('p');
        tech.className = 'project-tech';
        tech.textContent = project.tech;

        var desc = document.createElement('p');
        desc.className = 'project-desc';
        desc.textContent = project.description;

        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'delete-btn';
        deleteButton.textContent = 'Hapus Proyek';
        deleteButton.addEventListener('click', function () {
            askDeleteConfirmation(project.id, project.name);
        });

        body.appendChild(badge);
        body.appendChild(title);
        body.appendChild(tech);
        body.appendChild(desc);
        body.appendChild(deleteButton);

        card.appendChild(thumb);
        card.appendChild(body);
        return card;
    }

    /**
     * Merender seluruh kartu sesuai filter aktif.
     * @param {string} category - kategori filter aktif
     */
    function renderProjects(category) {
        var grid = document.getElementById('project-grid');
        var empty = document.getElementById('empty-state');
        if (!grid) {
            return;
        }

        var projects = loadProjects();
        var visible = filterProjects(projects, category);

        grid.innerHTML = '';
        visible.forEach(function (project) {
            grid.appendChild(createProjectCard(project));
        });

        if (empty) {
            empty.classList.toggle('hidden', visible.length > 0);
        }
    }

    /* ------------------------------------------------------------------------
     * 5. EVENT HANDLER & FORM
     * Unit Kompetensi J.620100.010.01: Event Listener & Form Handling
     * --------------------------------------------------------------------- */

    /**
     * Menangani submit formulir tambah proyek.
     * @param {Event} event - event submit
     */
    function handleFormSubmit(event) {
        event.preventDefault();

        var form = event.target;
        var data = {
            name: form.elements.name.value,
            category: form.elements.category.value,
            tech: form.elements.tech.value,
            image: form.elements.image.value,
            description: form.elements.description.value
        };

        var result = validateProject(data);
        clearErrors();

        if (!result.valid) {
            Object.keys(result.errors).forEach(function (field) {
                var element = document.getElementById('error-' + field);
                if (element) {
                    element.textContent = result.errors[field];
                }
            });
            setStatus('Periksa kembali formulir Anda.', true);
            return;
        }

        var projects = loadProjects();
        projects.unshift(createProjectObject(data));
        saveProjects(projects);
        form.reset();
        clearErrors();
        setStatus('Proyek berhasil ditambahkan dan tersimpan.');
        renderProjects(getActiveFilter());
    }

    /** Menghapus semua pesan error pada formulir. */
    function clearErrors() {
        ['name', 'tech', 'image', 'description', 'category'].forEach(function (field) {
            var element = document.getElementById('error-' + field);
            if (element) {
                element.textContent = '';
            }
        });
    }

    /**
     * Menampilkan status hasil operasi formulir.
     * @param {string} message - pesan status
     * @param {boolean} isError - true jika pesan error
     */
    function setStatus(message, isError) {
        var status = document.getElementById('form-status');
        if (!status) {
            return;
        }
        status.textContent = message;
        status.style.color = isError ? 'var(--danger)' : 'var(--accent)';
    }

    /** Mendapatkan kategori filter yang sedang aktif. */
    function getActiveFilter() {
        var active = document.querySelector('.filter-btn.active');
        return active ? active.getAttribute('data-filter') : 'Semua';
    }

    /**
     * Menangani klik tombol filter kategori.
     * @param {Event} event - event klik
     */
    function handleFilterClick(event) {
        var button = event.currentTarget;
        var buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(function (item) { item.classList.remove('active'); });
        button.classList.add('active');
        renderProjects(button.getAttribute('data-filter'));
    }

    var pendingDeleteId = null;

    /**
     * Menampilkan modal konfirmasi sebelum menghapus proyek.
     * @param {string} id - id proyek
     * @param {string} name - nama proyek
     */
    function askDeleteConfirmation(id, name) {
        pendingDeleteId = id;
        var modal = document.getElementById('confirm-modal');
        var text = document.getElementById('confirm-text');
        if (text) {
            text.textContent = 'Proyek "' + name + '" akan dihapus permanen dari daftar.';
        }
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    /** Menutup modal konfirmasi. */
    function closeConfirmModal() {
        pendingDeleteId = null;
        var modal = document.getElementById('confirm-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    /** Menghapus proyek yang dikonfirmasi dari localStorage. */
    function confirmDelete() {
        if (!pendingDeleteId) {
            closeConfirmModal();
            return;
        }
        var remaining = loadProjects().filter(function (project) {
            return project.id !== pendingDeleteId;
        });
        saveProjects(remaining);
        closeConfirmModal();
        renderProjects(getActiveFilter());
    }

    /** Menampilkan atau menyembunyikan dashboard admin. */
    function toggleAdmin(show) {
        var publicSections = document.querySelectorAll('#identity, #portfolio');
        var adminSection = document.getElementById('admin');
        publicSections.forEach(function (section) {
            section.classList.toggle('hidden', show);
        });
        if (adminSection) {
            adminSection.classList.toggle('hidden', !show);
            if (show) {
                adminSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }

    /** Mengubah tema terang/gelap dan menyimpan preferensi. */
    function toggleTheme() {
        var isDark = document.documentElement.classList.toggle('dark');
        getStorage().setItem(THEME_KEY, isDark ? 'dark' : 'light');
        updateThemeIcon(isDark);
    }

    /**
     * Mengatur ikon tombol tema.
     * @param {boolean} isDark - status tema gelap
     */
    function updateThemeIcon(isDark) {
        var button = document.getElementById('btn-theme');
        if (button) {
            button.textContent = isDark ? '☀' : '◐';
            button.setAttribute('aria-label', isDark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
        }
    }

    /** Menginisialisasi preferensi tema saat halaman dibuka. */
    function initTheme() {
        var saved = getStorage().getItem(THEME_KEY);
        var isDark = saved === 'dark';
        document.documentElement.classList.toggle('dark', isDark);
        updateThemeIcon(isDark);
    }

    /** Menampilkan/menyembunyikan menu di layar kecil. */
    function toggleMenu() {
        var menu = document.getElementById('nav-menu');
        if (menu) {
            menu.classList.toggle('open');
        }
    }

    /** Mengembalikan data proyek ke kondisi awal (reset). */
    function resetProjects() {
        var confirmed = window.confirm('Reset semua proyek ke data awal? Proyek yang ditambahkan akan hilang.');
        if (!confirmed) {
            return;
        }
        saveProjects(getDefaultProjects());
        renderProjects('Semua');
        setStatus('Data proyek berhasil dikembalikan ke awal.');
    }

    /* ------------------------------------------------------------------------
     * 6. INISIALISASI
     * --------------------------------------------------------------------- */

    /** Mendaftarkan seluruh event listener saat DOM siap. */
    function init() {
        // Hanya jalankan UI jika markup halaman utama tersedia.
        // Guard ini memungkinkan main.js dipakai ulang oleh tests.html.
        if (!document.getElementById('project-form')) {
            return;
        }
        initTheme();

        var year = document.getElementById('year');
        if (year) {
            year.textContent = new Date().getFullYear();
        }

        var form = document.getElementById('project-form');
        if (form) {
            form.addEventListener('submit', handleFormSubmit);
        }

        document.querySelectorAll('.filter-btn').forEach(function (button) {
            button.addEventListener('click', handleFilterClick);
        });

        document.getElementById('btn-admin').addEventListener('click', function () { toggleAdmin(true); });
        document.getElementById('btn-close-admin').addEventListener('click', function () { toggleAdmin(false); });
        document.getElementById('btn-theme').addEventListener('click', toggleTheme);
        document.getElementById('menu-toggle').addEventListener('click', toggleMenu);

        document.getElementById('btn-reset').addEventListener('click', resetProjects);
        document.getElementById('btn-confirm-delete').addEventListener('click', confirmDelete);
        document.getElementById('btn-cancel-delete').addEventListener('click', closeConfirmModal);

        var modal = document.getElementById('confirm-modal');
        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeConfirmModal();
                }
            });
        }

        var profile = document.querySelector('.identity-photo img');
        if (profile) {
            profile.addEventListener('error', function () { handleImageError(profile); });
        }

        renderProjects('Semua');
    }

    /* ------------------------------------------------------------------------
     * 7. EKSPOR UNTUK PENGUJIAN UNIT
     * Unit Kompetensi J.620100.033.02: Melaksanakan Pengujian Unit Program
     * Fungsi murni diekspor ke window agar dapat diuji di tests.html.
     * --------------------------------------------------------------------- */
    window.PortfolioApp = {
        STORAGE_KEY: STORAGE_KEY,
        VALID_CATEGORIES: VALID_CATEGORIES,
        getDefaultProjects: getDefaultProjects,
        loadProjects: loadProjects,
        saveProjects: saveProjects,
        filterProjects: filterProjects,
        createProjectObject: createProjectObject,
        validateProject: validateProject,
        handleImageError: handleImageError
    };

    window.handleImageError = handleImageError;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
