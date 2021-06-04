import {
  ModalInput,
  ModalPropertiesTypes,
  ModalProperties,
} from '../../modales/ModalForm'

export class PutStockRestaurant {
  modalInputs
  modalProperties
  constructor(stock, id) {
    this.modalProperties = new ModalProperties(
      'Ajouter des éléments au stock',
      'modifStockRestaurant',
      `/api/restaurants/${id}/stock`
    )
    this.modalInputs = []
    // debugger
    this.modalInputs = [
      new ModalInput(
        'ingredient_id',
        'Ingredient',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        stock.ingredient_id
      ),
      new ModalInput(
        'quantity',
        'Quantite à ajouter au stock',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        stock.quantity
      ),
    ]
  }
}
