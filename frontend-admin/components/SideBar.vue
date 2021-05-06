<template>
  <b-container fluid class="test">
    <b-row>
      <b-col>
        <h2>{{ pageProperties.title }}</h2>
        <ul v-for="link in links" :key="link.url">
          <li>
            <a :href="link.url">{{ link.title }}</a>
          </li>
        </ul>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {
  props: ['links', 'pageProperties'],
}
</script>
<style scoped>
.test {
  display: flex;
  flex-direction: column;
  background-color: aliceblue;
  flex-grow: 1;
}
</style>
