

import os
from flask import Flask, render_template, render_template_string, request


app = Flask(__name__)
app.secret_key = os.urandom(16).hex()

def exploit_filter(exploit):
    message = ""
    if "_" in exploit:
        message = "_ detected in your exploit, find a way to bypass the filter" 
    return message, exploit.replace("_", " ")

@app.route("/", methods=["POST", "GET"])
def index():
    if request.method == "GET":
        rendered_template = render_template("level_3.html.j2", exploit=None, message=None)
        return render_template_string(rendered_template), 200

    else:
        exploit = request.form['exploit']
        message, exploit = exploit_filter(exploit)
        result = [message, exploit]
        return render_template_string(render_template("level_3.html.j2", result=result)), 200

if __name__ == "__main__":
    app.run(debug=True, port=9000, host='0.0.0.0')
