import React, { Component } from 'react'

class Reciepe extends Component {
  render() {
    const { current, add, remove } = this.props

    let total = 0
    current.map((item, key) => total += item.meal.price * item.quantity ) 

    return (
      <table className="table table-bordered" style={{ margin: "15px" }}>
        <tr>
          <td><b>Item</b></td>
          <td style={{ textAlign: 'center' }}><b>Quantity</b></td>
          <td style={{ textAlign: 'right' }}><b>Price</b></td>
          <td style={{ textAlign: 'right' }}><b>Total</b></td>
        </tr>
        {
          current.map((item, key) =>
            <tr>
              <td>{ item.meal.name }</td>
              <td style={{ textAlign: 'center' }}>
                <button onClick={() => remove(item.meal.id)} className="btn btn-primary btn-xs">-</button>
                  &nbsp;&nbsp;{ item.quantity }&nbsp;&nbsp;
                <button onClick={() => add(item.meal.id)} className="btn btn-primary btn-xs">+</button>
              </td>
              <td style={{ textAlign: 'right' }}>
                { item.meal.price } KM
              </td>
              <td style={{ textAlign: 'right' }}>{ Math.round(item.meal.price * item.quantity * 100) / 100 } KM</td>
            </tr>
          )
        }
        <tr>
          <td><b>Total</b></td>
          <td style={{ textAlign: 'center' }}><b></b></td>
          <td style={{ textAlign: 'right' }}><b></b></td>
          <td style={{ textAlign: 'right' }}><b>{ Math.round(total * 100) / 100 } KM</b></td>
        </tr>
      </table>
    )
  }
}

export default Reciepe