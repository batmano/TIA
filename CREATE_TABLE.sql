-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2017-04-16 21:00:53.974

-- tables
-- Table: Account
CREATE TABLE Account (
    account_id int NOT NULL AUTO_INCREMENT,
    client_id int NOT NULL,
    product_id int NOT NULL,
    amount numeric(15,2) NOT NULL DEFAULT 0,
    per_month int NOT NULL DEFAULT 0,
    loan numeric(15,2) NOT NULL DEFAULT 0,
    paid numeric(15,2) NOT NULL DEFAULT 0,
    CONSTRAINT Account_pk PRIMARY KEY (account_id)
);

-- Table: Branch
CREATE TABLE Branch (
    branch_id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    UNIQUE INDEX Branch_ak_1 (name),
    CONSTRAINT Branch_pk PRIMARY KEY (branch_id)
);

-- Table: Client
CREATE TABLE Client (
    client_id int NOT NULL AUTO_INCREMENT,
    first_name varchar(25) NOT NULL,
    last_name varchar(50) NOT NULL,
    current_amount numeric(15,2) NOT NULL,
    CONSTRAINT Client_pk PRIMARY KEY (client_id)
);

-- Table: Employee
CREATE TABLE Employee (
    employee_id int NOT NULL AUTO_INCREMENT,
    first_name varchar(25) NOT NULL,
    last_name varchar(50) NOT NULL,
    position_id int NOT NULL,
    branch_id int NOT NULL,
    CONSTRAINT Employee_pk PRIMARY KEY (employee_id)
);

-- Table: Position
CREATE TABLE Position (
    position_id int NOT NULL AUTO_INCREMENT,
    position_name varchar(25) NOT NULL,
    CONSTRAINT Position_pk PRIMARY KEY (position_id)
);

-- Table: Product
CREATE TABLE Product (
    product_id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    CONSTRAINT Product_pk PRIMARY KEY (product_id)
);

-- Table: Product_sold
CREATE TABLE Product_sold (
    sale_id int NOT NULL AUTO_INCREMENT,
    product_id int NOT NULL,
    employee_id int NOT NULL,
    branch_id int NOT NULL,
    client_id int NOT NULL,
    sale_date date NOT NULL,
    CONSTRAINT Product_sold_pk PRIMARY KEY (sale_id)
);

-- Table: Transactions
CREATE TABLE Transactions (
    transaction_id bigint NOT NULL AUTO_INCREMENT,
    client_id int NOT NULL,
    employee_id int NOT NULL,
    amount numeric(15,2) NOT NULL,
    receiver_id int NOT NULL,
    date date NOT NULL,
    CONSTRAINT Transactions_pk PRIMARY KEY (transaction_id)
);

-- foreign keys
-- Reference: Account_Client (table: Account)
ALTER TABLE Account ADD CONSTRAINT Account_Client FOREIGN KEY Account_Client (client_id)
    REFERENCES Client (client_id);

-- Reference: Account_Product (table: Account)
ALTER TABLE Account ADD CONSTRAINT Account_Product FOREIGN KEY Account_Product (product_id)
    REFERENCES Product (product_id);

-- Reference: Bank_employees_Branch (table: Employee)
ALTER TABLE Employee ADD CONSTRAINT Bank_employees_Branch FOREIGN KEY Bank_employees_Branch (branch_id)
    REFERENCES Branch (branch_id);

-- Reference: Bank_employees_Position (table: Employee)
ALTER TABLE Employee ADD CONSTRAINT Bank_employees_Position FOREIGN KEY Bank_employees_Position (position_id)
    REFERENCES Position (position_id);

-- Reference: Sale_product_Bank_employees (table: Product_sold)
ALTER TABLE Product_sold ADD CONSTRAINT Sale_product_Bank_employees FOREIGN KEY Sale_product_Bank_employees (employee_id)
    REFERENCES Employee (employee_id);

-- Reference: Sale_product_Branch (table: Product_sold)
ALTER TABLE Product_sold ADD CONSTRAINT Sale_product_Branch FOREIGN KEY Sale_product_Branch (branch_id)
    REFERENCES Branch (branch_id);

-- Reference: Sale_product_Client (table: Product_sold)
ALTER TABLE Product_sold ADD CONSTRAINT Sale_product_Client FOREIGN KEY Sale_product_Client (client_id)
    REFERENCES Client (client_id);

-- Reference: Sale_product_Product (table: Product_sold)
ALTER TABLE Product_sold ADD CONSTRAINT Sale_product_Product FOREIGN KEY Sale_product_Product (product_id)
    REFERENCES Product (product_id);

-- Reference: Transaction_Bank_employees (table: Transactions)
ALTER TABLE Transactions ADD CONSTRAINT Transaction_Bank_employees FOREIGN KEY Transaction_Bank_employees (employee_id)
    REFERENCES Employee (employee_id);

-- Reference: Transaction_receiver (table: Transactions)
ALTER TABLE Transactions ADD CONSTRAINT Transaction_receiver FOREIGN KEY Transaction_receiver (receiver_id)
    REFERENCES Client (client_id);

-- End of file.

