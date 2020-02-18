import React, { Component } from 'react'

class PaymentCard extends Component {


  constructor() {
    super()

    this.state = {
        value: ""
    }
  }


  handleChange(e) {
    this.setState({value: e.target.value});
  }

  render() {
    const { prepare, back } = this.props 
        
    return (
        <div className="wrapper-app">
            <h3>Card Payment</h3>
            <div className="flex-grid">
                <div className="flex-grid__item">
                    <img src={'http://www.pngpix.com/wp-content/uploads/2016/10/PNGPIX-COM-Credit-Card-PNG-Transparent-Image.png'} style={{ width: '100%' }} />
                </div>
                <div className="flex-grid__item">
                    <label className="card-number-title" style={{ color: '#fff', textAlign: 'center' }}>Enter card number here</label>
                    <input type="number" value={this.state.value} className="card-input" style={{ color: '#fff' }} placeholder="xxxx xxxx xxxx xxxx" onChange={this.handleChange.bind(this)} />
                    <button className="go-back__button" onClick={prepare} disabled={this.state.value.length!==16}>
                        Finish transaction
                    </button>
                    <p style={{ color: '#d5d5d5', margin: '15px 0', display: 'block', fonSize: '18px' }}>
                        Keep in mind that your credit card needs to have 16 digits before you can proceed.
                    </p>
                </div>
            </div>
            <div style={{ maxWidth: '760px' }}>
                <button style={{ width: '100%' }} className="go-back__button" onClick={back}>
                    Choose another payment option
                </button>
            </div>
        </div>
    )
  }
}

export default PaymentCard
