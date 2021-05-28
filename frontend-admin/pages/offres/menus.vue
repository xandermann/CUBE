<template>
  <List :elems="menus" :modal="modaleMenu" />
</template>
<script>
import { AjoutMenus } from '../../assets/models/modales/offres/AjoutMenus'
import { ListeMenus } from '../../assets/models/viewModels/list/Menus'
export default {
  data() {
    return {
      menus: new ListeMenus(this.$config.apiURL + '/api/menus'),
      modaleMenu: new AjoutMenus(),
    }
  },
}
</script>
