import {
  ModalInput,
  ModalProperties,
  ModalPropertiesTypes,
} from '../../ModalForm'
export class AjoutResto {
  modalProperties = new ModalProperties(
    'Ajouter un restaurant',
    'ajoutRestaurant',
    '/api/restaurants'
  )

  modalInputs = [
    new ModalInput(
      'name',
      'Nom du restaurant',
      new ModalPropertiesTypes().PLAINTEXT
    ),
    new ModalInput(
      'full_address',
      'Adresse du restaurant',
      new ModalPropertiesTypes().PLAINTEXT
    ),
    new ModalInput(
      'postal_code',
      'Code postal',
      new ModalPropertiesTypes().PLAINTEXT
    ),
    new ModalInput('city', 'Ville', new ModalPropertiesTypes().PLAINTEXT),
    new ModalInput('country', 'Pays', new ModalPropertiesTypes().SELECT, [
      { value: 'France', text: 'France' },
      { value: 'Belgique', text: 'Belgique' },
      { value: 'Luxembourg', text: 'Luxembourg' },
    ]),

    new ModalInput(
      'number_phone',
      'Numéro de téléphone',
      new ModalPropertiesTypes().PLAINTEXT
    ),
  ]
}
