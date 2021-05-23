<template>
  <List :elems="plats" :modal="modalePlat" />
</template>
<script>
import { AjoutPlats } from '../../assets/models/modales/offres/AjoutPlats'
import { ListIngredients } from '../../assets/models/viewModels/list/Ingredients'
export default {
  data() {
    return {
      plats: new ListIngredients(this.$config.apiURL + '/api/dishes'),
      modalePlat: new AjoutPlats(),
    }
  },
}
</script>
