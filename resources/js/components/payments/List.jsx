import React, { Component } from 'react'

class List extends Component {
  render() {
    const { payments, paid } = this.props 

    return (
      <div className="current-order"> 
        <div className="current-order__heading">
          Orders ready for payment
        </div>
        {
          payments.map((item, key) => (
            <div>
              <div style={{ display: 'inline-block', width: '50%', fontSize: '24px', textAlign: 'center', lineHeight: '60px' }}>#{ item.id }</div>
              <div style={{ display: 'inline-block', width: '50%' }}>
                <button className="current-order__button" onClick={() => paid(item.id)}>
                  Order paid 
                </button>
              </div>
            </div>
          ))
        }
      </div>
    )
  }
}

export default List