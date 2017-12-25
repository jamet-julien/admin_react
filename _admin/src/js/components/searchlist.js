import React from 'react';
import Store from '../store/store.js';

const filter = {
    actualite     : ( obj, find) => (!!~obj.name.toLocaleUpperCase().indexOf( find)),
    categorie     : ( obj, find) => (!!~obj.name.toLocaleUpperCase().indexOf( find)),
    critere       : ( obj, find) => (!!~obj.name.toLocaleUpperCase().indexOf( find)),
    personicx     : ( obj, find) => (!!~obj.name.toLocaleUpperCase().indexOf( find)),
    souscategorie : ( obj, find) => (!!~obj.name.toLocaleUpperCase().indexOf( find)),
    tag           : ( obj, find) => (!!~obj.slug.toLocaleUpperCase().indexOf( find))
};

export const computeFilter = (name, find) => (obj) =>( find == '' || filter[name](obj, find));

export default class Search extends React.Component{
   
    render(){
      return (
          <span className="search">
              <input 
                defaultValue={Store.getState().global.filterDefault}
                className="searchInput"
                onChange={({target})=>{
                    
                    if (target.value.length > 2 || target.value.length == 0){
                        Store.dispatch({
                            type  : `setFilter`,
                            filter: target.value
                        });
                    }
                
            }}/>
        </span>
      );
    }

}