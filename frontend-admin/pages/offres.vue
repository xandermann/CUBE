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
