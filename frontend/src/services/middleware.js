import user from './auth'

export default {
  auth (to, from, next) {
    next(user.check() ? true : {
      path: '/'
    })
  }
}
