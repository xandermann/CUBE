<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-select
      v-model="defaultValue"
      :form-value="formValue"
      :options="selectOptions"
      @change="$emit('input', $event)"
    ></b-form-select>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: String,
    options: Object,
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
            (this.selectOptions = rest.map(function (item) {
              return { text: item.name, value: item.id }
            }))
        )
        .catch((err) => alert(err))
    }
  },
}
</script>
