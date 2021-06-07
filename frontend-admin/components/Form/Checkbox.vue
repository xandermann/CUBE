<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-checkbox
      :id="title"
      :form-value="formValue"
      @change="$emit('input', $event)"
    >
    </b-form-checkbox>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: Boolean,
  },
}
</script>
