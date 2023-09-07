# Dummy Data Generator To MySQL

# (c)2023 GESANG TECHNOLOGY

# Var :
# Tanggaljam ; suhu ; pH ; kelembaban
# Sortir berdasarkan tanggal terbaru

import random
import csv
import pandas as pd
from datetime import datetime, timedelta
import mysql.connector

# Function to generate a random datetime within a given range
def random_datetime(start_date, end_date):
    return start_date + timedelta(
        seconds=random.randint(0, int((end_date - start_date).total_seconds()))
    )

# Function to generate random data based on your criteria
def generate_data():
    tanggaljam = random_datetime(datetime(2023, 1, 1), datetime(2023, 12, 31))
    suhu = round(random.uniform(15, 35), 2)
    pH = round(random.uniform(0, 14), 1)
    kelembaban = round(random.uniform(30, 80), 1)

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

# Sort the DataFrame by the "tanggaljam" column
df = df.sort_values(by="tanggaljam", ascending=False)

# Establish a connection to the MySQL database
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="kopi"
)

# Create a cursor object to interact with the database
cursor = db_connection.cursor()

# Create a table to store the data (if it doesn't exist)
create_table_query = """
CREATE TABLE IF NOT EXISTS sensor_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggaljam DATETIME,
    suhu INT,
    pH INT,
    kelembaban INT
);
"""
cursor.execute(create_table_query)

# Reset the auto-increment ID to 1
#reset_id_query = "ALTER TABLE sensor_data AUTO_INCREMENT = 1;"
#cursor.execute(reset_id_query)

# Insert the sorted data from the DataFrame into the database
insert_query = "INSERT INTO sensor_data (tanggaljam, suhu, pH, kelembaban) VALUES (%s, %s, %s, %s)"
values = [tuple(row) for row in df.values]
cursor.executemany(insert_query, values)

# Commit the changes and close the cursor and database connection
db_connection.commit()
cursor.close()
db_connection.close()

print("Data has been saved to the MySQL database after sorting.")