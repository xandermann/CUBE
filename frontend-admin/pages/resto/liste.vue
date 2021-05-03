<template>
  <List :restos="restos" />
</template>
<script>
export default {
  data() {
    return {
      restos: [],
    }
  },
  async fetch() {
    this.restos = await fetch(
      'http://localhost:8090/api/restaurants'
    ).then((res) => res.json())
  },
}
</script>
