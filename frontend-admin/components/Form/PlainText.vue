<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-input
      v-model="defaultValue"
      :form-value="formValue"
      @input="$emit('input', $event)"
    ></b-form-input>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: String,
  },
  data() {
    return {
      defaultValue: this.formValue,
    }
  },
}
</script>
