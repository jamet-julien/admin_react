import React from 'react';
import { NavLink } from 'react-router-dom';
import SearchList, { computeFilter } from './searchlist.js';
import Store from '../store/store.js';

const updateItem = ( item) => {
  Store.dispatch({
    type: 'setItem',
    item
  });
}

export const ListText = ({ name, pathRoot}) => {
  
  let find = Store.getState().global.filter;

  return (
    <nav className="list">
      {
        Store.getState()[name].filter( computeFilter( name, find.toLocaleUpperCase()) ).map(( obj) =>{ 
          return (<NavLink
            key={obj.id}
            activeClassName="selected"
            className="listItem lien"
            onClick={()=>{
              updateItem( obj);
            }}
            to={`${pathRoot}/${obj.id}`}>
            {obj.name || obj.titre || obj.title || obj.slug}
          </NavLink>)
        })
      }
    </nav>
  );
  
};