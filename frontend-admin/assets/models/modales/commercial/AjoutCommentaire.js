import { ModalInput, ModalProperties, ModalPropertiesTypes } from '../ModalForm'
export class AjoutCommentaires {
  modalProperties = new ModalProperties(
    'Ajouter un commentaire',
    'ajoutCommentaire'
  )

  modalInputs = [
    new ModalInput(
      'titreCommentaire',
      'Titre du commentaire',
      ModalPropertiesTypes.PLAINTEXT
    ),
    new ModalInput(
      'contenuCommentaire',
      'Contenu du commentaire',
      ModalPropertiesTypes.PLAINTEXT
    ),
  ]
}
