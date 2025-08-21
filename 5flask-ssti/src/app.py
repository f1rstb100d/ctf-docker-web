from flask import Flask
from flask import request
from flask import render_template_string

app = Flask(__name__)

Introduction = """
此脚本仅为演示，使用此模板时请移除此文件
此文件实现了 /flag 和 / 两个路由，其中 /flag 直接返回flag
"""


@app.route('/', methods=['GET', 'POST'])
def index():
    template = '''
    <h2>请GET传参name</h2>
    <p>Hello %s </p>''' % (request.args.get('name'))
    return render_template_string(template)


#@app.route("/flag")
#def flag():
#    with open("/flag", "r") as f:
#        return f.read()
