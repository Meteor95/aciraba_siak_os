const mysql = require("mysql")
require("dotenv").config()
const koneksinya = {};

koneksinya.konekdatabase = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: process.env.DB_NAME,
    port: process.env.DB_PORT,
})

module.exports = koneksinya; 