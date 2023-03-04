<script setup>

defineProps({
  name: {
    type: String,
    required: true,
  },
});

</script>

<template>
  <svg
    aria-hidden="true"
    class="icon"
  >
    <use :href="`#${name}`" />
  </svg>
</template>

<style lang="scss">
.icon {
  @include size(1em);

  fill: currentcolor;
}
</style>
