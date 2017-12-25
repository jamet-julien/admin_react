import React from 'react';
import Store from '../store/store.js';

const onSupp = (tag, item, list) => {
  deleteItem(tag, list);
  onChange('tag', item, list);
};

const onAdd = (tag, item, list) => {
  addItem( tag, list);
  onChange('tag', item, list);
};

const onChange = (attr, item, value) => {
   Store.dispatch({
    type: 'updateItem',
    update: {
      attr,
      value,
      item
    }
  });
};

const addItem = ( value, list) => {
  list.push(value);
}

const deleteItem = ( tag, tagList) => {

  let pos  = tagList.indexOf( tag);

  if( ~pos){
    tagList.splice( pos, 1);
  }

};


class TagItem extends React.Component{
  render(){
    return(
      <li>
        {this.props.tag}
        <span onClick={(e) => {
          onSupp( this.props.tag, this.props.item, this.props.list);
        }}></span>
      </li>
    );
  }
}

class TagList extends React.Component {
  
  state = {
    tag        : [],
    inputValue : ''
  };

  componentWillMount() {
    this.setState({
      tag        : [...this.props.item.tag],
      inputValue : ''
    });
  }

  reset(){
    this.setState({
      inputValue: ''
    });
  }

  updateInputValue(target){
    this.setState({
      inputValue: target.value
    });
  }

  render() {
    return (<fieldset
      className="edit">

      <label
        className="editLabel">
        {this.props.label}
      </label>

      <ul className="tagList">
        {this.state.tag.map((name, index)=>{
          return (<TagItem key={index} tag={name} item={this.props.item} list={this.state.tag} />);
        })}
        <li>
          <input type="text" name="tag" defaultValue={this.state.inputValue} placeholder="nouveau tag" onChange={({ target })=>{this.updateInputValue(target)}}/>
          <button onClick={(e) => {
              onAdd( this.state.inputValue, this.props.item, this.state.tag);
              this.reset();
              e.preventDefault();
          }}>
        </button></li>
      </ul>

    </fieldset>
    );
  }

}

export default TagList;