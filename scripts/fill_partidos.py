from connector import connect_db, close_db
import csv

cnx = connect_db()

with open('files/partidos.csv') as csv_file:
    reader = csv.reader(csv_file, delimiter=";", lineterminator='\n')
    next(reader)

    cursor = cnx.cursor()

    for row in reader:
        data_partido = (row[0], row[1], row[2], row[3], row[4], row[5])
        add_partido = """INSERT INTO 
            partidos (
                codigo,
                equipo_local,
                equipo_visitante,
                puntos_local,
                puntos_visitante,
                temporada) VALUES (%s,%s,%s,%s,%s,%s)"""

        try:
            cursor.execute(add_partido, data_partido)
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
