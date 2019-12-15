

import os
from flask import Flask, render_template, render_template_string, request


app = Flask(__name__)
app.secret_key = os.urandom(16).hex()

app.config["LEVEL"] = os.environ.get('SSTI_LEVEL')

if app.config["LEVEL"] is not None:
    template_name = "level_{}.html.j2".format(app.config['LEVEL'])
else:
    template_name = "level_1.html.j2"



@app.route("/", methods=["POST", "GET"])
def index():
    if request.method == "GET":
        rendered_template = render_template(template_name, exploit=None)
        return render_template_string(rendered_template), 200

    else:
        exploit = request.form['exploit']
        return render_template_string(render_template(template_name, exploit=exploit)), 200

if __name__ == "__main__":
    app.run(debug=True, port=9000, host='0.0.0.0')
