<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-input
      v-bind:formValue="formValue"
      v-on:input="$emit('input', $event)"
    ></b-form-input>
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
