export class ListeExample {
    // Liste des champs a afficher dans la vue
    //Ajouter 'modify' pour la modale de modification (PUT /api/entite/{id}) et 'delete' pour la suppression standard (DELETE /api/entite/{id})
    liste
    title = 'Liste des ingrédients'
    urlFetch
    champs = ['a','b']
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
    //list.data si paginee, list.map sinon
    this.liste.data = list.data.map(function (item) {
      return new Example(item)
    })
  }
  }
  
  export class Example {
    id
    constructor(item) {
      // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
      this.id = item.id
    }
  }
  