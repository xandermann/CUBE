import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutStockResto {
  modalProperties
  constructor(id) {
    this.modalProperties = new ModalProperties(
      'Ajouter un nouvel ingrédient au stock',
      'ajoutIngredStock',
      `/api/restaurants/${id}/stock`
    )
  }

  modalInputs = [
    new ModalInput(
      'ingredient_id',
      "Nom de l'ingredient",
      new ModalPropertiesTypes().SELECT,
      '/api/ingredients'
    ),
    new ModalInput(
      'quantity',
      'Quantité',
      new ModalPropertiesTypes().PLAINTEXT
    ),
  ]
}
