
function getQueryString(object) {
  return Object.keys( object).map( function(item) {
    return (typeof object[item] == "string")?[
      encodeURIComponent( item),
      '=',
      encodeURIComponent( object[ item])
    ].join('') : [
      encodeURIComponent(item),
      '=',
      encodeURIComponent( JSON.stringify( object[item] ))
    ].join('');
  }).join('&');
}

/**
 * @param  {String} model, {}
 * @return {Function} { all, get, delete, add, update}
 */
const fetchBuild = ( model ) => ( children = [], opt = {}) =>{
  let
    root    = window.SETTING.root.replace('/admin', ''),
    url     = [ `${root}`, model],
    sUrl    = url.concat( children).join( '/'),
    entete  = {
      crossDomain : true,
      method      : 'GET',
      credentials : 'same-origin',
      headers     : {
        'Cache-Control' : 'no-cache',
        'Content-Type'  : 'application/x-www-form-urlencoded'
      }
    };

  if( opt.body){
    opt.body = getQueryString( opt.body);
  }

  return fetch( `${sUrl}.json`, Object.assign( entete, opt))
              .then( (result) => result.json());
};

/**
 * @param  {Function} fn
 * @return {Object} { all, get, delete, add, update}
 */
const Api = ( fn) => ({
  all : fn,
  get : ( id ) => fn( [id]),
  add : ( formData)=> fn( [], { 
    method : 'POST',
    body   : formData
  }),
  update : ( id, formData) => fn([ id], {
    method : 'PUT',
    body   : formData
  }),
  delete : (id) => fn([id], { method: 'DELETE', body: {ref : 'id'}})
});



export default (function(){

  let Model = {};

  [
    'partenaire',
    'actualite',
    'categorie',
    'categoriecritere',
    'categoriesouscategorie',
    'critere',
    'personicx',
    'sociodemographique',
    'souscategorie',
    'souscategoriecritere',
    'tag',
    'tagcritere',
    'user'
  ].map(( sName) => {
    Model[ sName ] = Api( fetchBuild( sName.toLocaleLowerCase()));
  });

  return Model;
})();