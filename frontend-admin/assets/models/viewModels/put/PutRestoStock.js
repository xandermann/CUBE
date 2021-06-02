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
      'Modifier la quantité en stock',
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
        'Quantite',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        stock.quantity
      ),
    ]
  }
}
