export default defineEventHandler(async (event) => {
    const query = getQuery(event)
    if (!query.key) return "Set the key value"
    const data = await useStorage().getItem(`db:${query.key}`)
    const data2 = await useStorage().getItem('db:foo')
    console.log(typeof data2)
    return data2
})
