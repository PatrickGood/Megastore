Use prgo222;
CREATE TABLE Users (
		username VARCHAR(255) NOT NULL, 
		password VARCHAR(255) NOT NULL,  
		email VARCHAR(255) NOT NULL, 
		fname VARCHAR(255) NOT NULL, 
		lname VARCHAR(255) NOT NULL, 
		u_street VARCHAR(255) NOT NULL, 
		u_city VARCHAR(255) NOT NULL, 
		u_state CHAR(2) NOT NULL, 
		u_zip CHAR(5) NOT NULL, 
		u_type VARCHAR(255) NOT NULL,
		PRIMARY KEY (username)
		
);
CREATE TABLE Inventory(
		itemID INTEGER NOT NULL, 
		name VARCHAR(255) NOT NULL UNIQUE, 
		brand VARCHAR(255) NOT NULL, 
		item_type VARCHAR(255) NOT NULL, 
		quantity INTEGER NOT NULL, 
		price float NOT NULL, 
		on_promotion BOOLEAN NOT NULL, 
		promo_price float NOT NULL, 
		image_path VARCHAR(255) NOT NULL, 
		description VARCHAR(255) NOT NULL,
		PRIMARY KEY (itemID)	
);
CREATE TABLE Cart(
		itemID INTEGER NOT NULL, 
		desired_quantity INTEGER NOT NULL, 
		username VARCHAR(255) NOT NULL,
		PRIMARY KEY (username, itemID),
		FOREIGN KEY (itemID) REFERENCES Inventory(itemID),
		FOREIGN KEY (username) REFERENCES Users(username)
);
CREATE TABLE Orders(
		orderID INTEGER NOT NULL AUTO_INCREMENT, 
		username VARCHAR(255) NOT NULL, 
		status BOOLEAN DEFAULT 0  NOT NULL, 
		o_date TIMESTAMP NOT NULL DEFAULT NOW(), 
		shipping_address_street VARCHAR(255) NOT NULL, 
		shipping_address_state VARCHAR(255) NOT NULL, 
		shipping_address_city VARCHAR(255) NOT NULL, 
		shipping_address_zip VARCHAR(255) NOT NULL,
		total_price float NOT NULL,
		PRIMARY KEY (orderID,username),
		FOREIGN KEY (username) REFERENCES Users(username)
);
CREATE TABLE Order_Details(
		orderID INTEGER NOT NULL, 
		itemId INTEGER NOT NULL, 
		quantity INTEGER NOT NULL, 
		component_price float NOT NULL,
		PRIMARY KEY (orderID, itemID),
		FOREIGN KEY (itemID) REFERENCES Inventory(itemID),
		FOREIGN KEY (orderID) REFERENCES Orders(orderID)
);



