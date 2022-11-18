// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: [
        '@/assets/css/style.css'
    ],
    modules: ['@nuxtjs/tailwindcss'],
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
    }

})
