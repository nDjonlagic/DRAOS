import React, { Component } from 'react'
import ReactDOM from 'react-dom'

import Reciepe from '../components/order/Reciepe'
import Start from '../components/order/Start'
import Type from '../components/order/Type'
import Meal from '../components/order/Meal'
import Payment from '../components/order/Payment'
import PaymentCard from '../components/order/PaymentCard'
import PaymentWait from '../components/order/PaymentWait'
import Prepare from '../components/order/Prepare'
import Ready from '../components/order/Ready'
import Unfinished from '../components/order/Unfinished'

import Back from '../components/order/actions/Back'
import Pay from '../components/order/actions/Pay'
import Abort from '../components/order/actions/Abort'
import New from '../components/order/actions/New'
import Prepay from '../components/order/actions/Prepay'
import ToOrder from '../components/order/actions/ToOrder'

import * as services from '../services'

class Order extends Component {
  constructor() {
    super()

    this.state = {
      start: true,
      type: false,
      meal: false,
      payment_pre: false,
      payment: false,
      payment_card: false,
      payment_wait: false,
      prepare: false,
      ready: false,

      order: null,
      order_items: [],

      type_id: null,

      meal_types: [],
      meal_items: [],

      unfinished: []
    }
  }

  /** Component lifecycle */
  componentWillMount() {
    this.initilizeTypes()
    this.initilizeUnfinished()
  }

  /** Initilizaation methods */
  initilizeTypes = async () => {
    try {
      let response = await services.send('meal/types')
      let data = response.data

      this.setState({
        meal_types: data
      })
    } catch(err) {
      console.log(err)
    }
  }

  initilizeUnfinished = async () => {
    try {
      let response = await services.send('order/unfinished')
      let data = response.data

      this.setState({
        unfinished: data
      })
    } catch(err) {
      console.log(err)
    }
  }

  /** User actio mehtods */
  start = async () => {
    try {
      let response = await services.send('order/create', {}, "POST")
      let data = response.data

      this.setState({
        start: false,
        type: true,
        meal: false,

        order: data,
        order_items: []
      })
    } catch(err) {
      console.log(err)
    }
  }

  type = async (type_id, order) => {
    try {
      let response = await services.send('meal/types/' + type_id + '/' + order)
      let data = response.data

      this.setState({
        type: false,
        meal: true,

        type_id: type_id,
        meal_items: data
      })
    } catch(err) {
      console.log(err)
    }
  }

  add = async (id) => {
    try {
      let response = await services.send('order/add/' + this.state.order.id, {
        meal_id: id
      }, "POST")

      let data = response.data

      console.log("Data")
      console.log(data)

      this.setState({
        order: data.order,
        order_items: data.items
      })

      this.type(this.state.type_id, this.state.order.id)
    } catch(err) {
      console.log(err)
    }
  }

  remove = async (id) => {
    try {
      let response = await services.send('order/remove/' + this.state.order.id, {
        meal_id: id
      }, "POST")

      let data = response.data

      this.setState({
        order: data.order,
        order_items: data.items
      })

      this.type(this.state.type_id, this.state.order.id)
    } catch(err) {
      console.log(err)
    }
  }

  abort = () => {
    this.initilizeUnfinished()
  }

  prepay = () => {
    this.setState({
      type: false,
      payment_pre: true
    })
  }

  backToOrder = () => {
    this.setState({
      payment_pre: false,
      type: true
    })
  }

  pay = () => {

    this.setState({
      type: false,
      meal: false,
      payment_pre: false,
      payment_card: false,
      payment_wait: false,
      payment: true
    });

  }

  payCash = async () => {
    try {
      await services.send('order/ready2pay', {
        order: this.state.order.id
      }, 'POST')

      this.setState({
        payment: false,
        payment_wait: true,
      })

      this.intervalPayment = setInterval(() => this.waitPayment(), 5000)
    } catch(err) {
      console.log("cant pay by cash")
    }
  }

  payCard = () => {
    this.setState({
      payment: false,
      payment_card: true,
    });
  }

