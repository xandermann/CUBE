export class ModalForm {}

// Permet de créer les propriété utilisées dans la modale
// A vocation à contenir les infos de la route concernée par le formulaire
export class ModalProperties {
  title
  id
  url
  constructor(title, id, url) {
    this.title = title
    this.id = id
    this.url = url
  }
}

// Propriétés nécessaires à la création d'un input
export class ModalInput {
  property
  title
  type
  validation
  listValues // Liste de valeurs possibles
  defaultValue // Valeur par défaut
  constructor(property, title, type, listValues, defaultValue) {
    this.property = property
    this.title = title
    this.type = type
    this.listValues = listValues
    this.defaultValue = defaultValue
  }
}

// Regroupe les différents types d'input
// Sera utilisé dans ModalForm.vue pour générer le bon type d'input
export class ModalPropertiesTypes {
  PLAINTEXT = 'plaintext'
  CHECKBOX = 'checkbox'
  DATETIME = 'dateTime'
  DATE = 'date'
  SELECT = 'select'
  MAP = 'map'
  ADDRESS = 'address'
}
