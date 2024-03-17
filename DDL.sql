CREATE SCHEMA CarRentalSystem;
USE           CarRentalSystem;

CREATE TABLE CAR(

PLATE     CHAR(10)                                    NOT NULL,
MOTOR_ID  VARCHAR(255)                                NOT NULL,
MODEL     VARCHAR(255)                                NOT NULL,
YEAR      INT                                         NOT NULL,
CLASS     VARCHAR(255)                                NOT NULL,
BRAND     VARCHAR(255)                                NOT NULL,
COLOR     VARCHAR(255)                                NOT NULL,
STATUS    VARCHAR(255)                                NOT NULL DEFAULT "active",
IMAGE     VARCHAR(300),
PRICE_DAY DECIMAL(10,2)                               NOT NULL,
OFFICE_ID INT                                         NOT NULL,
RESERVED  BOOLEAN                                     NOT NULL DEFAULT 0,


PRIMARY KEY(PLATE)
);


CREATE TABLE CUSTOMER(

SSN         CHAR(14)                                    NOT NULL,
FNAME       VARCHAR(255)                                NOT NULL,
LNAME       VARCHAR(255)                                NOT NULL,
EMAIL       VARCHAR(255)                                NOT NULL,
PASSWORD    VARCHAR(255)                                NOT NULL,
LICENSE_NO  CHAR(14)                                    NOT NULL,
PHONE_NO    CHAR(14)                                    NOT NULL,
COUNTRY     VARCHAR(255)                                NOT NULL,
CITY        VARCHAR(255)                                NOT NULL,
ADDRESS     VARCHAR(255)                                NOT NULL,

PRIMARY KEY(SSN)
);



CREATE TABLE RENT(

RENT_ID          INT                          NOT NULL AUTO_INCREMENT,
SSN              CHAR(14)                                    NOT NULL,
PLATE            CHAR(10)                                    NOT NULL,
RENTED_DATE      DATETIME                                    NOT NULL,
RETURNED_DATE    DATETIME                                    NOT NULL,
TOTAL_PRICE      DECIMAL(11,2)                               NOT NULL,
RETURNED         BOOLEAN                           NOT NULL DEFAULT 0,
PICKED_UP        BOOLEAN                           NOT NULL DEFAULT 0,
PAID             BOOLEAN                           NOT NULL DEFAULT 0,

PRIMARY KEY(RENT_ID,SSN,PLATE)
);

CREATE TABLE PAYMENT(

PAYMENT_ID      INT                          NOT NULL AUTO_INCREMENT,
RENT_ID         INT                          NOT NULL,
PAYMENT_DATE    TIMESTAMP                    NOT NULL,
PRICE           DECIMAL(11,2)                NOT NULL,
CARD_NO         VARCHAR(255)                 NOT NULL,
CVC             VARCHAR(10)                  NOT NULL,
/*card expiration date*/

PRIMARY KEY(PAYMENT_ID,RENT_ID)
);

CREATE TABLE ADMIN (

FNAME       VARCHAR(255)                                NOT NULL,
LNAME       VARCHAR(255)                                NOT NULL,
EMAIL       VARCHAR(255)                                NOT NULL,
PASSWORD    VARCHAR(255)                                NOT NULL,

PRIMARY KEY(EMAIL)
);

CREATE TABLE OFFICE (

OFFICE_ID       INT                                     NOT NULL AUTO_INCREMENT,
CITY            VARCHAR(255)                            NOT NULL,


PRIMARY KEY(OFFICE_ID)
);

ALTER TABLE RENT    ADD FOREIGN KEY(PLATE)       REFERENCES CAR(PLATE);
ALTER TABLE RENT    ADD FOREIGN KEY(SSN)         REFERENCES CUSTOMER(SSN);
ALTER TABLE PAYMENT ADD FOREIGN KEY (RENT_ID)    REFERENCES RENT(RENT_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE CAR     ADD FOREIGN KEY(OFFICE_ID)   REFERENCES OFFICE(OFFICE_ID);