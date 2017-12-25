import React              from 'react';
import ReactDOM           from 'react-dom';
import App                from './components/app.js';
import {routesLib}        from './routes/routes.js';
import Store, { onReady } from './store/store.js';

const $APP = document.getElementById('app');


let render = () =>{
  ReactDOM.render(
    <App routes={routesLib}/>,
    $APP
  );
};

if ($APP){
  
  onReady( () =>{
    render();
    Store.subscribe(render);
  });
  
}