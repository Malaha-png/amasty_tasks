-- написать запрос, который бы выводил полное имя и баланс человека на данный момент 
SELECT persons.id, persons.fullname, SUM(transactions.amount) as Amount FROM persons INNER JOIN transactions ON persons.id = transactions.to_person_id GROUP BY persons.id, persons.fullname

-- написать запрос, который бы выводил имя человека, который участвовал в передаче денег наибольшее количество раз
SELECT persons.fullname,((SELECT COUNT(*) FROM transactions WHERE transactions.from_person_id=persons.id) +(SELECT COUNT(*) FROM transactions  WHERE transactions.to_person_id=persons.id)) AS Summ FROM persons ORDER BY Summ DESC LIMIT 1

-- написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города
SELECT transactions.transaction_id FROM transactions INNER JOIN persons on persons.id = transactions.from_person_id WHERE persons.city_id= (SELECT persons.city_id FROM persons WHERE persons.id=transactions.to_person_id)