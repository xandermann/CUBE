<template>
  <b-container fluid>
    <b-row class="h-100">
      <b-col cols="2" class="pl-0 pr-0" style="z-index: 2">
        <SideBar :links="items" :page-properties="pageProps" />
      </b-col>
      <b-col cols="10" class="pl-0 pr-0" style="z-index: 1"
        ><NuxtChild
      /></b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {
  data() {
    return {
      pageProps: { title: 'Offres' },
      items: [
        { url: '/offres/ingredients', title: 'Ingrédients' },
        { url: '/offres/plats', title: 'Plats' },
        { url: '/offres/menus', title: 'Menus' },
      ],
    }
  },
}
</script>
