<template>
  <div>
    <b-table striped hover :items="restos"></b-table>
  </div>
</template>

<script>
export default {
  props: ['restos'],
}
</script>
