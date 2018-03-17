export class Color {
   id: number;
   name: string;
   symbol: string;

   constructor(name, symbol) {
      this.name = name;
      this.symbol = symbol;
   }
}

// there's gotta be a better place for these. I'm only using them for playground tests.
export const white = new Color("White", "W");
export const blue = new Color("Blue", "U");
export const black = new Color("Black", "B");
export const red = new Color("Red", "R");
export const green = new Color("Green", "G");
