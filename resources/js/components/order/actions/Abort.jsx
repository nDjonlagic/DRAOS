import React from 'react'

const Abort = ({ abort }) => (
  <button className="go-back__button button-abort" onClick={abort}>
    Abort order
  </button>
)

export default Abort