import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutPlatResto {
  modalProperties
  constructor(id) {
    this.modalProperties = new ModalProperties(
      'Ajouter un nouveau plat',
      'ajoutPlatResto',
      `/api/restaurants/${id}/dishes`
    )
  }

  modalInputs = [
    new ModalInput('name', 'Nom du plat', new ModalPropertiesTypes().PLAINTEXT),
    new ModalInput(
      'price',
      'Prix du plat',
      new ModalPropertiesTypes().PLAINTEXT,
      null,
      null,
      'number'
    ),
    new ModalInput(
      'ingredients',
      'Ingrédients du plat',
      new ModalPropertiesTypes().SELECT,
      '/api/ingredients',
      null,
      true
    ),
  ]
}
