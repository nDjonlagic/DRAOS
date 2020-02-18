import React, { Component } from 'react'

class Item extends Component {
  constructor() {
    super()

    this.state = {
      ready: false
    }
  }

  readytoggle = () => {
    this.setState({
      ready: !this.state.ready
    })
  }

  render() {
    const { data } = this.props

    return (
      <div onClick={this.readytoggle} className={(this.state.ready) ? "current-item current-item__ready" : "current-item"}>
        <div className="current-item__name">
          { data.meal.name }
        </div>
        <div className="current-item__quantity">
          { data.quantity } 
        </div>
      </div>
    )
  }
}

export default Item