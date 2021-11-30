<template>
    <transition
        name="loading"
        @afterLeave="loadingDone"
    >
        <div
            v-show="loadingConfig.type === 'default' && isLoading"
            v-lock="loadingConfig.type === 'default' && isLoading"
            class="o-loading-default"
        />
    </transition>
</template>

<script>

export default {
    name: 'LoadingDefault',
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
    setup (props, context) {
        const loadingDone = () => {
        }

        return {
            loadingDone,
        }
    },
}
</script>

<style lang='scss'>
.o-loading-default {
    @include size(100%);

    position: fixed;
    top: 0;
    left: 0;
    background: map-get($admin-colors, primary);
    z-index: 999;
    cursor: wait;

    > * {
        pointer-events: none;
    }
}
</style>
