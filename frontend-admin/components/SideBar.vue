<template>
  <b-container fluid class="SideBar bgPrimaryDark">
    <b-row>
      <b-col id="sideMenu" class="d-none d-md-block">
        <div class="d-flex align-items-center justify-content-center">
          <h2>{{ pageProperties.title }}</h2>
        </div>
        <ul v-for="link in links" :key="link.url">
          <li>
            <b-link :to="link.url">{{ link.title }}</b-link>
          </li>
        </ul>
      </b-col>
      <b-col class="d-block d-md-none text-center" @click="expandSideBar()">
        <span id="expandArrow" class="fa fa-angle-right mt-3"></span>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {
  props: {
    links: Array,
    pageProperties: Object,
  },
  methods: {
    expandSideBar() {
      const sideMenu = document.getElementById('sideMenu')
      const sideBar = document.getElementsByClassName('SideBar')[0]
      const arrow = document.getElementById('expandArrow')
      if (sideMenu.classList.contains('d-none')) {
        arrow.classList.add('rotated')
        sideMenu.classList.remove('d-none')
        sideBar.classList.add('expanded')
      } else {
        arrow.classList.remove('rotated')
        sideMenu.classList.add('d-none')
        sideBar.classList.remove('expanded')
      }
    },
  },
}
</script>
<style scoped>
.SideBar {
  transition: 0.5s all ease;
}
.rotated {
  transform: rotate(-180deg);
}
.expanded {
  width: 100vw;
}
</style>
