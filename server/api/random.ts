export default defineEventHandler(async (event) => {

    const query = getQuery(event)
    if (!query.key) return "Set the key value"
    if (!query.value) return "Where is the value bro?"

    await useStorage().setItem(`db:${query.key}`, query.value)
    await useStorage().setItem('db:foo', { hello: 'world' })


    return "Data Set"
})