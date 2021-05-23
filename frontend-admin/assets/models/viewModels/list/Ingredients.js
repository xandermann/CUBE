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
    this.liste = {}
    this.liste.currentPage = list.current_page
    this.liste.nextPageUrl = list.next_page_url
    this.liste.prevPageUrl = list.prev_page_url
    this.liste.totalRows = list.total
    this.liste.perPage = list.per_page
    this.liste.data = list.data.map(function (item) {
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
