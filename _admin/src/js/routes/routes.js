import {
  homeLayout,

  partenaireLayout,
  partenaireLayoutChild,
  //partenaireLayoutAdd,

  actualiteLayout,
  actualiteLayoutChild,
  //actualiteLayoutAdd,

  categorieLayout,
  categorieLayoutChild,
  //categorieLayoutAdd,

  critereLayout,
  critereLayoutChild,
  //critereLayoutAdd,

  personicxLayout,
  personicxLayoutChild,
  //personicxLayoutAdd,

  souscategorieLayout,
  souscategorieLayoutChild,
  //souscategorieLayoutAdd,

  tagLayout,
  tagLayoutChild,
  //tagLayoutAdd

} from '../pagelayout/pagelayout.js';

export const routesLib = [
  {
    path        : `${window.SETTING.root}/`,
    text        : "Dashboard",
    layout      : homeLayout
  },
  {
    path        : `${window.SETTING.root}/actualite`,
    text        : "Actualite",
    storeName   : "actualite",
    layout      : actualiteLayout,
    layoutChild : actualiteLayoutChild,
    layoutAdd   : actualiteLayoutChild
  },
  {
    path        : `${window.SETTING.root}/partenaire`,
    text        : "Partenaire",
    storeName   : "partenaire",
    layout      : partenaireLayout,
    layoutChild : partenaireLayoutChild,
    layoutAdd   : partenaireLayoutChild
  },
  {
    path        : `${window.SETTING.root}/categorie`,
    text        : "Categorie",
    storeName   : "categorie",
    layout      : categorieLayout,
    layoutChild : categorieLayoutChild,
    //layoutAdd   : categorieLayoutAdd
  },
  {
    path        : `${window.SETTING.root}/critere`,
    text        : "Critere",
    storeName   : "critere",
    layout      : critereLayout,
    layoutChild : critereLayoutChild,
    //layoutAdd   : critereLayoutAdd
  },
  {
    path        : `${window.SETTING.root}/personicx`,
    text        : "Segment clé en main",
    storeName   : "personicx",
    layout      : personicxLayout,
    layoutChild : personicxLayoutChild,
    //layoutAdd   : personicxLayoutAdd
  },
  {
    path        : `${window.SETTING.root}/souscategorie`,
    text        : "Sous-categorie",
    storeName   : "souscategorie",
    layout      : souscategorieLayout,
    layoutChild : souscategorieLayoutChild,
    //layoutAdd   : souscategorieLayoutAdd
  }/*,
  {
    path        : `${window.SETTING.root}/tag`,
    text        : "Tag",
    storeName   : "tag",
    layout      : tagLayout,
    layoutChild : tagLayoutChild,
    //layoutAdd   : tagLayoutAdd
  }*/
];
