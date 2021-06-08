<template>
  <List :elems="ingredients" :modal="modaleIngred" />
</template>
<script>
import { AjoutIngredients } from '../../assets/models/modales/offres/AjoutIngredients'
import { ListIngredients } from '../../assets/models/viewModels/list/Ingredients'
export default {
  data() {
    return {
      ingredients: new ListIngredients(
        this.$config.apiURL + '/api/ingredients'
      ),
      modaleIngred: new AjoutIngredients(),
    }
  },
}
</script>
