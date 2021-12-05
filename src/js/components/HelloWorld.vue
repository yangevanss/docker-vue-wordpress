<template>
    <div class="hello-world" />
</template>

<script>
import { inject } from '@vue/composition-api'

export default {
    name: 'HelloWorld',
    setup () {
        const viewportInfo = inject('viewportInfo')
        const addLoadingStack = inject('addLoadingStack')

        addLoadingStack(new Promise(resolve => {
            setTimeout(() => {
                console.log('%cBlock Studio', 'color: #ffffff; background-color: #40587c; padding: 5px 10px;')
                resolve()
            }, Math.random() * 1000)
        }))

        return {
            viewportInfo,
        }
    },
}
</script>

<style lang="scss">
.hello-world {
    background: url('~@/assets/img/block-map.jpg') no-repeat center / cover;

    &::before {
        content: '';
        display: block;
        padding-bottom: 56.25%;
    }
}
</style>
