import React, { Component } from 'react'

class List extends Component {
  render() {
    const { queue, take, ac, cont } = this.props 
    
    return (
      <div className="wrapper-app">
        <div className="current-order" style={{ width: '100%' }}> 
          {
            queue.length > 0
            &&
            <div className="current-order__info">
              Orders in the queue: <span>{ queue.length } orders</span>
            </div>
          }
          {
            queue.length == 0
            &&
            <div className="current-order__info">
              Orders in the queue: <span>no orders at this moment</span>
            </div>
          }
          <button className="current-order__button" onClick={take}>
            Take next order
          </button>
        </div>
        <div className="active-orders" style={{ width: '100%' }}>
          <div className="current-order"> 
            <div className="current-order__heading">
              Active orders
            </div>
            {
              ac.map((item, key) => (
                <div>
                  <div style={{ display: 'inline-block', width: '50%', fontSize: '24px', textAlign: 'center', lineHeight: '60px' }}>#{ item.id }</div>
                  <div style={{ display: 'inline-block', width: '50%' }}>
                    <button className="current-order__button" onClick={() => cont(item.id)}>
                      Continue 
                    </button>
                  </div>
                </div>
              ))
            }
            {
              (ac.length == 0)
              &&
              <div>
                <div className="current-order__info">
                  No active orders
                </div>
              </div>
            }
          </div>
        </div>
      </div>
    )
  }
}

export default List