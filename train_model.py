import joblib
import numpy as np
import pymysql
from sklearn.linear_model import LinearRegression

connection = pymysql.connect(
    host='localhost', 
    user='root', 
    password='', 
    database='spends'
)

query = """
    SELECT 
        YEAR(date_applied) AS year, 
        COUNT(*) AS beneficiaries
    FROM seniors
    WHERE application_status_id = 3
    GROUP BY YEAR(date_applied)
    ORDER BY year
"""
cursor = connection.cursor()
cursor.execute(query)
rows = cursor.fetchall()

inflation_data = {
    2019: 2.39, 2020: 2.39, 2021: 3.93, 2022: 5.82, 2023: 2.5  
}

X = []
y = []
cumulative_beneficiaries = 0

for row in rows:
    year = row[0]
    beneficiaries = row[1]
    cumulative_beneficiaries += beneficiaries

    inflation = inflation_data.get(year, 3.0)
    
    base_pension_per_person = 1000  
    annual_pension = base_pension_per_person * 12  
    adjusted_pension = annual_pension * (1 + inflation / 100)  
    
    total_pension = cumulative_beneficiaries * adjusted_pension  
    X.append([year, cumulative_beneficiaries, inflation])
    y.append(total_pension)

X = np.array(X)
y = np.array(y)

model = LinearRegression()
model.fit(X, y)

joblib.dump(model, 'model.pkl')

print("Model trained and saved successfully.")

cursor.close()
connection.close()
