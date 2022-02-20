from connector import connect_db, close_db
import csv

cnx = connect_db()

with open('files/equipos.csv') as csv_file:
    reader = csv.reader(csv_file, delimiter=';', lineterminator='\n')
    next(reader)

    cursor = cnx.cursor()

    for row in reader:
        data_equipo = (row[0], row[1], row[2], row[3])
        add_equipo = """INSERT INTO
            equipos (
                nombre,
                ciudad,
                conferencia,
                division) VALUES (%s,%s,%s,%s)"""

        try:
            cursor.execute(add_equipo, data_equipo)
        except mysql.connector.Error as err:
            if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
                print("Something is wrong with your user name or password")
            elif err.errno == errorcode.ER_BAD_DB_ERROR:
                print("Database does not exist")
            else:
                print(err)

cursor.close()
cnx.commit()
cnx.rollback()
close_db(cnx)
