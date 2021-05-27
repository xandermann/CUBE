import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutStockResto {
  modalProperties = new ModalProperties(
    'Ajouter un nouvel ingrédient au stock',
    'ajoutIngredStock',
    '/api/restaurants/1/stock'
  )

  modalInputs = [
    new ModalInput(
      'nomIngredient',
      "Nom de l'ingredient",
      new ModalPropertiesTypes().PLAINTEXT
    ),
  ]
}
