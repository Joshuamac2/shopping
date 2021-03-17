# Shopping

<h5> Steps using terminal </h5>

- (1) Create database 'cart'
- (2) Create table 'tools'
```
CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
 `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
```
- (3) Insert values
```
INSERT INTO tools VALUE (1, "Sledgehammer", 125.75);
INSERT INTO tools VALUE (2, "Axe", 190.50);
INSERT INTO tools VALUE (3, "Bandsaw", 562.131);
INSERT INTO tools VALUE (4, "Chisel", 12.9);
INSERT INTO tools VALUE (5, "Hacksaw", 18.45);
```
