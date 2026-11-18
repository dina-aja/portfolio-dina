// ============================================================================
// Salin hasil build Vite ke path STABIL (tanpa hash).
//
// Tujuan: halaman tidak bergantung pada manifest Vite di server. File
// public/css/app.css dan public/js/app.js ikut ter-commit, jadi tampilan tetap
// benar walaupun proses build di Railway gagal atau tidak berjalan.
// ============================================================================
import fs from 'node:fs'
import path from 'node:path'

const root = process.cwd()
const manifestPath = path.join(root, 'public/build/manifest.json')

if (! fs.existsSync(manifestPath)) {
    console.error('manifest.json tidak ditemukan. Jalankan `vite build` terlebih dahulu.')
    process.exit(1)
}

const manifest = JSON.parse(fs.readFileSync(manifestPath, 'utf8'))

function copyEntry(entry, target) {
    const item = manifest[entry]

    if (! item?.file) {
        console.error(`Entri "${entry}" tidak ditemukan di manifest.json`)
        process.exit(1)
    }

    const source = path.join(root, 'public/build', item.file)
    const destination = path.join(root, target)

    fs.mkdirSync(path.dirname(destination), { recursive: true })
    fs.copyFileSync(source, destination)

    console.log(`${item.file}  ->  ${target}`)
}

copyEntry('resources/css/app.css', 'public/css/app.css')
copyEntry('resources/js/app.js', 'public/js/app.js')
