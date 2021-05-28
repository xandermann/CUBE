<template>
  <div>
    <List :elems="franchises" :modal="modaleFranchise" />
  </div>
</template>
<script>
import { AjoutFranchise } from '../../assets/models/modales/resto/Add/AjoutFranchise'
import { ListFranchises } from '../../assets/models/viewModels/list/Franchises'
export default {
  data() {
    return {
      franchises: new ListFranchises(this.$config.apiURL + '/api/restaurants'),
      modaleFranchise: new AjoutFranchise(),
    }
  },
}
</script>
