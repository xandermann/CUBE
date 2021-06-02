import {
  ModalInput,
  ModalPropertiesTypes,
  ModalProperties,
} from '../../modales/ModalForm'

export class PutRestaurant {
  modalProperties
  modalInputs

  constructor(restaurant, id) {
    this.ModalProperties = new ModalProperties(
      'Modifier un restaurant',
      'modifRestaurant',
      `/api/restaurants/${id}`
    )
    this.modalInputs = []
    // debugger
    this.modalInputs = [
      new ModalInput(
        'name',
        'Nom du restaurant',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        restaurant.name
      ),
      new ModalInput(
        'full_address',
        'Adresse du restaurant',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        restaurant.coordinate.full_address
      ),
      new ModalInput(
        'city',
        'Ville',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        restaurant.coordinate.city
      ),
      new ModalInput(
        'postal_code',
        'Code postal',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        restaurant.coordinate.postal_code
      ),
      new ModalInput(
        'country',
        'Pays',
        new ModalPropertiesTypes().SELECT,
        [
          { value: 'France', text: 'France' },
          { value: 'Belgique', text: 'Belgique' },
          { value: 'Luxembourg', text: 'Luxembourg' },
          restaurant.coordinate.country,
        ],
        restaurant.coordinate.country
      ),

      new ModalInput(
        'localisation',
        'Localisation',
        new ModalPropertiesTypes().ADDRESS,
        null,
        {
          lat: restaurant.coordinate.lat_address,
          lng: restaurant.coordinate.lng_address,
        }
      ),
      new ModalInput(
        'number_phone',
        'Numéro de téléphone',
        new ModalPropertiesTypes().PLAINTEXT,
        null,
        restaurant.coordinate.number_phone
      ),
    ]
  }
}
