# -*- coding: utf-8 -*-
"""Project Akhir Rekomendasi.ipynb

Automatically generated by Colaboratory.

Original file is located at
    https://colab.research.google.com/drive/1M0KW4tl28byjWoncU-tOqrK-uWHVNkwT
"""

import pandas as pd
import numpy as np
import mysql.connector

dataset = pd.read_csv('content/Data Besar.csv')
print('Shape dataset:', dataset.shape)
print('\nLima data teratas:\n', dataset.head())
print('\nInformasi dataset:')
print(dataset.info())
print('\nStatistik deskriptif:\n', dataset.describe())

print(dataset.isnull().sum())

# import numpy as np
# from sklearn.preprocessing import LabelEncoder
# # Convert feature/column 'Month'
# LE = LabelEncoder()
# dataset['Nama'] = LE.fit_transform(dataset['Nama'])
# print(LE.classes_)
# print(np.sort(dataset['Nama'].unique()))
# print('')

# # Convert feature/column 'VisitorType'
# LE = LabelEncoder()
# dataset['Category'] = LE.fit_transform(dataset['Category'])
# print(LE.classes_)
# print(np.sort(dataset['Category'].unique()))

# LE = LabelEncoder()
# dataset['Images'] = LE.fit_transform(dataset['Images'])
# print(LE.classes_)
# print(np.sort(dataset['Place'].unique()))

# LE = LabelEncoder()
# dataset['Link_gmaps'] = LE.fit_transform(dataset['Link_gmaps'])
# print(LE.classes_)
# print(np.sort(dataset['Link_gmaps'].unique()))

# LE = LabelEncoder()
# dataset['Images'] = LE.fit_transform(dataset['Images'])
# print(LE.classes_)
# print(np.sort(dataset['Images'].unique()))

import matplotlib.pyplot as plt
import seaborn as sns
import numpy as np
# checking the Distribution of customers on Revenue
plt.rcParams['figure.figsize'] = (12,5)
plt.subplot(1, 2, 1)
sns.countplot(dataset['Rating'], palette = 'pastel')
plt.title('Rating Destination', fontsize = 20)
plt.xlabel('Destination', fontsize = 14)
plt.ylabel('Rating', fontsize = 14)
plt.show()

"""# Formula dari IMDB dengan Weighted Rating  

v: jumlah ulasan/comment untuk film tersebut   
m: jumlah minimum ulasan/comment yang dibutuhkan supaya dapat masuk dalam chart   
R: rata-rata rating dari film tersebut   
D: nilai rating minimal untuk kita tampilkan di rekomendasi
"""

D = 4

m = dataset['Comment'].quantile(0.2)
print(m)

def imdb_weighted_rating(df, var=0.8):
    v = df['Comment']
    R = df['Rating']
    m = df['Comment'].quantile(var)
    df['score'] = (v/(m+v))*R + (m/(m+v))*D # rumus IMDb 
    return df['score']
    
imdb_weighted_rating(dataset)

# # melakukan pengecekan dataframe
# print(dataset.head())

# data_new = df(['score'])

# # removing the target column Revenue from dataset and assigning to X
# X = df.drop(['Rating'], axis = 1)
# # assigning the target column Revenue to y
# y = df['score']
# # checking the shapes
# print("Shape of X:", X.shape)
# print("Shape of y:", y.shape)

# from sklearn.tree import DecisionTreeClassifier
# # Call the classifier
# model = DecisionTreeClassifier()
# # Fit the classifier to the training data
# model = model.fit(X_train,y_train)
# # Apply the classifier/model to the test data
# y_pred = model.predict(X_test)
# print(y_pred.shape)

# from sklearn.model_selection import train_test_split
# # splitting the X, and y
# X_train, X_test, y_train, y_test = train_test_split(X, y, test_size = 0.2, random_state = 0)
# # checking the shapes
# print("Shape of X_train :", X_train.shape)
# print("Shape of y_train :", y_train.shape)
# print("Shape of X_test :", X_test.shape)
# print("Shape of y_test :", y_test.shape)

# from sklearn.metrics import confusion_matrix, classification_report

# # evaluating the model
# print('Training Accuracy :', model.score(X_train, y_train))
# print('Testing Accuracy :', model.score(X_test, y_test))

# confusion matrix
#print('\nConfusion matrix:')
# cm = confussion_matrix(y_test, y_pred)
# print(cm)

# # classification report
# print('\nClassification report:')
# #cr = classification.report(y_test, y_pred)
# print(cr)

def simple_recommender(df, top=10):
      
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password='',
        database="book_db"
    )
    mycursor = mydb.cursor()
    #mycursor.execute('insert into rekomendasi values')
    mycursor.execute('delete from rekomendasi')
    mydb.commit()
    for x in range(0,len(df['Nama'])-1):
        sql = "INSERT INTO rekomendasi(name,category,price,rating,place,link_gmaps,link_images) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (df['Nama'][x],df['Category'][x],np.float64(df['Price'][x]),np.float64(df['Rating'][x]),df['Place'][x],df['Link_gmaps'][x],df['Images'][x])
        #print(val)
        mycursor.execute (sql, val)
        mydb.commit()
    df = df.loc[df['Comment'] >= m]
    df = df.sort_values(by='score',ascending=False) #urutkan dari nilai tertinggi ke terendah
    
    # mengambil 10 teratas
    df = df[:top]
    
    return df
    

    
# mengambil 10 data teratas  
 
print(simple_recommender(dataset, top=9))

"""# Referensi :

Github : https://github.com/RobyRiyanto/Building-Recommender-System/blob/main/data/movie_rating.csv

The Hybrid Recommender System of the Indonesian Online Market Products using IMDb weight rating and TF-IDF (Dari Jurnal Rekayasa Sistem dan Sistem Informasi)

http://jurnal.iaii.or.id/index.php/RESTI/article/view/3486/497
"""