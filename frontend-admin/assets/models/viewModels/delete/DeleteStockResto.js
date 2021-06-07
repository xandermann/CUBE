import { ModalInput, ModalProperties } from '../../modales/ModalForm'

export class DeleteStockRestaurant {
  modalInputs
  modalProperties
  constructor(stock, id) {
    this.modalProperties = new ModalProperties(
      'Supprimer un élément du stock',
      'supprStockRestaurant',
      `/api/restaurants/${id}/stock`
    )
    this.modalInputs = [
      new ModalInput('ingredient_id', null, null, null, stock.ingredient_id),
    ]
  }
}
