
CREATE TABLE city_municipality (
    id INT AUTO_INCREMENT PRIMARY KEY,
    place VARCHAR(255),
    category INT
);

INSERT INTO city_municipality (place, category) VALUES
('Alcantara', 1),
('Alcoy', 1),
('Alegria', 1),
('Aloguinsan', 1),
('Argao', 1),
('Asturias', 1),
('Badian', 1),
('Balamban', 1),
('Bantayan', 1),
('Barili', 1),
('Bogo City', 2),
('Boljoon', 1),
('Borbon', 1),
('Carcar City', 2),
('Carmen', 1),
('Catmon', 1),
('Cebu City', 2),
('Compostela', 1),
('Consolacion', 1),
('Cordova', 1),
('Daanbantayan', 1),
('Dalaguete', 1),
('Danao City', 2),
('Dumanjug', 1),
('Ginatilan', 1),
('Lapu-Lapu City', 2),
('Liloan', 1),
('Madridejos', 1),
('Malabuyoc', 1),
('Mandaue City', 2),
('Medellin', 1),
('Minglanilla', 1),
('Moalboal', 1),
('Naga City', 2),
('Oslob', 1),
('Pilar', 1),
('Pinamungajan', 1),
('Poro', 1),
('Ronda', 1),
('Samboan', 1),
('San Fernando', 1),
('San Francisco', 1),
('San Remigio', 1),
('Santa Fe', 1),
('Santander', 1),
('Sibonga', 1),
('Sogod', 1),
('Tabogon', 1),
('Tabuelan', 1),
('Talisay City', 2),
('Toledo City', 2),
('Tuburan', 1),
('Tudela', 1);

CREATE TABLE Barangays(
barangay_id int auto_increment PRIMARY KEY,
barangay_name VARCHAR(255),
city_municipality_id INT,
FOREIGN KEY(city_municipality_id) REFERENCES city_municipality(id)
);




