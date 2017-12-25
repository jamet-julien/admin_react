import React  from 'react';
import { TextareaCustom, InputCustom, ButtonCustom, FileCustom } from '../components/inputcustom.js';
import BtnDelete from '../components/btndelete.js';
import TagList   from '../components/taglist.js';
import Store     from '../store/store.js';

const onSubmitUpdate = (e, item, storeName) => {
  Store.dispatch({
    type: 'updateCurrentItem',
    item,
    storeName
  });
  e.preventDefault();
};

const onSubmitAdd = (e, item, storeName) => {

  Store.dispatch({
    type: 'addCurrentItem',
    item,
    storeName
  });

  e.preventDefault();
};

const actualite = ( item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if (item.id){
            onSubmitUpdate( e, item, 'actualite');
          }else{
            onSubmitAdd( e, item, 'actualite');
          }
        }}>
        <BtnDelete item={item} type="actualite" />

        <FileCustom
            type="file"
            name="image"
            label="Image"
            item={item}
            defaultValue={ item.image || ''} />

        <InputCustom
            type="text"
            name="name"
            label="Titre"
            item={item}
            defaultValue={item.name || ''}/>

        <InputCustom

            type="text"
            name="label"
            label="Label"
            item={item}
            defaultValue={item.label || ''}/>

        <TextareaCustom
            type="text"
            name="content"
            label="Resume"
            item={item}
            defaultValue={item.content || ''}/>

        <TextareaCustom
          type="text"
          name="content_suite"
          label="Contenu"
          item={item}
          defaultValue={item.content_suite || ''} />

        <ButtonCustom value="Saved"/>
      </form>
    </div >
  );
};

const partenaire = (item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e) => {
          if (item.id) {
            onSubmitUpdate(e, item, 'partenaire');
          } else {
            onSubmitAdd(e, item, 'partenaire');
          }
        }}>
        <BtnDelete item={item} type="partenaire" />

        <FileCustom
          type="file"
          name="image"
          label="Image"
          item={item}
          defaultValue={item.image || ''} />

        <InputCustom
          type="text"
          name="name"
          label="Titre"
          item={item}
          defaultValue={item.name || ''} />

        <ButtonCustom value="Saved" />
      </form>
    </div >
  );
};

const categorie = ( item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if (item.id){
            onSubmitUpdate( e, item, 'categorie');
          }else{
            onSubmitAdd( e, item, 'categorie');
          }
        }}>
        <InputCustom
          type="text"
          name="name"
          label="Titre"
          item={item}
          defaultValue={item.name || ''}/>

        <ButtonCustom value="Saved"/>
      </form>
    </div>
  );
};

const critere = (item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if (item.id){
            onSubmitUpdate( e, item, 'critere');
          }else{
            onSubmitAdd(e, item, 'critere');
          }
        }}>
        <InputCustom
          type="text"
          name="name"
          label="Titre"
          item={item}
          defaultValue={item.name || ''}/>

        <InputCustom
          type="text"
          name="facebook"
          label="Volume Facebook"
          item={item}
          defaultValue={item.facebook || ''}/>

        <InputCustom
          type="text"
          name="dbm"
          label="Volume DBM"
          item={item}
          defaultValue={item.dbm || ''}/>

        <TagList label="Tag" tagList={item.tag} item={item} />

        <TextareaCustom
          type="text"
          name="label"
          label="Label"
          item={item}
          defaultValue={item.definition || ''} />

        <ButtonCustom value="Saved"/>
      </form>

    </div >
  );
};

const personicx = (item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if (item.id){
            onSubmitUpdate( e, item, 'personicx');
          }else{
            onSubmitUpdate( e, item, 'personicx');
          }
        }}>
        <InputCustom
            type="text"
            name="name"
            label="Titre"
            item={item}
            defaultValue={item.name || ''}/>

        <TextareaCustom
            type="text"
            name="descriptif"
            label="Label"
            item={item}
            defaultValue={item.descriptif || ''}/>

        <ButtonCustom value="Saved"/>
      </form>
    </div >
  );
};

const souscategorie = ( item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if( update){
            onSubmitUpdate(e, item, 'souscategorie');
          }else{
            onSubmitAdd(e, item, 'souscategorie');
          }
        }}>
        <InputCustom
          type="text"
          name="name"
          label="Titre"
          item={item}
          defaultValue={item.name || ''}/>

        <ButtonCustom value="Saved"/>
      </form>
    </div >
  );
};

const tag = ( item) => {

  return (
    <div key={item.id} className="content">
      <form
        onSubmit={(e)=>{
          if (item.id){
            onSubmitUpdate(e, item, 'tag');
          }else{
            onSubmitAdd(e, item, 'tag');
          }
        }}>

        <InputCustom
          type="text"
          name="name"
          label="Titre"
          item={item}
          defaultValue={item.name || ''} />

        <ButtonCustom value="Saved"/>
      </form>
    </div >
  );
};

export default {
  partenaire,
  actualite,
  categorie,
  critere,
  personicx,
  souscategorie,
  tag
};
