<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-datepicker
      :id="title"
      :form-value="formValue"
      class="mb-2"
      @input="$emit('input', $event)"
    ></b-form-datepicker>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: String,
  },
}
</script>