INSERT INTO Barangays (barangay_name, city_municipality_id) VALUES
('Cabadiangan', 1),
('Cabil-isan', 1),
('Candabong', 1),
('Lawaan', 1),
('Manga', 1),
('Palanas', 1),
('Poblacion', 1),
('Polo', 1),
('Salagmaya', 1),
('Atabay', 2),
('Daan-Lungsod', 2),
('Guiwang', 2),
('Nug-as', 2),
('Pasol', 2),
('Poblacion', 2),
('Pugalo', 2),
('San Agustin', 2),
('Compostela', 3),
('Guadalupe', 3),
('Legaspi', 3),
('Lepanto', 3),
('Madridejos', 3),
('Montpeller', 3),
('Poblacion', 3),
('Santa Filomena', 3),
('Valencia', 3),
('Angilan', 4),
('Bojo', 4),
('Bonbon', 4),
('Esperanza', 4),
('Kandingan', 4),
('Kantabogon', 4),
('Kawasan', 4),
('Olango', 4),
('Poblacion', 4),
('Punay', 4),
('Rosario', 4),
('Saksak', 4),
('Tampa-an', 4),
('Toyokon', 4),
('Zaragosa', 4),
('Alambijud', 5),
('Anajao', 5),
('Apo', 5),
('Balaas', 5),
('Balisong', 5),
('Binlod', 5),
('Bogo', 5),
('Bug-ot', 5),
('Bulasa', 5),
('Butong', 5),
('Calagasan', 5),
('Canbantug', 5),
('Canbanua', 5),
('Cansuje', 5),
('Capio-an', 5),
('Casay', 5),
('Catang', 5),
('Colawin', 5),
('Conalum', 5),
('Guiwanon', 5),
('Gutlang', 5),
('Jampang', 5),
('Jomgao', 5),
('Lamacan', 5),
('Langtad', 5),
('Langub', 5),
('Lapay', 5),
('Lengigon', 5),
('Linut-od', 5),
('Mabasa', 5),
('Mandilikit', 5),
('Mompeller', 5),
('Panadtaran', 5),
('Poblacion', 5),
('Sua', 5),
('Sumaguan', 5),
('Tabayag', 5),
('Talaga', 5),
('Talaytay', 5),
('Talo-ot', 5),
('Tiguib', 5),
('Tulang', 5),
('Tulic', 5),
('Ubaub', 5),
('Usmad', 5),
('Agbanga', 6),
('Agtugop', 6),
('Bago', 6),
('Bairan', 6),
('Banban', 6),
('Baye', 6),
('Bog-o', 6),
('Kaluangan', 6),
('Lanao', 6),
('Langub', 6),
('Looc Norte', 6),
('Lunas', 6),
('Magcalape', 6),
('Manguiao', 6),
('New Bago', 6),
('Owak', 6),
('Poblacion', 6),
('Saksak', 6),
('San Isidro', 6),
('San Roque', 6),
('Santa Lucia', 6),
('Santa Rita', 6),
('Tag-amakan', 6),
('Tagbubonga', 6),
('Tubigagmanok', 6),
('Tubod', 6),
('Ubogon', 6),
('Alawijao', 7),
('Balhaan', 7),
('Banhigan', 7),
('Basak', 7),
('Basiao', 7),
('Bato', 7),
('Bugas', 7),
('Calangcang', 7),
('Candiis', 7),
('Dagatan', 7),
('Dobdob', 7),
('Ginablan', 7),
('Lambug', 7),
('Malabago', 7),
('Malhiao', 7),
('Manduyong', 7),
('Matutinao', 7),
('Patong', 7),
('Poblacion', 7),
('Sanlagan', 7),
('Santicon', 7),
('Sohoton', 7),
('Sulsugan', 7),
('Talayong', 7),
('Taytay', 7),
('Tigbao', 7),
('Tiguib', 7),
('Tubod', 7),
('Zaragosa', 7),
('Abucayan', 8),
('Aliwanay', 8),
('Arpili', 8),
('Baliwagan (Poblacion)', 8),
('Bayong', 8),
('Biasong', 8),
('Buanoy', 8),
('Cabagdalan', 8),
('Cabasiangan', 8),
('Cambuhawe', 8),
('Cansomoroy', 8),
('Cantibas', 8),
('Cantuod', 8),
('Duangan', 8),
('Gaas', 8),
('Ginatilan', 8),
('Hingatmonan', 8),
('Lamesa', 8),
('Liki', 8),
('Luca', 8),
('Matun-og', 8),
('Nangka', 8),
('Pondol', 8),
('Prenza', 8),
('Santa Cruz-Santo Niño (Poblacion)', 8),
('Singsing', 8),
('Sunog (Magsaysay)', 8),
('Vito', 8),
('Atop-atop', 9),
('Baigad', 9),
('Bantigue', 9),
('Baod', 9),
('Binaobao', 9),
('Botigues', 9),
('Doong', 9),
('Guiwanon', 9),
('Hilotongan', 9),
('Kabac', 9),
('Kabangbang', 9),
('Kampingganon', 9),
('Kangkaibe', 9),
('Lipayran', 9),
('Luyongbaybay', 9),
('Mojon', 9),
('Obo-ob', 9),
('Patao', 9),
('Putian', 9),
('Sillon', 9),
('Suba', 9),
('Sulangan', 9),
('Sungko', 9),
('Tamiao', 9),
('Ticad', 9),
('Azucena', 10),
('Bagakay', 10),
('Balao', 10),
('Bolocboloc', 10),
('Budbud', 10),
('Bugtong Kawayan', 10),
('Cabcaban', 10),
('Cagay', 10),
('Campangga', 10),
('Candugay', 10),
('Dakit', 10),
('Giloctog', 10),
('Giwanon', 10),
('Guibuangan', 10),
('Gunting', 10),
('Hilasgasan', 10),
('Japitan', 10),
('Kalubihan', 10),
('Kangdampas', 10),
('Luhod', 10),
('Lupo', 10),
('Luyo', 10),
('Maghanoy', 10),
('Maigang', 10),
('Malolos', 10),
('Mantalongon', 10),
('Mantayupan', 10),
('Mayana', 10),
('Minolos', 10),
('Nabunturan', 10),
('Nasipit', 10),
('Pancil', 10),
('Pangpang', 10),
('Paril', 10),
('Patupat', 10),
('Poblacion', 10),
('San Rafael', 10),
('Santa Ana', 10),
('Sayaw', 10),
('Tal-ot', 10),
('Tubod', 10),
('Vito', 10),
('Anonang Norte', 11),
('Anonang Sur', 11),
('Banban', 11),
('Binabag', 11),
('Bungtod', 11),
('Carbon', 11),
('Cayang', 11),
('Cogon', 11),
('Dakit', 11),
('Don Pedro Rodriguez', 11),
('Gairan', 11),
('La Paz', 11),
('Libertad', 11),
('Lourdes', 11),
('Lusaran', 11),
('Malingin', 11),
('Marangog', 11),
('Maria Rosario', 11),
('Maribago', 11),
('Pandan', 11),
('Polambato', 11),
('Sambag', 11),
('San Vicente', 11),
('Santo Niño', 11),
('Siocon', 11),
('Siyaro', 11),
('Sudlonon', 11),
('Taytayan', 11),
('Ubujan', 11),
('Upaw', 11),
('Arbor', 12),
('Baclayan', 12),
('El Pardo', 12),
('Granada', 12),
('Lower Becerril', 12),
('Lunop', 12),
('Nangka', 12),
('Poblacion', 12),
('San Antonio', 12),
('South Granada', 12),
('Upper Becerril', 12),
('Atabay', 13),
('Bagasawe', 13),
('Bili', 13),
('Bongdo', 13),
('Buktin', 13),
('Cadaruhan', 13),
('Calambua', 13),
('Catmon-Daan', 13),
('Clavera', 13),
('Don Gregorio Antigua', 13),
('Don Gregorio Paras', 13),
('Duangan', 13),
('Gimama-a', 13),
('Guindarohan', 13),
('Laaw', 13),
('Lamac', 13),
('Lanao', 13),
('Looc', 13),
('Managase', 13),
('Poblacion', 13),
('Rizal', 13),
('Tabunan', 13),
('Sagay', 13),
('San Agustin', 13),
('San Antonio', 13),
('San Pascual', 13),
('Sawang', 13),
('Siokon', 13),
('Taboc', 13),
('Tilhaong', 13),
('Tuyobo', 13),
('Victoria', 13),
('Bolinawan', 14),
('Buenavista', 14),
('Calidngan', 14),
('Can‑asujan', 14),
('Guadalupe', 14),
('Liburon', 14),
('Napo', 14),
('Ocaña', 14),
('Perrelos', 14),
('Poblacion I', 14),
('Poblacion II', 14),
('Poblacion III', 14),
('Tuyom', 14),
('Valencia', 14),
('Valladolid', 14),
('Baring', 15),
('Cantipay', 15),
('Cantukong', 15),
('Cantumog', 15),
('Caurasan', 15),
('Cogon East', 15),
('Cogon West', 15),
('Corte', 15),
('Dawis Norte', 15),
('Dawis Sur', 15),
('Hagnaya', 15),
('Ipil', 15),
('Lanipga', 15),
('Liboron', 15),
('Lower Natimao-an', 15),
('Luyang', 15),
('Poblacion', 15),
('Puente', 15),
('Sac-on', 15),
('Triumfo', 15),
('Upper Natimao-an', 15),
('Agsuwao', 16),
('Amancion', 16),
('Anapog', 16),
('Bactas', 16),
('Basak', 16),
('Binongkalan', 16),
('Bongyas', 16),
('Cabungaan', 16),
('Cambangkaya', 16),
('Can-ibuang', 16),
('Catmondaan', 16),
('Corazon', 16),
('Duyan', 16),
('Flores', 16),
('Ginabucan', 16),
('Macaas', 16),
('Panalipan', 16),
('San Jose Poblacion', 16),
('Tabili', 16),
('Tinabyonan', 16),
('Adlaon', 17),
('Agsungot', 17),
('Apas', 17),
('Babag', 17),
('Bacayan', 17),
('Banilad', 17),
('Basak Pardo', 17),
('Basak San Nicolas', 17),
('Binaliw', 17),
('Bonbon', 17),
('Budla-an', 17),
('Buhisan', 17),
('Bulacao', 17),
('Buot-Taup Pardo', 17),
('Busay', 17),
('Calamba', 17),
('Cambinocot', 17),
('Camputhaw', 17),
('Capitol Site', 17),
('Carreta', 17),
('Central', 17),
('Cogon Pardo', 17),
('Cogon Ramos', 17),
('Day-as', 17),
('Duljo', 17),
('Ermita', 17),
('Guadalupe', 17),
('Guba', 17),
('Hippodromo', 17),
('Inayawan', 17),
('Kalubihan', 17),
('Kalunasan', 17),
('Kamagayan', 17),
('Kasambagan', 17),
('Kinasang-an Pardo', 17),
('Labangon', 17),
('Lahug', 17),
('Lorega', 17),
('Lusaran', 17),
('Luz', 17),
('Mabini', 17),
('Mabolo', 17),
('Malubog', 17),
('Mambaling', 17),
('Pahina Central', 17),
('Pahina San Nicolas', 17),
('Pamutan', 17),
('Pardo', 17),
('Pari-an', 17),
('Paril', 17),
('Pasil', 17),
('Pit-os', 17),
('Pulangbato', 17),
('Pung-ol-Sibugay', 17),
('Punta Princesa', 17),
('Quiot Pardo', 17),
('Sambag I', 17),
('Sambag II', 17),
('San Antonio', 17),
('San Jose', 17),
('San Nicolas Central', 17),
('San Roque', 17),
('Santa Cruz', 17),
('Sapangdaku', 17),
('Sawang Calero', 17),
('Sinsin', 17),
('Sirao', 17),
('Suba Poblacion', 17),
('Sudlon I', 17),
('Sudlon II', 17),
('T. Padilla', 17),
('Tabunan', 17),
('Tagbao', 17),
('Talamban', 17),
('Taptap', 17),
('Tejero', 17),
('Tinago', 17),
('Tisa', 17),
('To-ong Pardo', 17),
('Zapatera', 17),
('Bagalnga', 18),
('Basak', 18),
('Buluang', 18),
('Cabadiangan', 18),
('Cambayog', 18),
('Canamucan', 18),
('Cogon', 18),
('Dapdap', 18),
('Estaca', 18),
('Lupa', 18),
('Magay', 18),
('Mulao', 18),
('Panangban', 18),
('Poblacion', 18),
('Tag-ube', 18),
('Tamiao', 18),
('Tubigan', 18),
('Cabangahan', 19),
('Cansaga', 19),
('Casili', 19),
('Danglag', 19),
('Garing', 19),
('Jugan', 19),
('Lamac', 19),
('Lanipga', 19),
('Nangka', 19),
('Panas', 19),
('Panoypoy', 19),
('Pitogo', 19),
('Poblacion Occidental', 19),
('Poblacion Oriental', 19),
('Polog', 19),
('Pulpogan', 19),
('Sacsac', 19),
('Tayud', 19),
('Tilhaong', 19),
('Tolotolo', 19),
('Tugbongan', 19),
('Alegria', 20),
('Bangbang', 20),
('Buagsong', 20),
('Catarman', 20),
('Cogon', 20),
('Dapitan', 20),
('Day-as', 20),
('Gabi', 20),
('Gilutongan', 20),
('Ibabao', 20),
('Pilipog', 20),
('Poblacion', 20),
('San Miguel', 20),
('Aguho', 21),
('Bagay', 21),
('Bakhawan', 21),
('Bateria', 21),
('Bitoon', 21),
('Calape', 21),
('Carnaza', 21),
('Dalingding', 21),
('Lanao', 21),
('Logon', 21),
('Malbago', 21),
('Malingin', 21),
('Maya', 21),
('Pajo', 21),
('Paypay', 21),
('Poblacion', 21),
('Talisay', 21),
('Tapilon', 21),
('Tinubdan', 21),
('Tominjao', 21),
('Ablayan', 22),
('Babayongan', 22),
('Balud', 22),
('Banhigan', 22),
('Bulak', 22),
('Caleriohan', 22),
('Caliongan', 22),
('Casay', 22),
('Catolohan', 22),
('Cawayan', 22),
('Consolacion', 22),
('Coro', 22),
('Dugyan', 22),
('Dumalan', 22),
('Jolomaynon', 22),
('Lanao', 22),
('Langkas', 22),
('Lumbang', 22),
('Malones', 22),
('Maloray', 22),
('Mananggal', 22),
('Manlapay', 22),
('Mantalongon', 22),
('Nalhub', 22),
('Obo', 22),
('Obong', 22),
('Panas', 22),
('Poblacion', 22),
('Sacsac', 22),
('Salug', 22),
('Tabon', 22),
('Tapun', 22),
('Tuba', 22),
('Baliang', 23),
('Bayabas', 23),
('Binaliw', 23),
('Cabungahan', 23),
('Cagat-Lamac', 23),
('Cahumayan', 23),
('Cambanay', 23),
('Cambubho', 23),
('Cogon-Cruz', 23),
('Danasan', 23),
('Dungga', 23),
('Dunggoan', 23),
('Guinacot', 23),
('Guinsay', 23),
('Ibo', 23),
('Langosig', 23),
('Lawaan', 23),
('Licos', 23),
('Looc', 23),
('Magtagobtob', 23),
('Malapoc', 23),
('Manlayag', 23),
('Mantija', 23),
('Masaba', 23),
('Maslog', 23),
('Nangka', 23),
('Oguis', 23),
('Pili', 23),
('Poblacion', 23),
('Quisol', 23),
('Sabang', 23),
('Sacsac', 23),
('Sandayong Norte', 23),
('Sandayong Sur', 23),
('Santa Rosa', 23),
('Santican', 23),
('Sibacan', 23),
('Suba', 23),
('Taboc', 23),
('Taytay', 23),
('Togonon', 23),
('Tuburan Sur', 23),
('Balaygtiki', 24),
('Bitoon', 24),
('Bulak', 24),
('Bullogan', 24),
('Calaboon', 24),
('Camboang', 24),
('Candabong', 24),
('Cogon', 24),
('Cotcoton', 24),
('Doldol', 24),
('Ilaya', 24),
('Kabalaasnan', 24),
('Kabatbatan', 24),
('Kambanog', 24),
('Kang-actol', 24),
('Kanghalo', 24),
('Kanghumaod', 24),
('Kanguha', 24),
('Kantangkas', 24),
('Kanyuko', 24),
('Kolabtingon', 24),
('Lamak', 24),
('Lawaan', 24),
('Liong', 24),
('Manlapay', 24),
('Masa', 24),
('Matalao', 24),
('Paculob', 24),
('Panlaan', 24),
('Pawa', 24),
('Poblacion Central', 24),
('Poblacion Looc', 24),
('Poblacion Sima', 24),
('Tangil', 24),
('Tapon', 24),
('Tubod-Bitoon', 24),
('Tubod-Dugoan', 24),
('Anao', 25),
('Cagsing', 25),
('Calabawan', 25),
('Cambagte', 25),
('Campisong', 25),
('Canorong', 25),
('Guiwanon', 25),
('Looc', 25),
('Malatbo', 25),
('Mangaco', 25),
('Palanas', 25),
('Poblacion', 25),
('Salamanca', 25),
('San Roque', 25),
('Agus', 26),
('Babag', 26),
('Bankal', 26),
('Baring', 26),
('Basak', 26),
('Buaya', 26),
('Calawisan', 26),
('Canjulao', 26),
('Caubian', 26),
('Caw-oy', 26),
('Cawhagan', 26),
('Gun-ob', 26),
('Ibo', 26),
('Looc', 26),
('Mactan', 26),
('Maribago', 26),
('Marigondon', 26),
('Pajac', 26),
('Pajo', 26),
('Pangan-an', 26),
('Poblacion', 26),
('Punta Engaño', 26),
('Pusok', 26),
('Sabang', 26),
('San Vicente', 26),
('Santa Rosa', 26),
('Subabasbas', 26),
('Talima', 26),
('Tingo', 26),
('Tungasan', 26),
('Cabadiangan', 27),
('Calero', 27),
('Catarman', 27),
('Cotcot', 27),
('Jubay', 27),
('Lataban', 27),
('Mulao', 27),
('Poblacion', 27),
('San Roque', 27),
('San Vicente', 27),
('Santa Cruz', 27),
('Tabla', 27),
('Tayud', 27),
('Yati', 27),
('Bunakan', 28),
('Kangwayan', 28),
('Kaongkod', 28),
('Kodia', 28),
('Maalat', 28),
('Malbago', 28),
('Mancilang', 28),
('Pili', 28),
('Poblacion', 28),
('San Agustin', 28),
('Tabagak', 28),
('Talangnan', 28),
('Tarong', 28),
('Tugas', 28),
('Armeña', 29),
('Barangay I', 29),
('Barangay II', 29),
('Cerdeña', 29),
('Labrador', 29),
('Lombo', 29),
('Looc', 29),
('Mahanlud', 29),
('Mindanao', 29),
('Montañeza', 29),
('Salmeron', 29),
('Santo Niño', 29),
('Sorsogon', 29),
('Tolosa', 29),
('Alang-alang', 30),
('Bakilid', 30),
('Banilad', 30),
('Basak', 30),
('Cabancalan', 30),
('Cambaro', 30),
('Canduman', 30),
('Casili', 30),
('Casuntingan', 30),
('Centro', 30),
('Cubacub', 30),
('Guizo', 30),
('Ibabao-Estancia', 30),
('Jagobiao', 30),
('Labogon', 30),
('Looc', 30),
('Maguikay', 30),
('Mantuyong', 30),
('Opao', 30),
('Paknaan', 30),
('Pagsabungan', 30),
('Subangdaku', 30),
('Tabok', 30),
('Tawason', 30),
('Tingub', 30),
('Tipolo', 30),
('Umapad', 30),
('Antipolo', 31),
('Canhabagat', 31),
('Caputatan Norte', 31),
('Caputatan Sur', 31),
('Curva', 31),
('Daanlungsod', 31),
('Dalingding Sur', 31),
('Dayhagon', 31),
('Don Virgilio Gonzales', 31),
('Gibitngil', 31),
('Kawit', 31),
('Lamintak Norte', 31),
('Lamintak Sur', 31),
('Luy-a', 31),
('Maharuhay', 31),
('Mahawak', 31),
('Panugnawan', 31),
('Poblacion', 31),
('Tindog', 31),
('Cadulawan', 32),
('Calajo-an', 32),
('Camp 7', 32),
('Camp 8', 32),
('Cuanos', 32),
('Guindaruhan', 32),
('Linao', 32),
('Manduang', 32),
('Pakigne', 32),
('Poblacion Ward I', 32),
('Poblacion Ward II', 32),
('Poblacion Ward III', 32),
('Poblacion Ward IV', 32),
('Tubod', 32),
('Tulay', 32),
('Tunghaan', 32),
('Tungkil', 32),
('Tungkop', 32),
('Vito', 32),
('Agbalanga', 33),
('Bala', 33),
('Balabagon', 33),
('Basdiot', 33),
('Batadbatad', 33),
('Bugho', 33),
('Buguil', 33),
('Busay', 33),
('Lanao', 33),
('Poblacion East', 33),
('Poblacion West', 33),
('Saavedra', 33),
('Tomonoy', 33),
('Tuble', 33),
('Tunga', 33),
('Alpaco', 34),
('Bairan', 34),
('Balirong', 34),
('Cabungahan', 34),
('Cantao-an', 34),
('Central Poblacion', 34),
('Cogon', 34),
('Colon', 34),
('East Poblacion', 34),
('Inayagan', 34),
('Inoburan', 34),
('Jaguimit', 34),
('Lanas', 34),
('Langtad', 34),
('Lutac', 34),
('Mainit', 34),
('Mayana', 34),
('Naalad', 34),
('North Poblacion', 34),
('Pangdan', 34),
('Patag', 34),
('South Poblacion', 34),
('Tagjaguimit', 34),
('Tangke', 34),
('Tinaan', 34),
('Tuyan', 34),
('Uling', 34),
('West Poblacion', 34),
('Alo', 35),
('Bangcogon', 35),
('Bonbon', 35),
('Calumpang', 35),
('Can-ukban', 35),
('Canangca-an', 35),
('Cansalo-ay', 35),
('Cañang', 35),
('Daanlungsod', 35),
('Gawi', 35),
('Hagdan', 35),
('Lagunde', 35),
('Looc', 35),
('Luka', 35),
('Mainit', 35),
('Manlum', 35),
('Nueva Caceres', 35),
('Poblacion', 35),
('Pungtod', 35),
('Tan-awan', 35),
('Tumalog', 35),
('Biasong', 36),
('Cawit', 36),
('Dapdap', 36),
('Esperanza', 36),
('Imelda', 36),
('Lanao', 36),
('Lower Poblacion', 36),
('Moabog', 36),
('Montserrat', 36),
('San Isidro', 36),
('San Juan', 36),
('Upper Poblacion', 36),
('Villahermosa', 36),
('Anislag', 37),
('Anopog', 37),
('Binabag', 37),
('Buhingtubig', 37),
('Busay', 37),
('Butong', 37),
('Cabiangon', 37),
('Camugao', 37),
('Duangan', 37),
('Guimbawian', 37),
('Lamac', 37),
('Lut-od', 37),
('Mangoto', 37),
('Opao', 37),
('Pandacan', 37),
('Poblacion', 37),
('Punod', 37),
('Rizal', 37),
('Sacsac', 37),
('Sambagon', 37),
('Sibago', 37),
('Tajao', 37),
('Tangub', 37),
('Tanibag', 37),
('Tupas', 37),
('Tutay', 37),
('Adela', 38),
('Altavista', 38),
('Cagcagan', 38),
('Cansabusab', 38),
('Daan Paz', 38),
('Eastern Poblacion', 38),
('Esperanza', 38),
('Libertad', 38),
('Mabini', 38),
('Mercedes', 38),
('Pagsa', 38),
('Paz', 38),
('Rizal', 38),
('San Jose', 38),
('Santa Rita', 38),
('Teguis', 38),
('Western Poblacion', 38),
('Butong', 39),
('Can-abuhon', 39),
('Canduling', 39),
('Cansalonoy', 39),
('Cansayahon', 39),
('Ilaya', 39),
('Langin', 39),
('Libo-o', 39),
('Malalay', 39),
('Palanas', 39),
('Poblacion', 39),
('Santa Cruz', 39),
('Tupas', 39),
('Vive', 39),
('Basak', 40),
('Bonbon', 40),
('Bulangsuran', 40),
('Calatagan', 40),
('Cambigong', 40),
('Camburoy', 40),
('Canorong', 40),
('Colase', 40),
('Dalahikan', 40),
('Jumangpas', 40),
('Monteverde', 40),
('Poblacion', 40),
('San Sebastian', 40),
('Suba', 40),
('Tangbo', 40),
('Balud', 41),
('Balungag', 41),
('Basak', 41),
('Bugho', 41),
('Cabatbatan', 41),
('Greenhills', 41),
('Ilaya', 41),
('Lantawan', 41),
('Liburon', 41),
('Magsico', 41),
('Panadtaran', 41),
('Pitalo', 41),
('Poblacion North', 41),
('Poblacion South', 41),
('San Isidro', 41),
('Sangat', 41),
('Tabionan', 41),
('Tananas', 41),
('Tinubdan', 41),
('Tonggo', 41),
('Tubod', 41),
('Cabunga-an', 42),
('Campo', 42),
('Consuelo', 42),
('Esperanza', 42),
('Himensulan', 42),
('Montealegre', 42),
('Northern Poblacion', 42),
('San Isidro', 42),
('Santa Cruz', 42),
('Santiago', 42),
('Sonog', 42),
('Southern Poblacion', 42),
('Unidos', 42),
('Union', 42),
('Western Poblacion', 42),
('Anapog', 43),
('Argawanon', 43),
('Bagtic', 43),
('Bancasan', 43),
('Batad', 43),
('Busogon', 43),
('Calambua', 43),
('Canagahan', 43),
('Dapdap', 43),
('Gawaygaway', 43),
('Hagnaya', 43),
('Kayam', 43),
('Kinawahan', 43),
('Lambusan', 43),
('Lawis', 43),
('Libaong', 43),
('Looc', 43),
('Luyang', 43),
('Mano', 43),
('Poblacion', 43),
('Punta', 43),
('Sab-a', 43),
('San Miguel', 43),
('Tacup', 43),
('Tambongon', 43),
('To-ong', 43),
('Victoria', 43),
('Balidbid', 44),
('Hagdan', 44),
('Hilantagaan', 44),
('Kinatarkan', 44),
('Langub', 44),
('Maricaban', 44),
('Okoy', 44),
('Poblacion', 44),
('Pooc', 44),
('Talisay', 44),
('Bunlan', 45),
('Cabutongan', 45),
('Candamiang', 45),
('Canlumacad', 45),
('Liloan', 45),
('Lip-tong', 45),
('Looc', 45),
('Pasil', 45),
('Poblacion', 45),
('Talisay', 45),
('Abugon', 46),
('Bae', 46),
('Bagacay', 46),
('Bahay', 46),
('Banlot', 46),
('Basak', 46),
('Bato', 46),
('Cagay', 46),
('Can-aga', 46),
('Candaguit', 46),
('Cantolaroy', 46),
('Dugoan', 46),
('Guimbangco-an', 46),
('Lamacan', 46),
('Libo', 46),
('Lindogon', 46),
('Magcagong', 46),
('Manatad', 46),
('Mangyan', 46),
('Papan', 46),
('Poblacion', 46),
('Sabang', 46),
('Sayao', 46),
('Simala', 46),
('Tubod', 46),
('Ampongol', 47),
('Bagakay', 47),
('Bagatayam', 47),
('Bawo', 47),
('Cabalawan', 47),
('Cabangahan', 47),
('Calumboyan', 47),
('Dakit', 47),
('Damolog', 47),
('Ibabao', 47),
('Liki', 47),
('Lubo', 47),
('Mohon', 47),
('Nahus-an', 47),
('Pansoy', 47),
('Poblacion', 47),
('Tabunok', 47),
('Takay', 47),
('Alang-alang', 48),
('Caduawan', 48),
('Camoboan', 48),
('Canaocanao', 48),
('Combado', 48),
('Daantabogon', 48),
('Ilihan', 48),
('Kal-anan', 48),
('Labangon', 48),
('Libjo', 48),
('Loong', 48),
('Mabuli', 48),
('Managase', 48),
('Manlagtang', 48),
('Maslog', 48),
('Muabog', 48),
('Pio', 48),
('Poblacion', 48),
('Salag', 48),
('Sambag', 48),
('San Isidro', 48),
('San Vicente', 48),
('Somosa', 48),
('Taba-ao', 48),
('Tapul', 48),
('Bongon', 49),
('Dalid', 49),
('Kanlim-ao', 49),
('Kanluhangon', 49),
('Kantubaon', 49),
('Mabunao', 49),
('Maravilla', 49),
('Olivo', 49),
('Poblacion', 49),
('Tabunok', 49),
('Tigbawan', 49),
('Villahermosa', 49),
('Biasong', 50),
('Bulacao', 50),
('Candulawan', 50),
('Camp IV', 50),
('Cansojong', 50),
('Dumlog', 50),
('Jaclupan', 50),
('Lagtang', 50),
('Lawaan I', 50),
('Lawaan II', 50),
('Lawaan III', 50),
('Linao', 50),
('Maghaway', 50),
('Manipis', 50),
('Mohon', 50),
('Poblacion', 50),
('Pooc', 50),
('San Isidro', 50),
('San Roque', 50),
('Tabunok', 50),
('Tangke', 50),
('Tapul', 50),
('Awihao', 51),
('Bagakay', 51),
('Bato', 51),
('Biga', 51),
('Bulongan', 51),
('Bunga', 51),
('Cabitoonan', 51),
('Calongcalong', 51),
('Cambang-ug', 51),
('Camp 8', 51),
('Canlumampao', 51),
('Cantabaco', 51),
('Capitan Claudio', 51),
('Carmen', 51),
('Daanglungsod', 51),
('Don Andres Soriano (Lutopan)', 51),
('Dumlog', 51),
('Gen. Climaco (Malubog)', 51),
('Ibo', 51),
('Ilihan', 51),
('Juan Climaco, Sr. (Magdugo)', 51),
('Landahan', 51),
('Loay', 51),
('Luray II', 51),
('Matab-ang', 51),
('Media Once', 51),
('Pangamihan', 51),
('Poblacion', 51),
('Poog', 51),
('Putingbato', 51),
('Sagay', 51),
('Sam-ang', 51),
('Sangi', 51),
('Santo Niño (Mainggit)', 51),
('Subayon', 51),
('Talavera', 51),
('Tubod', 51),
('Tungkay', 51),
('Alegria', 52),
('Amatugan', 52),
('Antipolo', 52),
('Apalan', 52),
('Bagasawe', 52),
('Bakyawan', 52),
('Bangkito', 52),
('Barangay I (Poblacion)', 52),
('Barangay II (Poblacion)', 52),
('Barangay III (Poblacion)', 52),
('Barangay IV (Poblacion)', 52),
('Barangay V (Poblacion)', 52),
('Barangay VI (Poblacion)', 52),
('Barangay VII (Poblacion)', 52),
('Barangay VIII (Poblacion)', 52),
('Bulwang', 52),
('Caridad', 52),
('Carmelo', 52),
('Cogon', 52),
('Colonia', 52),
('Daan Lungsod', 52),
('Fortaliza', 52),
('Ga-ang', 52),
('Gimama-a', 52),
('Jagbuaya', 52),
('Kabangkalan', 52),
('Kabkaban', 52),
('Kagba-o', 52),
('Kalangahan', 52),
('Kamansi', 52),
('Kampoot', 52),
('Kan-an', 52),
('Kanlunsing', 52),
('Kansi', 52),
('Kaorasan', 52),
('Libo', 52),
('Lusong', 52),
('Macupa', 52),
('Mag-alwa', 52),
('Mag-antoy', 52),
('Mag-atubang', 52),
('Maghan-ay', 52),
('Mangga', 52),
('Marmol', 52),
('Montealegre', 52),
('Putat', 52),
('San Juan', 52),
('Sandayong', 52),
('Santo Niño', 52),
('Siotes', 52),
('Sumon', 52),
('Tominjao', 52),
('Tomugpa', 52),
('Buenavista', 53),
('Calmante', 53),
('Daan Secante', 53),
('General', 53),
('McArthur', 53),
('Northern Poblacion', 53),
('Puertobello', 53),
('Santander', 53),
('Secante Bag-o', 53),
('Southern Poblacion', 53),
('Villahermosa', 53);

