// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: [
        '@/assets/css/style.css'
    ],
    imports: {
        dirs: ['stores'],
    },
    modules: ['@nuxtjs/tailwindcss', 'nuxt-headlessui', ['@pinia/nuxt', { autoImports: ['defineStore'] }],],
    app: {

        head: {
            title: 'NITER NOTEBOT',
            meta: [
                { charset: 'utf-8' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            ],
            link: [
                { rel: 'icon', type: 'image/x-icon', href: 'public/favicon.ico' }
            ]
        }
    },
    runtimeConfig: {
        public: {
            baseURL: process.env.BASE_URL || 'http://localhost:3000'
        }
    },

})
