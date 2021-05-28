<template>
  <List :elems="commentaires" :modal="modaleComm" />
</template>
<script>
import { AjoutCommentaires } from '../../assets/models/modales/commercial/AjoutCommentaire'
export default {
  data() {
    return {
      commentaires: [],
      modaleComm: new AjoutCommentaires(),
    }
  },
  async fetch() {
    this.commentaires = await fetch(
      process.env.API_URL + '/api/ingredients'
    ).then((res) => res.json())
  },
}
</script>