CREATE TABLE product_items(
	product_id INT PRIMARY KEY AUTO_INCREMENT,
	product_name VARCHAR(255),
	item_price DOUBLE(10, 2),
	quantity DOUBLE(10, 2),
	isAvailable INT,
	category_id INT,
	FOREIGN KEY (category_id) REFERENCES product_categories(category_id),
	img_loc TEXT,
	datetime_added VARCHAR(255),
	datetime_edited VARCHAR(255)
);

CREATE TABLE product_categories(
	category_id INT PRIMARY KEY AUTO_INCREMENT,
	category_name VARCHAR(255),
	category_img TEXT,
	modified_by INT,
	FOREIGN KEY (modified_by) REFERENCES users(user_id),
	isAvailable INT,
	datetime_added VARCHAR(255),
	datetime_edited VARCHAR(255)
);

SELECT * FROM users;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password_hash VARCHAR(255),
    full_name VARCHAR(200),
    phone_number VARCHAR(15),
    city_municipality VARCHAR(200),
    barangay VARCHAR(200),
    purok VARCHAR(200),
    additional_info TEXT,
		user_type INT,
    address_label VARCHAR(100),
    datetime_added VARCHAR(255),
		datetime_edited VARCHAR(255)
);

CREATE TABLE cart(
	cart_id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	product_id INT,
	FOREIGN KEY (product_id) REFERENCES product_items(product_id),
	quantity DOUBLE(10,2),
	datetime_added VARCHAR(100)
);

