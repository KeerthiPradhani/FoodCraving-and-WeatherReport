<?php

    /**
     * Custom class for the database. Provides some basic CRUD functionality for product and user management.
     */
    class StorefrontDB extends SQLite3
    {

        /**
         * Constructor. Uses "storefront.db" as the file.
         */
        function __construct()
        {
            $this->open('storefront.db');
        }

        /**
         * Initializes the database. Will drop existing tables!
         */
        public function initialize() {
            $this->exec("
            DROP TABLE IF EXISTS Users;
            CREATE TABLE Users (
                UserID INTEGER PRIMARY KEY,
                Username VARCHAR(60) UNIQUE NOT NULL,
                Salt VARCHAR(30) NOT NULL,
                Hash VARCHAR(30) NOT NULL
            );

            DROP TABLE IF EXISTS Products;
            CREATE TABLE Products (
                ProductID INTEGER PRIMARY KEY,
                Name VARCHAR(30) NOT NULL,
                Description VARCHAR(120) NOT NULL,
                ImageURL VARCHAR(256),
                Price REAL NOT NULL
            );

            DROP TABLE IF EXISTS ShoppingCart;
            CREATE TABLE ShoppingCart (
                UserID INTEGER NOT NULL,
                ProductID INTEGER NOT NULL,
                Quantity INTEGER NOT NULL,
                FOREIGN KEY(UserID) REFERENCES Users(UserID),
                FOREIGN KEY(ProductID) REFERENCES Products(ProductID)
            );
            ");
        }

        /**
         * Calculates a hash of a string.
         *
         * @param string $string the string to calculate the hash for
         * @return string calculated hash
         */
        private function calculateHash($string) {
            return hash('sha256', $string);
        }

        /**
         * Adds a product into the database.
         *
         * @param string $name the product name
         * @param string $description the product description
         * @param string $imageURL the product image URL
         * @param string $price the product price
         */
        public function addProduct($name, $description, $imageURL, $price) {
            $this->exec("INSERT INTO PRODUCTS (Name, Description, ImageURL, Price) VALUES ('$name', '$description', '$imageURL', $price)");
        }

        /**
         * Gets the database rows which represent all the products.
         *
         * @return SQLite3Result representing the product rows
         */
        public function getProducts() {
            return $this->query("SELECT * FROM PRODUCTS");
        }

        /**
         * Gets a database row which represents a product.
         *
         * @return SQLite3Result representing the product row
         */
        public function getProduct($productID) {
            return $this->query("SELECT * FROM PRODUCTS WHERE ProductID=$productID");
        }

        /**
         * Adds a user into the database.
         *
         * @param string $username the username to add
         * @param string $password the password for the user
         * @return {string} calculated hash
         */
        public function addUser($username, $password) {
            // Get the salt
            $salt = time();
            // Calculate the hash
            $hash = $this->calculateHash($salt.$password);
            // Insert the user into the database
            $this->exec("INSERT INTO Users (Username, Salt, Hash) VALUES ('$username', '$salt', '$hash')");
        }

        /**
         * Checks to see if credentials authenticates.
         *
         * @param string $username the username to authenticate
         * @param string $password the password to authenticate with
         * @return boolean true if the supplied credentials authenticate, false otherwise
         */
        public function authenticateUser($username, $password) {
            // Get the results from the query
            $results = $this->query("SELECT Salt, Hash FROM Users WHERE Username = '$username'");

            // Get the first row in the results
            $result = $results->fetchArray(SQLITE3_ASSOC);

            // Check to see if any results are present
            if ($result) {
                // Get the salt from the database
                $salt = $result['Salt'];
                // Get the hash from the database
                $expectedHash = $result['Hash'];
                // Calculate the hash supplied by the user (using the salt from the database)
                $actualHash = $this->calculateHash($salt.$password);
                // Return a match (or not) (password is invalid)
                return $expectedHash === $actualHash;
            } else {
                // Invalid username
                return false;
            }
        }

    }

?>
