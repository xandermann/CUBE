export class ListRestaurant {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des restaurants'
  champs = ['nom', 'adresseComplete', 'ville', 'pays', 'telephone']

  constructor(url) {
    this.urlFetch = url
  }

  setList(list) {
    this.liste = {}
    this.liste.currentPage = list.current_page
    this.liste.nextPageUrl = list.next_page_url
    this.liste.prevPageUrl = list.prev_page_url
    this.liste.totalRows = list.total
    this.liste.perPage = list.per_page
    this.liste.data = list.data.map(function (item) {
      return new Restaurant(item)
    })
  }
}

export class Restaurant {
  id
  nom
  adresseComplete
  ville
  pays
  telephone
  constructor(restaurant) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = restaurant.id
    this.nom = restaurant.name
    this.adresseComplete = restaurant.coordinate.full_address
    this.ville = restaurant.coordinate.city
    this.pays = restaurant.coordinate.country
    this.telephone = restaurant.coordinate.number_phone
  }
}
