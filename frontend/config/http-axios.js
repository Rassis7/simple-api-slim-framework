'use strict'
import axios from 'axios'
import ls from 'localStorage'

let baseUrl = ''

switch (process.env.NODE_ENV) {
  case 'production':
    baseUrl = ''
    break
  case 'homolog':
    baseUrl = ''
    break
  default:
    baseUrl = 'http://localhost:8888'
}

export const HTTP_AXIOS = axios.create({
  baseURL: baseUrl,
  timeout: 10000,
  'headers': {
    'x-Token': ls.getItem('TOKEN') || null
  }
})
