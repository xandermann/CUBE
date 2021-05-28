<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-datepicker
      :id="title"
      v-bind:formValue="formValue"
      v-on:input="$emit('input', $event)"
      class="mb-2"
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
