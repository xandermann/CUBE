<template>
  <b-container fluid>
    <b-row>
      <b-col cols="2" class="pl-0 pr-0">
        <SideBar :links="items" :page-properties="pageProps" />
      </b-col>
      <b-col cols="10" class="pl-0 pr-0"><NuxtChild /></b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {
  data() {
    return {
      pageProps: { title: 'Commercial' },
      items: [{ url: '/commercial/avis', title: 'Avis' }],
    }
  },
}
</script>
