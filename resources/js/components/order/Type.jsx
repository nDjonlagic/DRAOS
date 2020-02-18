import React, { Component } from 'react'
import Back from "./actions/Back";
import New from "./actions/New";

class Type extends Component {
  render() {
    const { types, order, select, pay } = this.props

    return (
      <div className="flex-grid">
          <button className="go-back__button" onClick={event =>  window.location.href='http://localhost:8080/fss/public/'}>
              Back
          </button>
          {
            types.map((item, key) =>
            <div className="flex-grid__item">
              <div className="type-item" onClick={() => select(item.id, order.id)}>
                <h3>{ item.title }</h3>
              </div>
            </div>
          )
        }
      </div>
    )
  }
}

export default Type
