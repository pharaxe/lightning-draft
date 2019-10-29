export class Card {
   id: number;
   name: string;
   url: string;
   cmc: number;
   mana_cost: string;
   mana_symbols: string[];

   multiverseid: number;
   rarity: string;

   constructor(config: any) {
      this.id = config.id;
      this.name = config.name;
      this.url = config.url;
      this.mana_cost = config.mana_cost;
      this.cmc = config.cmc;

      this.mana_symbols = [];

      this.parseManaCost();
   }

   parseManaCost() {
      if (this.mana_cost) {
         let manas = this.mana_cost.toLowerCase();
         manas = manas.replace(/{/g, '');
         manas = manas.replace(/\//g, '');
         manas = manas.replace(/}/g, ',');
         manas = manas.substring(0, manas.length-1); // trim off leading comma
         this.mana_symbols = manas.split(",");
      } 
   }

   getAdjustedCmc() {
      let adjusted_cmc = this.cmc;

      if (this.cmc != 0 && this.mana_cost.indexOf('X') != -1) { // nonartifact X spells sort high
         adjusted_cmc += 8;
      }

      return adjusted_cmc;
   }
}

// TODO put this in a service, global variables are bad
export const basic_lands = {
   'white': new Card({
      'cmc': -1,
      'name': '8 Plains',
      'url': 'https://img.lightningdraft.online/plains.jpg',
      'mana_cost': ''}),
   'blue': new Card({
      'cmc': -1,
      'name': '8 Islands',
      'url': 'https://img.lightningdraft.online/island.jpg',
      'mana_cost': ''}),
   'black': new Card({
      'cmc': -1,
      'name': '8 Swamps',
      'url': 'https://img.lightningdraft.online/swamp.jpg',
      'mana_cost': ''}),
   'red': new Card({
      'cmc': -1,
      'name': '8 Mountains',
      'url': 'https://img.lightningdraft.online/mountain.jpg',
      'mana_cost': ''}),
   'green': new Card({
      'cmc': -1,
      'name': '8 Forests',
      'url': 'https://img.lightningdraft.online/forest.jpg',
      'mana_cost': ''}),
}