  prepare = async () => {
    try {
      let response = await services.send('order/queue', {
        order: this.state.order.id
      }, 'POST')

      this.setState({
        payment_card: false,
        payment_wait: false,
        prepare: true,
      })

      this.interval = setInterval(() => this.wait(), 5000)
    } catch(err) {
      console.log("Cant prepare")
    }
  }

  wait = async () => {
    try {
      let response = await services.send('order/await', {
        order: this.state.order.id
      }, 'POST')

      let data = response.data

      if(data.ready) {
        this.setState({
          prepare: false,
          ready: true
        })
      }
    } catch(err) {
      console.log("error in waiting")
    }
  }

  waitPayment = async () => {
    try {
      let response = await services.send('order/await/payment', {
        order: this.state.order.id
      }, 'POST')

      let data = response.data

      if(data.ready) {
        clearInterval(this.intervalPayment)
        this.prepare()
      }
    } catch(err) {
      console.log("error in waiting")
    }
  }

  back = () => {
    this.setState({
      type: true,
      meal: false,
      payment: false,
      payment_card: false,
      payment_wait: false,
      payment_pre: false
    })
  }

  again = () => {
    clearInterval(this.interval)

    this.initilizeUnfinished()

    this.setState({
      start: true,
      type: false,
      meal: false,
      payment_pre: false,
      payment: false,
      payment_card: false,
      payment_wait: false,
      prepare: false,
      ready: false
    })
  }

  cont = (order, order_items) => {
    this.setState({
      order: order,
      order_items: order_items,
      start: false,
      type: true,
      meal: false
    })
  }

  render() {
    const { start, type, meal, payment, payment_pre, payment_card, payment_wait, prepare, ready } = this.state
    const { meal_types, meal_items, order, order_items, unfinished } = this.state

    return (
      <div className="flex-container">
        {
          start
          &&
          <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#24242f', borderRight: '10px solid #98bb75' }}>
              <Start
                start={this.start}
                />
            </div>
            {
              unfinished.length > 0
              &&
              <div className="flex-container__white" style={{ background: '#363744' }}>
                <Unfinished
                  unfinished={unfinished}
                  cont={this.cont}
                  />
              </div>
            }
          </div>
        }
        {
          type
          &&
          <div className="flex-container flex-2">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <Type
                types={meal_types}
                order={order}
                select={this.type}
                pay={this.pay}
                />
            </div>
          </div>
        }
        {
          meal
          &&
          <div className="flex-container flex-2">
            <div className="flex-container__white" style={{ background: '#363744', paddingTop: '370px'}}>
              <Back
                back={this.back}
                />
              <Meal
                items={meal_items}
                add={this.add}
                remove={this.remove}
                back={this.back}
                />
            </div>
          </div>
        }
        {
          payment
          &&
           <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <Payment
                payCash={this.payCash}
                payCard={this.payCard}
                back={this.back}
              />
            </div>
          </div>
        }
        {
          payment_card
          &&
          <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <PaymentCard
                prepare={this.prepare}
                back={this.pay}
              />
            </div>
          </div>
        }
        {
          payment_wait
          &&
          <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <PaymentWait
                order={this.state.order.id}
                />
              <Pay
                pay={this.pay}
                text={'Select another payment option'}
                />
            </div>
          </div>
        }
        {
          prepare
          &&
          <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <Prepare />
            </div>
          </div>
        }
        {
          ready
          &&
          <div className="flex-container">
            <div className="flex-container__white" style={{ background: '#363744' }}>
              <Ready />
              <New again={this.again} />
            </div>
          </div>
        }
        {
          (!start && !payment && !payment_wait && !payment_card && !prepare && !ready)
          &&
          <div className="flex-container" style={{ background: '#24242f!important' }}>
            <div className="flex-container__white" style={{ background: '#24242f', borderLeft: '10px solid #98bb75' }}>
              <Reciepe
                current={order_items}
                add={this.add}
                remove={this.remove}
                />
              <Pay
                pay={this.pay}
                empty_order={order_items.length === 0}
                />
              <Abort
                abort={this.again}
                />
            </div>
          </div>
        }
      </div>
    )
  }
}

export default Order

if(document.getElementById('order')) {
    ReactDOM.render(<Order />, document.getElementById('order'));
}

