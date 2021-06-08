import { ModalInput, ModalProperties, ModalPropertiesTypes } from '../ModalForm'
export class AjoutPlats {
  modalProperties = new ModalProperties(
    'Ajouter un plat',
    'ajoutPlat',
    '/api/dishe'
  )

  modalInputs = [
    new ModalInput(
      'name',
      'Nom du restaurant',
      new ModalPropertiesTypes().PLAINTEXT
    ),

    new ModalInput(
      'price',
      'Prix',
      new ModalPropertiesTypes().PLAINTEXT,
      null,
      null,
      'number'
    ),
  ]
}
