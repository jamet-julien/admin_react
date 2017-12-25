import React from 'react';

import { 
  BrowserRouter as Router,
  hashHistory 
} from 'react-router-dom';

import {Menu} from './menu.js';
import {Main} from './main.js';

export default class App extends React.Component {

  render() {
    return (
      <Router history={hashHistory}>
        <div className="container">
          <Menu routes={this.props.routes}/>
          <Main routes={this.props.routes}/>
        </div>
      </Router>
    );
  }
}