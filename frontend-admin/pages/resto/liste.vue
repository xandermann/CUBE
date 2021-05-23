<template>
  <div>
    <List :elems="restos" :modal="modaleResto" />
  </div>
</template>
<script>
import { AjoutResto } from '../../assets/models/modales/resto/AjoutResto'
import { ListRestaurant } from '../../assets/models/viewModels/list/Restaurant'
export default {
  data() {
    return {
      restos: new ListRestaurant(this.$config.apiURL + '/api/restaurants'),
      modaleResto: new AjoutResto(),
    }
  },
}
</script>
