import React, { Component } from 'react'

class Meal extends Component {
  render() {
    const { items, add, remove, back, quantity } = this.props 

    return (
      <div className="flex-grid">
        {
          items.map((item, key) => 
            <div className="flex-grid__item">
              <div className="type-item">
                <div className="meal-image">
                  <img src={item.image} />
                </div>
                <h3>{ item.name }</h3>
                <h5>{ item.price } KM</h5>
              </div>
              <div className="options">
                <button className="btn-quantity" onClick={() => remove(item.id)}>-</button>
                <div className="quantity">{ item.quantity }</div>
                <button className="btn-quantity" onClick={() => add(item.id)}>+</button>
              </div>
            </div>
          )
        } 
      </div>
    )
  }
}

export default Meal
