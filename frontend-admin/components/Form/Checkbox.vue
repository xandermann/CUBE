<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-checkbox
      :id="title"
      v-bind:formValue="formValue"
      v-on:change="$emit('input', $event)"
    >
      I accept the terms and use
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
