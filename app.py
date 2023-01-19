from crypt import methods
from urllib import response
from flask import Flask, render_template, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route("/", methods=['GET'])
def index_get():
    from test import init
    args = request.args
    userMsg = args.get('message', default="bruh", type=str)
    userMsg = userMsg.replace('_', ' ')
    if len(userMsg) <1:
        return " "
    else:
        responseMsg = init(userMsg)
        return responseMsg

if __name__ == "__main__":
    app.run(debug=True)