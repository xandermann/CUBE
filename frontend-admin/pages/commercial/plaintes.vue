<template>
  <div>
    <List :elems="plaintes" />
  </div>
</template>
<script>
import { ListePlaintes } from '../../assets/models/viewModels/list/Plaintes'
export default {
  data() {
    return {
      plaintes: new ListePlaintes(this.$config.apiURL + '/api/complaints'),
    }
  },
}
</script>
