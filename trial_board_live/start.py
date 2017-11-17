from flask import Flask
app = Flask(__name__)


@app.route('/hi')
def trial_board_live():
	#if request.method == 'GET':
	return 'asdffdsa world'
@app.route('/hello')
def hello_world():
    return 'hello world'

@app.route('/fuck/fuck',methods=['GET'])
def fucking_world():
	#if request.method == 'GET':
	return 'Fucking world'

@app.route('/user/<username>')
def show_user_profile(username):
    # show the user profile for that user
    return 'User %s' % username
	
if __name__ == '__main__':
    app.run(host='0.0.0.0')