INSERT INTO BRANCH (NAME) VALUES ('Pobocka BA');
INSERT INTO BRANCH (NAME) VALUES ('Pobocka KE');
INSERT INTO BRANCH (NAME) VALUES ('Pobocka ZA');
INSERT INTO BRANCH (NAME) VALUES ('Pobocka PO');


INSERT INTO `position`(`position_name`) VALUES ('FINANCNY PORADCA');
INSERT INTO `position`(`position_name`) VALUES ('OSOBNY BANKAR');
INSERT INTO `position`(`position_name`) VALUES ('RIADITEL POBOCKY');


INSERT INTO `employee`( `first_name`, `last_name`, `position_id`, `branch_id`) 
VALUES ('Mato','Rarogiewicz', 3, 1);
        
INSERT INTO `employee`( `first_name`, `last_name`, `position_id`, `branch_id`) 
VALUES ('Jano','Kuzelnik', 1, 1);

INSERT INTO `employee`( `first_name`, `last_name`, `position_id`, `branch_id`) 
VALUES ('Monika','Pekna', 2, 1);



INSERT INTO `client`(`client_id`, `first_name`, `last_name`, `current_amount`) 
VALUES (-1, 'BANKA', 'BANKA', 1000000);

INSERT INTO `client`( `first_name`, `last_name`, `current_amount`) 
VALUES ('Klaudia', 'Mocna', 1500);

INSERT INTO `product`( `name`) VALUES ('BEZNY UCET');
INSERT INTO `product`( `name`) VALUES ('BEZUCELOVY UVER');
INSERT INTO `product`( `name`) VALUES ('HYPOTEKA');


INSERT INTO `account`(`account_id`, `client_id`, `product_id`, `amount`, `per_month`, `loan`, `paid`) 
VALUES (-1,-1,1,1000000,-1,-1,-1);

INSERT INTO `account`( `client_id`, `product_id`, `amount`, `per_month`, `loan`, `paid`) 
VALUES (1,1,1500,-1,-1,-1);


INSERT INTO `product_sold`(`product_id`, `employee_id`, `branch_id`, `client_id`, `sale_date`) VALUES 
(1,1,1,1,now())