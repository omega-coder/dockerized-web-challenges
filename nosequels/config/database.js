const mongoose = require("mongoose");
const dotenv = require("dotenv");
dotenv.config();

const CHALLENGE_USERNAME = process.env.CHALLENGE_USERNAME;
const CHALLENGE_DATABASE_NAME = process.env.CHALLENGE_DATABASE_NAME;
const CHALLENGE_PASSWORD = process.env.CHALLENGE_PASSWORD;
const CHALLENGE_DB_HOST = process.env.CHALLENGE_DB_HOST;

const mongoDB = `mongodb+srv://${CHALLENGE_USERNAME}:${CHALLENGE_PASSWORD}@${CHALLENGE_DB_HOST}/${CHALLENGE_DATABASE_NAME}?retryWrites=true&w=majority`;

console.log(mongoDB);

mongoose.connect(mongoDB);
mongoose.Promise = global.Promise;

module.exports = mongoose;
