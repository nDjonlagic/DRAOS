import React, { Component } from 'react'

class Unfinished extends Component {
  render() {
    const { cont, unfinished } = this.props

    return (
      <div className="wrapper-app" >
        <h3>Recent unfinished orders</h3>
        <span>
          Hey fellow user, we found some <b>unfinished orders</b> from before. We tought, maybe you want to continue some of them?
        </span>
        <div style={{ textAlign: 'left' }}>
          {
            unfinished.map((item, key) =>
              <div className="recent-unfinished">
                <a onClick={() => cont(item.order, item.order_items)} href="javascript:void(0)">
                  Continue order
                </a>
                {item.order_items.length} item(s): {item.order_items[0].meal.name}
                {
                  (item.order_items.length > 1)
                  &&
                  <inline>
                    &nbsp;and {item.order_items.length - 1} other
                  </inline>
                }
              </div>
            )
          }
        </div>
      </div>
    )
  }
}

export default Unfinished
