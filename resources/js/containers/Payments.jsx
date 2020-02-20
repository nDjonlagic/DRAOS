import React, { Component } from 'react'
import ReactDOM from 'react-dom'

import List from '../components/payments/List'

import * as services from '../services'

class Payments extends Component {
  constructor() {
    super()

    this.state = {
      orders: []
    }
  }

  componentDidMount() {
    this.load()
    setInterval(() => this.load(), 10000)
  }

  load = async () => {
    try {
      let response = await services.send('order/list/payment')
      let data = response.data

      this.setState({
        orders: data.data
      })
    } catch(err) {
      console.log("Loading the queue")
    }
  }

  paid = async (id) => {
    try {
      let response = await services.send('order/queue', {
        order: id
      }, 'POST')

      this.load()
    } catch(err) {
      console.log("Cant prepare")
    }
  }

  render() {
    return (
      <div className="flex-container">
        <div className="flex-container__white" style={{ background: '#24242f', borderRight: '10px solid #98bb75' }}>
          <List
            payments={this.state.orders}
            paid={this.paid}
            />
          <a href="/staff" className="go-back__button" style={{ textAlign: 'center', maxWidth: '320px' }}>
            Back to main screen
          </a>
        </div>
      </div>
    )
  }
}

export default Payments

if(document.getElementById('payments')) {
    ReactDOM.render(<Payments />, document.getElementById('payments'));
}
