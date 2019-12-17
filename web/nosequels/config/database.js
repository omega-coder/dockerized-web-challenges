const mongoose = require('mongoose');
const mongoDB = 'mongodb://db/nosql_challenge';

mongoose.connect(mongoDB);
mongoose.Promise = global.Promise;

module.exports = mongoose;