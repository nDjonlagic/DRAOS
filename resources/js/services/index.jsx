// initilize axios and redirect
import React from 'react'
import axios from 'axios'

// fetch the configuration
import apiconfig from './config'

/* Service send option */
export const send = (endpoint, data = {}, method = "GET", headers = {}) => {

  // set authorization headers if available 
  if(document.getElementById('access-token')) {
    headers = {
      'Authorization': document.getElementById('access-token').value,
      ...headers
    }
  }

  // set the request options
  let options = {
    method,
    headers,
    data,
    url: apiconfig.api + endpoint
  }

  // return the promise
  return axios(options)
}
