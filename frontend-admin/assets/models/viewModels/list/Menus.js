export class ListeMenus {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des menus'
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
      return new Menu(item)
    })
  }
}

export class Menu {
  id
  nom
  prix
  constructor(menu) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = menu.id
    this.nom = menu.name
    this.prix = menu.price
  }
}
