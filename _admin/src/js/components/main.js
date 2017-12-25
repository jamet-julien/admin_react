import React from 'react';
import { Route } from 'react-router-dom';

export const Main = ({routes}) =>{
  return(
    <div className="main">
      {
        routes.map(( oRoute, index)=>{
          return( 
          <Route
            exact={index==0}
            key={index}
            path={oRoute.path}
            component={oRoute.layout}/>);
        })
      }
      {
         routes.filter(obj => obj.layoutAdd).map((oRoute, index) => {
           return (<Route
             key={`add-${index}`}
             exact={true}
             path={oRoute.path}
             storeName={oRoute.storeName}
             component={oRoute.layoutAdd} />);
         })
      }
      {
        routes.filter(obj => obj.layoutChild).map((oRoute, index) => {
          return (<Route
            key={`child-${index}`}
            path={`${oRoute.path}/:id`}
            storeName={oRoute.storeName}
            component={oRoute.layoutChild}/>);
        })
      }
    </div>
  );
};