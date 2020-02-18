import React, { Component } from 'react'
import ReactDOM from 'react-dom'

import Current from '../components/preparation/Current'
import List from '../components/preparation/List'

import * as services from '../services'

class Preparation extends Component {
  constructor() {
    super()

    this.state = {
      current_id: null,
      current_items: [],

      queue: [],
      active: []
    }
  }

  componentWillMount() {
    this.load()
    this.loadActive()
  }

  componentDidMount() {
    this.load()
    setInterval(() => { this.load() }, 10000)
  }

  // load the orders
  load = async () => {
    try {
      let response = await services.send('order/list')
      let data = response.data

      this.setState({
        queue: data.data
      })
    } catch(err) {
      console.log("Loading the queue")
    }
  }

  // load the active orders
  loadActive = async () => {
    try {
      let response = await services.send('order/list/active')
      let data = response.data

      this.setState({
        active: data
      })
    } catch(err) {
      console.log(err)
      console.log("Loading the active")
    }
  }

  // take order into preparation
  take = async () => {
    try {
      let response = await services.send('preparation/take', {}, 'POST')
      let data = response.data

      this.setState({
        current_id: data.order.id,
        current_items: data.order_items
      })

      // load the queue again
      this.load()
      this.loadActive()
    } catch(err) {
      console.log("Taking order error")
    }
  }

  cont = async (id) => {
    try {
      let response = await services.send('order/current/' + id)
      let data = response.data

      this.setState({
        current_id: data.order.id,
        current_items: data.order_items
      })

      // load the queue again
      this.load()
      this.loadActive()
    } catch(err) {
      let response = await s
    }
  }

  // finish the preparaton
  finish = async () => {
    try {
      let response = await services.send('preparation/finish', {
        id: this.state.current_id
      }, 'POST')
      let data = response.data

      this.setState({
        current_id: null,
        current_items: [],
      })

      this.load()
      this.loadActive()
    } catch(err) {
      console.log("Finishing order error")
    }
  }

  render() {
    const { current_id, current_items, queue, active } = this.state

    return (
      <div className="flex-container">
        <div className="flex-container__white" style={{ background: '#24242f', borderRight: '10px solid #98bb75' }}>
          <List
            queue={queue}
            ac={active}
            take={this.take}
            cont={this.cont}
            />
          <a href="/fss/public/staff" className="go-back__button" style={{ textAlign: 'center' }}>
            Back to main screen
          </a>
        </div>
        <div className="flex-container__white" style={{ background: '#363744' }}>
          <Current
            id={current_id}
            items={current_items}
            queue={queue}
            finish={this.finish}
            take={this.take}
            />
        </div>
      </div>
    )
  }
}

export default Preparation

if(document.getElementById('preparation')) {
    ReactDOM.render(<Preparation />, document.getElementById('preparation'));
}
