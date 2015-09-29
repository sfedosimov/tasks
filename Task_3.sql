SELECT d1.type, d1.value 
FROM data as d1 
JOIN (select type, max(date) as date from data group by type) as d2
ON d1.type=d2.type AND d1.date=d2.date;


SELECT type, max(date) as date, SUBSTR(MAX(CONCAT(date, value)), 11) as value
FROM data GROUP BY type;


SELECT * FROM data d where not exists
(SELECT * FROM data where type = d.type and date > d.date );


SELECT d1.* FROM data d1 LEFT JOIN data d2
ON d1.type = d2.type AND d1.date < d2.date
WHERE d2.date IS NULL;