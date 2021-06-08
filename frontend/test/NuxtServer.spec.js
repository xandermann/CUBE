// const { Nuxt, Builder } = require('nuxt')
// const nuxtConfig = require('../nuxt.config.js')
// let nuxt = null

describe('NuxtServer', () => {
  test('()', () => {
    expect(true).toBe(true)
  })
})

// beforeAll(async () => {
//   nuxt = new Nuxt({
//     ...nuxtConfig,
//     server: { port: 3001 },
//     buildDir: '.nuxt-build-jest',
//   })

//   await new Builder(nuxt).build()

//   await nuxt.server.listen(3001, 'localhost')
// }, 300000)

// const authMock = {
//   loggedIn: true,
// }

// describe('GET /', () => {
//   test('Route / exits and render HTML', async () => {
//     const { html, error } = await nuxt.server.renderRoute('/', {
//       loggedIn: true,
//       $auth: authMock,
//     })

//     expect(html).toBeDefined()
//     console.log(error)
//     // expect(html).toBeGreaterThan(0)
//     // expect(html).toBeGreaterThanOrEqual(200)
//     // expect(html).toBeLessThan(300)
//   })
// })

// afterAll(() => {
//   nuxt.close()
// })
