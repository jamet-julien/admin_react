import { createStore, combineReducers } from 'redux';
import { browserHistory } from 'react-router';
import Model    from '../api/model.js';

/**
 * 
 * @param {*} state 
 */
function updateItemState( state, currentItem){
  let i = 0,
    iLent = state.length;

  for (; i < state.length; i++) {
    if (state[i].id == currentItem.id) {
      state[i] = currentItem;
      break;
    }
  }
}

function deleteItemState( state, id) {
  let i = 0,index = -1,
    iLent = state.length;

  for (; i < iLent; i++) {
    if (state[i].id == id) {
      index = i;
      break;
    }
  }

  if(~index){
    state.splice( index, 1);
  }
}

function intersect(a, b) {
  var t;
  if (b.length > a.length) t = b, b = a, a = t; // indexOf to loop over shorter
  return a.filter(function (e) {
    return b.indexOf(e) > -1;
  });
};

function addItemState(  state, currentItem) {
  
  let aFind   = ['name', 'slug'];
  let [sAttr] = intersect( aFind, Object.keys( currentItem));

  state.push( currentItem);
  state.sort( (a, b) => {

    let nameA = a[sAttr].toUpperCase(),
        nameB = b[sAttr].toUpperCase();

    if (nameA < nameB) {
      return -1;
    }

    if (nameA > nameB) {
      return 1;
    }

    return 0;
  });
}

/**
 * 
 * @param {*} obj 
 */
function reply( obj){
  Store.dispatch(obj);
}


/**
 * 
 */
const buildReducer = ( filter, fn) => ( state = [], params) => {

  let [ sFilter, method] = (params.type) ? params.type.split('/') : ['-', '-'];

  if (filter.toLocaleUpperCase() != sFilter){
    return state;
  }

  params.type = method;

  return fn( state, params);
};

/** */
function listenerPartenaire(state, params) {
  if (params.type == 'set') {
    state = params.data;
  }
  return state;
}

function listenerActualite( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

/** */
function listenerCategorie( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

/** */
function listenerCritere( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

/** */
function listenerPersonicx( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

/** */
function listenerSouscategorie( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

/** */
function listenerTag( state, params) {
  if(params.type == 'set' ){
    state = params.data;
  }
  return state;
}

let globalInit = {
  filter        : '',
  filterDefault : '',
  needSaved     : false,
  currentItem   : {}
};

/** */
function global( state = globalInit, params){

  if( params.type == 'setFilter'){
    state.filter = params.filter;
  }

  if( params.type == 'setItem') {
    state.currentItem = {...params.item};
    state.needSaved   = false;
  }

  if( params.type == 'changePage') {
    state.filterDefault = state.filter;
  }

  if( params.type == 'updateItem'){
    let { attr, value, item} = params.update;

    state.needSaved = (item[attr] != value) || attr == 'tag';
    
    if(!item[attr]){
      item[attr] = value;
      state.currentItem[attr] = value
    }

    state.currentItem[ attr ] = value;
  }

  if( params.type == 'updateOk'){
    updateItemState( params.stateSource, params.data);
    state.currentItem = {...params.data};
    state.needSaved   = false;
  }

  if (params.type == 'deleteOk') {
    let path = `${window.SETTING.root}/${params.storeName}`;
    deleteItemState( params.stateSource, params.id);
    state.currentItem = {};
    history.pushState( null, null, path);
  }

  if (params.type == 'addOk') {
    let path = `${window.SETTING.root}/${params.storeName}/${params.data.id}`;
    addItemState( params.stateSource, params.data);
    state.currentItem = {...params.data};
    state.needSaved   = false;
    history.pushState( null, null, path);
  }

  if (params.type == 'updateCurrentItem'){

    let storeName    = params.storeName,
        stateSource  = Store.getState()[storeName];

    Model[storeName].update(state.currentItem.id, state.currentItem)
      .then(({ message, data})=>{
        if (message == 'success'){
          reply({ type: 'updateOk', stateSource, data, item : params.item});
        }
      });
   
  }

  if (params.type == 'deleteCurrentItem') {

    let storeName = params.storeName,
      stateSource = Store.getState()[storeName];

    Model[storeName].delete(state.currentItem.id)
      .then(({ message, data }) => {
        if (message == 'success') {
          reply({ type: 'deleteOk', storeName, stateSource,  id: state.currentItem.id });
        }
      });

  }

  if (params.type == 'addCurrentItem') {
    
    let storeName = params.storeName,
    stateSource = Store.getState()[storeName];
    
    Model[storeName].add( state.currentItem)
      .then(({ message, data }) => {
        if (message == 'success') {
          reply({ type: 'addOk', storeName, stateSource,  data, item: params.item });
        }
      });

  }

  return state;
}

const Store = createStore(
  combineReducers({
    global,       
    partenaire    : buildReducer( 'PARTENAIRE', listenerPartenaire),
    actualite     : buildReducer( 'ACTUALITE', listenerActualite),
    categorie     : buildReducer( 'CATEGORIE', listenerCategorie),
    critere       : buildReducer( 'CRITERE', listenerCritere),
    personicx     : buildReducer( 'PERSONICX', listenerPersonicx),
    souscategorie : buildReducer( 'SOUSCATEGORIE', listenerSouscategorie),
    tag           : buildReducer( 'TAG', listenerTag)
  })
);

export default Store;

export const onReady = ( fn) => {

  let models = [
    'partenaire',
    'actualite',
    'categorie',
    'critere',
    'personicx',
    'souscategorie',
    'tag'
  ];

  let lastPromise = models.reduce(( promise, name, index)=>{

    return promise.then((obj = {}) =>{

      if( index){

        let prevName = models[ index-1 ].toLocaleUpperCase();
        Store.dispatch({ 
          type : `${prevName}/set`,
          data : obj.data
        });

      } 

      return Model[name].all();
    });

  }, Promise.resolve());

  lastPromise.then(({data})=>{
    Store.dispatch({ type: `TAG/set`, data });
    fn();
  });

};



