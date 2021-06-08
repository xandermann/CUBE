import Index from '@/pages/about.vue'
import Account from '@/pages/account.vue'
import Restaurants from '@/pages/index.vue'
import Login from '@/pages/login.vue'
import Orders from '@/pages/orders.vue'
import RestaurantsMenus from '@/pages/restaurants/_id/menus.vue'
import SignUp from '@/pages/signup.vue'
import { config, mount } from '@vue/test-utils'
import axios from 'axios'
import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue'
Vue.use(BootstrapVue)

const authMock = {
  loggedIn: true,
}

// Mock Nuxt client-side component
config.stubs['client-only'] = { template: '<div><slot /></div>' }

describe('Pages tests', () => {
  test('Index is well mounted', () => {
    const wrapper = mount(Index, { mocks: { $auth: authMock } })
    expect(wrapper).not.toBe(null)
  })

  test('Login is well mounted', () => {
    const wrapper = mount(Login, {
      mocks: { $auth: authMock },
    })
    expect(wrapper).not.toBe(null)
  })

  test('SignUp is well mounted', () => {
    const wrapper = mount(SignUp, { mocks: { $auth: authMock } })
    expect(wrapper).not.toBe(null)
  })

  test('Account is well mounted', () => {
    const wrapper = mount(Account, {
      mocks: { $auth: authMock, $axios: axios },
    })
    expect(wrapper).not.toBe(null)
  })

  test('Orders is well mounted', () => {
    const wrapper = mount(Orders, {
      mocks: { $auth: authMock, $axios: axios },
    })
    expect(wrapper).not.toBe(null)
  })

  test('Restaurants is well mounted', () => {
    const wrapper = mount(Restaurants, {
      mocks: { $auth: authMock, $axios: axios },
    })
    expect(wrapper).not.toBe(null)
  })

  test('Restaurants/id is well mounted', () => {
    const wrapper = mount(RestaurantsMenus, {
      mocks: {
        $auth: authMock,
        $axios: axios,
        $route: {
          params: {
            id: 1,
          },
        },
      },
    })
    expect(wrapper).not.toBe(null)
  })
})
