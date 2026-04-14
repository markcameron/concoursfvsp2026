import { PageFlip } from 'page-flip'
import * as pdfjsLib from 'pdfjs-dist'

import workerUrl from 'pdfjs-dist/build/pdf.worker.mjs?url'
pdfjsLib.GlobalWorkerOptions.workerSrc = workerUrl

async function renderPdfToImages(pdfUrl, onProgress) {
    const pdf = await pdfjsLib.getDocument(pdfUrl).promise
    const totalPages = pdf.numPages
    const images = []

    for (let i = 1; i <= totalPages; i++) {
        const page = await pdf.getPage(i)
        const viewport = page.getViewport({ scale: 1.5 })
        const canvas = document.createElement('canvas')
        canvas.width = viewport.width
        canvas.height = viewport.height
        await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise
        images.push(canvas.toDataURL())
        onProgress(i, totalPages)
    }

    return { images, width: images.length ? await getPageDimensions(pdf) : { w: 550, h: 778 } }
}

async function getPageDimensions(pdf) {
    const page = await pdf.getPage(1)
    const viewport = page.getViewport({ scale: 1.5 })
    return { w: Math.floor(viewport.width), h: Math.floor(viewport.height) }
}

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('flipbook-container')
    if (!container) return

    const pdfUrl = container.dataset.pdfUrl
    if (!pdfUrl) return

    if (/SamsungBrowser/i.test(navigator.userAgent)) {
        document.getElementById('flipbook-loading').remove()
        document.getElementById('flipbook-incompatible-msg').classList.remove('hidden')
        return
    }

    const loadingText = document.getElementById('flipbook-loading-text')
    const loadingBar = document.getElementById('flipbook-loading-bar')
    const loadingSection = document.getElementById('flipbook-loading')
    const viewerSection = document.getElementById('flipbook-viewer')
    const bookEl = document.getElementById('flipbook-book')

    renderPdfToImages(pdfUrl, (current, total) => {
        const pct = Math.round((current / total) * 100)
        if (loadingText) loadingText.textContent = `Chargement... ${pct}%`
        if (loadingBar) loadingBar.style.width = pct + '%'
    }).then(({ images, width: { w, h } }) => {
        if (loadingSection) loadingSection.remove()
        if (viewerSection) viewerSection.classList.remove('hidden')

        const containerWidth = container.offsetWidth || 1000
        const maxWidth = Math.min(containerWidth - 32, 1200)
        const scale = maxWidth / (w * 2)
        const displayW = Math.floor(w * scale)
        const displayH = Math.floor(h * scale)

        const pageFlip = new PageFlip(bookEl, {
            width: displayW,
            height: displayH,
            size: 'fixed',
            showCover: true,
            drawShadow: true,
            flippingTime: 700,
            useMouseEvents: true,
            showPageCorners: true,
            mobileScrollSupport: false,
        })

        pageFlip.loadFromImages(images)

        const pageCounter = document.getElementById('flipbook-page-counter')

        pageFlip.on('flip', (e) => {
            if (pageCounter) {
                pageCounter.textContent = `${e.data + 1} / ${pageFlip.getPageCount()}`
            }
        })

        pageFlip.on('init', () => {
            if (pageCounter) {
                pageCounter.textContent = `1 / ${pageFlip.getPageCount()}`
            }
        })

        document.getElementById('flipbook-prev').addEventListener('click', () => pageFlip.flipPrev())
        document.getElementById('flipbook-next').addEventListener('click', () => pageFlip.flipNext())
    }).catch(err => {
        console.error('Failed to load PDF:', err)
        if (loadingText) loadingText.textContent = 'Erreur lors du chargement du livret.'
        if (loadingBar) loadingBar.parentElement.remove()
    })
})
