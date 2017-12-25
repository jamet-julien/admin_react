import React from 'react';
import Store from '../store/store.js';


const onChange = (e, item) =>{
  let attr = e.target.name,
     value = e.target.value;

  Store.dispatch({
    type   : 'updateItem',
    update : {
      attr, 
      value,
      item
    }
  });
};


const onChangeFile = (e, item, parent) => {
  let attr    = e.target.name,
    fileData  = e.target.files[0],
    value     = e.target.value,
   oReader    = new FileReader();

  oReader.onloadend = (eReader)=>{

    if(eReader.target.readyState == FileReader.DONE) { // DONE == 2

      parent.setState({
        image: eReader.target.result
      });

      Store.dispatch({
        type: 'updateItem',
        update: {
          attr,
          value : eReader.target.result,
          item
        }
      });
     
    }
  };

  if( value != ''){
    oReader.readAsDataURL( fileData);
  }else{

    let srcImage = parent.state.tmpItem[ attr ];

    if( srcImage){
      parent.setState({
        image: srcImage
      });
    }
  }
};

export class TextareaCustom extends React.Component {

  state = {
    tmpItem : {}
  };

  componentWillMount() {
    this.setState({
      tmpItem: { ...this.props.item }
    });
  }

  render() {
    return (
      <fieldset
        className="edit">

        <label
          className="editLabel">
          {this.props.label}
        </label>

        <textarea
          { ... this.props}

          onChange={(e)=>{
            onChange( e, this.state.tmpItem);
          }} 
          className="editTextarea"/>

      </fieldset>
    );

  }
}

export class InputCustom extends React.Component{
  state = {
    tmpItem : {}
  };

  componentWillMount(){
    this.setState({
      tmpItem : {...this.props.item}
    });
  }
  
  render(){
    return (
      <fieldset
        className="edit">

          <label
            className="editLabel">
          {this.props.label}
          </label>

          <input
            { ... this.props}

            onChange={(e)=>{
              onChange( e, this.state.tmpItem);
            }} 
            className="editInput" />
              
      </fieldset>
    );

  }
}

export class ButtonCustom extends React.Component {

  render() {
    let disabled = Store.getState().global.needSaved;
    return (
      <fieldset
        className="edit editright">

        <button
          disabled={!disabled}
          className="editButton">
          {this.props.value}
        </button>

      </fieldset>
    );

  }
}


export class FileCustom extends React.Component {
  state = {
    tmpItem: {},
    image  : '',
  };

  componentWillMount() {
    this.setState({
      tmpItem: { ...this.props.item },
      image  : this.props.defaultValue || false
    });
  }

  render() {
    return (
      <fieldset
        className="edit">

        <label
          className="editLabel">
          {this.props.label}
        </label>
        {this.state.image && <img
          className="editPreview"
          src={this.state.image} />}
        <input
          { ... this.props}
          type="file"
          onChange={(e) => {
            onChangeFile( e, this.state.tmpItem, this);
          }}
          className="editInput" />

      </fieldset>
    );

  }
}
