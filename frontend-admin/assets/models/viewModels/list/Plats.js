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
        this.liste.currentPage = list.current_page
        this.liste.nextPageUrl = list.next_page_url
        this.liste.prevPageUrl = list.prev_page_url
        this.liste.totalRows = list.total
        this.liste.perPage = list.per_page
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
      this.nom = item.menu_name
    }
  }
  