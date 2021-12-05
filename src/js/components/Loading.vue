<template>
    <transition
        name="loading"
        @afterLeave="loadingDone"
    >
        <div
            v-show="isLoading"
            v-lock="isLoading"
            class="o-loading"
        />
    </transition>
</template>

<script>

export default {
    name: 'Loading',
    props: {
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
.o-loading {
    @include size(100%);

    position: fixed;
    top: 0;
    left: 0;
    background: map-get($admin-colors, primary);
    z-index: 99;

    > * {
        pointer-events: none;
    }
}
</style>
