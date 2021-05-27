import { ModalInput, ModalProperties, ModalPropertiesTypes } from '../ModalForm'
export class AjoutIngredients {
  modalProperties = new ModalProperties(
    'Ajouter un ingrédient',
    'ajoutIngredient',
    '/api/ingredients'
  )

  modalInputs = [
    new ModalInput(
      'name',
      "Nom de l'ingrédient",
      new ModalPropertiesTypes().PLAINTEXT
    ),
  ]
}
