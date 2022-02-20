from connector import connect_db, close_db
import csv

cnx = connect_db()

with open('files/estadisticas.csv') as csv_file:
    reader = csv.reader(csv_file, delimiter=";", lineterminator='\n')
    next(reader)

    cursor = cnx.cursor()

    for row in reader:
        data_estadistica = (row[0], row[1], row[2], row[3], row[4], row[5])
        add_estadistica = """INSERT INTO
            estadisticas (
                temporada,
                jugador,
                puntos_por_partido,
                asistencias_por_partido,
                tapones_por_partido,
                rebotes_por_partido) VALUES (%s,%s,%s,%s,%s,%s)"""

        try:
            cursor.execute(add_estadistica, data_estadistica)
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
