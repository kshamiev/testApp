SELECT `Name`, COUNT(*) FROM Citys GROUP BY 1 ORDER BY 2 DESC;
SELECT ID, `Name` FROM Citys WHERE  `Name` = 'Бобруйск';

SELECT `Name`, COUNT(*) FROM `Users` GROUP BY 1 ORDER BY 2 DESC;
SELECT ID, `Name` FROM `Users` WHERE `Name` IN ('Name');
SELECT ID, `Name` FROM `Users` WHERE ID IN (23, 26);
SELECT COUNT(*) FROM `Users`
-- DELETE FROM Citys;