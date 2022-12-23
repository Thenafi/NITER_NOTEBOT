export default defineNuxtConfig({
    routeRules: {
        "/teacher": { static: true }
    },
    nitro: {
        preset: 'firebase',
        prerender: {
            crawlLinks: false,
            routes: ['/cover', '/notes', '/teachers', '/']
        },
        storage: {
            'db': {
                driver: 'redis',
                host: process.env.REDIS_HOST,
                port: 11440,
                password: process.env.REDIS_PASSWORD
            },

        }
    },
    css: [
        '@/assets/css/style.css'
    ],
    imports: {
        dirs: ['stores'],
    },
    modules: ['@nuxtjs/tailwindcss', 'nuxt-icon', '@nuxtjs/partytown', '@vueuse/nuxt', ['@pinia/nuxt', { autoImports: ['defineStore'] }],],
    partytown: {
        /* any partytown-specific configuration */
        forward: ['dataLayer.push'],
    },
    app: {

        head: {
            title: 'NITER NOTEBOT',
            meta: [
                { charset: 'utf-8' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1' },
                {
                    name: "description", content: "NITER Notebot is a educational platform containing several academic notes, questions. It also provides some useful tools which is very handy to use."
                }
            ],
            link: [
                { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
            ],
            htmlAttrs: {
                lang: 'en'
            },
            script: [
                {
                    // src: "https://cdn.counter.dev/script.js", 'data-id': "d9bae897-f1cd-414c-84b9-e33bdc000308", "data-utcoffset": "6"
                },
                { src: 'https://www.googletagmanager.com/gtag/js?id=G-MNHSBWGL98', async: true, type: 'text/partytown' },
            ],
        }
    },
    runtimeConfig: {
        public: {
            baseURL: process.env.BASE_URL || 'http://localhost:3000'
        }
    },

})
