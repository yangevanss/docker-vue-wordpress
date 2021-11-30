<template>
    <transition
        name="loading"
        @afterLeave="loadingDone"
    >
        <div
            v-show="loadingConfig.type === 'ajax' && isLoading"
            v-lock="loadingConfig.type === 'ajax' && isLoading"
            class="o-loading-ajax"
        />
    </transition>
</template>

<script>
import { inject } from '@vue/composition-api'

export default {
    name: 'LoadingAjax',
    props: {
        loadingConfig: {
            type: Object,
            required: true,
        },
        isLoading: {
            type: Boolean,
            required: true,
        },
    },
    setup (props, { emit }) {
        const changeLoadingType = inject('changeLoadingType')

        const loadingDone = () => {
            changeLoadingType('LOADING_TYPE_DEFAULT')
        }

        return {
            loadingDone,
        }
    },
}
</script>

<style lang='scss'>
.o-loading-ajax {
    @include size(100%);

    position: fixed;
    top: 0;
    left: 0;
    background: map-get($colors, white);
    z-index: 999;
    cursor: wait;

    > * {
        pointer-events: none;
    }
}
</style>
