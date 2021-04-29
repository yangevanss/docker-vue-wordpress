const uniqueID = (() => {
    const generate = function * () {
        let increment = 0
        while (true) {
            yield increment
            increment++
        }
    }
    const increment = generate()
    return () => increment.next().value
})()

const bindingEl = (el) => {
    const ID = uniqueID()

    let bindEvents = el.dataset.blurs
    if (bindEvents) {
        bindEvents += `, ${ID}`
        return
    }
    el.setAttribute('data-blurs', ID)

    return ID
}

const clickOutSide = (el, callback, e) => {
    const path = e.path || e.composedPath?.()
    const isInside = ~path.indexOf(el)
    if (!isInside) {
        callback(isInside)
    }
}

const eventsHandler = {}

export default function (Vue, options) {
    Vue.directive('blur', {
        bind (el, { value }) {
            const event = clickOutSide.bind(this, el, value)
            document.body.addEventListener('click', event)
            eventsHandler[bindingEl(el)] = event
        },
        update () {

        },
        unbind (el) {
            const bindEvents = el.dataset.blurs.split(', ')
            bindEvents.forEach((ID) => {
                const event = eventsHandler[ID]
                document.body.removeEventListener('click', event)
                delete eventsHandler[ID]
            })
        },
    })
}
