export default defineNuxtConfig({
    routeRules: {
        "/teacher": { static: true }
    },
    nitro: {
        preset: 'vercel',
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
    modules: ['@nuxtjs/tailwindcss', ['@pinia/nuxt', { autoImports: ['defineStore'] }],],
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
            }
        }
    },
    runtimeConfig: {
        public: {
            baseURL: process.env.BASE_URL || 'http://localhost:3000'
        }
    },

})
