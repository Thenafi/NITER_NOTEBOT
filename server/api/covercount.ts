export default defineEventHandler(async (event) => {
    const count = await useStorage().getItem('db:cover-count')
    const query = getQuery(event)
    if (query?.type === 'increment') {
        await useStorage().setItem('db:cover-count', count + 1)
    }
    return count
})
