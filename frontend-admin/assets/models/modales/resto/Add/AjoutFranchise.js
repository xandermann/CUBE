import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutFranchise {
  modalProperties = new ModalProperties(
    'Ajouter un groupement de franchise',
    'ajoutGrpFranchise',
    '/api/restaurants'
  )

  modalInputs = [
    new ModalInput(
      'nomFranchise',
      'Nom de la franchise',
      new ModalPropertiesTypes().PLAINTEXT
    ),
  ]
}
