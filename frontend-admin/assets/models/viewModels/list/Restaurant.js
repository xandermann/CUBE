import { PutRestaurant } from '../put/PutResto'

export class ListRestaurant {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des restaurants'
  champs = [
    'nom',
    'adresseComplete',
    'ville',
    'pays',
    'telephone',
    'modifier',
    'supprimer',
  ]

  constructor(url) {
    this.urlFetch = url
  }

  setList(list) {
    this.liste = {}
    this.liste.currentPage = list.current_page ?? 1
    this.liste.nextPageUrl = list.next_page_url ?? 1
    this.liste.prevPageUrl = list.prev_page_url ?? 1
    this.liste.totalRows = list.total ?? 100
    this.liste.perPage = list.per_page ?? 100
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
  codePostal
  pays
  telephone
  putModal
  constructor(restaurant) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = restaurant.id
    this.nom = restaurant.name
    this.adresseComplete = restaurant.coordinate.full_address
    this.ville = restaurant.coordinate.city
    this.codePostal = restaurant.coordinate.postal_code
    this.pays = restaurant.coordinate.country
    this.telephone = restaurant.coordinate.number_phone
    this.putModal = new PutRestaurant(restaurant, restaurant.id)
  }
}
