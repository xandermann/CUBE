<template>
  <b-container fluid class="p-0">
    <span v-if="$fetchState.pending" class="loading"></span>
    <b-alert v-else-if="$fetchState.error" show variant="danger"
      >Une erreur s'est produite, merci de contacter votre
      administrateur</b-alert
    >
    <div class="d-flex pl-1 align-items-center justify-content-between">
      <span>{{ elems.title }}</span>
      <b-button class="m-2" v-b-modal="modal.modalProperties.id"
        >Ajouter</b-button
      >
    </div>
    <div
      v-if="elems.liste != null"
      class="d-flex flex-column align-items-center"
    >
      <b-table
        striped
        hover
        :fields="fields"
        :items="elems.liste.data"
        responsive="sm"
        @row-clicked="navigateToItem"
      >
        <template #cell(index)="data">
          <b-button variant="primary" :id="data.item.id">Modifier</b-button>
          <b-button
            variant="danger"
            :id="data.item.id"
            v-b-modal="'Delete' + data.item.id"
            >Supprimer</b-button
          >
          <FormModalDelete :id="data.item.id" :titreModale="data.item.nom" />
        </template>
      </b-table>
      <b-pagination
        @change="handlePageChange"
        :total-rows="elems.liste.totalRows"
        :per-page="elems.liste.perPage"
      ></b-pagination>
    </div>
    <div
      v-if="elems == null || elems.liste == null"
      class="d-flex flex-column align-items-center justify-content-center"
    >
      <h4>Aucune donnée n'est disponible</h4>
    </div>

    <FormModal :modal="modal" />
  </b-container>
</template>

<script>
export default {
  props: {
    elems: Object,
    modal: Object,
  },
  data() {
    return {
      page: 1,
      fields: this.elems.length > 0 ? this.elems.champs.concat(['index']) : [],
    }
  },
  methods: {
    navigateToItem(item) {
      window.location.href = item.id
    },
    handlePageChange(value) {
      this.page = value
      this.$fetch()
    },
  },
  async fetch() {
    this.restos = await fetch(this.elems.urlFetch + '?page=' + this.page)
      .then((res) => res.json())
      .then((rest) => this.elems.setList(rest))
  },
}
</script>
