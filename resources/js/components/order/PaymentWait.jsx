import React, { Component } from 'react'

class PaymentWait extends Component {
  render() {
    const { order } = this.props 

    return (
      <div className="wrapper-app">
        <h3>Order: <b>#{ order }</b></h3>
        <span>
          Once you pay at the cash register, your order will start preparing.
        </span>
        <img style={{ width: '240px', margin: '30px 0' }} src={'https://www.bootgum.com/wp-content/uploads/2018/07/Wallet_Cash_550px.gif'} />
      </div>
    )
  }
}

export default PaymentWait
