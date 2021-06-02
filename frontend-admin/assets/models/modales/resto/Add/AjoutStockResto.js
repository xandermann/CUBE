import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutStockResto {
  modalProperties = new ModalProperties(
    'Ajouter un nouvel ingrédient au stock',
    'ajoutIngredStock',
    '/api/restaurants/2/stock'
  )

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
