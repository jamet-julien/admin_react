import React       from 'react';
import { NavLink } from 'react-router-dom';
import Store       from '../store/store.js';


export const Menu = ({routes}) => {
  return(
    <ul
      className="menu">
      {
        routes.map((oRoute, index) =>
          <li key={index}><NavLink
            key={index}
            activeClassName="selected"
            className="lien"
            onClick={()=>{
                Store.dispatch({
                    type  : `changePage`
                });
            }}
            to={oRoute.path}>
            {oRoute.text}
          </NavLink></li>
        )
      }
      <li><a href="?logout" className="lien" >Logout</a></li>
    </ul>
  );
};
