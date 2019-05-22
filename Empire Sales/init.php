<html>
	<head></head>
	<body>
<?php 
    // The Users database
    class BusDB extends SQLite3 {
        function __construct() {
            $this->open('bus.db');
        }
    }
 
    // Instantiate the Users database
    $db = new BusDB();
    if (!$db) {
        echo $db->lastErrorMsg();
    }
 
    // Populate the Users database
    $sql =<<<EOF
        DROP TABLE IF EXISTS Users;
        CREATE TABLE Users (
            UserID INTEGER PRIMARY KEY,
            Username VARCHAR(60) UNIQUE,
            hash VARCHAR(30)
            
        );
        INSERT INTO Users(Username, hash) VALUES ('admin', '1a52e17fa899cf40fb04cfc42e6352f1');

        DROP TABLE IF EXISTS Inventory;
        CREATE TABLE Inventory (
            STK VARCHAR PRIMARY KEY,
            ID INT NOT NULL,
            VIN VARCHAR(16) NOT NULL,
            Mileage INT NOT NULL,
            New INT NOT NULL,
            FOREIGN KEY(ID) REFERENCES Specifications(ID)
        );

        INSERT INTO Inventory VALUES ('EB0616', 1, '1FTSS34L03', 198362, 0);
        INSERT INTO Inventory VALUES ('EB0518', 2, '1FTSS3EL5', 154558, 0);
        INSERT INTO Inventory VALUES ('EB0618', 3, '1FDFE4FSXC', 139500, 0);
        INSERT INTO Inventory VALUES ('B0317', 4, '1FDXFS1HD', 3002, 1);
        INSERT INTO Inventory VALUES ('B1418', 5, '1FDES8PM5', 2598, 1);
        INSERT INTO Inventory VALUES ('B1518', 5, '1FDESPPM9', 2988, 1);
        INSERT INTO Inventory VALUES ('B1918', 5, '1FDFE5FS6', 2668, 1);
        INSERT INTO Inventory VALUES ('B4018', 6, '1FDFE4FSD', 3320, 1);
        INSERT INTO Inventory VALUES ('B4118', 7, '2C7WBG1J', 3008, 1);
        INSERT INTO Inventory VALUES ('B4318', 7, '2C4GBG1KR', 2093, 1);
        INSERT INTO Inventory VALUES ('B4618', 8, '1N9MMAC66', 3650, 1);
        INSERT INTO Inventory VALUES ('B4718', 9, '1FDFES6KD', 2565, 1);
        INSERT INTO Inventory VALUES ('B4818', 10, '1FMZL1CM8', 2560, 1);

        DROP TABLE IF EXISTS Specifications;
        CREATE TABLE Specifications (
            ID INTEGER PRIMARY KEY AUTOINCREMENT,
            Year INT NOT NULL,
            Make VARCHAR(30) NOT NULL,
            Model VARCHAR(30) NOT NULL,
            Engine VARCHAR(50),
            Transmission VARCHAR(50),
            Capacity VARCHAR(20),
            Gas VARCHAR(50),
            Brakes VARCHAR(50),
            Seats VARCHAR(50),
            Width VARCHAR(50),
            Height VARCHAR(50),
            Length VARCHAR(50)
        );

        INSERT INTO Specifications VALUES (1, 2003,'Ford','EC3', '4.2L V-64.2L','4 speed automatic','32 gallon','Up to 12 city / 16 highway','front disc','2','79.3','52.5','211.9');
        INSERT INTO Specifications VALUES (2, 2011,'Ford','E350','255-hp, 5.4-liter V-8 (regular gas)','Standard four-speed automatic transmission','33.0 gal.','Up to 12 city / 16 highway','Front ventilated disc brakes','2','73.7in','83.7in','216.7in');
        INSERT INTO Specifications VALUES (3, 2012,'Ford','E450','6.8L EFI Triton V10 Engine','Automatic','55-gallon','Up to 14 city / 19 highway','4-Wheel Disc Anti-Lock Braking System (ABS)','2','94.9in','80in','261.1in');
        INSERT INTO Specifications VALUES (4, 2017,'Ford / Federal','Spirit','1.6-liter 4-cylinder, 135 HP Ford engine','5-speed manual transmission','7.75 US gal','Up to 8 city','Anti-Lock Brake System (ABS)','4-way manual front-passenger seat','80.5in','57.8in','178.7in');
        INSERT INTO Specifications VALUES (5, 2018,'Eldorado','World Trans','6.8L V10 Gas','5-Speed Automatic','40 Gallon',NULL,'Power w/4 wheel anti lock','4','96in','115in','259in');
        INSERT INTO Specifications VALUES (6, 2018,'Eldorado','Advantage','6.2L Gas','Electronic 6-Speed Auto','55 Gallon',NULL,'Power w/4 wheel anti lock','4','96″','115in','259in');
        INSERT INTO Specifications VALUES (7, 2018,'Revability','Dodge Grand Caravan','3.6-Liter V6 24-Valve VVT Engine','6-Speed Automatic 62TE Transmission','20-Gallon Fuel Tank','17 city/25 hwy','Anti-Lock 4-Wheel Heavy-Duty Disc Brakes','2nd-Row Bench w/3rd Row 60/40 Stow ''n Go® Bench','78.7 in','68.9 in','202.8 in');
        INSERT INTO Specifications VALUES (8, 2018,'Eldorado California','EZ Rider II','Cummins - Diesel, CNG, LNG','Allison - B300R, B400R, Voith, ZF','40 Gallon',NULL,'S-Cam Drum W/Automatic Slack Adjusters And ABS','Up to 33','102in','125’ With Exhaust, 126in With Roof HVAC, 136in With CNG','30ft 7in');
        INSERT INTO Specifications VALUES (9, 2019,'Eldorado','Aerotech 220','6.2L Gas','Electronic 6-Speed Auto','40 Gallon',NULL,'Power w/4 wheel anti lock','4','96in','115in','96in');
        INSERT INTO Specifications VALUES (10, 2019,'Mobilty Trans','Ford Transit','3.7L Ti-VCT V6 or 3.5L EcoBoost V6 or 3.2L I-5 Power Stroke Turbo Diesel','Automatic','25 gal.',NULL,'Power 4-wheel disc with anti-lock brake system','up to 15','81.3 in','82.4 in','219.9 in');

        DROP TABLE IF EXISTS Photos;
        CREATE TABLE Photos(
            ID INT NOT NULL,
            Path VARCHAR(100),
            FOREIGN KEY(ID) REFERENCES Specifications(ID)
        );

        INSERT INTO Photos VALUES ('1', './img/13/16039_1269219.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_4550023.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_4552688.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_4550023.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_4956230.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_7890436.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_8820894.jpg');
        INSERT INTO Photos VALUES ('1', './img/13/16039_8942724.jpg');

        INSERT INTO Photos VALUES ('2', './img/1/2011-Ford-EconolineWagon-XL.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2011FRD002b_640_02.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2011FRD002b_640_03.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2011FRD002b_640_05.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2011FRD002b_640_06.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2011FRD002b_640_21.jpg');
        INSERT INTO Photos VALUES ('2', './img/1/2014-ford-e-series-350-xls-super-duty-passenger-truck-air-vents.webp');
        INSERT INTO Photos VALUES ('2', './img/1/2014-ford-e-series-350-xls-super-duty-passenger-truck-audio-system.webp');
        INSERT INTO Photos VALUES ('2', './img/1/2014-ford-e-series-350-xls-super-duty-passenger-truck-steering-wheel.webp');



        INSERT INTO Photos VALUES ('3', './img/2/e450_drw_32.jpg');
        INSERT INTO Photos VALUES ('3', './img/2/cq5dam.web.1280.1280 (1).jpeg');
        INSERT INTO Photos VALUES ('3', './img/2/cq5dam.web.1280.1280 (2).jpeg');
        INSERT INTO Photos VALUES ('3', './img/2/cq5dam.web.1280.1280.jpeg');

        INSERT INTO Photos VALUES ('4', './img/3/maxresdefault.jpg');
        INSERT INTO Photos VALUES ('4', './img/3/spirit-exec.png');
        INSERT INTO Photos VALUES ('4', './img/3/spirit-int-limo.jpg');
        INSERT INTO Photos VALUES ('4', './img/3/spirit-int.jpg');

        INSERT INTO Photos VALUES ('5', './img/4/Shuttle_bus.png');
        INSERT INTO Photos VALUES ('5', './img/4/WorldTrans_Pic.jpg');
        INSERT INTO Photos VALUES ('5', './img/4/WT0072-2a.jpg');
        INSERT INTO Photos VALUES ('5', './img/4/WT0072-4a.jpg');
        INSERT INTO Photos VALUES ('5', './img/4/WT0072-15a.jpg');
        INSERT INTO Photos VALUES ('5', './img/4/WT0072-16a.jpg');

        INSERT INTO Photos VALUES ('6', './img/7/ElDorado_Advantage_201605-22.jpg');
        INSERT INTO Photos VALUES ('6', './img/7/ElDorado_Advantage_201605-24-600x400.jpg');
        INSERT INTO Photos VALUES ('6', './img/7/ElDorado_Advantage_201605-25.jpg');
        INSERT INTO Photos VALUES ('6', './img/7/2016JulAdvantage2-600x900.jpg');
        INSERT INTO Photos VALUES ('6', './img/7/Advantage-steel-cage-1.jpg');
        INSERT INTO Photos VALUES ('6', './img/7/DSCF8074.jpg');

        INSERT INTO Photos VALUES ('7', './img/8/1510604919_ft_model.png');
        INSERT INTO Photos VALUES ('7', './img/8/1510703470_gall_lr.jpg');
        INSERT INTO Photos VALUES ('7', './img/8/1510703490_gall_lr.jpg');
        INSERT INTO Photos VALUES ('7', './img/8/1510617074_gall_lr.jpg');
        INSERT INTO Photos VALUES ('7', './img/8/1510617123_gall_lr.jpg');
        INSERT INTO Photos VALUES ('7', './img/8/1510617211_gall_lr.jpg');
        INSERT INTO Photos VALUES ('7', './img/8/1510617242_gall_lr.jpg');


        INSERT INTO Photos VALUES ('8', './img/10/ezrider_pic.jpg');
        INSERT INTO Photos VALUES ('8', './img/10/1515798249-6.png');

        INSERT INTO Photos VALUES ('9', './img/11/Aerotech-Ford-220-Westin-5989.jpg');
        INSERT INTO Photos VALUES ('9', './img/11/used-buses-for-sale-eldorodo-aerotech-220-L.JPG');
        INSERT INTO Photos VALUES ('9', './img/11/used-buses-for-sale-eldorodo-aerotech-220.JPG');
        INSERT INTO Photos VALUES ('9', './img/11/aerotech220-2.jpg');

        INSERT INTO Photos VALUES ('10', './img/12/U4X-9-700x397.png');
        INSERT INTO Photos VALUES ('10', './img/12/U4X-3-700x461.jpg');
EOF;

    // Create the table
    $db->query($sql);
    $db->close();
    echo "wrote database";
?>
	</body>
</html>