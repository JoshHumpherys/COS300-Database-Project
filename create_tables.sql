DROP SCHEMA IF EXISTS `marciadb`;
CREATE SCHEMA `marciadb`;
USE `marciadb`;

CREATE TABLE `customer` (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(45) NOT NULL,
    LastName VARCHAR(45) NOT NULL,
    Email VARCHAR(255),
    Address VARCHAR(255),
    HasMembership BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE `phone` (
    CustomerID INT,
    Phone VARCHAR(45),
    PRIMARY KEY (CustomerID, Phone),
    FOREIGN KEY (CustomerID) REFERENCES `customer`(CustomerID) ON UPDATE RESTRICT ON DELETE CASCADE
);

CREATE TABLE `order` (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    DropDate DATE NOT NULL,
    PromiseDate DATE,
    PickupDate DATE,
    MethodOfPayment VARCHAR(45),
    CustomerID INT NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES `customer`(CustomerID) ON UPDATE RESTRICT ON DELETE CASCADE
);

CREATE TABLE `order_item` (
    OrderItemID INT PRIMARY KEY AUTO_INCREMENT,
    Quantity INT NOT NULL,
    Description VARCHAR(255),
    Instructions VARCHAR(255)
);

CREATE TABLE `service` (
    ServiceID INT PRIMARY KEY AUTO_INCREMENT,
    Description VARCHAR(255),
    Price DECIMAL(10, 2) NOT NULL,
    HoursRequired INT NOT NULL
);

CREATE TABLE `order_item_has_service` (
    OrderItemID INT,
    ServiceID INT,
    PRIMARY KEY (OrderItemID, ServiceID),
    FOREIGN KEY (OrderItemID) REFERENCES `order_item`(OrderItemID) ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (ServiceID) REFERENCES `service`(ServiceID) ON UPDATE RESTRICT ON DELETE CASCADE
);
