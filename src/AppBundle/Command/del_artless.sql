DELETE FROM cards WHERE cardid IN (SELECT * FROM 
   (SELECT cards.cardid 
      FROM cards LEFT JOIN arts ON 
      (cards.cardid=arts.cardid) 
      WHERE arts.cardid IS NULL)tmpTable);

DELETE FROM sets WHERE name LIKE "Unh%"; 
DELETE FROM sets WHERE name LIKE "Ung%"; 
