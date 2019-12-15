const userModel = require('../models/users');
const jwt = require('jsonwebtoken');

module.exports = {
    'create': function (req, res, next) {
        if (req.body.name === 'admin') {
            res.json({
                status: "error",
                message: "you can't create a user with the admin name"
            });
        } else {
            userModel.create({
                name: req.body.name,
                email: req.body.email,
                password: req.body.password
            }, function (err, result) {
                if (err)
                    next(err);
                else
                    res.json({
                        status: "success",
                        message: "User added successfully!",
                        data: null
                    });
            });
        }

    },
    'authenticate': function (req, res, next) {
        userModel.findOne({
            name: req.body.name,
            password: req.body.password
        }, function (err, userInfo) {
            if (err) {
                next(err);
            } else {
                const token = jwt.sign({
                    id: userInfo._id,
                    name: userInfo.name,
                }, req.app.get('secret_key'), {
                    expiresIn: '1h'
                });
                delete userInfo.password;
                res.json({
                    status: "success",
                    message: "User Found!!",
                    data: {
                        user: userInfo,
                        token: token
                    }
                });
            }
        })
    }
}