const mongoose = require('mongoose');

// Schema definition

const Schema = mongoose.Schema;

const CourseSchema = new Schema({
    name: {
        type: String,
        trim: true,
        required: true,
    },
    cost: {
        type: Number,
        default: 10,
    }

});

module.exports = mongoose.model('Course', CourseSchema);