DROP SCHEMA IF EXISTS `group1`;
CREATE SCHEMA `group1`;
USE `group1`;

CREATE TABLE `customer` (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(45) NOT NULL,
    LastName VARCHAR(45) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Address VARCHAR(255) NOT NULL,
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
    DropDate DATETIME NOT NULL,
    PromiseDate DATETIME NOT NULL,
    PickupDate DATETIME,
    MethodOfPayment VARCHAR(45),
    CustomerID INT NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES `customer`(CustomerID) ON UPDATE RESTRICT ON DELETE CASCADE
);

CREATE TABLE `service` (
    ServiceID INT PRIMARY KEY AUTO_INCREMENT,
    Description VARCHAR(255),
    Price DECIMAL(10, 2) NOT NULL,
    HoursRequired INT NOT NULL
);

CREATE TABLE `order_item` (
    OrderItemID INT PRIMARY KEY AUTO_INCREMENT,
    Quantity INT NOT NULL,
    Instructions VARCHAR(255),
    OrderID INT NOT NULL,
    ServiceID INT NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES `order`(OrderID) ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (ServiceID) REFERENCES `service`(ServiceID) ON UPDATE RESTRICT ON DELETE CASCADE
);

# DELIMITER //
# CREATE FUNCTION order_insert_procedure (pCustomerID INT)
#     RETURNS INT
#     BEGIN
#         DECLARE curDate DATETIME;
#         DECLARE outOrderID INT;
#         SET curDate = NOW();
#         INSERT INTO `order` VALUES (DEFAULT, curDate, curDate, NULL, NULL, pCustomerID);
#         SELECT MAX(OrderID) AS outOrderID FROM `order`;
#         RETURN outOrderID;
#     END //
# CREATE PROCEDURE order_pickup_procedure (IN pOrderID INT, IN pMethodOfPayment VARCHAR(45))
#     BEGIN
#         UPDATE `order` SET PickupDate = NOW(), MethodOfPayment = pMethodOfPayment WHERE OrderID = pOrderID;
#     END //
# DELIMITER ;