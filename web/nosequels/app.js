const express = require("express");
const logger = require("morgan");
const users = require('./routes/users');
const courses = require('./routes/courses');
const bodyParser = require("body-parser");
const mongoose = require('./config/database');
var jwt = require('jsonwebtoken');

const app = express();

app.set('secret_key', '7bea58b7f18d965c1fab28292fd96ed719428b30');

mongoose.connection.on('error', console.error.bind(console, 'Mongodb connection error: '));

app.use(logger('dev'));

app.use(bodyParser.urlencoded({
    "extended": false
}));


app.get('/', function (req, res) {
    res.json({
        "status": "welcome to the NOSQL Challenge"
    });
});

app.use('/users', users);
app.use('/courses', validateUser, courses);

app.get('/favicon.ico', function (req, res) {
    res.sendStatus(204);
});

function validateUser(req, res, next) {
    jwt.verify(req.headers['x-access-token'], req.app.get('secret_key'), function (err, decoded) {
        if (err) {
            res.json({
                status: "error",
                message: 'x-access-token header is missing from request',
                data: null
            });
        } else {
            req.body.name = decoded.name;
            next();
        }
    });
}


app.use(function (req, res, next) {
    let err = new Error('Not Found');
    err.status = 404;
    next(err);
});

app.use(function (err, req, res, next) {
    console.log(err);

    if (err.status === 404)
        res.status(404).json({
            message: "Not found"
        });
    else
        res.status(500).json({
            message: "Something looks wrong :( !!!"
        });
});



app.listen(3000, function () {
    console.log("Server listening on port 3000;");
});