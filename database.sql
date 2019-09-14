create database test;

use test;

CREATE TABLE `suan1db` (
   `id` int(11) NOT NULL auto_increment,
  `productname` varchar(100) NOT NULL,
  `productdescription` varchar(100) NOT NULL,
  `productprice` int(100) NOT NULL,
  `productquantity` int(100) NOT NULL,
   PRIMARY KEY  (`id`)
);