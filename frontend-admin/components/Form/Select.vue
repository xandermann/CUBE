<template>
  <div>
    <label :for="title">{{ title }}</label>
    <b-form-select
      v-bind:formValue="formValue"
      v-on:change="$emit('input', $event)"
      :options="options"
    ></b-form-select>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    formValue: String,
    options: Array,
  },
}
</script>
