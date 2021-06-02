<template>
  <b-container fluid class="p-0">
    <span v-if="$fetchState.pending" class="loading"></span>
    <b-alert v-else-if="$fetchState.error" show variant="danger"
      >Une erreur s'est produite, merci de contacter votre
      administrateur</b-alert
    >
    <div class="d-flex pl-1 align-items-center justify-content-between">
      <span>{{ elems.title }}</span>
      <b-button v-b-modal="modal.modalProperties.id" class="m-2"
        ><span class="fa fa-plus"></span
      ></b-button>
    </div>
    <div
      v-if="elems.liste != null"
      class="d-flex flex-column align-items-center ListTable"
    >
      <b-table
        striped
        hover
        :fields="fields"
        :items="elems.liste.data"
        responsive="sm"
        class="w-100"
        @row-clicked="navigateToItem"
      >
        <template #cell(modify)="data">
          <b-button v-b-modal="'Put' + data.item.id" variant="primary"
            ><span class="fa fa-pen"
          /></b-button>
          <FormModalPut
            :object-id="data.item.id"
            :object-to-modify="data.item.putModal"
          />
        </template>
        <template #cell(delete)="data">
          <b-button
            :id="data.item.id"
            v-b-modal="'Delete' + data.item.id"
            variant="danger"
            ><span class="fa fa-trash"
          /></b-button>
          <FormModalDelete
            :id="data.item.id"
            :titre-modale="data.item.nom"
            :url="elems.urlFetch + '/' + data.item.id"
          />
        </template>
      </b-table>
      <b-pagination
        :total-rows="elems.liste.totalRows"
        :per-page="elems.liste.perPage"
        @change="handlePageChange"
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
      fields: [],
    }
  },
  async fetch() {
    await fetch(this.elems.urlFetch + '?page=' + this.page)
      .then((res) => res.json())
      .then(
        (rest) => this.elems.setList(rest),
        (this.fields = this.elems.champs)
      )
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
}
</script>
<style scoped>
.ListTable {
  background-color: white !important;
  border-radius: 5px;
}
</style>
