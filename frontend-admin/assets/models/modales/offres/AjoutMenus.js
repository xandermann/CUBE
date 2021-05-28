import { ModalInput, ModalProperties, ModalPropertiesTypes } from '../ModalForm'
export class AjoutMenus {
  modalProperties = new ModalProperties(
    'Ajouter un Menu',
    'ajoutMenu',
    '/api/menu'
  )

  modalInputs = [
    new ModalInput('name', 'Nom du menu', new ModalPropertiesTypes().PLAINTEXT),

    new ModalInput('price', 'Prix', new ModalPropertiesTypes().PLAINTEXT),
  ]
}
