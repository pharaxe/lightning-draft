DELETE FROM sets WHERE name LIKE "Unh%"; 
DELETE FROM sets WHERE name LIKE "Ung%"; 

DELETE FROM cards WHERE cardid IN (SELECT * FROM 
   (SELECT cards.cardid 
      FROM cards LEFT JOIN arts ON
      (cards.cardid=arts.cardid)
      LEFT JOIN sets ON
      (arts.setid = sets.setid)
      WHERE (sets.code LIKE "CNS" OR sets.code LIKE "CN2") 
       AND (cards.ability LIKE "%draft%" OR cards.ability LIKE "%note%"))tmpTable);

DELETE FROM cards WHERE `ability` like "%banding%";
DELETE FROM cards WHERE `ability` like "%bands with%";

DELETE FROM cards WHERE cardid IN (SELECT * FROM 
   (SELECT cards.cardid 
      FROM cards LEFT JOIN arts ON 
      (cards.cardid=arts.cardid) 
      WHERE arts.cardid IS NULL)tmpTable);
