import { ModalInput, ModalProperties, ModalPropertiesTypes } from '../ModalForm'
export class AjoutUser {
  modalProperties = new ModalProperties('Ajouter un utilisateur', 'ajouterUser')

  modalInputs = [
    new ModalInput('nomUtilisateur', 'Nom', ModalPropertiesTypes.PLAINTEXT),
    new ModalInput('nomUtilisateur', 'Prénom', ModalPropertiesTypes.PLAINTEXT),
  ]
}
