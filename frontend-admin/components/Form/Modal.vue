<template>
  <div>
    <b-modal
      :id="modal.modalProperties.id"
      :title="modal.modalProperties.title"
      :hide-footer="hiddenActions"
      @ok="submitForm"
      @shown="modalShown"
      @close="$emit('hasBeenHidden', true)"
    >
      <b-progress
        v-if="result == 'pending'"
        variant="info"
        :animated="true"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span>Ajout en cours</span></b-progress-bar
        ></b-progress
      >
      <b-progress
        v-if="result == 'success'"
        variant="success"
        :animated="false"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span>Ajout réussi</span></b-progress-bar
        ></b-progress
      >
      <b-progress
        v-if="result == 'error'"
        :value="100"
        variant="danger"
        :animated="false"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span>Ajout échoué : {{ errorMessage }}</span></b-progress-bar
        ></b-progress
      >
      <b-form v-if="!hiddenActions">
        <div v-for="champ in modal.modalInputs" :key="champ.property">
          <div v-if="champ.type == types.PLAINTEXT">
            <FormPlainText
              v-model="form[champ.property]"
              :title="champ.title"
              :type="champ.validation"
            />
          </div>
          <div v-if="champ.type == types.DATE">
            <FormDate v-model="form[champ.property]" :title="champ.title" />
          </div>
          <div v-if="champ.type == types.CHECKBOX">
            <FormCheckbox v-model="form[champ.property]" :title="champ.title" />
          </div>
          <div v-if="champ.type == types.SELECT">
            <FormSelect
              v-model="form[champ.property]"
              :title="champ.title"
              :options="champ.listValues"
              :multiple="champ.validation"
            />
          </div>
          <div v-if="champ.type == types.ADDRESS">
            <FormLeaflet
              :title="champ.title"
              :address="{
                full_address: form.full_address,
                city: form.city,
                postal_code: form.postal_code,
                country: form.country,
              }"
              @lat="form.lat_address = $event"
              @lng="form.lng_address = $event"
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
      errorMessage: '',
      hiddenActions: false,
    }
  },
  methods: {
    // permet à leaflet de charger
    modalShown() {
      setTimeout(() => {
        window.dispatchEvent(new Event('resize'))
      }, 100)
    },
    submitForm(event) {
      event.preventDefault()
      this.postNewEntity(this.modal.modalProperties.url)
    },
    async postNewEntity(url) {
      console.log(JSON.stringify(this.form))
      this.result = 'pending'
      this.hiddenActions = true
      await this.$axios
        .$post(url, this.form)
        .then((response) => {
          this.result = 'success'
        })
        .catch((error) => {
          this.result = 'error'
          this.errorMessage = error
        })
    },
  },
}
</script>
