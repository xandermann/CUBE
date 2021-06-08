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
        <b-button :to="'offres/ingredients'" variant="primary"
          >Ingrédients</b-button
        >
        <b-button :to="'offres/plats'" variant="primary">Plats</b-button>
        <b-button :to="'offres/menus'" variant="primary">Menus</b-button>
      </div>
    </div>
  </b-container>
</template>
