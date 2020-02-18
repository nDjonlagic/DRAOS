import React, { Component } from 'react'

class Prepare extends Component {
  render() {
    return (
      <div className="wrapper-app">
        <h3>Your order is being prepared</h3>
        <span>
          Please don't close this window. We will notify you once your order is prepared. In the mean-time don't forget to check-out all the other meals we have in our fast-food.
        </span>
        <img src={'http://www.laplatashops.com/wp-content/uploads//2018/04/start-burger.gif'} />
      </div>
    )
  }
}

export default Prepare
