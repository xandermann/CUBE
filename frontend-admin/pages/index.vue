<template>
  <b-container fluid>
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
      <h3>Bienvenue</h3>
      <div>
        <b-button :to="'resto'" variant="primary">Restaurants</b-button>
        <b-button :to="'offres'" variant="primary">Offres</b-button>
        <b-button :to="'commercial'" variant="primary">Commercial</b-button>
      </div>
    </div>
  </b-container>
</template>
