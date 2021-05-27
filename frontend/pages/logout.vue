<template>
  <h1>TODO</h1>
</template>

<script>
export default {
  middleware: 'auth',
  mounted() {
    this.$auth.logout().catch(console.log)
  },
}
</script>
