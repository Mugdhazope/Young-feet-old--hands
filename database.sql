-- Creating the "volunteer" table
CREATE TABLE volunteer (
    name VARCHAR(255),
    number BIGINT PRIMARY KEY,
    gender VARCHAR(10),
    age INT,
    area VARCHAR(255)
);

-- Creating the "elder" table
CREATE TABLE elder (
    name VARCHAR(255),
    number BIGINT PRIMARY KEY,
    gender VARCHAR(10),
    age INT,
    area VARCHAR(255),
    help VARCHAR(2)
);
