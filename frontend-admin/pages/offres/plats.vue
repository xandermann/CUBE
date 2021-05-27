<template>
  <List :elems="plats" :modal="modalePlat" />
</template>
<script>
import { AjoutPlats } from '../../assets/models/modales/offres/AjoutPlats'
import { ListePlats } from '../../assets/models/viewModels/list/Plats'
export default {
  data() {
    return {
      plats: new ListePlats(this.$config.apiURL + '/api/dishes'),
      modalePlat: new AjoutPlats(),
    }
  },
}
</script>
