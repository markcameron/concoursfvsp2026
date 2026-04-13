import { init as flipbookInit } from 'flipbook-viewer'
import * as pdfjsLib from 'pdfjs-dist'

import workerUrl from 'pdfjs-dist/build/pdf.worker.mjs?url'
pdfjsLib.GlobalWorkerOptions.workerSrc = workerUrl

function createPdfBook(pdfUrl, callback) {
    const cache = {}

    pdfjsLib.getDocument(pdfUrl).promise
        .then(pdf => {
            callback(null, {
                numPages: () => pdf.numPages,
                getPage: (n, cb) => renderPage(pdf, n, cb),
            })
        })
        .catch(err => callback(err || 'PDF loading failed'))

    function renderPage(pdf, n, cb) {
        if (!n) return cb(null, null) // page 0 = blank (pdfjs is 1-indexed)
        if (cache[n]) return cb(null, cache[n])

        pdf.getPage(n)
            .then(page => {
                const scale = 2
                const viewport = page.getViewport({ scale })
                const canvas = document.createElement('canvas')
                canvas.width = viewport.width
                canvas.height = viewport.height

                page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise
                    .then(() => {
                        cache[n] = { img: canvas, num: n, width: canvas.width, height: canvas.height }
                        cb(null, cache[n])
                    })
                    .catch(cb)
            })
            .catch(cb)
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('flipbook-container')
    if (!container) return

    const pdfUrl = container.dataset.pdfUrl
    if (!pdfUrl) return

    const loading = document.getElementById('flipbook-loading')
    const viewer = document.getElementById('flipbook-viewer')

    createPdfBook(pdfUrl, (err, book) => {
        if (err) {
            console.error('Failed to load PDF:', err)
            if (loading) loading.textContent = 'Erreur lors du chargement du livret.'
            return
        }

        if (loading) loading.remove()
        if (viewer) viewer.classList.remove('hidden')

        const app = document.getElementById('flipbook-app')
        const containerWidth = container.offsetWidth || 1000
        const width = Math.min(containerWidth - 32, 1200)
        const opts = {
            width,
            height: Math.round(width * 0.65),
            backgroundColor: '#1a1a2e',
        }

        flipbookInit(book, app, opts, (err, fbViewer) => {
            if (err) {
                console.error('Failed to initialize flipbook:', err)
                return
            }

            document.getElementById('flipbook-prev').addEventListener('click', () => fbViewer.flip_back())
            document.getElementById('flipbook-next').addEventListener('click', () => fbViewer.flip_forward())
            document.getElementById('flipbook-zoom').addEventListener('click', () => fbViewer.zoom())
        })
    })
})
