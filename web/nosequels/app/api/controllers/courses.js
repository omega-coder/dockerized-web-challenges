const courseModel = require('../models/courses');

module.exports = {
    getById: function (req, res, next) {
        console.log(req.body);
        courseModel.findById(req.params.courseId, function (err, courseInfo) {
            if (err) {
                next(err);
            } else {
                res.json({
                    status: "success",
                    message: "Course Found!",
                    data: {
                        course: courseInfo
                    }
                });
            }
        })
    },
    getAll: function (req, res, next) {
        console.log(req.body);
        let courseList = [];
        courseModel.find({}, function (err, courses) {
            if (err) {
                next(err);
            } else {
                for (let course of courses) {
                    courseList.push({
                        id: course._id,
                        name: course.name,
                        cost: course.cost,
                        content: course.content
                    });
                }
                res.json({
                    status: "success",
                    message: "Courses list found!",
                    data: {
                        courses: courseList
                    }
                });
            }
        })
    }
}