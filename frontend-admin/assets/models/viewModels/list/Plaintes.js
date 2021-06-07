export class ListePlaintes {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des plaintes'
  champs = ['date', 'note', 'message']

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
      return new Plainte(item)
    })
  }
}

export class Plainte {
  id
  date
  note
  message
  constructor(plainte) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = plainte.id
    this.email = plainte.email
    this.date = new Date(plainte.created_at).toLocaleDateString()
    this.message = plainte.message
  }
}
