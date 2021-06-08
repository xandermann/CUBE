<template>
  <b-container fluid class="h-100">
    <div
      class="h-100 d-flex flex-column align-items-center justify-content-center"
    >
      <!-- <Logo /> -->
      <b-img
        src="/images/logo.png"
        fluid
        alt="Logo Goodfood"
        style="width: 400px; height: auto; object-fit: cover"
      />
      <h3>Sélectionnez une page pour commencer</h3>
      <div>
        <b-button :to="'resto/liste'" variant="primary"
          >Liste des restaurants</b-button
        >
      </div>
    </div>
  </b-container>
</template>
