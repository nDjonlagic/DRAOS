import React from 'react'

const Pay = ({ pay, empty_order, text }) => (
  <button className="go-back__button" onClick={pay} disabled={empty_order}>
    {
      (text == null)
      &&
      <span>
        Proceed to payment 
      </span>
    }
    {
      (text != null)
      &&
      <span>
        { text }
      </span>
    }
  </button>
)

export default Pay