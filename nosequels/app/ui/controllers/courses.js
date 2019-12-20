const courseModel = require('../../../models/courses');

module.exports = {
    getAll: function (req, res, next) {
        let courseList = []
        courseModel.find({}, function (err, courses) {
            if (err) {
                next(err);
            } else {
                for (let course of courses) {
                    if (course.owner !== 'admin') {
                        courseList.push({
                            id: course._id,
                            name: course.name,
                            cost: course.cost,
                            content: course.content,
                            owner: course.owner,
                        });
                    } else {
                        if (req.body.name !== 'admin') {
                            courseList.push({
                                id: course._id,
                                name: course.name,
                                cost: course.cost,
                                content: 'You must be admin to see the content of this course!',
                                owner: course.owner,
                            });
                        } else {
                            courseList.push({
                                id: course._id,
                                name: course.name,
                                cost: course.cost,
                                content: course.content,
                                owner: course.owner,
                            });
                        }

                    }

                }
                res.render('courses', {
                    courses: courseList,
                    user: {
                        name: req.body.name
                    }
                });
            }
        });
    }
}