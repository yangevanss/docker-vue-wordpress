<template>
    <div class="test">
        test
    </div>
</template>

<script>
export default {
    name: 'Test',
    mounted () {
        console.log('mounted')
    },
}
</script>

<style lang="scss">
.test {
    @include size(500px);

    background-color: red;
}
</style>
