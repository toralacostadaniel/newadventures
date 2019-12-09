import psycopg2
from datetime import datetime

try:
    connection = psycopg2.connect(
        user = "root",
        password = "",
        host = "localhost",
        port = "5432",
        database = "newadventures"
    )

    cursor = connection.cursor()

    cursor.execute("SELECT * FROM sensor_one ORDER BY id DESC")
    record = cursor.fetchone()
    if record is None:
        id = 0
    else:
        id = record[0]
    cursor.execute("INSERT INTO sensor_one VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", (id + 1, 15, 17, 22, 0, 1, -1, datetime.now().strftime('%Y/%m/%d %H:%M:%S'), datetime.now().strftime('%Y/%m/%d %H:%M:%S')))

    cursor.execute("SELECT * FROM sensor_two ORDER BY id DESC")
    record = cursor.fetchone()
    if record is None:
        id = 0
    else:
        id = record[0]
    cursor.execute("INSERT INTO sensor_two VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", (id + 1, 11, 14, 21, 1, 1, -1, datetime.now().strftime('%Y/%m/%d %H:%M:%S'), datetime.now().strftime('%Y/%m/%d %H:%M:%S')))

    cursor.execute("SELECT * FROM sensor_three ORDER BY id DESC")
    record = cursor.fetchone()
    if record is None:
        id = 0
    else:
        id = record[0]
    cursor.execute("INSERT INTO sensor_three VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", (id + 1, 12, 17, 20, 0, 0, 1, datetime.now().strftime('%Y/%m/%d %H:%M:%S'), datetime.now().strftime('%Y/%m/%d %H:%M:%S')))

    connection.commit()

except(Exception, psycopg2.Error) as error:
    print("Error while connecting to PostgreSQL ", error)

finally:
    if(connection):
        cursor.close()
        connection.close()
        print("PostgreSQL connection closed")
