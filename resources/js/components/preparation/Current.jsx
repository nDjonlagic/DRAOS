import React, { Component } from 'react'

import Item from './Current/Item'

class Current extends Component {
  render() {
    const { items, queue, finish, take } = this.props 

    return (
      <div className="current-order" style={{ width: '100%' }}> 
        <div className="current-order__heading">
          Preparing
        </div>
        {
          items.length == 0
          &&
          <div>
            <div className="current-order__info">
              Nothing selected
            </div>
          </div>
        }
        {
          items.length != 0
          &&
          <div>
            {
              items.map((item, key) => 
                <Item data={item} />
              )
            }
            <button className="current-order__button" onClick={finish}>
              Order is ready
            </button>
          </div>
        }
      </div>
    )
  }
}

export default Current
