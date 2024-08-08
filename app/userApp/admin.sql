INSERT INTO `super_user`(`super_id`, `super_name`, `super_password`, `super_createdAt`) VALUES (1,'admin@music.com','21232f297a57a5a743894a0e4a801fc3',NOW());

SELECT * FROM `user_details` WHERE 1

SELECT original_l2_name, SUM(song_income) AS Total_Income
FROM balance
GROUP BY original_l2_name
ORDER BY Total_Income DESC
LIMIT 10;




*/

SELECT 
    balance.original_l2_name,
    songs.song_title,
    songs.content_isPremium,
    songs.content_premiumAt,
    balance.balance_date,
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_title = balance.song_name
WHERE 
    balance.balance_date >= songs.content_premiumAt
    AND songs.content_isPremium = 'Yes'
    AND balance.balance_date BETWEEN '2024-05-01' AND '2024-05-31'
GROUP BY 
    balance.original_l2_name;

SELECT 
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    balance.balance_date >= songs.content_premiumAt
    AND songs.content_isPremium = 'Yes';




SELECT 

    SUM(balance.song_income)
FROM 
    balance
INNER JOIN 
    songs ON songs.song_title = balance.song_name
WHERE
    (
        (songs.content_isPremium = 'Yes' AND balance.balance_date < songs.content_premiumAt)
        OR songs.content_isPremium = 'No'
        OR (songs.content_isPremium = 'Yes' AND balance.balance_date >= songs.content_premiumAt)
    );



SELECT 
    song_title, 
    COUNT(*) AS NumOccurrences
FROM 
    songs
GROUP BY 
    song_title
HAVING 
    COUNT(*) > 1;


SELECT SUM(song_income) from balance WHERE original_l2_name  = 'Nairwks Production'

SELECT     
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    (
        (songs.content_isPremium = 'Yes' AND balance.balance_date <= songs.content_premiumAt)
        OR songs.content_isPremium = 'No'
    )
    AND songs.content_createdBy = 'Y3G7L1XT'


SELECT 
    balance.song_name,
    songs.song_title,
    songs.content_isPremium,
    songs.content_premiumAt,
    balance.balance_date,
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_title = balance.song_name
WHERE 
    balance.balance_date >= songs.content_premiumAt
    AND songs.content_isPremium = 'Yes'
GROUP BY 
    balance.song_name, songs.song_title, songs.content_isPremium, songs.content_premiumAt, balance.balance_date;
