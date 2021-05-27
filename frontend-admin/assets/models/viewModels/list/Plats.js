export class ListePlats {
  // Liste des champs a afficher dans la vue
  liste
  title = 'Liste des plats'
  urlFetch
  champs = ['nom']
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
    // Rajouter pagination par la suite (list.data)
    this.liste.data = list.data.map(function (item) {
      return new Plat(item)
    })
  }
}

export class Plat {
  id
  nom
  constructor(item) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = item.id
    this.nom = item.name
  }
}
