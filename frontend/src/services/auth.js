import ls from 'localStorage'
import jwt from 'jsonwebtoken'

export default {
  check () {
    const token = JSON.parse(ls.getItem('TOKEN'))

    if (!token || token === '' || token === 'undefined') {
      ls.removeItem('TOKEN')
      return false
    }

    return jwt.verify(token.jwt, process.env.HASH_TOKEN, (err, decoded) => {
      console.log(err, decoded)
      return (decoded !== undefined)
    })
  }
}
