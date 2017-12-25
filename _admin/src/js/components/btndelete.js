import React from 'react';
import Store from '../store/store.js';

const onDelete = ( e, item, storeName) => {
  Store.dispatch({
    type: 'deleteCurrentItem',
    item,
    storeName
  });
  e.preventDefault();
};

class BtnDelete extends React.Component {

  render(){
    return this.props.item.id? (
      <a onClick={(e)=>{
        onDelete(e, this.props.item, this.props.type);
      }} className="lienDelete">Supprimer</a>
    ) : null;
  }

}

export default BtnDelete;
