/**
 * ============================================================================
 * PENGUJIAN UNIT PROGRAM - UNIT KOMPETENSI J.620100.033.02
 * ----------------------------------------------------------------------------
 * Setiap test case memverifikasi satu fungsi pada main.js.
 * Hasil ditampilkan di tests.html dan juga dicatat ke console browser.
 * ============================================================================
 */

(function () {
    'use strict';

    var app = window.PortfolioApp;
    var results = [];

    /**
     * Membuat storage palsu untuk menguji fungsi localStorage tanpa browser.
     * @returns {Object} fasad storage dengan method getItem, setItem, removeItem
     */
    function createMockStorage() {
        var data = {};
        return {
            getItem: function (key) { return Object.prototype.hasOwnProperty.call(data, key) ? data[key] : null; },
            setItem: function (key, value) { data[key] = String(value); },
            removeItem: function (key) { delete data[key]; },
            _data: data
        };
    }

    /**
     * Menjalankan satu test case dan menyimpan hasilnya.
     * @param {string} name - nama pengujian
     * @param {Function} callback - fungsi pengujian (melempar error jika gagal)
     */
    function test(name, callback) {
        try {
            callback();
            results.push({ name: name, passed: true });
        } catch (error) {
            results.push({ name: name, passed: false, message: error.message });
        }
    }

    /**
     * Assertions sederhana.
     */
    function assert(condition, message) {
        if (!condition) {
            throw new Error(message || 'Assertion failed');
        }
    }

    function assertEquals(actual, expected, message) {
        assert(actual === expected, (message || 'Nilai tidak sama') + ' (dapat: ' + actual + ', harap: ' + expected + ')');
    }

    /* ---------- Test sekumpulan fungsi ---------- */

    test('Data awal berupa array of objects yang lengkap', function () {
        var projects = app.getDefaultProjects();
        assert(Array.isArray(projects), 'Data awal harus berupa array');
        assert(projects.length >= 3, 'Minimal 3 proyek awal');
        projects.forEach(function (project) {
            assert(project.id && project.name && project.category, 'Field wajib proyek tidak lengkap');
            assert(project.image && project.description, 'Thumbnail dan deskripsi wajib ada');
        });
    });

    test('Filter "Semua" mengembalikan seluruh proyek', function () {
        var projects = app.getDefaultProjects();
        assertEquals(app.filterProjects(projects, 'Semua').length, projects.length);
    });

    test('Filter Web hanya mengembalikan kategori Web', function () {
        var result = app.filterProjects(app.getDefaultProjects(), 'Web');
        assert(result.length > 0, 'Harus ada proyek Web');
        result.forEach(function (project) {
            assertEquals(project.category, 'Web');
        });
    });

    test('Filter Mobile dan IoT bekerja sesuai kategori', function () {
        ['Mobile', 'IoT'].forEach(function (category) {
            var result = app.filterProjects(app.getDefaultProjects(), category);
            assert(result.length > 0, 'Harus ada proyek ' + category);
            result.forEach(function (project) {
                assertEquals(project.category, category);
            });
        });
    });

    test('Filter menolak input bukan array', function () {
        assertEquals(app.filterProjects(null, 'Web').length, 0);
    });

    test('Validasi menolak formulir kosong', function () {
        var result = app.validateProject({ name: '', category: '', tech: '', image: '', description: '' });
        assertEquals(result.valid, false);
        assert(result.errors.name && result.errors.category && result.errors.tech && result.errors.description);
    });

    test('Validasi menerima data yang benar', function () {
        var result = app.validateProject({
            name: 'Website Sekolah',
            category: 'Web',
            tech: 'HTML, CSS, JS',
            image: 'https://picsum.photos/seed/sekolah/600/400',
            description: 'Website profil sekolah lengkap dengan galeri.'
        });
        assertEquals(result.valid, true, 'Data valid harus diterima');
    });

    test('Validasi menolak URL gambar tidak valid', function () {
        var result = app.validateProject({
            name: 'Proyek Valid',
            category: 'Web',
            tech: 'HTML CSS',
            image: 'bukan-url',
            description: 'Deskripsi yang cukup panjang.'
        });
        assertEquals(result.valid, false);
        assert(result.errors.image, 'Error URL harus muncul');
    });

    test('createProjectObject membuat id unik dan merapikan data', function () {
        var project = app.createProjectObject({
            name: '  Aplikasi Ujian  ',
            category: 'Mobile',
            tech: ' Flutter ',
            image: '',
            description: '  Aplikasi ujian online.  '
        });
        assert(project.id.indexOf('prj-') === 0, 'Id harus diawali prj-');
        assertEquals(project.name, 'Aplikasi Ujian');
        assertEquals(project.category, 'Mobile');
        assert(project.image.length > 0, 'Thumbnail fallback harus diisi');
    });

    test('LocalStorage: data kosong memakai data awal', function () {
        var storage = createMockStorage();
        assertEquals(app.loadProjects(storage).length, app.getDefaultProjects().length);
    });

    test('LocalStorage: data tersimpan dan terbaca kembali', function () {
        var storage = createMockStorage();
        var projects = [{ id: 'x1', name: 'Proyek Uji', category: 'IoT', tech: 'ESP32', image: 'https://picsum.photos/1', description: 'Deskripsi uji' }];
        assertEquals(app.saveProjects(projects, storage), true);
        assertEquals(app.loadProjects(storage)[0].name, 'Proyek Uji');
    });

    test('LocalStorage: data rusak ditangani dengan fallback', function () {
        var storage = createMockStorage();
        storage.setItem(app.STORAGE_KEY, '{ rusak');
        assertEquals(app.loadProjects(storage).length, app.getDefaultProjects().length);
    });

    test('Penanganan error gambar mengganti thumbnail', function () {
        var img = { src: 'gambar-rusak.jpg', onerror: function () {}, alt: '' };
        app.handleImageError(img);
        assert(img.src.indexOf('picsum.photos') !== -1, 'Harus memakai gambar fallback');
        assertEquals(img.onerror, null, 'Handler error harus dinonaktifkan');
        assertEquals(img.alt, 'Gambar tidak tersedia');
    });

    /* ---------- Tampilkan hasil ---------- */

    function renderResults() {
        var list = document.getElementById('test-list');
        var summary = document.getElementById('summary');
        if (!list || !summary) {
            return;
        }

        list.innerHTML = '';
        results.forEach(function (result) {
            var item = document.createElement('li');
            item.className = result.passed ? 'pass' : 'fail';
            item.textContent = (result.passed ? '✓ LULUS  ' : '✗ GAGAL  ') + result.name +
                (result.message ? ' — ' + result.message : '');
            list.appendChild(item);
        });

        var passed = results.filter(function (result) { return result.passed; }).length;
        summary.className = 'summary ' + (passed === results.length ? 'pass' : 'fail');
        summary.textContent = 'Hasil: ' + passed + ' / ' + results.length + ' pengujian lulus.';
        console.log('Unit test selesai:', passed + '/' + results.length, results);
    }

    renderResults();
})();
