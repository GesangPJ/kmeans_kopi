# Dummy Data Generator

# (c)2023 GESANG TECHNOLOGY

# Var :
# Tanggaljam ; suhu ; pH ; kelembaban
# Sortir berdasarkan tanggal terbaru

import random
import csv
import pandas as pd
from datetime import datetime, timedelta

# Function to generate a random datetime within a given range
def random_datetime(start_date, end_date):
    return start_date + timedelta(
        seconds=random.randint(0, int((end_date - start_date).total_seconds()))
    )

# Function to generate random data based on your criteria
def generate_data():
    tanggaljam = random_datetime(datetime(2023, 1, 1), datetime(2023, 12, 31))
    suhu = round(random.uniform(15, 35), 2)
    pH = round(random.uniform(0, 14), 2)
    kelembaban = round(random.uniform(30, 80), 2)

    if 5 <= pH <= 6.5 and 18 <= suhu <= 22:
        kondisi = "Baik"
    elif pH > 6.6 and 18 <= suhu <= 25:
        kondisi = "Sedang"
    elif pH < 5 and 18 <= suhu <= 25:
        kondisi = "Sedang"
    else:
        kondisi = "Buruk"

    return tanggaljam, suhu, pH, kelembaban

# Generate data
data = []
for _ in range(50):  # You can change the number of rows as needed
    data.append(generate_data())

# Create a pandas DataFrame from the generated data
df = pd.DataFrame(data, columns=["tanggaljam", "suhu", "pH", "kelembaban"])

# Sort the DataFrame by the "tanggaljam" column from newest to oldest
# To sort from oldest to newest, replace "ascending=False" with "ascending=True"
df = df.sort_values(by="tanggaljam", ascending=False)

# Save the DataFrame to an Excel file
df.to_excel("data/dummy_data.xlsx", index=False)

print("Dummy data has been generated and saved to dummy_data.xlsx.")