from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import numpy as np
import random

app = Flask(__name__)
CORS(app) 

model = joblib.load('model.pkl')

@app.route('/admin/dashboard', methods=['POST'])
def predict_dashboard():
    data = request.get_json()
    features = data['features']

    if not all(len(row) == 3 for row in features):
        return jsonify({'error': 'Invalid input format. Each row must have 3 features.'}), 400

    predictions = model.predict(features).tolist()

    last_row = features[-1]
    last_year = last_row[0]
    cumulative_beneficiaries = last_row[1]
    inflation = last_row[2]

    future_predictions = []
    for i in range(1, 6):
        next_year = last_year + i
        cumulative_beneficiaries += random.randint(500, 1000)

        future_inflation = inflation * (1 + 0.02)
        future_features = np.array([[next_year, cumulative_beneficiaries, future_inflation]])

        future_prediction = model.predict(future_features)[0]
        future_predictions.append({
            'year': next_year,
            'prediction': round(future_prediction, 2),
            'cumulative_beneficiaries': cumulative_beneficiaries
        })

    combined_predictions = [{
        'year': features[i][0],
        'prediction': round(predictions[i], 2),
        'cumulative_beneficiaries': features[i][1]
    } for i in range(len(features))] + future_predictions

    return jsonify(combined_predictions)

if __name__ == '__main__':
    app.run(debug=True, port=5000)
