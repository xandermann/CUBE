<template>
  <div>
    <List :elems="avis" />
  </div>
</template>
<script>
import { ListAvis } from '../../../assets/models/viewModels/list/Avis'
export default {
  data() {
    return {
      avis: new ListAvis(
        this.$config.apiURL +
          '/api/restaurants/' +
          this.$route.params.id +
          '/reviews'
      ),
    }
  },
}
</script>
