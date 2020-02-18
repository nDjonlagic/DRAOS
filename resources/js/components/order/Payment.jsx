import React, { Component } from 'react'

class Payment extends Component {
  render() {
    const { back, payCard, payCash } = this.props 

    return (
        <div className="wrapper-app">
            <h3>Payment</h3>
            <span>
                We provide two options of payment: card payment as a direct payment, once you are done your order starts being prepared and cash payment - once you create your order, go to the cash register and pay in order for your order to be proceeded.
            </span>
            <div className="flex-grid" style={{ maxWidth: '760px' }}>
                <div className="flex-grid__item">
                    <div className="type-item" onClick={() => payCard()}>
                        <div className="meal-image">
                            <img src={'http://www.pngpix.com/wp-content/uploads/2016/10/PNGPIX-COM-Credit-Card-PNG-Transparent-Image.png'} />
                        </div>
                            <br />
                        <h4>Card payment</h4>
                    </div>
                </div>
                <div className="flex-grid__item">
                    <div className="type-item" onClick={() => payCash()}>
                        <div className="meal-image">
                            <img src={'http://www.pngpix.com/wp-content/uploads/2016/03/Dollar-Cash-Money-PNG-image-500x375.png'} />
                        </div>
                            <br />
                        <h4>Pay by Cash</h4>
                    </div>
                </div>
            </div>
            <div style={{ maxWidth: '760px' }}>
                <button style={{ width: '100%' }} className="go-back__button" onClick={back}>
                    Go back to your order
                </button>
            </div>
        </div>
    )
  }
}

export default Payment
