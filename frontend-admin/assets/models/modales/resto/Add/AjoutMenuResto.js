import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutMenuResto {
  modalProperties
  constructor(id) {
    this.modalProperties = new ModalProperties(
      'Ajouter un nouveau menu',
      'ajoutMenuStock',
      `/api/restaurants/${id}/menus`
    )
  }

  modalInputs = [
    new ModalInput('name', 'Nom du menu', new ModalPropertiesTypes().PLAINTEXT),
    new ModalInput(
      'price',
      'Prix du menu',
      new ModalPropertiesTypes().PLAINTEXT,
      null,
      null,
      'number'
    ),
    new ModalInput(
      'dishes',
      'Plats du menu',
      new ModalPropertiesTypes().SELECT,
      '/api/dishes',
      null,
      true
    ),
  ]
}
