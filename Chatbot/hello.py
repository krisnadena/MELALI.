from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import string
import random
import nltk
from flask import abort, Flask, jsonify, redirect, request, url_for
import json
nltk.download('punkt')
nltk.download('omw-1.4')
nltk.download('wordnet')
f = open('data.txt', 'r', errors='ignore')
raw = f.read()
raw = raw.lower()
sentence_list = nltk.sent_tokenize(raw)
def greeting_response(text):
    text = text.lower()
    
    #Bots greeting respone
    bot_greetings = ['howdy','hi','hello','hola']
    
    #Users greeting
    user_greetings = ['hi','hey','hello','greetings','wassup']
    
    for word in text.split():
        if word in user_greetings:
            return random.choice(bot_greetings)
        
    #Random response to greeting
def gratitude_response(text):
    text=text.lower()
    bot_gratitude = ['thank you','thanks','that is very kind of you','you are welcome']
    for word in text.split():
        if word in bot_gratitude:
            return random.choice(bot_gratitude)
def index_sort(list_var):
    length = len(list_var)
    list_index = list(range(0, length))
    
    x = list_var        
    for i in range(length):
        for j in range(length):
            if x[list_index[i]] > x[list_index[j]]:
                #swap
                temp = list_index[i]
                list_index[i] = list_index[j]
                list_index[j] = temp
    return list_index
def response(user_input):
    user_input=user_input.lower()
    sentence_list.append(user_input)
    bot_response= ''
    cm=CountVectorizer().fit_transform(sentence_list)
    similarity_scores=cosine_similarity(cm[-1],cm)
    similarity_scores_list=similarity_scores.flatten()
    index=index_sort(similarity_scores_list)
    index=index[1:]
    response_flag=0
    
    j=0
    for i in range(len(index)):
        if similarity_scores_list[index[i]]>0.0:
            bot_response=bot_response+' '+sentence_list[index[i]]
            response_flag=1
            j=j+1
        if j>2:
            break

        if response_flag==0:
            bot_response=bot_response+" "+"Maaf, kami tidak bisa mengerti pertanyaan anda"

        sentence_list.remove(user_input) 

        return bot_response
def response_api(data):
    return (
        jsonify(**data),
        data['code']
    )
app = Flask(__name__)

@app.route("/")
def hello_world():
    return "<p>Hello, World! Deploy nich...</p>"

@app.route("/works")
def it_works():
    return "IT Works! nyehehe"
    
@app.route('/chat', methods=['POST'])
def chat():
    if request.method == 'POST':
        data = request.form['message']
        hasil=response(data)
        if(data==hasil):
            hasil="Maaf, kami tidak bisa mengerti pertanyaan anda"
        return response_api({
            'code': 200,
            'message': 'Berhasil',
            'data': hasil
        })