<template>
  <div>
    <b-modal
      :id="modal.modalProperties.id"
      :title="modal.modalProperties.title"
      @ok="submitForm"
      :hide-footer="hiddenActions"
    >
      <b-alert v-if="result" show>{{ result }}</b-alert>
      <b-form v-if="!hiddenActions">
        <div v-for="champ in modal.modalInputs" :key="champ.property">
          <div v-if="champ.type == types.PLAINTEXT">
            <FormPlainText
              :title="champ.title"
              v-model="form[champ.property]"
            />
          </div>
          <div v-if="champ.type == types.DATE">
            <FormDate :title="champ.title" v-model="form[champ.property]" />
          </div>
          <div v-if="champ.type == types.CHECKBOX">
            <FormCheckbox :title="champ.title" v-model="form[champ.property]" />
          </div>
          <div v-if="champ.type == types.SELECT">
            <FormSelect
              :title="champ.title"
              :options="champ.listValues"
              v-model="form[champ.property]"
            />
          </div>
        </div>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import { ModalPropertiesTypes } from '../../assets/models/modales/ModalForm'
export default {
  props: { modal: Object },
  data() {
    return {
      form: {},
      types: new ModalPropertiesTypes(),
      result: '',
      hiddenActions: false,
    }
  },
  methods: {
    submitForm(event) {
      event.preventDefault()
      this.postNewEntity(this.modal.modalProperties.url)
    },
    async postNewEntity(url) {
      console.log(JSON.stringify(this.form))
      this.result = 'Ajout en cours'
      this.hiddenActions = true
      await this.$axios
        .$post(url, this.form)
        .then((response) => {
          this.result = "L'élément a été ajouté avec succès"
        })
        .catch((error) => {
          this.result = error
        })
    },
  },
}
</script>
