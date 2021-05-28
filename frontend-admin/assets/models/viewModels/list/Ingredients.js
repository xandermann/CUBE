export class ListIngredients {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des ingrédients'
  champs = ['nom']

  constructor(url) {
    this.urlFetch = url
  }

  setList(list) {
    debugger
    this.liste = {}
    this.liste.currentPage = list.current_page ?? 1
    this.liste.nextPageUrl = list.next_page_url ?? 1
    this.liste.prevPageUrl = list.prev_page_url ?? 1
    this.liste.totalRows = list.total ?? 100
    this.liste.perPage = list.per_page ?? 100
    // Rajouter pagination par la suite (list.data)
    this.liste.data = list.map(function (item) {
      return new Ingredient(item)
    })
  }
}

export class Ingredient {
  id
  nom
  constructor(ingredient) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = ingredient.id
    this.nom = ingredient.name
  }
}
