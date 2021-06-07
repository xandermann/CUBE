export class ListAvis {
  // Liste des champs a afficher dans la vue
  liste
  urlFetch
  title = 'Liste des avis du restaurant'
  champs = ['nom', 'email', 'date', 'note', 'message']

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
      return new Avis(item)
    })
  }
}

export class Avis {
  id
  name
  email
  date
  note
  message
  constructor(avis) {
    // Les champs ci-dessous sont utilisés mais pas forcément affichés dans la vue
    this.id = avis.id
    this.nom = avis.firstname + ' ' + avis.lastname
    this.email = avis.email
    this.date = new Date(avis.created_at).toLocaleDateString()
    this.note = avis.pivot.note
    this.message = avis.pivot.message
  }
}
