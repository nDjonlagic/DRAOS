import React, { Component } from 'react'

class Start extends Component {
  render() {
    const { start } = this.props

    return (
      <div className="wrapper-app" style={{  backgroundImage: "url(" + "https://wallpaperaccess.com/full/1306229.jpg" + ")",}}>
          <div style={{textAlign: 'center', background: '#000000', opacity: '0.8'}}>

          <h3>Welcome to Tasty To Go order</h3>
        <span>
              Hungry? Do not hesitate but click on the button below and quench your hunger in a few moments.
        </span>
        <button className="button-start_order" onClick={start}>
          Start your order
        </button>
          </div>

      </div>
    )
  }
}

export default Start