CREATE TABLE shop(
	shop_id INT PRIMARY KEY AUTO_INCREMENT,
	shop_name VARCHAR(255),
	shop_purok VARCHAR (255),
	shop_barangay_id INT,
	FOREIGN KEY (shop_barangay_id) REFERENCES barangays(barangay_id),
	shop_city_municipality_id INT,
	FOREIGN KEY (shop_city_municipality_id) REFERENCES city_municipality(id)
);
 
CREATE TABLE orders(
	order_id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	shop_id INT,
	FOREIGN KEY (shop_id) REFERENCES shop(shop_id),
	order_timedate VARCHAR(255),
	order_status INT,
	total_amount DOUBLE(10, 2),
	payment_method INT, 
	shipping_address TEXT,
	billing_address TEXT,
	shipping_cost DOUBLE (10, 2),
	customer_notes TEXT
);

CREATE TABLE order_items(
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	order_id INT,
	FOREIGN KEY (order_id) REFERENCES orders(order_id),
	product_id INT,
	FOREIGN KEY (product_id) REFERENCES product_items(product_id),
	quantity DOUBLE (10, 2),
	price DOUBLE (10, 2),
	total_price DOUBLE (10, 2),
	datetime_added VARCHAR(255)
);

CREATE TABLE acc_management_privileges(
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	view_acc INT,
	manage_user_type INT
);

CREATE TABLE prod_management_privileges(
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	add_prod INT,
	mark_prod INT,
	update_prod INT,
	delete_prod INT,
	add_cat INT,
	mark_cat INT,
	update_cat INT,
	delete_cat INT,
	updated_by_admin INT,
	FOREIGN KEY (updated_by_admin) REFERENCES users(user_id),
	datetime_modified VARCHAR(255)
);



