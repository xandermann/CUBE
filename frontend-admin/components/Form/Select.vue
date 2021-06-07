<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-select
      v-if="Array.isArray(selectOptions)"
      v-model="defaultValue"
      :form-value="formValue"
      :options="selectOptions"
      :multiple="multiple"
      @change="$emit('input', $event)"
    ></b-form-select>
    <div v-else class="alert alert-primary" role="alert">
      Chargement de la liste en cours...
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: String,
    options: Object,
    multiple: Boolean,
  },
  data() {
    return {
      defaultValue: this.formValue,
      selectOptions: this.options,
    }
  },
  async fetch() {
    if (!Array.isArray(this.$props.options)) {
      await fetch(this.$config.apiURL + this.$props.options)
        .then((res) => res.json())
        .then(
          (rest) =>
            (this.selectOptions = rest.data.map((item) => {
              if (this.$props.multiple) {
                return { text: item.name, value: { id: item.id, quantity: 1 } }
              } else {
                return { text: item.name, value: item.id }
              }
            }))
        )
        .catch((err) => alert(err))
    }
  },
}
</script>
