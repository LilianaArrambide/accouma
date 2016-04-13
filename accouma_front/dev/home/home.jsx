import React from 'react'
import {Card, TextInput, Button} from 'Belle'
import Base from '../common/base'
import {InputP, CardP} from '../common/styleProperties'
import {Link} from 'react-router'

class Home extends React.Component {
  render() {
    let CardS = CardP();
    CardS.margin = '10px';
    return (
      <Base section="home" >
        <Card className="home-block" style={CardS}>
          <h2 className="home-blockTitle">Users</h2>
          <Link className="home-blockLink" to={'/users'}>Users</Link>
        </Card>
        <Card className="home-block" style={CardS}>
          <h2 className="home-blockTitle">Registers</h2>
          <Link className="home-blockLink" to={'/registers'}>Registers</Link>
        </Card>
        <Card className="home-block" style={CardS}>
          <h2 className="home-blockTitle">Accounts</h2>
          <Link className="home-blockLink" to={'/accounts'}>Accounts</Link>
        </Card>
      </Base>
    )
  }
}

export default Home
