-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 08:22 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

/* Inicio Permisos de los usuarios  */
INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`)
VALUES ( 'login', 'login user', '001');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'logout', 'logout user', '002');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access  module account', 'access  module account', '010');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Get Account Information', 'Get Account Information', '011');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify Account Information', 'modify Account Information', '012');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module account items found', 'access module account items found', '020');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account found items', 'get account found items', '021');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account found item', 'get specific account found item', '022');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify found item', 'modify found item', '023');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create found item', 'create found item', '024');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete found item', 'delete found item', '025');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module account items lost', 'access module account items lost', '030');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account lost items', 'get account lost items', '031');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account lost item', 'get specific account lost item', '032');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify lost item', 'modify lost item', '033');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create lost item', 'create lost item', '034');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete lost item', 'delete lost item', '035');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module orders', 'access module orders', '040');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account orders', 'get account orders', '041');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account order', 'get specific account order', '042');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify found order', 'modify found order', '043');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create  order', 'create  order', '044');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  order', 'delete  order', '045');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module shipments', 'access module shipments', '050');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account shipments', 'get account shipments', '051');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account shipment', 'get specific account shipment', '052');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify found shipment', 'modify found shipment', '053');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create  shipment', 'create  shipment', '054');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  shipment', 'delete  shipment', '055');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module Requests', 'access module Requests', '060');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account  Requests', 'get account  Requests', '061');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account  Request', 'get specific account  Request', '062');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module notifications', 'access module notifications', '070');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get account notifications', 'get account notifications', '071');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific account notification', 'get specific account notification', '072');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  notification', 'modify  notification', '073');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  notification', 'delete  notification', '075');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get chats account', 'get chats account', '081');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'open chat account', 'open chat account', '082');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify chat account', 'modify chat account', '083');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'creat chat account', 'creat chat account', '084');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete chat account', 'delete chat account', '085');


/* Fin Permisos de los usuarios  */

/* Inicio Permisos de los empleados  */
INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'login', 'login employee', '300');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'logout', 'logout', '301');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Get Account Information', 'Get Account Information', '310');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify Account Information', 'modify Account Information', '311');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module items found', 'access module items found', '320');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get  found items', 'get  found items', '321');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific found item', 'get specific found item', '322');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify found item', 'modify found item', '323');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete found  item', 'delete found  item', '325');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module items lost', 'access module items lost', '330');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get  lost items', 'get  lost items', '331');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific  lost  item', 'get specific  lost  item', '332');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  lost item', 'modify  lost item', '333');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  lost  item', 'delete  lost  item', '335');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module orders', 'access module orders', '340');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get orders', 'get orders', '341');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific  order', 'get specific  order', '342');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  order', 'modify  order', '343');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  order', 'delete  order', '345');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module shipments', 'access module shipments', '350');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get shipments', 'get shipments', '351');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific shipment', 'get specific shipment', '352');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  shipment', 'modify  shipment', '353');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  shipment', 'delete  shipment', '355');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module notifications', 'access module notifications', '370');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get notifications', 'get notifications', '371');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific notification', 'get specific notification', '372');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  notification', 'modify  notification', '373');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create notification', 'create notification', '374');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  notification', 'delete  notification', '375');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'access module chats', 'access module chats', '380');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get chats', 'get chats', '381');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'open chat', 'open chat', '382');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify  chat', 'modify  chat', '383');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create chat', 'create chat', '384');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete  chat', 'delete  chat', '385');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get specific chat', 'get specific chat', '386');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Access modulo employee', 'Access modulo employee', '390');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get employees', 'get employees', '391');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get spefific employee', 'get spefific employee', '392');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify employee', 'modify employee', '393');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'create employee', 'create employee', '394');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'delete employee', 'delete employee', '395');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Access modulo statistics', 'Access modulo statistics', '400');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get statistics', 'get statistics', '401');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Access modulo record', 'Access modulo record', '410');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get records', 'get records', '411');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get speficic record', 'get speficic record', '412');


INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'Access modulo configurations', 'Access modulo configurations', '420');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'get configurations', 'get configurations', '421');

INSERT INTO `ap_wilwif`.`permission` ( `name`, `description`, `code`) 
VALUES ( 'modify configurations', 'modify configurations', '422');
/* end  Permisos de los empleados */

/* start Add roles */

INSERT INTO `rol` ( `code`, `name`, `description`, `slug`) VALUES
( '001', 'user', 'is the default rol for register people', 'user');

INSERT INTO `rol` ( `code`, `name`, `description`, `slug`) VALUES
('010', 'Administrator', 'is the user with all the permitions', 'admin');

/* end Add Roles */


/* Start permitions to rol

(select id from rol where code ="010") get id rol admin 
(select id from rol where code ="001")   get id rol user 
(select id from permission where code ="010")  get the id of a permssion by code
*/
INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="001"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="002"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="010"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="011"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="012"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="020"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="021"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="022"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="023"),(select id from rol where code ="001"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="024"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="025"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="030"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="031"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="032"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="033"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="034"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="035"),(select id from rol where code ="001"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="040"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="041"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="042"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="043"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="044"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="045"),(select id from rol where code ="001"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="050"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="051"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="052"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="053"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="054"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="055"),(select id from rol where code ="001"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="060"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="061"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="062"),(select id from rol where code ="001"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="070"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="071"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="072"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="073"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="075"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="081"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="082"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="083"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="084"),(select id from rol where code ="001"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="085"),(select id from rol where code ="001"));



INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="300"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="301"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="310"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="311"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="320"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="321"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="322"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="323"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="325"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="330"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="331"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="332"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="333"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="335"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="340"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="341"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="342"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="343"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="345"),(select id from rol where code ="010"));



INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="350"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="351"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="352"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="353"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="355"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="370"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="371"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="372"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="373"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="374"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="375"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="380"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="381"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="382"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="383"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="384"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="385"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="386"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="390"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="391"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="392"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="393"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="394"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="395"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="400"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="401"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="410"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="411"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="412"),(select id from rol where code ="010"));



INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="420"),(select id from rol where code ="010"));

INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="421"),(select id from rol where code ="010"));


INSERT INTO `ap_wilwif`.`permission_rol` (`id_permission`, `id_rol`) 
VALUES ( (select id from permission where code ="422"),(select id from rol where code ="010"));

/* end  permitions to tol */

/* create admin user clave admin2016in*/

INSERT INTO `ap_wilwif`.`user` (`name`,`username`,`password`,`email`)
VALUES ("Administrator","Admin", "7c4927148c45e356a9a93231a595cd50", "info@zuaru.com");

/* end create admin user */


/*  create secuty question */

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("Your mother's middle name?");

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("Your favorite tv show?");

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("Your pet name?");

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("What is your dream job?");

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("Who was your best childhood friend?");

INSERT INTO `ap_wilwif`.`security_question` ( `label`) 
VALUES ("In which city did your mother and father meet?");

/*  end secuty question */

/* create Status */ 
INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Unread', 'Message or notification that are unread');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Read', 'Message or notification that are Read');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Active', ' is Active');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Erased', 'is deleted');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Locked', 'is bloqued');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Waiting', 'is waiting');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'On Hold', 'is waiting');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Canceled', 'is canceled');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Completed', 'is completed');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'On Way', ' already shiped');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Returned', ' is Returned');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Returned', ' is Returned');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Arrive', 'already is in the destination');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Lost', ' is Lost');

INSERT INTO `ap_wilwif`.`status` (`id`, `status`, `description`)
VALUES (NULL, 'Found', ' is Found');

/* End Status */ 

/*  Create Item Category Base  */
INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Passport', 'Passport');
 
INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Identity Number', 'ID');
 
 INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Wallet', 'Wallet');
 
 INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Smarth Phones', 'Phones');
 
 INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Luggage', 'Luggage');
 
  INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Pet', 'Pet');
 
 INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Accessory', 'Accessory');
 
  INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Laptop', 'Laptop');
  
 INSERT INTO `ap_wilwif`.`item_category` ( `name`, `slug`)
 VALUES ( 'Etc', 'Other');
/*  End item Category Base*/