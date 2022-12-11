export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.hook('page:finish', () => {
        if (document.activeElement instanceof HTMLElement) {
            document.activeElement.blur();
        }
    })
})
