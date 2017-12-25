import React      from 'react';
import {ListText} from '../components/listitem.js';
import SearchList from '../components/searchlist.js';
import formLayout from './editlayout.js';
import Store      from '../store/store.js';
import { withRouter } from 'react-router-dom';

const getListComponent = (name) =>(
  <div className="sidebar">
    <SearchList/>
    <ListText pathRoot={`${window.SETTING.root}/${name}`} name={name} />
  </div>
);

const getFormComponent = ( model, update = true) =>{ 
  let item = Store.getState().global.currentItem;
  return formLayout[model]( item, update);
};

export const homeLayout = ( props) =>(
  <div>
    <h1>Bienvenue</h1>
  </div>
);

export const partenaireLayout = (props) => {
  return getListComponent('partenaire');
};
export const actualiteLayout = ( props) =>{
  return getListComponent('actualite');
};
export const categorieLayout = ( props) =>{
  return getListComponent('categorie');
};
export const critereLayout = ( props) =>{
  return getListComponent('critere');
};
export const personicxLayout = ( props) =>{
  return getListComponent('personicx');
};
export const souscategorieLayout = ( props) =>{
  return getListComponent( 'souscategorie');
};
export const tagLayout = ( props) =>{
  return getListComponent('tag');
}

/***********************************************************
 * 
 ***********************************************************/

class LayoutChild extends React.Component{
  
  componentWillMount(){
    let [valueEnd, valueBefore] = this.props.match.url.split('/').reverse(),
      item;

    if(/\d+/.test( valueEnd )){
      item = Store.getState()[valueBefore].find((el) => el.id == valueEnd);
    }else{
      item = { ...Store.getState()[valueEnd][0] };
      for (let attr in item) item[attr] = '';
    }

    Store.dispatch({
      type: 'setItem',
      item
    });
  }

}

export class partenaireLayoutChild extends LayoutChild {
  render() {
    return getFormComponent('partenaire');
  }
}

export class actualiteLayoutChild extends LayoutChild {
  render(){
    return getFormComponent( 'actualite');
  }
}

export class categorieLayoutChild extends LayoutChild {
  render(){
    return getFormComponent('categorie');
  }
}

export class critereLayoutChild extends LayoutChild {
  render(){
    return getFormComponent('critere');
  }
}

export class personicxLayoutChild extends LayoutChild {
  render(){
    return getFormComponent('personicx');
  }
}

export class souscategorieLayoutChild extends LayoutChild {
  render(){
    return getFormComponent('souscategorie');
  }
}

export class tagLayoutChild extends LayoutChild {
  render(){
    return getFormComponent('tag');
  }
}