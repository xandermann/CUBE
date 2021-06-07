// import { DeleteStockRestaurant } from '../delete/DeleteStockResto'
// import { PutStockRestaurant } from '../put/PutRestoStock'
export class ListPlatsRestaurant {
  // Liste des champs a afficher dans la vue
  liste
  title = 'Plats proposés'
  urlFetch
  champs = ['nom', 'prix']
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
      return new PlatRestaurant(item)
    })
  }
}

export class PlatRestaurant {
  id
  nom
  prix
  // putModal
  constructor(item) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = item.id
    this.nom = item.name
    this.prix = item.price
    // this.putModal = new PutStockRestaurant(item.pivot, item.pivot.restaurant_id)
    // this.deleteModal = new DeleteStockRestaurant(
    //   item.pivot,
    //   item.pivot.restaurant_id
    // )
  }
}
