<template>
  <div>
    <b-modal
      :id="'Put' + objectId"
      :title="objectToModify.modalProperties.title"
      :hide-footer="hiddenActions"
      @ok="submitForm"
      @close="$emit('hasBeenHidden', true)"
    >
      <b-progress
        v-if="result == 'pending'"
        variant="info"
        :animated="true"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span>Modification en cours</span></b-progress-bar
        ></b-progress
      >
      <b-progress
        v-if="result == 'success'"
        variant="success"
        :animated="false"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span>Modification réussie</span></b-progress-bar
        ></b-progress
      >
      <b-progress
        v-if="result == 'error'"
        :value="100"
        variant="danger"
        :animated="false"
        class="mt-3"
        ><b-progress-bar :value="100"
          ><span
            >Modification échouée : {{ errorMessage }}</span
          ></b-progress-bar
        ></b-progress
      >
      <b-form v-if="!hiddenActions">
        <div v-for="champ in objectToModify.modalInputs" :key="champ.property">
          <div v-if="champ.type == types.PLAINTEXT">
            <FormPlainText
              v-model="form[champ.property]"
              :title="champ.title"
              :type="champ.validation"
              :form-value="champ.defaultValue"
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
              :form-value="champ.defaultValue"
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
  props: { objectId: Number, objectToModify: Object },
  data() {
    return {
      form: {},
      types: new ModalPropertiesTypes(),
      result: '',
      errorMessage: '',
      hiddenActions: false,
    }
  },
  mounted() {
    this.objectToModify.modalInputs.forEach((champ) => {
      this.form[champ.property] = champ.defaultValue
    })
  },
  methods: {
    // initEntity() {
    //   const valeurs = this.$props.objectToModify
    //   for (const property in valeurs) {
    //     this.form[property] = valeurs[property]
    //   }
    // },
    submitForm(event) {
      event.preventDefault()

      this.putEntity(this.objectToModify.modalProperties.url)
    },
    async putEntity(url) {
      this.result = 'pending'
      this.hiddenActions = true
      alert(url)
      await this.$axios
        .$put(url, this.form)
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
