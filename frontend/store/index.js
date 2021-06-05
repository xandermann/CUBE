// import Cookies from 'js-cookie'

// // export const state = () => ({
// // })

// export const getters = {
//   basket: (state) => {
//     const basket = Cookies.get('basket') ?? '[]'

//     return JSON.parse(basket)
//   },
// }

// export const mutations = {
//   addMenuInBasket(state, menu) {
//     const basket = Cookies.get('basket') ?? '[]'

//     const jsonBasket = JSON.parse(basket)

//     const newJsonBasket = [...jsonBasket, menu]

//     Cookies.set('basket', JSON.stringify(newJsonBasket))
//   },
//   removeMenuFromBasket(state, menuId) {
//     const basket = Cookies.get('basket') ?? '[]'

//     const jsonBasket = JSON.parse(basket)

//     jsonBasket.splice(menuId, 1)

//     Cookies.set('basket', JSON.stringify(jsonBasket))
//   },
// }
