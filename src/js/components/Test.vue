<template>
    <div class="test">
        test
    </div>
</template>

<script>
import { inject } from '@vue/composition-api'

export default {
    name: 'Test',
    setup () {
        const viewportInfo = inject('viewportInfo')
        return {
            viewportInfo,
        }
    },
    mounted () {
    },
}
</script>

<style lang="scss">
.test {
    @include size(500px);

    background-color: red;
}
</style>
