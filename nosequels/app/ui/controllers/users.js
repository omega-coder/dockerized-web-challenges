const userModel = require('../../../models/users');
const jwt = require('jsonwebtoken');


module.exports = {
    'create': function (req, res, next) {
        if (req.body.name && req.body.password && req.body.email) {
            userModel.create({
                name: req.body.name,
                email: req.body.email,
                password: req.body.password
            }, function (errors, result) {
                if (err) {
                    next(err);
                } else {
                    res.render('login', {
                        message: "User created succesfully!"
                    });
                }
            })
        }
    }
}