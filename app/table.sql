
-- BANK DETAILS TABLE --
CREATE TABLE bank_details(
    bank_id int not null AUTO_INCREMENT,
    bank_name varchar(50),
    bank_ifsc_code varchar(50),
    bank_account_no varchar(50),
    bank_account_name varchar(50),
    bank_account_type varchar(50),
    bank_account_pan varchar(50),
    bank_unicode varchar(50),
    bank_user_code varchar(50),
    createdAt timestamp not null default current_timestamp,
    PRIMARY KEY(bank_id)
)



CREATE TABLE spotify_balance (
    country VARCHAR(255),
    label VARCHAR(255),
    main_label VARCHAR(255),
    sub_label VARCHAR(255),
    label_identification VARCHAR(255),
    product VARCHAR(255),
    uri VARCHAR(255),
    upc VARCHAR(255),
    ean VARCHAR(255),
    isrc VARCHAR(255),
    song_name VARCHAR(255),
    artist_name VARCHAR(255),
    composer_name VARCHAR(255),
    album_name VARCHAR(255),
    total VARCHAR(255), -- Assuming a decimal data type for total, adjust precision and scale as needed
    file_name VARCHAR(255),
    income VARCHAR(255), -- Assuming a decimal data type for income, adjust precision and scale as needed
    admin_exp VARCHAR(255), -- Assuming a decimal data type for admin_exp, adjust precision and scale as needed
    royalty VARCHAR(255), -- Assuming a decimal data type for royalty, adjust precision and scale as needed
    id VARCHAR(255),
    original_l1_name VARCHAR(255),
    original_l2_name VARCHAR(255),
    company VARCHAR(255),
    createdAt DATE NOT NULL DEFAULT CURRENT_DATE
);


SHOW TABLES;

SELECT song_name AS songName, original_l2_name, SUM(income) AS profit
FROM (
    SELECT song_name, original_l2_name, income FROM tiktok_balance 
    UNION ALL
    SELECT song_name, original_l2_name, income FROM spotify_balance
    UNION ALL
    SELECT asset_labels AS songName, original_l2_name, income FROM youtube_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM apple_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM amazon_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM gaana_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM jiosaavn_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM resso_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM facebook_balance
    UNION ALL
    SELECT songname AS songName, original_l2_name, income FROM airtel_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM vodafone_balance
    UNION ALL
    SELECT song_name, original_l2_name, income FROM bsnl_balance
) AS all_platforms
GROUP BY songName;



CREATE TABLE all_balance(
platforms_name VARCHAR(255),
song_name VARCHAR(255),
song_isrc VARCHAR(255),
song_income VARCHAR(255),
original_l2_name VARCHAR(255),
balance_date VARCHAR(255)
)


CREATE TABLE balance(
unique_id int not null,
platforms_name VARCHAR(255),
song_name VARCHAR(255),
song_isrc VARCHAR(255),
song_income VARCHAR(255),
original_l2_name VARCHAR(255),
balance_date VARCHAR(255),
PRIMARY KEY(unique_id)
)



--PLATFORM LISTED SONG --
CREATE TABLE platforms_listed_song(
    platforms_id int not null AUTO_INCREMENT,
    platforms_name varchar(50),
    platforms_song_name varchar(50),
    platforms_song_isrc varchar(50),
    platforms_song_original_l2_name varchar(50),
    song_id varchar(50),
    createdAt timestamp not null default current_timestamp,
    PRIMARY KEY(platforms_id)
)


--Platforms Name
CREATE TABLE platforms_name(
    platforms_id int not null AUTO_INCREMENT,
    platforms_name varchar(50),
    platforms_icon varchar(50),
    createdAt timestamp not null default current_timestamp,
    PRIMARY KEY(platforms_id)
)




SELECT 
    balance.song_name,
    original_l2_name,
    SUM(CASE WHEN platforms_name = 'Young Money' THEN song_income ELSE 0 END) AS 'Young Money',
    SUM(CASE WHEN platforms_name = 'Spotify' THEN song_income ELSE 0 END) AS 'Spotify',
    content_isPremium,
    content_premiumAt,
    balance_date,
    SUM(song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_title = balance.song_name
WHERE 
    balance.balance_date BETWEEN songs.content_premiumAt AND balance.balance_date
AND
    songs.content_isPremium = 'Yes'
GROUP BY 
    balance.song_name, original_l2_name, content_isPremium, content_premiumAt, balance_date;

SELECT 
    balance.song_name,
    original_l2_name,
    SUM(CASE WHEN platforms_name = 'Young Money' THEN song_income ELSE 0 END) AS 'Young Money',
    SUM(CASE WHEN platforms_name = 'Spotify' THEN song_income ELSE 0 END) AS 'Spotify',
    content_isPremium,
    balance_date,
    SUM(song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_title = balance.song_name
WHERE 
    songs.content_isPremium = 'No'
GROUP BY 
    balance.song_name, original_l2_name, content_isPremium,  balance_date;


CREATE TABLE super_user(
    super_id int not null AUTO_INCREMENT,
    super_name varchar(500),
    super_password varchar(500),
    super_createdAt varchar(500),
    PRIMARY KEY (super_id)
)
