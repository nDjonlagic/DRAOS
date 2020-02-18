import React, { Component } from 'react'

class Ready extends Component {
  render() {
    return (
        <div>
            <img src={'https://s3-ap-southeast-1.amazonaws.com/gw-thinksaas-deploy/website/images/checkmark-gif.gif'} />
            <h3 style={{ textAlign: 'center' }}>Your order is ready. Pick it up.</h3>
        </div>
    )
  }
}

export default Ready
