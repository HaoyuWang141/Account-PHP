DROP TABLE IF EXISTS users CASCADE ;
DROP TABLE IF EXISTS categories CASCADE ;
DROP TABLE IF EXISTS entries CASCADE ;

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT
);

CREATE TABLE entries (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(id),
    category_id INTEGER NOT NULL REFERENCES categories(id),
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    time TIMESTAMP,
    level INTEGER -- 0:普通消费, 1:小奢小贵, 2:大项支出
);
